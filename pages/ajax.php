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
    }
    $playerid = $obj->add($playerData);
    // echo $playerid ;

    if (!empty($playerid)) {
        $player = $obj->getRow('id',$playerid,$tbName='product');
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
        $productlist = $products;  
    }else{
        $productlist = [];
    }
    // echo json_encode($productlist);
    $total = $obj->getCount($tbName='products');
    $prdArr=['count' => $total , 'players' => $productlist];
    echo json_encode($prdArr);
    exit();
}



?>