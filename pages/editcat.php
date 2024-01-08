<form id="updateCatform" action="" method="POST">
    <div class="modal" tabindex="-1" id="editCatModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row modal-body">
                    <p>Edit Product Detailes</p>
                    <div class=" col-md-6">
                        <label for="" class="form-label">Name</label>
                        <input type="text" value="" name="cat_name" class="form-control" id="" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>


                    <!-- hidden fields -->

                    <input type="hidden" name="action" id="updatecategory" value="updatecategory">
                    <input type="hidden" name="catId" id="catId">

                </div>
            </div>
        </div>
    </div>
</form>