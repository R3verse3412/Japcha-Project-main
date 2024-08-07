

<div class="modal fade" id="changeAddressModal" tabindex="-1" role="dialog" aria-labelledby="changeAddressModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                    <h5 class="modal-title" id="changeModalLabel"><i class="uil uil-map-marker" style="color: #707070; left: 0;"></i> Change Delivery Address </h5>
                                    <button type="button" class="close" id="close_address_modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">

                                        <input type="text" class="form-control" id="Block_myProfile" placeholder="Block" name="address" value="<?= $customer_date["customer_address"]?>" required />
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="Postal_myProfile" placeholder="Postal Code" name="Postal" value="<?= $customer_date["postal_code"]?>"  required />
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="City_myProfile" placeholder="City" name="City" value="<?= $customer_date["city"]?>"  required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" id="Region_myProfile" placeholder="Region" name="Region" value="<?= $customer_date["region"]?>"  required />
                                    </div>

                                    <div
                                     class="alert alert-danger" id="InvalidInput" role="alert" style="display: none;">
                                    </div>
                                    
                                    <div
                                     class="alert alert-success" id="SuccessInput" role="alert" style="display: none;">
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="change_address">Save</button>
                                </div>
                            </div>
                        </div>
    </div>

    <script src="assets/js/CustomerChangeAddress.js"></script>

