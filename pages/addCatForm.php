    <!-- Modal for Add Category -->
    <form id="addCatForm" action="" method="POST">
        <div class="modal" id="addCategoryModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <input name="cname" type="text" class="form-control" id="cname" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>

                        <!-- hidden input fields -->
                        <input type="hidden" id="addcategory" value="addcategory" name="action">
                        <input type="hidden" name="catId" id="catId" value="">

                    </div>
                </div>
            </div>
        </div>
    </form>