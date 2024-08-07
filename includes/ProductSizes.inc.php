<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $product = htmlspecialchars($_POST["product"], ENT_QUOTES, 'UTF-8');
    $size = htmlspecialchars($_POST["size"], ENT_QUOTES, 'UTF-8');
    $price = htmlspecialchars($_POST["price"], ENT_QUOTES, 'UTF-8');
    $quantity = htmlspecialchars($_POST["quantity"], ENT_QUOTES, 'UTF-8');
   

    // instantiate signupContr class
    include "../classes/dbh.classes.php";
    include "../classes/ProductSizes-Model.php";
    include "../classes/add-ProductSizes-Controller.php";
    $addProductSize = new ProductSizesController($product, $size, $price, $quantity);

    // Runnig error handlers and user signup
    $addProductSize-> addProductSizes();
    header("location: ../bacK-end/admin-ProductSizes.php?error=none");
    // $customerId = $signup->fetchCustomerId($username);
    // instantiate ProfileInfoContr class
    // include "../classes/profileinfo.classes.php";
    // include "../classes/profileinfo-cntrl.classes.php";
    // $profileInfo = new ProfileInfoContr($customerId, $username);
    // $profileInfo->defaultProfileInfo();

    // // Going back to front page
    // header("location: ../index.php?error=none");

}
