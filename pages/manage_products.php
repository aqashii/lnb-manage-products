<?php

include("class.php");

$pdo = dbConfig::connect();
$dbObj = new database($pdo);

$categories = $dbObj->getCategory();


$getAllproducts = $dbObj->displayAllproducts();
// $cattt = '101';
// $getCategoryById = $dbObj->getCategoryById($cattt);

// echo $getCategoryById[0]['name'];


?>
<div class="container py-2">


    <div class="row mb-3">
        <div class="col-10">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text
                     bg-dark"><i class="fa-solid text-light
                      fa-magnifying-glass"></i></span>
                </div>
                <input type="text" name="" id="searchinput" class="form-control" placeholder="Search product...">
            </div>
        </div>
        <div class="col-2">
    <?php include 'addForm.php' ?>
           <button data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-dark" id="addNewBtn">
                Add New
            </button>
        </div>
    </div>
    <div class="alert text-center alert-success displaymessage d-none" role="alert">
      
    </div>
</div>
<div class="container mt-5">
        <!-- modal includes -->
    <?php include 'viewp.php' ?>
    <?php include 'editp.php' ?>
    <div class="table-responsive">
    <table class="table" id="ptable">
        <thead class="table-dark text-center">
            <tr>
                <!-- <th scope="col">ID</th> -->
                <th scope="col">Photo</th>
                <th scope="col">Name</th>
                <th scope="col">Category Name</th>
                <th scope="col">Size</th>
                <th scope="col">Quality Code</th>
                <th scope="col">Color</th>
                <th scope="col">Drop Status</th>
                <th scope="col">Sell Channel</th>
                <th scope="col">Brought Price</th>
                <th scope="col">Sell Price</th>
                <th scope="col">Sold Status</th>
                <th scope="col">Sold Price</th>
                <th scope="col">Sold Date</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
<!-- table body of all products -->
        </tbody>
    </table>
    </div>
    <!-- page nation -->
    <nav aria-label="Page navigation example" id="pagination">
        <!-- <ul class="pagination justify-content-center">
            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul> -->
    </nav>

    <!-- hidden input fields -->
    <input type="hidden" name="currentpage" value="1" id="currentpage" >
    <input type="hidden" name="thispage" id="thispage" value="manage-product" >
</div>

