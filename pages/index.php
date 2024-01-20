<?php


if(empty($_GET)){
    header("Location:?page=manageproduct");

}

else if ($_GET['page'] == 'addproduct') {
    include("add_product.php");
}

else if ($_GET['page'] == 'categories') {
    include("categories.php");
}
else if ($_GET['page'] == 'manageproduct') {
    include("manage_products.php");
}else{
    include("manage_products.php"); 
    
}