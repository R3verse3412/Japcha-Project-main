<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $prodvar_id = htmlspecialchars($_POST["prodvar_id"], ENT_QUOTES, 'UTF-8');
    $product = htmlspecialchars($_POST["product"], ENT_QUOTES, 'UTF-8');
    $size = htmlspecialchars($_POST["size"], ENT_QUOTES, 'UTF-8');
    $price = htmlspecialchars($_POST["price"], ENT_QUOTES, 'UTF-8');
    $quantity = htmlspecialchars($_POST["quantity"], ENT_QUOTES, 'UTF-8');

    include "../classes/dbh.classes.php";
    include "../classes/ProductSizes-Model.php";
    include "../classes/ProductVariationController.php";
    $update = new ProdVarController($prodvar_id, $product, $size, $price, $quantity);

    // Runnig error handlers and user signup
    $update-> updateProductVariation();
    header("location: ../bacK-end/admin-ProductSizes.php?error=none");

    // // Going back to front page
    // header("location: ../index.php?error=none");

}
