<?php
// Include your database connection code
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";

require_once "../classes/mailer_function.php";
$mailer = new YourEmailClass();

$OrderModel = new Order();

if (isset($_POST['updateorder'])){
    $orderid = $_POST['updateorder'];
    $customer_id  = $_POST['customerid'];
    $emails = $_POST['email'];
    $fnames = $_POST['fname'];
    $total_price = $_POST['total_price'];
    $OrderDate = $_POST['OrderDate'];
    if($OrderModel->UpdatePrepareOrder($orderid)){
        if($OrderModel->AcceptOrderV2($orderid, $customer_id)){
            $mailer->preparing_order($emails, $fnames, $total_price, $orderid, $OrderDate);
                $response = "Order #" . $orderid . " has been accepted.";
                echo $response;
          
        }else{
            echo "Invalid request.";
        }
      
    }else{
        
    }
    
}
