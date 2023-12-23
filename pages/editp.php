<form id="updateform" action="" method="POST">
    <div class="modal" tabindex="-1" id="editpModal" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Edit Product Detailes</p>
                    
                    <input type="text" name="pname" id="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button"  class="btn btn-primary">Save</button>
    
                    <!-- hidden fields -->
    
                    <input type="hidden" name="action" id="updateproduct" value="updateproduct">
                    <input type="hidden" name="productId" id="productId">
                    
                </div>
                </form>
            </div>
        </div>
    </div>


<script src="assets/js/script.js" >

</script>
