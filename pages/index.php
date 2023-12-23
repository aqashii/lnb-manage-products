<?php



if ($_GET['page'] == 'addproduct') {
    include("add_product.php");
}

if ($_GET['page'] == 'categories') {
    include("categories.php");
}
if ($_GET['page'] == 'manageproduct') {
    include("manage_products.php");
}