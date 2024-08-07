<?php
    include "adminHeader.php";
?>

<?php
include "../classes/dbh.classes.php";
include "../classes/CouponModel.php";
$coupon = new CouponModel();
$getCoupon = $coupon->getAllCoupon();
?>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

  <div class="container mt-5" style="height: 80%; width: 100%; padding-left: 280px;  margin-top: 80px;">
    <div class="row">
      <h2 class="mb-0 mr-1">Coupon Management</h1>

      <button type="button" class="btn" style="background-color: #D0BC05; border-color: #D0BC05; color: #ffffff;" data-toggle="modal" data-target="#addCouponModal">
        Add Coupon
      </button>
    </div>
    
    


    <div class="table-responsive mt-4">
    <a href="DiscountSenior.php">Go to Discount</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th></th>
            <!-- <th>Coupon Code</th> -->
            <th>Offer Name</th>
            <th>Discount Price</th>
            <th>Quantity</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Status</th>
            <th>Action</th>
          
          </tr>
        </thead>
        <tbody>
          <!-- Sample coupon data -->
          <?php
                     
                     $count = 1;
                     foreach ($getCoupon as $gCoupon):
                  ?>
                  <input type="hidden" name="" class="hidden_end_time" value="<?= $gCoupon['end_time']?>">
          <tr>
            
            <td><?= $count?></td>
            <td><?= $gCoupon['offer_name']?></td>
            <td><?= $gCoupon['discount_percentage']?></td>
            <td><?= $gCoupon['Quantity']?></td>
            <td><?= $gCoupon['start_time']?></td>
            <td class="timeend"><?= $gCoupon['end_time']?></td>
            <td class="couponStatus"></td>
            <td>
              <button type="button" class="btn btn_edit_coupon" style="background-color: black; border-color: black; color: #ffffff;"
              data-toggle="modal" data-target="#editModal" data-coupon_name="<?= $gCoupon['offer_name']?>" data-discount="<?= $gCoupon['discount_percentage']?>" data-quantity="<?= $gCoupon['Quantity']?>" data-starttime="<?= $gCoupon['start_time']?>" data-endtime="<?= $gCoupon['end_time']?>" data-coupon_id="<?= $gCoupon['id']?>">Edit </button>
              <button type="button" class="btn coup_deletes" id="coup_deletes" data-toggle="modal" data-target="#deleteCouponModal" style="background-color: #dc3545; border-color: #dc3545; color: #ffffff;"  data-coupon_id_delete="<?= $gCoupon['id']?>" data-coupon_name_delete="<?= $gCoupon['offer_name']?>">Delete</button>
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

  <!-- Add Coupon Modal -->
    
      <!-- Add Coupon Modal -->
      <div class="modal fade" id="addCouponModal" tabindex="-1" role="dialog" aria-labelledby="addCouponModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCouponModalLabel">Add Coupon</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="../includes/add-coupon.inc.php" method="post">
                <div class="form-group">
                  <label for="discount">Offer Name</label>
                  <input required type="text" class="form-control" id="offerName" name ="offerName"placeholder="">
                </div>
                <div class="form-group">
                  <label for="discount">Discount Price</label>
                  <input required type="text" class="form-control" id="discount" name = "discount"placeholder="Enter discount price">
                </div>
                <div class="form-group">
                  <label for="quantity">Quantity</label>
                  <input required type="text" class="form-control" id="Quantity" name="Quantity" placeholder="Enter quantity">
                </div>
                <div class="form-group">
                  <label for="editStartTime">Start Time</label>
                  <input required type="datetime-local" class="form-control StartTime" id="addStarttime" name="StartTime">
                </div>
                <div class="form-group">
                  <label for="editEndTime">End Time</label>
                  <input required type="datetime-local" class="form-control EndTime" id="addEndtime" name="EndTime">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" style="background-color: #D0BC05; border-color: #D0BC05; color: #ffffff;"name ="confirmAddButton"id ="confirmAddCoupon" data-toggle="modal" data-target="#confirmationAddModal">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"name="CloseButton">Close</button>
                  
                </div>  

                <!-- Confirmation Modal for Adding Coupon -->

                <div class="modal fade" id="confirmationAddModal" tabindex="-1" role="dialog" aria-labelledby="confirmationAddModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="confirmationAddModalLabel">Confirm Coupon</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        Are you sure you want to add this Coupon?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveAddCoupon"name ="saveAddButton">Add Coupon</button>
                        </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- For Editing Modal -->
              <?php
                include "EditCouponManagement.php";
              ?>

              <?php
                include "DeleteCoupon.php";
              ?>
<script>

var currentDate = new Date();

// Calculate the UTC offset for Asia/Manila (assuming UTC+8)
var utcOffset = -480; // UTC offset in minutes (UTC+8:00)

// Calculate the local date and time in Asia/Manila
var localDate = new Date(currentDate.getTime() + (utcOffset * 60 * 1000));

// Format the local date and time for the input value
var formattedDate = localDate.toISOString().slice(0, 16);

// Set the default value for the StartTime input
document.getElementById('addStarttime').value = formattedDate;
</script>

<script>
    $(document).ready(function () {
        // Initialize date picker for start time
        var currentDateTime = new Date().toISOString().slice(0, 16);

        // Set the min attribute for both datetime-local inputs
        $(".StartTime, .EndTime").attr("min", currentDateTime);

        $(".btn_edit_coupon").click(function(){
    // Retrieve the value of data-coupon_name
          var couponName = $(this).data('coupon_name');
          var discount = $(this).data('discount');
          var quantity = $(this).data('quantity');
          var starttime = $(this).data('starttime');
          var endtime = $(this).data('endtime');
          var coupon_id = $(this).data('coupon_id');
          // Set the coupon name in the modal input field
          $("#editModal").find("#editOfferName").val(couponName);
          $("#editModal").find("#editDiscount").val(discount);
          $("#editModal").find("#editQuantity").val(quantity);
          $("#editModal").find("#editStartTime").val(starttime);
          $("#editModal").find("#editEndTime").val(endtime);
          $("#editModal").find("#btn_update_coupon").val(coupon_id);

         
      });

      $(".coup_deletes").click(function(){
          let c_name = $(this).data('coupon_name_delete');
          let c_id = $(this).data('coupon_id_delete');

          console.log(c_name);
          $("#deleteCouponModal").find(".coupon_name").val(c_name);
          $("#deleteCouponModal").find("#btn_delete_coupon").val(c_id);
      });


      $(".btn_delete_coupon").click(function(){

        let  coupon_id = $(".btn_delete_coupon").val();

        $.ajax({
          type: 'POST',
          url: '../includes/add-coupon.inc.php',
                data: {
                    delete_coupon_id : coupon_id
                },
                success: function(response){

                    window.location.href = 'CouponManagement.php';
                },
                error: function(error){
                    console.log("error has occured: " + error);
                }
        });

      });

      $(".timeend").each(function(index) {
          var endTime = $(this).text(); // Use text() to get the content of the td element
          var statusElement = $(this).closest('tr').find('.couponStatus');
          console.log({
              endTime
          });

          if (new Date(endTime) > new Date()) {
              statusElement.text("ONGOING");
          } else {
              statusElement.text("EXPIRED");
          }
      });


    });
</script>



  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> -->

<?php
    include "adminFooter.php";

?>