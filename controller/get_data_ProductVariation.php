<?php

include "../config/databaseConnection.php";

if (isset($_POST['variationID'])) {
//     echo "connected";
    $variationID = htmlspecialchars($_POST["variationID"], ENT_QUOTES, 'UTF-8');
    
    $query = "SELECT * FROM product_sizes WHERE ProductSizes_id = '$variationID'";
    $result = mysqli_query($con, $query);

    $variation_data = array(); // Initialize an empty array to store data

    while ($row = mysqli_fetch_assoc($result)) {
        // Append data to the array for each row
        $variation_data[0] = $row['ProductSizes_id'];
        $variation_data[1] = $row['product_id'];
        $variation_data[2] = $row['size_id'];
        $variation_data[3] = $row['price'];
        $variation_data[4] = $row['quantity'];
    }
    // Output JSON response
    echo json_encode($variation_data);

} else {
    // Handle the case where 'AddonsId' is not set in $_POST
    echo json_encode(array('error' => 'CategoryID is missing.'));
}