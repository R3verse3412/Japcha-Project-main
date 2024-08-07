<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/profileinfo.classes.php";
$Profile_Model = new ProfileInfo();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['userid'])) {

        $userid = $_GET['userid'];
        $customer_date = $Profile_Model->getCustomerDataFront($userid);

        // Concatenate address components with a separator
        $address = $customer_date['customer_address'] . ', ' . $customer_date['postal_code'] . ', ' . $customer_date['city'] . ', ' . $customer_date['region'];

        // Return as JSON
        echo json_encode($address);
    }
    
}

