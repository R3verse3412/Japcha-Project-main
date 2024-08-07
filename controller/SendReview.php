<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Manila');
$review_date = date('Y-m-d H:i:s');

// Simulated JSON data for testing
require_once "../classes/dbh.classes.php";
require_once "../classes/ReviewModel.php";
$RevModel = new ReviewModel();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['customer_id'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $customer_id = $_POST['customer_id'];
        $customer_name = $_POST['customer_name'];
        $rating = $_POST['selectedRating'];
        $customer_review = htmlspecialchars($_POST["customer_review"], ENT_QUOTES, 'UTF-8');

        $send_review = $RevModel->SendReview($product_id, $product_name, $customer_id, $customer_name, $rating, $customer_review, $review_date);

        // Define the response as an associative array
        $response = array();

        if ($send_review != false) {
            $response['success'] = 'Review has been successfully submitted';
        } else {
            $response['error'] = 'Unable to send the review';
        }

        echo json_encode($response);
    }
}
?>
