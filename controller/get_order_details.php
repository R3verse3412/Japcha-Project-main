<?php
// Include your database connection code
// Include your database connection code
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";
require_once "../classes/CartModel.php";

$CartModel = new CartMOdel();
$OrderModel = new Order();

if (isset($_GET['customerId'])) {
    $customer_Id = $_GET['customerId'];
    $orderid = $_GET['order_id'];
    
    $order_data = $OrderModel->getOrder($orderid, $customer_Id);

    if (!empty($order_data)) { // Check if orders were found
        $orderDetails = [];

        foreach ($order_data as $order) {
            
            $proddata = $OrderModel->getData($orderid);
            $addons_id = $order['addons_id'] ?? null;
            $addonsDetails = $CartModel->FetchAddons($order['addons_id']);
            $addonsNAME = $addonsDetails['addons_name'] ?? "none";
            $orderDetails[] = [
                'orderNo' => $order['order_id'],
                'email' => $proddata['email'],
                'address' => $proddata['customer_address'],
                'customerName' => $proddata['username'],
                'addons' => [
                    'orders_id' => $order['order_id'],
                    'productName' => $order['product_name'],
                    'imageURL' => '../upload/' . $order['image_url'],
                    'size_name' => $proddata['size_name'],
                    'quantity' => 'x' . $order['quantity'],
                    'addons_name' =>  $addonsNAME,
                    'price' => $order['subtotal'],
                    'remarks_' => $order['product_remark']
                ],
                'cashOnDelivery' => $order['price'],
            ];
        }

        // Encode the order details as JSON and return it
        echo json_encode($orderDetails);
    } else {
        // Handle the case where no orders were found
        echo json_encode(['error' => 'No orders found']);
    }
}
