<?php

include "../config/databaseConnection.php";

if (isset($_POST['categoryid'])) {
    echo "connected";
    // $category_id = $_POST['categoryid'];
    // $query = "SELECT * FROM category WHERE category_id = '$category_id'";
    // $result = mysqli_query($con, $query);

    // $category_data = array(); // Initialize an empty array to store data

    // while ($row = mysqli_fetch_assoc($result)) {
    //     // Append data to the array for each row
    //     $category_data[0] = $row['addons_id'];
    //     $category_data[1] = $row['addons_name'];
    // }
    // // Output JSON response
    // echo json_encode($category_data);

} else {
    // Handle the case where 'AddonsId' is not set in $_POST
    echo json_encode(array('error' => 'AddonsId is missing.'));
}