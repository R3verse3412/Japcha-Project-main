<?php

require_once "../classes/dbh.classes.php";
require_once "../classes/ProductsModel.php";
$productModel = new ProductModel();
if (isset($_POST['id']) && isset($_POST['prodId']))  {
  
    $sizeid = $_POST['id'];
    $prod_id = $_POST['prodId'];

    $productModel->deleteVariation($sizeid, $prod_id);
    if($productModel != false){
        echo "success";
    }else{
        echo "didn't update variation.";
    }
   

} else{
    echo "error: Missing parameters";
}