<?php
include("database.php");


$pdo = dbConfig::connect();
$dbObj = new database($pdo);

//extracting all post requests
extract($_POST);
//Deleting category
if (isset($_POST["cid"])) {
    $cid = $_POST["cid"];
    $dbObj->deleteCategory($cid);
}
//add category
if (isset($_POST["catname"])) {
    $cname = $_POST["catname"];
    $dbObj->addCategory($cname);
}
//Edit category
if (isset($_POST["ucid"]) && isset($_POST["ucname"])) {
    $ucid = $_POST["ucid"];
    $ucname = $_POST["ucname"];

    $dbObj->editCategory($ucid, $ucname);
}

class database
{
    protected $pdo = null;
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function getCategory()
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getCategoryById($catid)
    {
        $query = "SELECT name FROM `categories` WHERE `id` = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $catid, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result !== false) {
                return $result;
            } else {
                return $result = "";
            }
        } else {
            $errorInfo = $stmt->errorInfo();
            echo $errorInfo[2];
        }
    }
    function deleteCategory($cid)
    {


        $query = "DELETE FROM `categories` WHERE `id` = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $cid, PDO::PARAM_INT);
        // $stmt->execute();
        if ($stmt->execute()) {
            header("Location:../?page=categories");
        } else {
            $errorInfo = $stmt->errorInfo();
            echo $errorInfo[2];
        }
    }
    function editCategory($cid, $cname)
    {

        $query = "UPDATE `categories` SET `name`= ? WHERE `id` = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $cname, PDO::PARAM_STR);
        $stmt->bindParam(2, $cid, PDO::PARAM_INT);

        // $stmt->execute();
        if ($stmt->execute()) {
            header("Location:../?page=categories");
            exit();
        } else {
            $errorInfo = $stmt->errorInfo();
            echo $errorInfo[2];
        }
    }


    function addCategory($cname)
    {


        $query = "INSERT INTO `categories`(`name`) VALUES (?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $cname, PDO::PARAM_STR);
        // $stmt->execute();
        if ($stmt->execute()) {
            header("Location:../?page=categories");
        } else {
            $errorInfo = $stmt->errorInfo();
            echo $errorInfo[2];
        }
    }

    function insertProduct($pname, $pcategory, $psize, $pquality, $pcolor, $dropstatus, $sellchannel, $broughtprice, $sellprice, $soldstatus, $soldprice, $solddate)
    {
        $query = "INSERT INTO `lb_products`(`cat_id`, `name`, `size`, `quality_code`, `color`, `drop_status`,
         `sell_channel`, `brought_price`, `sell_price`,
         `sold_price`, `sold_status`, `sold_date`)
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $pcategory, PDO::PARAM_STR);
        $stmt->bindParam(2, $pname, PDO::PARAM_STR);
        $stmt->bindParam(3, $psize, PDO::PARAM_STR);
        $stmt->bindParam(4, $pquality, PDO::PARAM_STR);
        $stmt->bindParam(5, $pcolor, PDO::PARAM_STR);
        $stmt->bindParam(6, $dropstatus, PDO::PARAM_STR);
        $stmt->bindParam(7, $sellchannel, PDO::PARAM_STR);
        $stmt->bindParam(8, $broughtprice, PDO::PARAM_STR);
        $stmt->bindParam(9, $sellprice, PDO::PARAM_STR);
        $stmt->bindParam(10, $soldprice, PDO::PARAM_STR);
        $stmt->bindParam(11, $soldstatus, PDO::PARAM_STR);
        $stmt->bindParam(12, $solddate, PDO::PARAM_STR);

        // $stmt->execute();
        if ($stmt->execute()) {
            header("Location:./?page=manageproduct");
        } else {
            $errorInfo = $stmt->errorInfo();
            echo $errorInfo[2];
        }
    }

    function displayAllproducts()
    {
        $query = "SELECT * FROM `lb_products`";
        $stmt = $this->pdo->prepare($query);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }



    public function update($data, $id)
    {
        $sql = "UPDATE `lb_products` SET ";
    }
}


