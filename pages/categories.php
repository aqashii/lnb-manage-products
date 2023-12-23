<?php
include("class.php");

$pdo = dbConfig::connect();
$dbObj = new database($pdo);

$categories = $dbObj->getCategory();




?>
<div class="container">
    <h3>Categories</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $key => $value) {
            ?>
                <tr>



                    <th scope="row"><?= $value['id'] ?></th>
                    <td><?= $value['name'] ?>
                        <!-- Modal for Edit Category -->
                        <div class="modal fade" id="editCategoryModal<?= $value['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Category Name</label>
                                            <input value="<?= $value['name'] ?>" type="text" class="form-control" id="ucname<?= $value['id'] ?>" required>

                                            <div id="check-validation" style="display: none;">
                                                Please provide name!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="btn-add" onclick="editCategory(cid = '<?= $value['id']; ?>');" data-bs-dismiss="" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>



                    <td><button id="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#editCategoryModal<?= $value['id'] ?>" class="btn btn-primary">Edit</button>
                        <button data-bs-target="#delconfirmbox<?= $value['id'] ?>" data-bs-toggle="modal" id="delete" type="button" class="btn btn-danger">Delete</button>
                        <!-- Delete Confirmation box modal -->
                        <div class="modal" tabindex="-1" id="delconfirmbox<?= $value['id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirm Now</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you want to delete...?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <button type="button" onclick="delCategory(<?= $value['id'] ?>)" class="btn btn-primary">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>


                </tr>
            <?php } ?>

        </tbody>
    </table>


</div>
<div class="container">
    <h4>Add Category</h4>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        Add new
    </button>

    <!-- Modal for Add Category -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input name="cname" type="text" class="form-control" id="cname" required>

                        <div id="check-validation" style="display: none;">
                            Please provide name!
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn-add" onclick="addCategory()" data-bs-dismiss="" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    <div class="alert alert-success d-flex d-none align-items-center my-2" id="successMessage" role="alert">

    </div>



</div>
<script>
    //Page reload function
    function onReload() {

        window.location.reload();

    }
    //Show success message function
    function successMessage(message) {

        var showSuccess = document.getElementById('successMessage');

        showSuccess.classList.toggle('d-none', false);
        showSuccess.innerHTML = `<svg class="bi flex-shrink-0 me-2 " width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
            ${message}
        </div>`;

        setTimeout(function() {

            showSuccess.classList.add('d-done');

        }, 3000);

    }
    //Add category to database
    function addCategory() {

        var cname = $('#cname').val();
        if (cname != '') {

            $.ajax({
                type: "post",
                url: "pages/class.php",
                data: {
                    catname: cname
                },
                success: function(data, status) {
                    // console.log(status);
                    $('#addCategoryModal').modal('hide');

                    successMessage('Category added success');
                    setTimeout(function() {

                        onReload();
                    }, 2000);

                }
            });
        } else {
            $('#check-validation').css({
                'display': 'block',
                'color': 'red'
            })

        }

    }
    //Delete Category
    function delCategory(cid) {
        var catid = cid;

        $.ajax({
            type: "post",
            url: "pages/class.php",
            data: {
                cid: catid
            },
            success: function(data, status) {
                $('#delconfirmbox' + catid).modal('hide');
                successMessage('Category deleted success');
                setTimeout(function() {

                    onReload();
                }, 2000);
            }

        })
    }

    //Edit category function
    function editCategory(cid) {
        // alert(id);
        var ucatid = cid;
        var ucname = $('#ucname' + ucatid).val();
        if (ucname != '') {

            $.ajax({
                type: 'post',
                url: 'pages/class.php',
                data: {
                    ucid: ucatid,
                    ucname: ucname

                },
                success: function(data, status) {
                    // console.log(data)
                    $('#editCategoryModal' + ucatid).modal('hide');
                    successMessage('Category updated success');
                    setTimeout(function() {

                        onReload();
                    }, 3000);

                }
            })
        } else {
            $('#check-validation').css({
                'display': 'block',
                'color': 'red'
            })
        }
    }
</script>