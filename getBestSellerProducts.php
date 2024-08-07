<?php
require_once "classes/dbh.classes.php";
require_once "classes/BestSeller.php";

$statModel = new BestSeller();
$statBestSelling = $statModel->BestSellerProduct();
$productLimit = 3; // Set the limit to 3

// Filter the products based on the limit
$filteredProducts = array_slice($statBestSelling, 0, $productLimit);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($filteredProducts);
?>
