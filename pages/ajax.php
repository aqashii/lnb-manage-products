<?php

include("class.php");
$pdo = dbConfig::connect();
$dbObj = new database($pdo);
// print_r($_REQUEST);
// die;
$action = $_REQUEST['action'];

// get count of function and getallproducts action
if ($action =='getallproducts') {
    $page=(!empty($_GET['page'])) ? $_GET['page']:1;
    $limit=4;
    //page =2
    //limit =4
    //start = 2-1=1 , 1*4 = ....4,5,6,7
    $start=($page-1)*$limit;

    $products = $dbObj->getRows($start,$limit);
    if (!empty($products)) {
        $productlist = $products;  
    }else{
        $productlist = [];
    }
    $total = $dbObj->getCount();
    $prdArr=['count'=>$total,'products'=>$productlist];
    echo json_encode($productlist);
    exit();
}



?>