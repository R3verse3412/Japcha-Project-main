<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

<?php
  
    include "c_header.php"; 
?>
<style>
    .container {
    height: auto; 
    width: 100%; 
    padding-left: 280px;  
    margin-top: 110px; 
    margin-left: 170px;
}
.orderMainCont {
        padding: 20px;
    }

    .moptitle {
        margin-top: 20px;
    }

    .modcont {
        display: flex;
    }

    .cod,
    .gcash {
        margin-right: 20px;
    }

    .productbg img {
        max-width: 100%;
        height: auto;
    }

    .prodDetails mt-4 .hr {
        border: 5px solid gray;
        
    }

    .new4 {
        border: 2px solid gray;

    }

    .Remarks{
        text-align: center;
    }

    .form-controls {
        text-align: center;
        height: 100px;
        width: 100px; 
    }

    .btn btn-link {
        color: #D0BC05;
    }

    .card-img-top{
        max-width: 100px; 
        max-height: 100px; 
        background-color:#D0BC05;
        border-style: ridge;
    }
    
    .totalPrice{
        text-align: center;
    }

    .btn{
        background-color:#D0BC05;
        color: black;
        width: 150px;
    }

    .table{
        margin-top: 50px;
    }

    .modal-gcash{
        text-align: center;
    }
    td{
        vertical-align: middle !important;
    }
    h3{
        font-size: 1rem !important;
    }
    </style>
