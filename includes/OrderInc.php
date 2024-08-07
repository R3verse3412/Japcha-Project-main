<?php
session_start();
include "../classes/dbh.classes.php";
include "../classes/OrderModel.php";
include "../classes/OrderController.php";
require_once "../classes/CartModel.php";
require_once "../classes/CouponModel.php";
$coupon_model = new CouponModel();

$cartmodel = new CartModel();
$order = new Order();
date_default_timezone_set('Asia/Manila');
$order_date = date('Y-m-d H:i:s');
// echo $order_date;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['proceed1'])){ 
         // echo 'connected';
    // echo '<br>';
    $payment_pickup = isset($_POST["group"]["payment"]["pickup"]) ? 1 : 0;
    $payment_cod = isset($_POST["group"]["payment"]["cod"]) ? 1 : 0;
    $payment_gcash = isset($_POST["group"]["payment"]["gcash"]) ? 1 : 0;
    $gcash_upload = null;
    if($payment_gcash != 0){
        if(isset($_FILES['gcash_payment_upload'])) {
            $file = $_FILES['gcash_payment_upload'];
            // Check if there was no error during the file upload
            if($file['error'] === 0) {
                $fileType = $file['type'];
    
                // Define allowed image MIME types
                $allowedImageTypes = array('image/jpeg', 'image/png');
    
                if (in_array($fileType, $allowedImageTypes)) {
                    // The uploaded file is an image
                    // echo 'File is an image. You can process it here.';
                    $uploadDirectory = '../upload-content/';
                    $uploadPath = $uploadDirectory . $_FILES['gcash_payment_upload']['name'];
                    $tmp_name = $_FILES['gcash_payment_upload']['tmp_name'];
                    move_uploaded_file($tmp_name, $uploadPath);
    
                    $gcash_upload = $_FILES['gcash_payment_upload']['name'];
                } else {
                    echo 'File is not an image. Please upload a valid image.';
                }
            } else {
                echo 'Error during file upload. Please try again.';
            }
        } else {
            echo 'No file was uploaded.';
        }
    }

    $discount_check = isset($_POST["check_discount"]) ? 1 : 0;
    $discount_percent = 0;
    $discount_name = "none";
    if( $discount_check != 0){
        if(isset($_FILES['id_validation'])) {
            $file = $_FILES['id_validation'];
            // Check if there was no error during the file upload
            if($file['error'] === 0) {
                $fileType = $file['type'];
    
                // Define allowed image MIME types
                $allowedImageTypes = array('image/jpeg', 'image/png');
    
                if (in_array($fileType, $allowedImageTypes)) {
                    // The uploaded file is an image
                    // echo 'File is an image. You can process it here.';
                    $uploadDirectory = '../upload-content/';
                    $uploadPath = $uploadDirectory . $_FILES['id_validation']['name'];
                    $tmp_name = $_FILES['id_validation']['tmp_name'];
                    move_uploaded_file($tmp_name, $uploadPath);
    
                    $valid_id = $_FILES['id_validation']['name'];
                } else {
                    echo 'File is not an image. Please upload a valid image.';
                }
            } else {
                echo 'Error during file upload. Please try again.';
            }
        } else {
            echo 'No file was uploaded.';
        }
        $discount_percent = htmlspecialchars($_POST["discount_percentage_senior"], ENT_QUOTES, 'UTF-8');

        $discount_name = htmlspecialchars($_POST["discount_name"], ENT_QUOTES, 'UTF-8');
    }

    // echo  $logo_name;
    // echo ' pickup: ';
    // echo $payment_pickup ;
    // echo ' cod: ';
    // echo $payment_cod ;
    // echo ' gcas:';
    // echo $payment_gcash;
    $totalprice = htmlspecialchars($_POST["total_data"], ENT_QUOTES, 'UTF-8');
    $remark = htmlspecialchars($_POST["remarks"], ENT_QUOTES, 'UTF-8');
    

    $customerid = htmlspecialchars($_POST["userid"], ENT_QUOTES, 'UTF-8');

    $prodid = htmlspecialchars($_POST["product_id_data"], ENT_QUOTES, 'UTF-8');

    $product_name = htmlspecialchars($_POST["p_name"], ENT_QUOTES, 'UTF-8');
    $product_price = htmlspecialchars($_POST["product_price"], ENT_QUOTES, 'UTF-8');
    

    $sizesid = htmlspecialchars($_POST["size_data"], ENT_QUOTES, 'UTF-8');
    $size_name = htmlspecialchars($_POST["size_name"], ENT_QUOTES, 'UTF-8');

    $subtotal = htmlspecialchars($_POST["subtotal1"], ENT_QUOTES, 'UTF-8');



    $quantity = htmlspecialchars($_POST["quantity"], ENT_QUOTES, 'UTF-8');

    $address = htmlspecialchars($_POST["address"], ENT_QUOTES, 'UTF-8');
    

    $addons_id = $_POST['addons_data'] ?? null;
    $addons_name = $_POST["addons_name"] ?? "";
    $addons_price = $_POST["addons_price"] ?? null;

    $product_remark = htmlspecialchars($_POST["prd_remark"], ENT_QUOTES, 'UTF-8');

  

    // echo '<br>';
    $discount = 0;
    $offerName = "none";
    $couponId = 0;
    $selectedCoupons = isset($_POST["selected_coupons"]) ? $_POST["selected_coupons"] : array();

    foreach ($selectedCoupons as $selectedCoupon) {
        $couponInfo = explode(' ', $selectedCoupon);
        
        $discount = isset($couponInfo[0]) ? floatval($couponInfo[0]) : 0;
        $offerName = isset($couponInfo[1]) ? implode(' ', array_slice($couponInfo, 1, -1)) : 'none';
        $couponId = end($couponInfo); // Get the last element as the ID
    
          $update_coupon_quantity = $coupon_model->updateCoupon($couponId);
    }

    if($order->insertToOrderHeader($customerid,  $totalprice, $remark, $address, $order_date, $payment_pickup , $payment_cod , $payment_gcash,  $gcash_upload, $discount, $offerName, $couponId, $discount_percent,  $discount_name,   $valid_id)){
        
        $getOrderNumber = $order->getOrderNumberOfCustomer($customerid,  $totalprice, $order_date);

        if($order->setOrder((int)$getOrderNumber, $customerid, $prodid, $product_name, $product_price, $sizesid, $size_name, $subtotal, $quantity, $addons_id, $addons_name, $addons_price, $product_remark, $order_date)){
            $_SESSION['order_placed'] = "successful_order";
            header("location: ../customerSHOP.php?error=none");
            exit();
        } else {
            echo "Failed to insert records.";
        }

    }


}
   

