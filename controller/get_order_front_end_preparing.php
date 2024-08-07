<?php
header('Content-Type: application/json');
// Simulated JSON data for testing
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";
$OrderModel = new Order();
$userid = $_GET['userId'];

$result = $OrderModel->getOrderNumberByCustomerPreparing($userid);
$orders = $result['orders'];
$total_price = $result['total_prices'];
$count = $result['count'];

$data = array();

// $order = $db;

for ($i = 0; $i < $count; $i++) {
    // $order_id = $order[$i]['id'];
    $order_id = $orders[$i];

    $product = $OrderModel->getOrderByCustomerPrepaing($order_id, $userid);
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

// $data = '[
//     {
//         "orderID":'.$orders.',
//         "products": [
//             {
//                 "image_url": "product1.jpg",
//                 "product_name": "Product 1",
//                 "price": "$10.00",
//                 "quantity": 3,
//                 "addons_name": "Addon 1",
//                 "addons_price": "$2.00",
//                 "subtotal": "$32.00"
//             },
//             {
//                 "image_url": "product2.jpg",
//                 "product_name": "Product 2",
//                 "price": "$15.00",
//                 "quantity": 2,
//                 "addons_name": "Addon 2",
//                 "addons_price": "$3.00",
//                 "subtotal": "$33.00"
//             }
//         ]
//     },
//     {
//         "orderID": 2,
//         "products": [
//             {
//                 "image_url": "product3.jpg",
//                 "product_name": "Product 3",
//                 "price": "$12.00",
//                 "quantity": 4,
//                 "addons_name": "Addon 3",
//                 "addons_price": "$4.00",
//                 "subtotal": "$56.00"
//             },
//             {
//                 "image_url": "product4.jpg",
//                 "product_name": "Product 4",
//                 "price": "$18.00",
//                 "quantity": 1,
//                 "addons_name": "Addon 4",
//                 "addons_price": "$2.50",
//                 "subtotal": "$20.50"
//             }
//         ]
//     }
// ]';

// echo $data;
?>
