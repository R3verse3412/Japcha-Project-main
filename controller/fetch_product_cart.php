<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/CartModel.php";

$CartModel = new CartMOdel();

    $customerId = $_GET['customer_id'];
    $cart = $CartModel->fetchCart($customerId);
  
        $CartItem = [];

        foreach ($cart as $carts){
            $addons_id = isset($carts['addons_id']) ? $carts['addons_id'] : null;
            $prod = $CartModel->fetchCartDetails($carts['product_id'], $carts['size_id'], $carts['addons_id']);
            // $addonsDetails = $CartModel->FetchAddons($carts['addons_id']);
            $addonsName = $carts['addons_name'] ?? "None";
            $fetchPrize = $CartModel->fetchPrice($carts['size_id'], $carts['product_id']);
            $CartItem[] = [
                'cartids' => $carts['cart_id'],
                'image_url' => 'upload/'. $prod['image_url'],
                'product_name' => $carts['product_name'],
                'product_id' => $carts['product_id'],
                'sizename' => $carts['size_name'],
                'addonsname' => $addonsName,
                'price' => $fetchPrize['price'],
                'quantity' => $carts['quantity'],
             
            ];
            
        }

        // Return the sample product data as JSON
        header('Content-Type: application/json');
        echo json_encode($CartItem);


   