if(isset($_POST['proceed2'])){
    $payment_pickup = isset($_POST["group"]["payment"]["pickup"]) ? 1 : 0;
    $payment_cod = isset($_POST["group"]["payment"]["cod"]) ? 1 : 0;
    $payment_gcash = isset($_POST["group"]["payment"]["gcash"]) ? 1 : 0;
    $gcash_upload = null;
    if($payment_gcash != 0){
        if(isset($_FILES['gcash_payment_upload'])) {
            $file = $_FILES['gcash_payment_upload'];
            // Check if there was no error during the file upload
            if($file['error'] === 0) {
                $fileType = $file['type'];
    
                // Define allowed image MIME types
                $allowedImageTypes = array('image/jpeg', 'image/png');
    
                if (in_array($fileType, $allowedImageTypes)) {
                    // The uploaded file is an image
                    // echo 'File is an image. You can process it here.';
                    $uploadDirectory = '../upload-content/';
                    $uploadPath = $uploadDirectory . $_FILES['gcash_payment_upload']['name'];
                    $tmp_name = $_FILES['gcash_payment_upload']['tmp_name'];
                    move_uploaded_file($tmp_name, $uploadPath);
    
                    $gcash_upload = $_FILES['gcash_payment_upload']['name'];
                   
                    // $savs = $samplemodel->setLogo($logo_name);
                    
                    // if ($savs === false) {
                    //     // Handle the database error here
                    //     echo "Error saving order to the database";
                    // } else {
                    //     // Specify the directory to move the file to
                    // }
                } else {
                    echo 'File is not an image. Please upload a valid image.';
                }
            } else {
                echo 'Error during file upload. Please try again.';
            }
        } else {
            echo 'No file was uploaded.';
        }
    }

    $discount_check = isset($_POST["check_discount"]) ? 1 : 0;
    $discount_percent = 0;
    $discount_name = "none";
    if( $discount_check != 0){
        if(isset($_FILES['id_validation'])) {
            $file = $_FILES['id_validation'];
            // Check if there was no error during the file upload
            if($file['error'] === 0) {
                $fileType = $file['type'];
    
                // Define allowed image MIME types
                $allowedImageTypes = array('image/jpeg', 'image/png');
    
                if (in_array($fileType, $allowedImageTypes)) {
                    // The uploaded file is an image
                    // echo 'File is an image. You can process it here.';
                    $uploadDirectory = '../upload-content/';
                    $uploadPath = $uploadDirectory . $_FILES['id_validation']['name'];
                    $tmp_name = $_FILES['id_validation']['tmp_name'];
                    move_uploaded_file($tmp_name, $uploadPath);
    
                    $valid_id = $_FILES['id_validation']['name'];
                } else {
                    echo 'File is not an image. Please upload a valid image.';
                }
            } else {
                echo 'Error during file upload. Please try again.';
            }
        } else {
            echo 'No file was uploaded.';
        }
        $discount_percent = htmlspecialchars($_POST["discount_percentage_senior"], ENT_QUOTES, 'UTF-8');

        $discount_name = htmlspecialchars($_POST["discount_name"], ENT_QUOTES, 'UTF-8');
    }


    $userID = $_POST["userid"];
    $customerid = $_POST["cid"];
    $totalprice = $_POST["total_data"];
    $subtotals = $_POST['subtotal1']; // This is now an array
    $prodid = $_POST["product_id_data"];
    $sizesid = $_POST["size_data"];
    $quantity = $_POST["quantity"];
    $addons = $_POST['addons_data'];
    $remark = htmlspecialchars($_POST["remarks"], ENT_QUOTES, 'UTF-8');

    $prod_price =$_POST["product_price"];
    $array = $_POST['prd_remark']; // Example, replace with your actual variable
    $product_remark = array_map('htmlspecialchars', $array);

    $addons_name = $_POST['addons_name'];
    $addons_price = $_POST['addons_price'];
    $p_name = $_POST['p_name'];
    $size_name = $_POST['size_name'];
    $address = htmlspecialchars($_POST["address"], ENT_QUOTES, 'UTF-8');

    $discount = 0;
    $offerName = "none";
    $couponId = 0;
    $selectedCoupons = isset($_POST["selected_coupons"]) ? $_POST["selected_coupons"] : array();

    foreach ($selectedCoupons as $selectedCoupon) {
        $couponInfo = explode(' ', $selectedCoupon);
        
        $discount = isset($couponInfo[0]) ? floatval($couponInfo[0]) : 0;
        $offerName = isset($couponInfo[1]) ? implode(' ', array_slice($couponInfo, 1, -1)) : 'none';
        $couponId = end($couponInfo); // Get the last element as the ID
    
          $update_coupon_quantity = $coupon_model->updateCoupon($couponId);
    }



    $number_of_rows = count($customerid); 
   
    $UpdateCart = $cartmodel->updateCart($userID);

    if($order->insertToOrderHeader($userID,  $totalprice, $remark, $address, $order_date, $payment_pickup , $payment_cod , $payment_gcash,  $gcash_upload, $discount, $offerName, $couponId, $discount_percent,  $discount_name,   $valid_id)){
        $getOrderNumber = $order->getOrderNumberOfCustomer($userID,  $totalprice, $order_date);
        for ($i = 0; $i < $number_of_rows; $i++) {

            $addons_id = !empty($addons[$i]) ? $addons[$i] : null;
            $AddonsName = !empty($addons_name[$i]) ? $addons_name[$i] : null;
            $AddonsPrice = !empty($addons_price[$i]) ? $addons_price[$i] : null;
            $InsertOrder[] = [
                'orders_id' => (int)$getOrderNumber,
                'customer_id' => $customerid[$i],
                'product_id' => $prodid[$i],
                'product_name' => $p_name[$i],
                'product_price' => $prod_price[$i], 
                'sizes_id' => $sizesid[$i],
                'size_name' => $size_name[$i],
                'addons_id' => $addons_id,
                'addons_name' => $AddonsName, 
                'addons_price' => $AddonsPrice,  // Set to null or provide actual values
                'quantity' => $quantity[$i],
                'subtotal' => $subtotals[$i],
                'product_remark' => $product_remark[$i],
                'order_date' => $order_date,
                
            ];
        }

        // var_dump($getOrderNumber);
        // var_dump($InsertOrder);
        if ($order->insertMultipleOrder($InsertOrder)) {
            $_SESSION['order_placed'] = "successful_order";
            header("location: ../customerSHOP.php?error=none");
            exit();
        } else {
            echo "Failed to insert multiple records.";
        }
    }else{
        echo "Failed to insert records.";
    }

  
}
    

}