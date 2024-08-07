<?php
// Include your database connection code
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";
require_once "../classes/mailer_function.php";
$mailer = new YourEmailClass();

$OrderModel = new Order();

if (isset($_POST['customer_id']) && isset($_POST['orderId'])){
    $orderid = $_POST['orderId'];
    $customerid  = $_POST['customer_id'];
    $emails = $_POST['email'];
    $fnames = $_POST['fname'];
    $total_price = $_POST['total_price'];
    $OrderDate = $_POST['order_date'];

    if($OrderModel->UpdateCompleteOrder($orderid)){
        
        if($OrderModel->CompleteOrder($orderid, $customerid)){
            $mailer->complete_oder($emails, $fnames, $total_price, $orderid, $OrderDate);

            $response = "Order #" . $orderid . " is completed";
            echo $response;
        }else{
            echo "Invalid";
        }
      
    }else{
        echo "Invalid request.";
    }
    
}
