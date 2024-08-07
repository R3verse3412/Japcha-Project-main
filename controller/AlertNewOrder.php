<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";

$OrderModel = new Order();

// Assuming you have a method in your OrderModel to get all new orders
$orders = $OrderModel->AlertNewOrder();

if (!empty($orders)) {
    $latestOrders = [];

    foreach ($orders as $order) {
        $orderDetails = $OrderModel->getCustomerDetails($order['customer_id']);

        $latestOrders[] = [
            'orderId' => $order['order_id'],
            'price' => $order['total_price'],
            'df' => $order['df'],
            'customerid' => $order['customer_id'],
            'remark' => $order['remark'],
            'customer_name' => $orderDetails['username'],
            'customer_address' => $orderDetails['customer_address'],
            'customer_email' => $orderDetails['email'],
            // Add more order details as needed
        ];
    }
} else {
    $latestOrders = [];
}

// Send the latest orders as JSON response
header('Content-Type: application/json');
echo json_encode(['orders' => $latestOrders]);
?>
