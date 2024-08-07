<?php
require_once "classes/dbh.classes.php";
require_once "classes/BestSeller.php";

$excludeProductIds = isset($_GET['excludeProductIds']) ? json_decode($_GET['excludeProductIds'], true) : [];

$statModel = new BestSeller();
$remainingProducts = $statModel->RemainingBestSellerProducts($excludeProductIds);

// Return JSON response for carouselContent_second
header('Content-Type: application/json');
echo json_encode($remainingProducts);
?>