class Product
{
    protected $tableProducts = "lb_products";
    protected $tableCategories = "categories";
    protected $pdo = NULL ;
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    // function to add products
    public function add($data,$tbName)
    {
        if ($tbName == "products") {
            $tbName = "lb_products";
        }else if($tbName == "category") {
            $tbName = "categories";
        }
        if (!empty($data)) {
            $fields = $placeholder = [];
            foreach ($data as $field => $value) {
                $fields[] = $field;
                $placeholder[] = ":{$field}";
                
            }
            // var_dump($placeholder);
        }
        // $sql = "INSERT INTO {$this->tableProducts} (`cat_id`, `name`, `size`, `quality_code`, `color`, `drop_status`,
        // `sell_channel`, `brought_price`, `sell_price`,
        // `sold_price`, `sold_status`, `sold_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $sql = "INSERT INTO {$tbName} (". implode(',',
            $fields) .") VALUES (". implode(',',$placeholder).")";
            // var_dump($sql);
            $stmt = $this->pdo->prepare($sql);
            try{
                $this->pdo->beginTransaction();
                // var_dump($data);
                $stmt->execute($data);
                $lastInsertedId = $this->pdo->lastInsertId();
                $this->pdo->commit();
                return $lastInsertedId;

            }catch (PDOException $e) {
                echo "Error ". $e->getMessage();
                $this->pdo->rollback();
            }

    }

    //function to get rows
    public function getRows($start,$limit,$tbName)
    {
        // $tableName = $tbName;
        if ($tbName == "products") {
            $tbName = "lb_products";
        }else if($tbName == "category") {
            $tbName = "categories";
        }
        $sql = "SELECT * FROM {$tbName} ORDER BY
        `id` DESC LIMIT {$start},{$limit} ";
        // var_dump($sql);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }
        return $results;
    }
    //function to get single row
    public function getRow($field,$value,$tbName){
        $tableName = $tbName;
        if ($tableName == "products") {
            $tableName = "lb_products";
        }else if($tableName == "category") {
            $tableName = "categories";
        }
        $sql = "SELECT * FROM {$tableName} WHERE 
        {$field} = :{$field}";
        // var_dump($sql);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":{$field}" => $value]);
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }
    //function to count no.of rows
    public function getCount($tbName)
    {
        $tableName = $tbName;
        if ($tableName == "products") {
            $tableName = "lb_products";
        }else if($tableName == "category") {
            $tableName = "categories";
        }
        $sql = "SELECT count(*) as pcount FROM 
        {$tableName}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pcount'];
    }
    //function to upload photo
    public function uploadPhoto($file){
        if (!empty($file)) {
            $fileTempPath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileType = $file['type'];
            $fileNameCmps = explode('.',$fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $newFileName = md5(time().$fileName).'.'.$fileExtension;
            $allowedExtn = ["png","jpg","jpeg"];

            if (in_array($fileExtension,$allowedExtn)) {
                $uploadFileDir = "../uploads/";
                $destFilePath = $uploadFileDir . $newFileName ;
                if (move_uploaded_file($fileTempPath,$destFilePath)) {
                    return $newFileName;
                }
            }
        }

    }
    // get category By Id
    function getCategoryById($catid)
    {
        $query = "SELECT name FROM `categories` WHERE `id` = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $catid, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result !== false) {
                return $result;
            } else {
                return $result = "";
            }
        } else {
            $errorInfo = $stmt->errorInfo();
            echo $errorInfo[2];
        }
    }
    //function to update
    public function update($data,$id,$tbName){

        if ($tbName == "products") {
            $tbName = "lb_products";
        }else if($tbName == "category") {
            $tbName = "categories";
        }

        if(!empty($data)){
            $fields = "";
            $x = 1;
            $fieldsCount = count($data);
            foreach($data as $field=>$value){
                $fields.= "{$field}=:{$field}";
                if($x<$fieldsCount){
                    $fields.= ",";
                }
                $x++;

            }
        }
        // var_dump($fields);
        // exit();

        $sql = "UPDATE {$tbName} SET {$fields} where id=:pid";
        $stmt = $this->pdo->prepare($sql);
        // var_dump($sql);
        // exit();
        try{
            $this->pdo->beginTransaction();
            $data['pid'] = $id;
            // var_dump($data);
            // exit();
            $stmt->execute($data);
            $this->pdo->commit();
        }catch (PDOException $e) {
            error_log("Error ". $e->getMessage());
            $this->pdo->rollback();
        }

    }

    //function to delete
    public function deleteRow($id,$tbName){
        if ($tbName == "products") {
            $tbName = "lb_products";
        }else if($tbName == "category") {
            $tbName = "categories";
        }

        $sql = "DELETE FROM {$tbName} WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        // var_dump($sql);
        // exit();
        try{
           $stmt->execute([':id'=>$id]);
           if($stmt->rowCount()>0){
            return true;
           }
        }catch (PDOException $e) {
            error_log("Error ". $e->getMessage());
            return false;
        }
    }
    //function to search

    public function searchProduct($searchText,$start,$limit,$tbName){

        if ($tbName == "products") {
            $tbName = "lb_products";
        }else if($tbName == "category") {
            $tbName = "categories";
        }

        $sql = "SELECT * FROM {$tbName} WHERE name LIKE :search ORDER BY id DESC LIMIT {$start},{$limit}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':search'=>"{$searchText}%"]);

        if ($stmt->rowCount()>0) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $result = [];
        }

        return $result;
    }

}
?>