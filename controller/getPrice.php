<?php

require "../classes/dbh.classes.php";
require "../classes/ProductsModel.php";
$prodModel = new ProductModel();

if(isset($_POST['size'])){
    var_dump($_POST['size']);
    // $size = $_POST['size']; // Assuming you are using { content: orders } in your AJAX request
    // $save = $prodModel->getPrice($size);
    // if ($save === false) {
    //     // Handle the database error here
    //     echo "Error saving content to the database";
    //     exit;
    // }else{
    //     header("Location: ../back-end/admin-cms.php");
    //     exit;
    // }
}