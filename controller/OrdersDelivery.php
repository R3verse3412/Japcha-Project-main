<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";

$OrderModel = new Order();

// Assuming you have a method in your OrderModel to get all orders
$orders = $OrderModel->getOrdersDelivery();

if (!empty($orders)) {
    $preparingOrders = [];

    foreach ($orders as $order) {
        $orderid = $order['order_id'];
        $proddata = $OrderModel->getDataDelivery($orderid);
        $preparingOrders[] = [
            'orderId' => $order['order_id'],
            'price' => $order['total_price'],
            'customer_id' => $order['customer_id'],
            'order_date' => $order['order_date'],
            'email' => $order['email'],
            'fname' => $order['username'],
            'details' => $proddata
            // Add more order details as needed
        ];
    }

    // Send the latest orders as JSON response
    header('Content-Type: application/json');
    echo json_encode(['orders' => $preparingOrders]);
}
?>
