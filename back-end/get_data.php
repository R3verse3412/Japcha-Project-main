<?php

// require_once('../includes/functions.inc.php');
include "../config/databaseConnection.php";

if (isset($_POST['AddonsId'])) {
    $addonsID = $_POST['AddonsId'];
    $query = "SELECT * FROM addons WHERE addons_id = '$addonsID'";
    $result = mysqli_query($con, $query);

    $addons_data = array(); // Initialize an empty array to store data

    while ($row = mysqli_fetch_assoc($result)) {
        // Append data to the array for each row
        $addons_data[0] = $row['addons_id'];
        $addons_data[1] = $row['addons_name'];
    }
    // Output JSON response
    echo json_encode($addons_data);

} else {
    // Handle the case where 'AddonsId' is not set in $_POST
    echo json_encode(array('error' => 'AddonsId is missing.'));
}