<?php
 if (isset($_SESSION["userid"])) 
 {
    $uid = $_SESSION["userid"];
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        // var_dump($sizeid);

    require_once 'classes/CouponModel.php';
    $coupon_model = new CouponModel();
?> 

<div class="container orderMainCont">
    <form action="includes/OrderInc.php" method ="POST"  enctype="multipart/form-data" id="FormCheckout">
    
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="detailsCont">
                    <div class="userDetails">
                        <div class="name">
                            <div class="name1">
                 
                                <p>Full Name</p>
                                <h4><?= $customer_date["username"] . ' ' . $customer_date["last_name"] ?></h4>
                                <input type="hidden" name="userid" value="<?= $uid ?>">
                            </div>
                        </div>

                        <div class="contact mt-3">
                            <div class="cont">
                                <p>Contact Number</p>
                                <h4 class="display_contact_checkout"><?= $customer_date["contact_number"]?></h4>
                            </div>
                            <a href="myProfile.php" class="btn">Change</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detailsCont">
                    <div class="deliveryCont">
                        <div class="address">
                            <h3>Delivery Address</h3>
                            <h4><?= implode(' ', [$customer_date["customer_address"], $customer_date["city"], $customer_date["region"]]) ?></h4>

                            <input type="hidden" name="address" value="<?= implode(' ', [$customer_date["customer_address"], $customer_date["city"], $customer_date["region"], $customer_date["postal_code"]]) ?>">
                        </div>
                        <a href="myProfile.php" class="btn">Change</a>
                    </div>
                    
                    <h3 class="moptitle mt-3">Mode of Payment</h3>
                    <div class="modcont">
                        <div class="pickup">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="pickup-checkbox" name="group[payment][pickup]" onclick="selectOnlyOne(this)">
                                <i class="fa fa-street-view" aria-hidden="true"></i>
                                <p class="form-check-label">Pick Up</p>
                            </div>
                        </div>

                        <div class="cod">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="cod-checkbox" name="group[payment][cod]"  onclick="selectOnlyOne(this)">
                                <!-- <img src="image/cod.png" alt=""> -->
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                <p class="form-check-label">Cash on Delivery</p>
                            </div>
                        </div>

                        <div class="gcash">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="gcash-checkbox" name="group[payment][gcash]" onclick="selectOnlyOne(this)">
                                <div class="gcashtitle">
                                    <strong>G-CASH <span style="font-size: 12px;">(0999-999-9999)</span></strong>
                                    <label for="gcash_payment" style="cursor: pointer;">
                                        <!-- <i class="fa fa-upload" aria-hidden="true"></i> <span style="font-size: 12px;">upload</span> -->
                                        <input class="form-control-file" type="file" accept="image/*" name="gcash_payment_upload" id="gcash_payment" disabled>
                                    </label>
                                    <div class="alert alert-danger" id="required_upload" role="alert" style="display:none;">
                                        upload is required
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row promo mt-2 p-3" style="display: flex; flex-direction: column;">

                <p>
                    <a class="btn-link" data-toggle="collapse" href="#promoCollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
                       Discount Promo !!
                    </a>
                </p>
     
            
            <div class="collapse" id="promoCollapse" style="max-width: 35rem;">
                <?php
                    $senior_discount = $coupon_model->getAllDiscountSenior();

                    foreach( $senior_discount as $discount):
                        if ($discount['isHide'] != 'hidden'):
                       
                ?>

                <div class="card card-body p-0" style="display: flex; flex-direction: row;">
                    <div class="card-header " style="background-color: gold;">
                        <span style="color: red; font-size: 30px;"><?= $discount['discount_percentage']?>% OFF</span>
                        <input type="hidden" name="discount_percentage_senior" value="<?= $discount['discount_percentage']?>">
                    
                    </div>
                    <div class="card-body">
                        <span style="color: red;"><?= $discount['description']?>!</span>
                        <input type="hidden" name="discount_name" value="<?= $discount['description']?>">
                        <p style="font-size: 12px;">Send a picture of your valid ID for validation. Thank you!</p>
                        <input type="file" name="id_validation" id="id_validate_senior" disabled>
                    </div>
                  
                </div>
                <div class="form-check">
                        <input type="checkbox" name="check_discount" id="senior_discount" class="form-check-input" value="<?= $discount['discount_percentage']?>">
                        <label class="form-check-label" for="senior_discount">Apply for discount</label>
                </div>

                <?php
                        endif;
                    endforeach;
                ?>
            </div>
        </div>

        <script>
    // Optional: If you want to enable/disable the file input based on some condition
    // Example: Enable the file input when the icon is clicked
    // document.querySelector('.fa-upload').addEventListener('click', function () {
    //     document.getElementById('gcash_payment').removeAttribute('disabled');
    // });

  
</script>


        <!-- Container for Product Details -->
        <div class="prodDetails mt-4">
            <div class="row">
<?php
$coupon = $coupon_model->GetAllCouponFrontEnd();
if (!empty($coupon)) {
    foreach ($coupon as $coupon_data) {
        // Check if the end_time is greater than the current date in Asia/Manila timezone
        $currentTime = new DateTime('now', new DateTimeZone('Asia/Manila'));
        $endTime = DateTime::createFromFormat('Y-m-d H:i:s', $coupon_data['end_time'], new DateTimeZone('Asia/Manila'));        
        $endTime->setTimezone(new DateTimeZone('Asia/Manila'));

        if ($endTime > $currentTime) {
            ?>
            <div class="card text-white bg-warning  mb-2 mr-2" style="width: 17rem; background-color: #FFFCE0; box-shadow: -1px 2px 4px 1px rgba(0, 0, 0, 0.25); border: none;">
                <div class="card-header" style="box-shadow: -1px 2px 4px 1px rgba(0, 0, 0, 0.25); color: red;">
                    <span style="font-weight: bold; ">COUPON</span>
                    <span>₱<?= $coupon_data['discount_percentage'] ?> Discount</span>
                    <input type="checkbox" class="exampleCheck" value="<?= $coupon_data['discount_percentage'] . ' ' . $coupon_data['offer_name'] . ' ' . $coupon_data['id'] ?>" name="selected_coupons[]">
                </div>
                <div class="card-body" style="color: black;">
                    <span>Name:</span>
                    <h5 class="card-title offername"><?= $coupon_data['offer_name'] ?></h5>
                </div>
            </div>
            <?php
        }
    }
}
?>




            </div>
           
            <hr class="new4"> </hr>
        </div>

        <?php
             if(isset($_POST['buynow'])){
                $prodID = $_POST['prdID'];
                $prodname = $_POST['prdname'];
                $image = $_POST['prodImage'];
                $sizeid = $_POST['sizes'];
                $quantity = $_POST['quantity'];
           
        ?>
        <input type="hidden" name="product_id_data" value="<?= $prodID ?>">
        <input type="hidden" name="size_data" value="<?= $sizeid ?>">
            <table class="table">
        <thead style="text-align: center;">
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Size</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
               
                <?php
                
                     ?>
               <th scope="col">Addons</th>

                <?php
                    
                ?>
                 <th scope="col">Subtotal</th>
                 <th scope="col">Remarks</th>
                <!-- <th scope="col">Action</th> -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center-content"><?php
                    // Assuming $images contains the file path to the image or video
                    if (strpos($image, '.mp4') !== false) {
                        // If $images contains '.mp4', it's a video
                        ?>
                        <video controls="false" style="max-width: 100px; max-height: 100px;">
                        <source src="upload/<?= $image?>" type="video/mp4">
                        <p>Your browser does not support the video tag</p>
                        </video>
                    <?php
                        } else {
                    ?>
                        <img src="upload/<?= $image ?>" alt="" style="max-width: 100px; max-height: 100px;" >
                    <?php
                        }
                    ?>
                </td>
                <td class="center-content"><?=  $prodname ?></td>
                <input type="hidden" name="p_name" value="<?=  $prodname ?>">
                <?php
                    $getSizeName =  $productModel->getOneSize($sizeid);
                    if ($getSizeName !== false) {
                        $sizename = $getSizeName;
                ?>
                <td class="center-content"><?=  $sizename ?></td>
                <input type="hidden" name="size_name" value="<?=  $sizename ?>">
                <?php
                    }
                ?>
                <?php
                 $getprice =  $productModel->getPriceBySize($sizeid, $prodID);
                
                 if ($getprice !== false) {
                    $price = $getprice;
                ?>
                <td class="center-content">₱<span id="price"><?=  $price ?></span></td>
                <input type="hidden" name="product_price" value="<?=  $price ?>">
               
                <?php
                 }
                ?>
                <td class="center-content"><input type="number" name="quantity" id="quantity" min="1" step="1" value="<?=  $quantity ?>" required style="width:50px;"></td>
               
                 <?php
                    // $ddson = 0;
                   
                     $ddson = $_POST['addons'] ?? null;
                    include_once "classes/add-addons.classes.php";
                    $addonsModel = new addAddons();
                    $dataAdds =  $addonsModel->getOneAddons($ddson);
               
                        $addonsName = $dataAdds['addons_name'] ?? "none";
                        $addonsPrice = $dataAdds['price']?? null;
                    
                     ?>
                          <td scope="col"><?= $addonsName ?><span id="addonsPrice"><?= $addonsPrice ?></span></td>
                          <input type="hidden" name="addons_data" value="<?= $ddson ?>">
                          <input type="hidden" name="addons_name" value="<?= $addonsName ?>">
                          <input type="hidden" name="addons_price" value="<?= $addonsPrice ?>">
                          <!-- <td></td> -->
                <!-- <?php
                         
                    
                ?> -->
            
            
                    <td class="center-content" >₱<span id="subtotal"></span></td>
                    <input type="hidden" name="subtotal1" id="subtotalInput">
              
                  <td class="center-content" ><textarea name="prd_remark" id="" rows="2" placeholder="Optional..." style="padding: 5px;"></textarea></td>
                <!-- <td class="center-content"><input type="checkbox" class="form-check-input" name="group" onclick="selectOnlyOne(this)"></td> -->
            </tr>
        </tbody>
    </table>

            <div class="remarks mt-3">
                        <h4 class ="Remarks">Remarks</h4>
                        <textarea name="remarks" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Optional..."></textarea>

            </div>

            <div class="totalPrice mt-3">
                <span id="shippingFee" style="display: none">Shipping Fee: ₱10.00</span>
                <h2 class="TP">Total Price:</h2>
                <span id="senior_discount_display"style="color: red;"><span class="span_discount_display"></span>% discount</span>
                <h3 class="value">₱<span id="total"><?= $price ?></span><span class="minus_discount_field"></span></h3>
                <input type="hidden" name="total_data" id="totalInput">
                <button class="btn btn-primary" type ="submit" name="proceed1">Proceed</button>
            </div>


<script src="assets/js/SingleOrderCheckout.js"></script>

<script>
    $('#FormCheckout').on('submit', function (event) {
        
        // Get the file input element
        const gcashPaymentUpload = $('#gcash_payment');
        // Get the danger alert element
        const dangerAlert = $('#required_upload');

        // Check if the G-CASH checkbox is checked
        if ($('#gcash-checkbox').prop('checked')) {
            // Check if any file is selected
            if (gcashPaymentUpload.is(':file') && gcashPaymentUpload[0].files.length === 0) {
                // Show the danger alert
                dangerAlert.show();
                // Prevent the form submission
                event.preventDefault();
            } else {
                // Hide the danger alert
                dangerAlert.hide();
            }
        } else {
            // Hide the danger alert if the checkbox is not checked
            dangerAlert.hide();
        }

        var quantity = document.querySelector('#quantity').value;


        if (quantity > 15) {
            // Display an alert
            alert('You have reached the maximum limit (15).');
            

            event.preventDefault();
        
        }
    });
</script>
<?php
  }
  if(isset($_POST['buyNowFromCart'])){

?>

<table class="table">
        <thead style="text-align: center;">
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Size</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
               
                <?php
                    // if(isset($_POST['addons'])){
                     ?>
               <th scope="col">Addons</th>

                <?php
                    // }
                ?>
                 <th scope="col">Subtotal</th>
                 <th scope="col">Product Remarks</th>
                <!-- <th scope="col">Action</th> -->
            </tr>
        </thead>
        <tbody>
        <?php 
            require_once "classes/CartModel.php";
            $ProdModel = new ProductModel();
            $cartModel = new CartModel();
            $displayCart = $cartModel->fetchCart($uid);

            foreach ($displayCart as $cart):
                $addonsid = $cart['addons_id'] ?? null;
                $fetchDetails = $cartModel->fetchCartDetails($cart['product_id'], $cart['size_id'], $cart['addons_id']);
                // $addonsDetails = $cartModel->FetchAddons($cart['addons_id']);
                $addonsName = $cart['addons_name'] ?? "";
                $addonsPrice = $cart['addons_price'] ?? "";
                $fetchPrize = $cartModel->fetchPrice($cart['size_id'], $cart['product_id']);
        ?>
            <tr class="product-row">
                <input type="hidden" name="cid[]" value="<?= $uid ?>">
                <td class="center-content">
                        <?php
                    // Assuming $images contains the file path to the image or video
                            if (strpos($fetchDetails['image_url'], '.mp4') !== false) {
                        // If $images contains '.mp4', it's a video
                        ?>
                        <video controls="false" style="max-width: 100px; max-height: 100px;">
                        <source src="upload/<?= $fetchDetails['image_url'] ?>" type="video/mp4">
                        <p>Your browser does not support the video tag</p>
                        </video>
                    <?php
                        } else {
                    ?>
                        <img src="upload/<?= $fetchDetails['image_url'] ?>" alt="" style="max-width: 100px; max-height: 100px;" >
                    <?php
                        }
                    ?>
                </td>
                <td class="center-content"><?= $cart['product_name'] ?></td>
                <input type="hidden" name="product_id_data[]" value="<?= $cart['product_id'] ?>">
                <input type="hidden" name="p_name[]" value="<?= $cart['product_name'] ?>">
                <td class="center-content"><?= $fetchDetails['size_name'] ?></td>
                <input type="hidden" name="size_name[]" value="<?= $fetchDetails['size_name'] ?>">
                <input type="hidden" name="size_data[]" value="<?= $cart['size_id'] ?>">
               
             
                <td class="center-content"> ₱<span class="product-price" id="product-price"><?= $cart['product_price'] ?></span></td>
               <input type="hidden" name="product_price[]" value="<?= $fetchPrize['price'] ?>">
              
                <td class="center-content"><input type="number" name="quantity[]" class="product-quantity" min="1" step="1" value="<?= $cart['quantity'] ?>" required style="width:50px;"></td>
               
             
                          <td scope="col"><?= $addonsName ?> <span class="addons-price" id="addonsPrice"><?= $addonsPrice ?></td>
                          <input type="hidden" name="addons_data[]" value="<?= $addonsid ?>">
                          <input type="hidden" name="addons_name[]" value="<?= $addonsName ?>">
                          <input type="hidden" name="addons_price[]" value="<?= $addonsPrice ?>">
                          <!-- <td></td> -->
               
                
                    <td class="center-content" ><span class="product-subtotal" id="product-subtotal"></span></td>
                    <input type="hidden" name="subtotal1[]" class="subtotal-input" id="subtotalInput" value="">
                    <td class="center-content" ><textarea name="prd_remark[]" id="" rows="2" placeholder="Optional..." style="padding: 5px;"></textarea></td>
                  
                <!-- <td class="center-content"><input type="checkbox" class="form-check-input" name="group" onclick="selectOnlyOne(this)"></td> -->
            </tr>
        <?php
            endforeach;
        ?>
        </tbody>
    </table>

    <div class="remarks mt-3">
                <h4 class ="Remarks">Remarks</h4>
                <textarea name="remarks" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Optional..."></textarea>

            </div>

            <div class="totalPrice mt-3">
                <span id="shippingFee" style="display: none">Shipping Fee: ₱10.00</span>
                <h2 class="TP">Total Price:</h2>
                <span id="senior_discount_display"style="color: red;"><span class="span_discount_display"></span>% discount</span>
                <h3 class="value"><span id="total"></span><span class="minus_discount_field"></span></h3>
                <input type="hidden" name="total_data" id="totalInput" value="<?= $fetchPrize['price'] ?>">
                <button class="btn btn-primary" type ="submit" name="proceed2">Proceed</button>
            </div>

<!-- <script src="assets/js/OrderCheckoutCart.js"></script> -->
<script src="assets/js/CheckoutFromCart.js"></script>
<script>
    $("#FormCheckout").submit(function(event) {
    // Check each quantity input in the array
    $('input[name="quantity[]"]').each(function() {
        var quantity = $(this).val();

        // Check if the quantity exceeds the maximum limit (10 in this case)
        if (quantity > 15) {
            // Display an alert
            alert('You have reached the maximum limit (15).');

            // Prevent the form from submitting
            event.preventDefault();
            return false; // Stop the loop and prevent further execution
        }
    });

});

</script>

<?php
 }
?>
          
        </div>
</form>

</div>

    <?php
    include "OrderCheckoutModal.php";
    ?>
    


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
<?php

}
}
include_once "c_footer.php";
?>