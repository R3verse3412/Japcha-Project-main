<?php
    include "adminHeader.php";
?>

<?php
include "../classes/dbh.classes.php";
include "../classes/CouponModel.php";
$coupon = new CouponModel();
$getDiscount = $coupon->getAllDiscountSenior();
?>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
<style>
    .table_container{
        justify-content: start !important;
    }
</style>
  <div class="container" style="width: 100%; padding-left: 200px;  margin-top: 80px;">
    <div class="row">
      <h2 class="mb-0 mr-1">Discount Management</h1>
    </div>

    <div class="table-responsive mt-4">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th></th>
            <!-- <th>Coupon Code</th> -->
            <th>Discount Percentage</th>
            <th>Discount Description</th>
            <th>Status</th>
            <th>Action</th>
          
          </tr>
        </thead>
        <tbody>
          <!-- Sample coupon data -->
          <?php
                     
                     $count = 1;
                     foreach ($getDiscount as $gDiscount):
                  ?>
                  <input type="hidden" name="" class="hidden_end_time" value="<?= $gCoupon['end_time']?>">
          <tr>
            
            <td><?= $count?></td>
            <td><?= $gDiscount['discount_percentage']?></td>
            <td><?= $gDiscount['description']?></td>
            <td><?= $gDiscount['isHide']?></td>
            <td>
              <button type="button" class="btn btn_edit_discount" style="background-color: black; border-color: black; color: #ffffff;"
              data-toggle="modal" data-target="#editDiscountModal" data-discount_id="<?= $gDiscount['discount_senior_id']?>" data-discount_percentage="<?= $gDiscount['discount_percentage']?>">Edit </button>

              <button type="button" class="btn discount_hide" id="discount_hide" data-toggle="modal" data-target="#confirmationModalHide"  style="background-color: #dc3545; border-color: #dc3545; color: #ffffff;"  data-discount_id="<?= $gDiscount['discount_senior_id']?>">Hide</button>

              <button type="button" class="btn discount_shown" id="discount_shown" data-toggle="modal" data-target="#confirmationModalHide"  style="background-color: #dc3545; border-color: #dc3545; color: #ffffff;"  data-discount_id="<?= $gDiscount['discount_senior_id']?>">Show</button>
            </td>
          
          </tr>
          <?php 
                       $count++; endforeach;
                  ?>          
          <!-- Add more coupon entries here -->
        </tbody>
      </table>
    </div>
  </div>

  <!--Edit Discount Modal -->


  
<div class="modal fade" id="editDiscountModal" tabindex="-1" role="dialog" aria-labelledby="editCouponModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editCouponModalLabel">Edit Discount</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="../includes/add-coupon.inc.php" method="post">
                  
                          <div class="form-group">
                              <label for="editDiscount">Discount (%)</label>
                              <input required type="text" class="form-control editDiscount" id="editDiscount" name="editDiscount" value ="" placeholder="Enter discount">
                          </div>

                          <input type="hidden" id="coupon_id_holder">
                          <div class="modal-footer">
                              <!-- Inside your table loop where you output coupon data -->
                              <td>
                                  <button type="button" class="btn edit-button" name="ConfirmButton" id="btn_update_discount" data-toggle="modal" data-target="#confirmationModal">Update</button>
                                  <button type="button" class="btn" style="background-color: #dc3545; border-color: #dc3545; color: #ffffff;" data-dismiss="modal" >Close</button>
                              </td> 

                        
                          </div>

               
                          
                      </form>
                  </div>
              </div>
          </div>
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
                                        <button type="button" class="btn btn-primary" id="update_discount" name ="updateButton">Save changes</button>

                                    </div>
                                    </div>
                            </div>
                        </div>

           <!-- Confirmation Modal -->
           <div class="modal fade" id="confirmationModalHide" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
                                        <button type="button" class="btn btn-primary" id="save_update_discount" name ="updateButton" data-dismiss="modal">Save changes</button>

                                    </div>
                                    </div>
                            </div>
                        </div>
<script>
    $(document).ready(function () {
        // Initialize date picker for start time
    
        $(".btn_edit_discount").click(function(){

          let discountid = $(this).data('discount_id');
          let discountPercentage = $(this).data('discount_percentage');

          $("#editDiscountModal").find("#editDiscount").val(discountPercentage);

          $("#editDiscountModal").find("#btn_update_discount")
                .data('discountid', discountid);
         
         });

      $(".discount_hide").click(function(){
        let discountid = $(this).data('discount_id');
        let status = "hidden";
        $("#confirmationModalHide").find("#save_update_discount")
        .data('discountid', discountid)
        .data('status', status);
      });


      $(".discount_shown").click(function(){
        let discountid = $(this).data('discount_id');
        let status = "shown";
        $("#confirmationModalHide").find("#save_update_discount")
        .data('discountid', discountid)
        .data('status', status);

        console.log(discountid);
      });


      $("#btn_update_discount").click(function(){

        let  discount_id = $(this).data('discountid');
        let discountPercentage = !isNaN(parseFloat($("#editDiscount").val())) ? parseFloat($("#editDiscount").val()) : NaN;

        console.log({
            discount_id,
            discountPercentage
        });
        $("#confirmationModal").find("#update_discount")
        .data('discountid', discount_id)
        .data('discountPercent', discountPercentage);
      });




      $("#save_update_discount").click(function(){

        let  discount_id = $(this).data('discountid');
        let status = $(this).data('status');
        console.log({
            discount_id,
            status
        });
        $.ajax({
          type: 'POST',
          url: '../includes/add-coupon.inc.php',
                data: {
                    hide_discount_id : discount_id,
                    status: status,
                },
                success: function(response){

                    window.location.href = 'DiscountSenior.php';
                },
                error: function(error){
                    console.log("error has occured: " + error);
                }
        });

      });


      $("#update_discount").click(function(){

            let  discount_id = $(this).data('discountid');
            let discountPercentage = $(this).data('discountPercent');

            $.ajax({
            type: 'POST',
            url: '../includes/add-coupon.inc.php',
                    data: {
                        update_discount_id : discount_id,
                        discountPercentage: discountPercentage,
                    },
                    success: function(response){

                        window.location.href = 'DiscountSenior.php';
                    },
                    error: function(error){
                        console.log("error has occured: " + error);
                    }
            });

        });




    });
</script>



<?php
    include "adminFooter.php";

?>