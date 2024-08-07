<?php
// Initialize the session or any required authentication checks
require_once "../classes/dbh.classes.php";
require_once "../classes/CartModel.php";
require_once "../classes/add-size.classes.php";
require_once "../classes/add-addons.classes.php";
require_once "../classes/ProductsModel.php";

$cart = new CartModel();
$sizeModel = new addSize();
$addonsModel = new addAddons();
$productModel = new ProductModel();
// ... (previous code)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receive and validate the data
    $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : null;
    $product_id = isset($_POST['prod__id']) ? $_POST['prod__id'] : null;
    $size_id = isset($_POST['size_id']) ? $_POST['size_id'] : null;
    // $addons_id = isset($_POST['addonsid']) ? $_POST['addonsid'] : null;
    $p_name = isset($_POST['p_name']) ? $_POST['p_name'] : null;
    
    $product_price = $productModel->getPriceBySize($size_id, $product_id);
    // $addons_name = isset($_POST['addons_name']) ? $_POST['addons_name'] : null;

    $addons_id = isset($_POST['addonsid']) ? $_POST['addonsid'] : null;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
    // $subtotal = 20;

    $size_name = $sizeModel->getSizeNameCart($size_id);
    $addons_details = $addonsModel->getOneAddons($addons_id);
    $addos_name = $addons_details['addons_name'] ?? "";
    $addos_price = $addons_details['price'] ?? "";
    

    // $response = "Customer ID: " . $customer_id . " Product ID: " . $quantity;
    
    // You can check if the addons_id is null or set to some default value
   
        // Perform cart update operations here, including database interactions
        
        // Example: Insert the selected product, size, and addons into the cart table
        $cart->insertToCart($customer_id, $product_id, $p_name, $product_price, $size_id, $size_name, $addons_id,  $addos_name, $addos_price, $quantity);
        
        // Check if the cart update was successful
        if ($cart != false) {
            $response = array('success' => true, 'message' => 'Item added to cart.' );
        } else {
            $response = array('success' => false, 'message' => 'Failed to add item to cart.');
        }

        // $response = "name: " . $product_price;
        // header('Content-Type: application/json');
        // echo json_encode($response);
   
} else {
    $response = array('success' => false, 'message' => 'Invalid request method.');
}

// Return the response in JSON format
header('Content-Type: application/json');
echo json_encode($response);
