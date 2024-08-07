<?php
session_start();
require "dbh.classes.php";
require "ProductsModel.php";
$productModel = new ProductModel();
$products = $productModel->getAllProducts();
if(isset($_POST['category'])){
    $category = $_POST['category'];
    
    if( $category === ""){
        
        $out = '';
        foreach ($products as $item) {
                $out .= '
                <div class="card p-2" style="width: 18rem; height: 350px">
                <div class="header d-flex justify-content-center p-2" style="height: 60%">
                ';

        // PHP code for rendering image or video based on file type
        if (strpos($item['image_url'], '.mp4') !== false) {
            $out .= '
                <video controls style="max-width: 100%">
                    <source src="../upload/' . $item['image_url'] . '" type="video/mp4">
                    <p>Your browser does not support the video tag</p>
                </video>';
        } else {
            $out .= '
                <img src="../upload/' . $item['image_url'] . '" alt="" style="max-width: 100%">';
        }

        $out .= '
                </div>
                <div class="card-body" style="height: 40%">
                    <div class="body" style="height:50%">
                        <h5 class="card-title">' . $item['product_name'] . '</h5>
                    </div>
                        
                    <div class="card-footer d-flex justify-content-center gap-2" style="background-color: transparent;  height:50%;">
                    ';

        // PHP code for rendering buttons based on conditions
        if (isset($_SESSION["fileManagement_edit"]) && $_SESSION["fileManagement_edit"] == 1) {
            $out .= '
                <button class="btn btn-info" data-tooltip="tooltip" data-placement="top" title="View Userlevel"
                    data-toggle="modal" data-target=""><i class="fa fa-eye" aria-hidden="true"></i></button>
                <button class="btn btn-secondary" data-tooltip="tooltip" data-placement="top" title="Edit Userlevel"
                    data-toggle="modal" data-target=""><i class="fa fa-edit" aria-hidden="true"></i></button>
                <button class="btn btn-warning" data-tooltip="tooltip" data-placement="top" title="Archive Userlevel"
                    data-toggle="modal" data-target=""><i class="fa fa-archive" aria-hidden="true"></i></button>
                <button class="btn btn-danger" data-tooltip="tooltip" data-placement="top" title="Delete Userlevel"
                    data-toggle="modal" data-target=""><i class="fa fa-trash" aria-hidden="true"></i></button>';
        }

        $out .= '
                    </div>
                </div>
            </div>';
            
        }

        echo $out;
    }else{
        $products = $productModel->getProductsByCategory($category);
        $out = '';
        foreach ($products as $item) {
            if ($item['category_id'] == $category) {
                $out .= '
                <div class="card p-2" style="width: 18rem; height: 350px">
                <div class="header d-flex justify-content-center p-2" style="height: 60%">
                ';

        // PHP code for rendering image or video based on file type
        if (strpos($item['image_url'], '.mp4') !== false) {
            $out .= '
                <video controls style="max-width: 100%">
                    <source src="../upload/' . $item['image_url'] . '" type="video/mp4">
                    <p>Your browser does not support the video tag</p>
                </video>';
        } else {
            $out .= '
                <img src="../upload/' . $item['image_url'] . '" alt="" style="max-width: 100%">';
        }

        $out .= '
                </div>
                <div class="card-body" style="height: 40%">
                    <div class="body" style="height:50%">
                        <h5 class="card-title">' . $item['product_name'] . '</h5>
    
                    </div>
                        
                    <div class="card-footer d-flex justify-content-center gap-2" style="background-color: transparent; height:50%;">
                    ';

        // PHP code for rendering buttons based on conditions
        if (isset($_SESSION["fileManagement_edit"]) && $_SESSION["fileManagement_edit"] == 1) {
            $out .= '
                <button class="btn btn-info" data-tooltip="tooltip" data-placement="top" title="View Userlevel"
                    data-toggle="modal" data-target="#viewProd' . $item['product_id'].'"><i class="fa fa-eye" aria-hidden="true"></i></button>
                <button class="btn btn-secondary" data-tooltip="tooltip" data-placement="top" title="Edit Userlevel"
                    data-toggle="modal" data-target="#edit' . $item['product_id'].'"><i class="fa fa-edit" aria-hidden="true"></i></button>
                <button class="btn btn-warning" data-tooltip="tooltip" data-placement="top" title="Archive Userlevel"
                    data-toggle="modal" data-target="#archiveProduct' . $item['product_id'].'"><i class="fa fa-archive" aria-hidden="true"></i></button>
                <button class="btn btn-danger" data-tooltip="tooltip" data-placement="top" title="Delete Userlevel"
                    data-toggle="modal" data-target="#deleteProduct' . $item['product_id'].'"><i class="fa fa-trash" aria-hidden="true"></i></button>';
        }

        $out .= '
                    </div>
                </div>
            </div>';
            }
        }

        echo $out;
    }
}