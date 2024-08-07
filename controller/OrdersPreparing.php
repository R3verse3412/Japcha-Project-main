<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";

$OrderModel = new Order();

try {
    // Assuming you have a method in your OrderModel to get all orders
    $orders = $OrderModel->getOrdersPreparing();

    if (!empty($orders)) {
        $preparingOrders = [];

        foreach ($orders as $order) {
            $orderid = $order['order_id'];
            $proddata = $OrderModel->getDataPreparing($orderid);
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
    } else {
        // Send an empty array if there are no orders
        header('Content-Type: application/json');
        echo json_encode(['orders' => []]);
    }
} catch (\Throwable $th) {
    // Handle exceptions and return an error response as JSON
    header('Content-Type: application/json');
    echo json_encode(['error' => $th->getMessage()]);
}
?>
