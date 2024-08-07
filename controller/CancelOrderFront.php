<?php
session_start();
// Include your database connection code
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";
$OrderModel = new Order();

if (isset($_POST['order_id']) && isset($_POST['customer_id'])) {
    // Get the values from the POST data
    $order_id = $_POST['order_id'];
    $customer_id = $_POST['customer_id'];

    if ($OrderModel->UpdateToCancelOrderFront($order_id)) {
      
        if ($OrderModel->CancelOrder($order_id)) {
            
            // Order cancellation successful
            $response = [
                'status' => 'success',
                'message' => 'Order #' . $order_id . ' has been successfully cancelled.',
            ];
            // $_SESSION['customer_id_cancel'] = $customer_id;
            $_SESSION['cancel_order_front'] = "success_cancel";
        } else {
            // Error in canceling order
            $response = [
                'status' => 'error',
                'message' => 'Failed to cancel order. Please try again.',
            ];
        }
    } else {
        // Error in updating order status
        $response = [
            'status' => 'error',
            'message' => 'Failed to update order status. Please try again.',
        ];
    }
} else {
    // Missing order_id or customer_id in POST
    $response = [
        'status' => 'error',
        'message' => 'Error in Order Request Cancellation. Missing order_id or customer_id.',
    ];
}

echo json_encode($response);
?>
