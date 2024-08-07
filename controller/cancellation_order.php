<?php
// Include your database connection code

require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";
require_once "../classes/CouponModel.php";
$coupon_model = new CouponModel();
$OrderModel = new Order();

if (isset($_POST['updateorder'])){
    $orderid = $_POST['updateorder'];
    $customer_id  = $_POST['customerid'];
    $reason =  htmlspecialchars($_POST["reason"], ENT_QUOTES, 'UTF-8');
    $coupon_id = $_POST['coupon_id'];

    if($OrderModel->UpdateToCancelOrder($orderid, $reason)){
        if($OrderModel->CancelOrder($orderid, $customer_id)){
            $response = "Order #" . $orderid . " has been cancelled.";
            
            if($coupon_id != 0){
                $coupon_update = $coupon_model->addBackQuantity($coupon_id);
            }
         
            echo $response;
        }else{
            echo "Invalid request.";
        }
      
    }else{
        
    }

}
