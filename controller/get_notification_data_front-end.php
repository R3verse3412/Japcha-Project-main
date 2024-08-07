<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";

try {
    $OrderModel = new Order();
    $customerid = $_GET['customerId'];

    // Assuming you have a method in your OrderModel to get all orders
    $orders = $OrderModel->getNotificationOrderDataFrontEnd($customerid);

    if (!empty($orders)) {
        $preparingOrders = [];

        foreach ($orders as $order) {
            $orderid = $order['order_id'];
            $proddata = $OrderModel->getDataComplete($orderid);

            $preparingOrders[] = [
                'orderId' => $order['order_id'],
                'price' => $order['total_price'],
                'customer_id' => $order['customer_id'],
                'OrderDate' => $order['order_date'],
                'statusSeen' => $order['isSeen'],
                'statusPreparing' => $order['preparing'],
                'statusDelivery' => $order['delivery'],
                'statusCompleted' => $order['completed'],
                'statusActive' => $order['isActive'],
                'statusRemoved' => $order['removed'],
                'statusCancel' => $order['cancel'],
                'details' => $proddata
                // Add more order details as needed
            ];
        }

        // Send the latest orders as JSON response
        header('Content-Type: application/json');
        echo json_encode(['orders' => $preparingOrders]);
        exit;
    } else {
        header('Content-Type: application/json');
        http_response_code(404);  // Not Found
        echo json_encode(['error' => 'No orders found']);
        exit;
    }
} catch (Exception $e) {
    header('Content-Type: application/json');
    http_response_code(500);  // Internal Server Error
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>
