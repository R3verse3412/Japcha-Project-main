<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";

$OrderModel = new Order();

// Assuming you have a method in your OrderModel to get all orders
$orders = $OrderModel->getOrdersV2();

if (!empty($orders) && count($orders) > 0) {
    $latestOrders = [];

    foreach ($orders as $order) {
        $orderDetails = $OrderModel->getCustomerDetails($order['customer_id']);

        $latestOrders[] = [
            'orderId' => $order['order_id'],
            'price' => $order['total_price'],
            'df' => $order['df'],
            'OrderDate' => $order['order_date'],
            'customerid' => $order['customer_id'],
            'remark' => $order['remark'],
            'coupon_discount' => $order['coupon_discount'],
            'coupon_name' => $order['coupon_name'],
            'coupon_id' => $order['coupon_id'],
            'discount_percent' => $order['discount_percent'],
            'discount_name' => $order['discount_name'],
            'discount_valid_id' => $order['discount_vaild_id'],
            'address' => $order['customer_address'],
            'customer_name' => $orderDetails['username'],
            'customer_lname' => $orderDetails['last_name'],
            'customer_address' => $orderDetails['customer_address'],
            'customer_postal_code' => $orderDetails['postal_code'],
            'customer_city' => $orderDetails['city'],
            'customer_region' => $orderDetails['region'],
            'customer_address_id' => $orderDetails['address_id'],
            'customer_email' => $orderDetails['email'],
            'payment_pickup'=> $order['payment_pickup'],
            'payment_cod'=> $order['payment_cod'],
            'payment_gcash'=> $order['payment_gcash'],
            'gcash_upload'=> $order['gcash_upload']
            // Add more order details as needed
        ];
    }
} else {
    $latestOrders = [];
}

// Send the latest orders as JSON response
header('Content-Type: application/json');
echo json_encode(['orders' => $latestOrders]);

