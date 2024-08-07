<?php

require_once "../classes/dbh.classes.php";
require_once "classes/VariationModel.php";
$VarModel = new VariationModel();
$variation_data = $VarModel->getPrice($productid);
// Filter the products based on the limit
$price = array_slice($variation_data);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($price);
?>
