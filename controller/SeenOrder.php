<?php
// Include your database connection code
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";
$OrderModel = new Order();

if (isset($_POST['orderId'])){
    $orderid = $_POST['orderId'];

    if($OrderModel->UpdateSeenOrder($orderid)){
        

            echo "success";
    
      
    }else{
        echo "Invalid request.";
    }
    
}
