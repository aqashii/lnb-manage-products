<form id="addform" action="" method="POST" enctype="multipart/form-data" >
    <div class="modal" tabindex="-1" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row modal-body">
                    <p>Add or Edit Product Detailes</p>
                    <div class=" col-md-6">
                        <label for="" class="form-label">Name</label>
                        <input type="text" value="" name="p_name" class="form-control" id="p_name" required>
                    </div>
                    <div class=" col-md-6">
                        <label for="" class="form-label">Select Category</label>
                        <select type="text" id="p_category" name="p_category" class="form-control">
                            <option value="">--select--</option>
                            <?php foreach ($categories as $key => $value) { ?>
                                <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" col-md-6">
                        <label for="" class="form-label">Size</label>
                        <input type="text" value="" name="p_size" class="form-control" id="p_size" required>
                    </div>
                    <div class=" col-md-6">
                        <label for="" class="form-label">Quality code</label>
                        <select type="text" id="p_quality" name="p_quality" class="form-control">
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
                    <div class=" col-md-6">
                        <label for="" class="form-label">Color</label>
                        <input type="text" value="" name="p_color" class="form-control" id="p_color" required>
                    </div>
                    <div class=" col-md-6">
                        <label for="" class="form-label">Drop status</label>
                        <select type="text" id="dropstatus" name="drop_status" class="form-control">
                            <option value="No">--select--</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    
                    <div class=" col-md-6">
                        <label for="" class="form-label">Brought price (AED)</label>
                        <input type="text" value="" name="p_brought_price" class="form-control" id="p_brought_price" required>
                    </div>
                    <div class=" col-md-6" id="sellchanneldiv" >
                        <label for="" class="form-label">Sell channel</label>
                        <select type="text" id="sell_channel" name="sell_channel" class="form-control">
                            <option value="">--select--</option>
                            <option value="instagram">Instagram</option>
                            <option value="facebook">Facebook</option>
                            <option value="mannual">Mannual</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                    <div class=" col-md-6">
                        <label for="" class="form-label">Sell price</label>
                        <input type="text" value="" name="p_sell_price" class="form-control" id="p_sell_price" required>
                    </div>
                    <div class=" col-md-6">
                        <label for="" class="form-label">Sold status</label>
                        <select type="text" id="soldstatus" name="sold_status" class="form-control">
                            <option value="">--select--</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class=" col-md-6" id="soldPricediv" >
                        <label for="" class="form-label">Sold price</label>
                        <input type="text" value="" name="p_sold_price" class="form-control" id="p_sold_price">
                    </div>
                    <div class=" col-md-6" id="soldDatediv" >
                        <label for="" class="form-label">Sold date</label>
                        <input type="text" value="" name="p_sold_date" class="form-control" id="p_sold_date">
                    </div>
                    <div class=" col-md-12">
                        <label for="" class="form-label">Product Image</label>
                        <input type="file" value="" name="p_photo" class="form-control" id="">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>


                    <!-- hidden input fields -->

                    <input type="hidden" name="action" id="addproduct" value="addproduct">
                    <input type="hidden" name="productId" id="productId" value="">

                </div>
            </div>
        </div>
    </div>
</form>
<script>
   
    $(document).ready(function() {
        //check sold_status
            $('#soldstatus').change(function() {
                var selectedVal = $(this).val();
                if (selectedVal == 'Yes') {
                    $('#soldPricediv , #soldDatediv').show();
                } else {
                    $('#soldPricediv , #soldDatediv').hide();
                }
            });
            //check drop status
            $('#dropstatus').change(function() {
                var selectedVal2 = $(this).val();
                if(selectedVal2 == 'Yes'){
                    $('#sellchanneldiv').show();
                }else{
                    $('#sellchanneldiv').hide();
                }
            });

        });
</script>