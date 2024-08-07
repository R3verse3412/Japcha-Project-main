<?php
header('Content-Type: application/json');
// Simulated JSON data for testing
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";
$OrderModel = new Order();
$userid = $_GET['userId'];

$result = $OrderModel->getOrderNumberByCustomerCancelled($userid);
$orders = $result['orders'];
$total_price = $result['total_prices'];
$cancel_reason = $result['cancellation_reason'];
$count = $result['count'];

$data = array();

// $order = $db;

for ($i = 0; $i < $count; $i++) {
    // $order_id = $order[$i]['id'];
    $order_id = $orders[$i];

    $product = $OrderModel->getOrderByCustomerCancelled($order_id, $userid);
    // var_dump($product);
    // $prod_sizw = $OrderModel->getOrderByCustomerV2($product[], $userid);
    $rowData = array(
        'orderID' => $order_id,
        'total_price' => $total_price[$i],
        'reason' => html_entity_decode($cancel_reason[$i], ENT_QUOTES, 'UTF-8'),
        'products' => $product
    );

    array_push($data, $rowData);
}

echo json_encode($data);
?>
