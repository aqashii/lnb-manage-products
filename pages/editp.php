<form id="updateform" action="" method="POST">
    <div class="modal" tabindex="-1" id="editpModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row modal-body">
                    <p>Edit Product Detailes</p>
                    <div class=" col-md-6">
                        <label for="" class="form-label">Select Category</label>
                        <select type="text" name="p_category" class="form-control">
                            <option value="">--select--</option>
                            <?php foreach ($categories as $key => $value) { ?>
                                <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" col-md-6">
                        <label for="" class="form-label">Name</label>
                        <input type="text" value="<?= $value['name'] ?>" name="p_name" class="form-control" id="" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>


                    <!-- hidden fields -->

                    <input type="hidden" name="action" id="updateproduct" value="updateproduct">
                    <input type="hidden" name="productId" id="productId">

                </div>
            </div>
        </div>
    </div>
</form>