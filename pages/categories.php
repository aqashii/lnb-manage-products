<!-- search bar and addnew -->
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
            <?php include 'addCatForm.php' ?>
            <button data-bs-toggle="modal" data-bs-target="#addCategoryModal" id="AddNewBtn" class="btn btn-dark">
                Add New
            </button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="text-align: -webkit-center;">
<div class="demo">

    <div class="alert alert-success displaymessage d-none" role="alert" style="width: 80%;">
</div>
        </div>
    </div>

</div>
<!-- table of categories -->
<div class="container">
    <!-- modal includes -->
    <?php include 'editcat.php'; ?>
    <h3>Categories</h3>
    <div class="table-responsive">

        <table class="table" id="cat_table">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col" style="width: 5%;">SL-NO</th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>


                </tr>
            </thead>
            <tbody>
                <!-- table body of categories -->
            </tbody>
        </table>
    </div>
</div>
<!-- page nation -->
<nav aria-label="Page navigation example" id="pagination">
    <!-- <ul class="pagination justify-content-center">
            <li class="page-item disabled   "><a class="page-link" href="#">Previous</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul> -->
</nav>
<!-- hidden inputs -->
<input type="hidden" name="currentpage" value="1" id="currentpage">
<input type="hidden" name="thispage" id="thispage" value="category-page">

<!-- show message div -->
<div class="container">
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

</div>