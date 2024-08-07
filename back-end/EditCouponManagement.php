

                  

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editCouponModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editCouponModalLabel">Edit Coupon</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="../includes/add-coupon.inc.php" method="post">
                          <div class="form-group">
                              <label for="editOfferName">Offer Name</label>
                              <input required type="text" class="form-control editOfferName" id="editOfferName" name="editOfferName" value="" placeholder="Enter offer name">
                          </div>
                          <div class="form-group">
                              <label for="editDiscount">Discount (%)</label>
                              <input required type="text" class="form-control editDiscount" id="editDiscount" name="editDiscount" value ="" placeholder="Enter discount price">
                          </div>
                          <div class="form-group">
                              <label for="editDiscount">Quantity</label>
                              <input required type="text" class="form-control editQuantity" id="editQuantity" name="editQuantity" value ="" placeholder="Enter quantity">
                          </div>
                          <div class="form-group">
                              <label for="editStartTime">Start Time</label>
                              <input required type="datetime-local" class="form-control StartTime" id="editStartTime" name="editStartTime" value ="">
                          </div>
                          <div class="form-group">
                              <label for="editEndTime">End Time</label>
                              <input required type="datetime-local" class="form-control EndTime" id="editEndTime" name="editEndTime" value ="">
                          </div>
                          <input type="hidden" id="coupon_id_holder">
                          <div class="modal-footer">
                              <!-- Inside your table loop where you output coupon data -->
                              <td>
                                  <button type="button" class="btn edit-button" name="ConfirmButton" id="btn_update_coupon" data-toggle="modal" data-target="#confirmationModal">Update</button>
                                  <button type="button" class="btn" style="background-color: #dc3545; border-color: #dc3545; color: #ffffff;" data-dismiss="modal" >Close</button>
                              </td> 

                        
                          </div>

                          <!-- Confirmation Modal -->
                            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Coupon</h5>
                                        <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to have changes?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="save_update_coupon" name ="updateButton">Save changes</button>

                                    </div>
                                    </div>
                            </div>
                        </div>
                          
                      </form>
                  </div>
              </div>
          </div>
      </div>


   

<script>
    $(document).ready(function(){

        let coupon_id;
        let coupon_name;
        let discount;
        let quantity;
        var starttime;
        var endtime;

        $("#btn_update_coupon").click(function(){
            coupon_id = $("#btn_update_coupon").val();
            coupon_name =  $("#editOfferName").val();
            discount =  $("#editDiscount").val();
            quantity = $("#editQuantity").val();
            starttime = $("#editStartTime").val();
            endtime = $("#editEndTime").val();
            console.log(endtime);
        });

        $("#save_update_coupon").click(function(){

            $.ajax({
                type: 'POST',
                url: '../includes/add-coupon.inc.php',
                data: {
                    coupon_name: coupon_name,
                    discount: discount,
                    quantity: quantity,
                    starttime: starttime,
                    endtime: endtime,
                    coupon_id : coupon_id
                },
                success: function(response){

                    window.location.href = 'CouponManagement.php';
                },
                error: function(error){
                    console.log("error has occured: " + error);
                }
            });
        });

    });
</script>


