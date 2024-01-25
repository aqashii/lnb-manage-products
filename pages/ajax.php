<?php

// include("class.php");
// $pdo = dbConfig::connect();
// $dbObj = new Product($pdo);
// print_r($_FILES);
// die;

$action = $_REQUEST['action'];
 
if (!empty($action)) {
    require_once 'class.php' ;
    $pdo = dbConfig::connect();
    $obj = new Product($pdo);
    
}
// adding product action

if ($action == 'addproduct' && !empty($_POST)) {
    $pname = $_POST['p_name'];
    $pcategory = $_POST['p_category'];
    $psize = $_POST['p_size'];
    $pquality = $_POST['p_quality'];
    $pcolor = $_POST['p_color'];
    $pdropstatus = $_POST['drop_status'];
    $pbroughtprice = $_POST['p_brought_price'];
    $psellchannel = $_POST['sell_channel'];
    $psellprice = $_POST['p_sell_price'];
    $psoldstatus = $_POST['sold_status'];
    $psoldprice = $_POST['p_sold_price'];
    $psolddate = $_POST['p_sold_date'];
    $pimage = $_FILES['p_photo'];

    // empty field checking 
    if($pdropstatus == "No"){
        $psellchannel = "";
    }
    if($psoldstatus == "No"){
        $psoldprice = 0;
        $psolddate = 0;
    }
    // var_dump($pimage['name']);
    // exit();

    $playerid = (!empty($_POST['productId'])) ? $_POST['productId'] : "";

    $imagename = "";
    if (!empty($pimage['name'])) {
        $imagename = $obj->uploadPhoto($pimage);
        $playerData = [
            'name' => $pname,
            'cat_id'=> $pcategory,
            'size'=> $psize,
            'quality_code'=> $pquality,
            'color'=> $pcolor,
            'drop_status'=> $pdropstatus,
            'brought_price'=> $pbroughtprice,
            'sell_channel'=> $psellchannel,
            'sell_price'=> $psellprice,
            'sold_status'=> $psoldstatus,
            'sold_price'=> $psoldprice,
            'sold_date'=> $psolddate,
            'photo'=> $imagename,
        ];
    }else{
        $playerData = [
            'name' => $pname,
            'cat_id'=> $pcategory,
            'size'=> $psize,
            'quality_code'=> $pquality,
            'color'=> $pcolor,
            'drop_status'=> $pdropstatus,
            'brought_price'=> $pbroughtprice,
            'sell_channel'=> $psellchannel,
            'sell_price'=> $psellprice,
            'sold_status'=> $psoldstatus,
            'sold_price'=> $psoldprice,
            'sold_date'=> $psolddate,   
        ];
        // var_dump($playerData);
    }
    // var_dump($playerData);
    // exit();
    if ($playerid) {
        $obj->update($playerData, $playerid, $tbName="products");
        $message = "Product Updated Successfully";
        
    }else{

        $playerid = $obj->add($playerData,$tbName="products");
        $message = "Product Added Successfully";
    }
    // echo $playerid ;

    if (!empty($playerid)) {
        $player = $obj->getRow('id',$playerid,$tbName='products');
        $player['message'] = $message ;
        echo json_encode($player);
        exit();
    }
    
}




// get count of function and getallproducts action
if ($action =='getallproducts') {
    $page=(!empty($_GET['page'])) ? $_GET['page']:1;
    $limit=4;
    //page =2
    //limit =4
    //start = 2-1=1 , 1*4 = ....4,5,6,7
    $start=($page-1)*$limit;

    $products = $obj->getRows($start,$limit,$tbName='products');
    if (!empty($products)) {
        // get category by id
        foreach ($products as $key => $value) {
            $catId = $value['cat_id'];
            $catName = $obj->getCategoryById($catId);
            if(!empty($catName)){

                $products[$key]['cat_id'] = $catName['name'];
            }else{
                $products[$key]['cat_id'] = "";
            }

        }
        // var_dump($products);
        $productlist = $products; 

    }else{
        $productlist = [];
    }
    // echo json_encode($productlist);
    $total = $obj->getCount($tbName='products');
    $prdArr=['count' => $total , 'players' => $productlist];
    //get category name by id


    echo json_encode($prdArr);
    exit();
}

// add category

if ($action == "addcategory" && !empty($_POST)) {
    $catName = $_POST['cname'];
    // echo $catName;

    $CatId = (!empty($_POST['catId'])) ? $_POST['catId'] :'';

    $playerData = [
        'name' => $catName,
    ];

    // checking request updation or insertion of category
    if (!empty($CatId)) {
        $obj->update($playerData,$CatId,$tbName="category");
    }else{
        
        $CatId = $obj->add($playerData,$tbName="category");
    }
    // echo $playerid ;

    if (!empty($CatId)) {
        $player = $obj->getRow('id',$CatId,$tbName='category');
        echo json_encode($player);
        exit();
    }
}
// action to perform edit category
if($action == "editcategory"){
    $CatId = (!empty($_GET['id'])) ? $_GET['id'] : "";

    if (!empty($CatId)) {

        $category = $obj->getRow('id',$CatId,$tbName='category');
        echo json_encode($category);
        exit();
        
    }
}
// action to perform deleting category
if ($action == "deletecategory") {
    $CatId = (!empty($_GET['id'])) ? $_GET['id'] : "";

    if(!empty($CatId)){
        $isdeleted = $obj->deleteRow($CatId,$tbName="category");
        if($isdeleted){
            $displaymessage = ['delete'=>1];

        }else{
            $displaymessage = ['delete'=>0];
        }
        echo json_encode($displaymessage);
        exit();
    }
    
}
if ($action == "getallcategories"){
    $page=(!empty($_GET['page'])) ? $_GET['page']:1;
    $limit=4;
    //page =2
    //limit =4
    //start = 2-1=1 , 1*4 = ....4,5,6,7
    $start=($page-1)*$limit;

    $categories = $obj->getRows($start,$limit,$tbName='category');

    if(!empty($categories)){
        $categorylist = $categories ;
    }else{
        $categorylist = [];
    }
    // echo json_encode($categorylist);
    $total = $obj->getCount($tbName='category');
    $catArr=['count' => $total , 'categories' => $categorylist];
    echo json_encode($catArr);
    exit();

}

// action to perform edit products
if($action == "editproduct"){
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : "";
    if (!empty($playerId)) {

        $product = $obj->getRow('id',$playerId,$tbName='products');
        $cat_id = $product['cat_id'];

        // var_dump($cat_id);
        $category = $obj->getRow('id',$cat_id,$tbName='category');
        if(!empty($category)){

            $product["cat_name"] = $category["name"];
        }else{
            $product["cat_name"] = "";
        }

        // var_dump($product);
        echo json_encode($product);
        exit();
        
    }
}

// action to perform delete row
if ($action == "deleteproduct"){
    $productId = (!empty($_GET['id'])) ? $_GET['id'] : "";
    
    if(!empty($productId)){
        $isdeleted = $obj->deleteRow($productId,$tbName="products");
        if($isdeleted){
            $displaymessage = ['delete'=>1];

        }else{
            $displaymessage = ['delete'=>0];
        }
        echo json_encode($displaymessage);
        exit();
    }
}

// action to perform searching products
if ($action == "searchproduct") {
    $queryString = (!empty($_GET['searchQuery'])) ? trim($_GET['searchQuery']) : '';
    $results = $obj->searchProduct($queryString,$start=0,$limit=4,$tbName="products");
    echo json_encode($results);
    exit();
}



?>