<?php

// require "../config/databaseConnection.php";
require_once "../classes/dbh.classes.php";
require_once "../classes/ProductsModel.php";
$productModel = new ProductModel();
// $sizeid, $prodid
if (isset($_GET['category']) && isset($_GET['prodid'])){

    $sizeid = $_GET['category'];

    $prodid = $_GET['prodid'];

    $getPrice = $productModel->getPriceBySize($sizeid, $prodid);

    if($getPrice != false){
        echo '<span>'.$getPrice.'</span>';
    }else{
        echo '<span>NaN</span>';
    }

  
}
?>
