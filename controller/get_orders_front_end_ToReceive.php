<?php
header('Content-Type: application/json');
// Simulated JSON data for testing
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";
$OrderModel = new Order();
$userid = $_GET['userId'];

$result = $OrderModel->getOrderNumberByCustomerDelivery($userid);
$orders = $result['orders'];
$total_price = $result['total_prices'];
$count = $result['count'];

$data = array();

// $order = $db;

for ($i = 0; $i < $count; $i++) {
    // $order_id = $order[$i]['id'];
    $order_id = $orders[$i];

    $product = $OrderModel->getOrderByCustomerDelivery($order_id, $userid);
    // var_dump($product);
    // $prod_sizw = $OrderModel->getOrderByCustomerV2($product[], $userid);
    $rowData = array(
        'orderID' => $order_id,
        'total_price' => $total_price[$i],
        'products' => $product
        // 'products' => array(
        //     array(
        //         "image_url" => "product1.jpg",
        //         "product_name" => $product,
        //         "price" => "$10.00",
        //         "quantity" => 3,
        //         "addons_name" => "Addon 1",
        //         "addons_price" => "$2.00",
        //         "subtotal" => "$32.00"
        //     )
        // )
    );

    array_push($data, $rowData);
}

echo json_encode($data);
?>
