<?php

include("class.php");



$pdo = dbConfig::connect();
$dbObj = new database($pdo);

$categories = $dbObj->getCategory();

//upload image to product_images

    if (isset($_FILES["p_image"])) {
        $uploadPath = "p_images/";
        $uploadImage = $uploadPath . basename($_FILES["p_image"]["name"]);
        if (move_uploaded_file($_FILES["p_image"]["temp_name"], $uploadImage)) {
            echo "uploaded";
        } else {
            echo "upload was error";
        }
    }



if (isset($_POST["submit"])) {
    $pname = $_POST["p_name"];
    $pcategory = $_POST["p_category"];
    $psize = $_POST["p_size"];
    $pquality = $_POST["p_quality"];
    $pcolor = $_POST["p_color"];
    $dropstatus = $_POST["drop_status"];
    $sellchannel = $_POST["sell_channel"];
    $broughtprice = $_POST["brought_price"];
    $sellprice = $_POST["sell_price"];
    $soldstatus =   $_POST["sold_status"];
    $soldprice  = $_POST["sold_price"];
    $solddate = $_POST["sold_date"];
    if (
        $pname != '' && $pcategory != '' && $psize != '' && $pquality != ''
        && $pcolor != '' && $dropstatus != ''
        && $sellchannel != '' && $broughtprice != ''
        && $sellprice != '' && $soldstatus != ''
    ) {
        $dbObj->insertProduct(
            $pname,
            $pcategory,
            $psize,
            $pquality,
            $pcolor,
            $dropstatus,
            $sellchannel,
            $broughtprice,
            $sellprice,
            $soldstatus,
            $soldprice,
            $solddate
        );
    } else {
        echo "cannot empty fields";
    }
}


?>
<div class="container p-5">
    <div class="row">
        <h3>Add Product</h3>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" name="p_name" class="form-control" id="" required>

        </div>
        <div class="mb-3">
            <label for="" class="form-label">Select Category</label>
            <select type="text" name="p_category" class="form-control">
                <option value="">--select--</option>
                <?php foreach ($categories as $key => $value) { ?>
                    <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                <?php } ?>
            </select>

        </div>

        <div class="mb-3">
            <label for="" class="form-label">Image</label>
            <input type="file" name="p_image" class="form-control" id="imageInput">
            <br>
            <a id="uploadimg" class="btn btn-primary">Upload</a>

        </div>


        <div class="mb-3">
            <label for="" class="form-label">Size</label>
            <input type="text" name="p_size" class="form-control" id="">


        </div>
        <div class="mb-3">
            <label for="" class="form-label">Quality Code</label>
            <select type="text" name="p_quality" class="form-control">
                <option value="">--select--</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>

            </select>

        </div>
        <div class="mb-3">
            <label for="" class="form-label">Color</label>
            <input type="text" name="p_color" class="form-control" id="">

        </div>
        <div class="mb-3">
            <label for="" class="form-label">Drop Status</label>
            <select type="text" name="drop_status" class="form-control">
                <option value="">--select--</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>

            </select>

        </div>

        <div class="mb-3">
            <label for="" class="form-label">Sell Channel</label>
            <select type="text" name="sell_channel" class="form-control">
                <option value="">--select--</option>
                <option value="instagram">Instagram</option>
                <option value="facebook">Facebook</option>
                <option value="mannual">Mannual</option>
                <option value="others">Others</option>



            </select>

        </div>
        <div class="mb-3">
            <label for="" class="form-label">Brought Price (AED)</label>
            <input name="brought_price" type="text" class="form-control" id="" required>

        </div>

        <div class="mb-3">
            <label for="" class="form-label">Sell Price</label>
            <input name="sell_price" type="text" class="form-control" id="">

        </div>
        <div class="mb-3">
            <label for="" class="form-label">Sold Status</label>
            <select type="text" id="soldstatus" name="sold_status" class="form-control">
                <option value="">--select--</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>

            </select>

        </div>
        <div class="mb-3" id="soldPricediv">
            <label for="" class="form-label">Sold Price</label>
            <input name="sold_price" type="text" class="form-control" id="">

        </div>

        <div class="mb-3" id="soldDatediv">
            <label for="" class="form-label">Sold Date</label>
            <input name="sold_date" type="text" class="form-control" id="">

        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</div>


<script>
    //check sold status 
    $(document).ready(function() {
            $('#soldstatus').change(function() {
                var selectedVal = $(this).val();
                if (selectedVal == 'Yes') {

                    $('#soldPricediv , #soldDatediv').show();


                } else {
                    $('#soldPricediv , #soldDatediv').hide();
                }
            });

        });
</script>