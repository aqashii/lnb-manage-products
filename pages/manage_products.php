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
                <input type="text" name="" id="" class="form-control" placeholder="Search product...">
            </div>
        </div>
        <div class="col-2">
           <a href="./?page=addproduct"><button  class="btn btn-dark">
                Add New
            </button></a> 
        </div>
    </div>
</div>

<div class="container mt-5">
        <!-- modal includes -->
    <?php include 'viewp.php' ?>
    <?php include 'editp.php' ?>
    <table class="table" id="ptable">
        <thead class="table-dark text-center">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Category Name</th>
                <th scope="col">Name</th>
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
            <!-- Add your table data rows here -->
            <!-- foreach loop for display all products -->
            <?php foreach ($getAllproducts as $key => $value) {

                $getNames = $dbObj->getCategoryById($value['cat_id']);

                //check category null or not
                if ($getNames == null) {
                    $catName = "<div class='text-danger'>Category Not Found</div>";
                } else {
                    $catName = $getNames['name'];
                }

                //class for text colors
                if ($value['sold_status'] == 'Yes') {
                    $classBg1 = "text-success";
                } else {
                    $classBg1 = "text-warning";
                }

                if ($value['drop_status'] == 'Yes') {
                    $classBg2 = "text-success";
                } else {
                    $classBg2 = "text-warning";
                }

            ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $catName ?></td>
                    <td><?= $value['name'] ?></td>
                    <td><?= $value['size'] ?></td>
                    <td><?= $value['quality_code'] ?></td>
                    <td><?= $value['color'] ?></td>
                    <td class="<?= $classBg2 ?>"><?= $value['drop_status'] ?></td>
                    <td><?= $value['sell_channel'] ?></td>
                    <td><?= $value['brought_price'] ?></td>
                    <td><?= $value['sell_price'] ?></td>
                    <td class="<?= $classBg1 ?>"><?= $value['sold_status'] ?></td>
                    <td><?= $value['sold_price'] ?></td>
                    <td><?= $value['sold_date'] ?></td>
                    <td>
                        <a href="#" class="me-3 viewp"  
                        data-bs-target="#viewpModal" title="View" data-bs-toggle="modal"><i class="fa-solid fa-eye text-success"></i></a>
                        <a href="#" 
                        data-bs-toggle="modal" data-bs-target="#editpModal" 
                        class="me-3 editp" title="Edit" ><i class="fa-solid fa-pen-to-square text-info"></i></a>
                        <a href="#" class="me-3 deletep" title="Delete" ><i class="fa-solid fa-trash-can text-danger"></i></a>

                    </td>

                </tr>
            <?php } ?>
            <!-- End foreach loop -->
        </tbody>
    </table>

    <!-- page nation -->
    <nav aria-label="Page navigation example" id="pagination">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</div>

