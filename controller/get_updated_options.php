<?php

require_once "../classes/dbh.classes.php";
require_once "../classes/ProductsModel.php";
require_once "../classes/ProductsModel.php";
$productModel = new ProductModel();
if (isset($_POST['id']) && isset($_POST['prodId']))  {
  
    $sizeid = $_POST['id'];
    $prod_id = $_POST['prodId'];

    $optionsHTML = '';

    $productModel->getSizeVariation($sizeid, $prod_id);
    if($productModel != false){
        $price = $productModel['price'];

        $sizeModel = new addSize();
        $sizemodel->getSizeName($sizeid);

        if($sizeModel != false){
            $sizeName = $sizeModel['size_name'];
            $optionsHTML = '<option value="' . $sizeid . '">' . $sizeName . ' - $' . $price . '</option>';
        }


    }else{
        echo $optionsHTML;
    }
   

} else{
    echo "error: Missing parameters";
}