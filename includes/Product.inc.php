<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    echo "connected";
    $comboName = htmlspecialchars($_POST["comboName"], ENT_QUOTES, 'UTF-8');
    $ComboDescription = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
    $product1 = htmlspecialchars($_POST["product1"], ENT_QUOTES, 'UTF-8');
    $product2 = htmlspecialchars($_POST["product2"], ENT_QUOTES, 'UTF-8');
    $category = htmlspecialchars($_POST["category"], ENT_QUOTES, 'UTF-8');


    // instantiate signupContr class
    include "../classes/dbh.classes.php";
    include "../classes/ProductsModel.php";
    include "../classes/ProductsController.php";
   
    $saveCombo = new ProductController($comboName, $ComboDescription, $product1, $product2, $category);
    $saveCombo->addComboProduct();
    header("location: ../back-end/adminProducts.php?error=none");
}
