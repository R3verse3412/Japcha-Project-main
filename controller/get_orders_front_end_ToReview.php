<?php
header('Content-Type: application/json');
// Simulated JSON data for testing
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";
$OrderModel = new Order();
$userid = $_GET['userId'];

$result = $OrderModel->getOrderNumberByCustomerComplete($userid);
$orders = $result['orders'];
$total_price = $result['total_prices'];
$count = $result['count'];
$usernames = $result['username']; // Note the change here
$lastnames = $result['lastname']; // Note the change here

$data = array();

// $order = $db;

for ($i = 0; $i < $count; $i++) {
    // $order_id = $order[$i]['id'];
    $order_id = $orders[$i];

    $product = $OrderModel->getOrderByCustomerComplete($order_id, $userid);
    // var_dump($product);
    // $prod_sizw = $OrderModel->getOrderByCustomerV2($product[], $userid);
    $rowData = array(
        'orderID' => $order_id,
        'total_price' => $total_price[$i],
        'customer_fname' => $usernames[$i], // Note the change here
        'customer_lname' => $lastnames[$i], // No
        'products' => $product

    );

    array_push($data, $rowData);
}

echo json_encode($data);
?>
