<?php
    include "../classes/dbh.classes.php";
    include "../classes/CouponModel.php";
    $coupon_model = new CouponModel();
//Retrieve the data in viewCategory
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    if (isset($_POST['saveAddButton'])) {
        echo "Connected";
        // $getCouponCode = htmlspecialchars($_POST["couponCode"], ENT_QUOTES, 'UTF-8');
        $getOfferName = htmlspecialchars($_POST["offerName"], ENT_QUOTES, 'UTF-8');
        $getDiscount = htmlspecialchars($_POST["discount"], ENT_QUOTES, 'UTF-8');
        $getQuantity = htmlspecialchars($_POST["Quantity"], ENT_QUOTES, 'UTF-8');
        $getStartTime = htmlspecialchars($_POST["StartTime"], ENT_QUOTES, 'UTF-8');
        $getEndTime = htmlspecialchars($_POST["EndTime"], ENT_QUOTES, 'UTF-8');
        $formattedStartTime = date("Y-m-d H:i:s", strtotime($getStartTime));
        $formattedEndTime = date("Y-m-d H:i:s", strtotime($getEndTime));


        $insertCoupon = $coupon_model->insertCoupon($getOfferName,$getDiscount,$getQuantity,$formattedStartTime,$formattedEndTime);
        
        header("location: ../back-end/CouponManagement.php?error=none");
        exit();

    }

    if (isset($_POST['coupon_id'])) {
        // $editCouponCode = htmlspecialchars($_POST["editCouponCode"], ENT_QUOTES, 'UTF-8');
        $editOfferName = htmlspecialchars($_POST["coupon_name"], ENT_QUOTES, 'UTF-8');
        $editDiscount = htmlspecialchars($_POST["discount"], ENT_QUOTES, 'UTF-8');
        $editQuantity = htmlspecialchars($_POST["quantity"], ENT_QUOTES, 'UTF-8');
        $editStartTime = htmlspecialchars($_POST["starttime"], ENT_QUOTES, 'UTF-8');
        $editEndTime = htmlspecialchars($_POST["endtime"], ENT_QUOTES, 'UTF-8');
        // $formattedStartTime = date("Y-m-d H:i:s", strtotime($editStartTime));
        // $formattedEndTime = date("Y-m-d H:i:s", strtotime($editEndTime));
        $couponID = htmlspecialchars($_POST["coupon_id"], ENT_QUOTES, 'UTF-8');


     
        $editCoupon = $coupon_model->editCoupon($editOfferName,$editDiscount,$editQuantity,$editStartTime,$editEndTime,$couponID);

        if($editCoupon != false){
            echo 'success';
        }else{
            exit();
        }

    } 
    if (isset($_POST['delete_coupon_id'])) {
        // $editCouponCode = htmlspecialchars($_POST["editCouponCode"], ENT_QUOTES, 'UTF-8');
        $couponID = htmlspecialchars($_POST["delete_coupon_id"], ENT_QUOTES, 'UTF-8');

      
        $delete_coupon = $coupon_model->DeleteCoupon($couponID);

        if($delete_coupon != false){
            echo 'success';
        }else{
            exit();
        }

    }    

    if (isset($_POST['hide_discount_id'])) {
        // $editCouponCode = htmlspecialchars($_POST["editCouponCode"], ENT_QUOTES, 'UTF-8');
        $discoun_id = htmlspecialchars($_POST["hide_discount_id"], ENT_QUOTES, 'UTF-8');
        $hideDisocunt = htmlspecialchars($_POST["status"], ENT_QUOTES, 'UTF-8');
      
        $delete_coupon = $coupon_model->HideDiscount($hideDisocunt,$discoun_id);

        if($delete_coupon != false){
            echo 'success';
        }else{
            exit();
        }

    }  

    if (isset($_POST['update_discount_id'])) {
        // $editCouponCode = htmlspecialchars($_POST["editCouponCode"], ENT_QUOTES, 'UTF-8');
        $discoun_id = htmlspecialchars($_POST["update_discount_id"], ENT_QUOTES, 'UTF-8');
        $discount_percentage = htmlspecialchars($_POST["discountPercentage"], ENT_QUOTES, 'UTF-8');
      
        $update_discount = $coupon_model->UpdateDiscount($discount_percentage,$discoun_id);

        if($update_discount != false){
            echo 'success';
        }else{
            exit();
        }

    }  

}
