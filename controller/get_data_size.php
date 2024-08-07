<?php

include "../config/databaseConnection.php";

if (isset($_POST['sizeID'])) {
//     echo "connected";
    $sizeID = htmlspecialchars($_POST["sizeID"], ENT_QUOTES, 'UTF-8');
    $query = "SELECT * FROM size WHERE size_id = '$sizeID'";
    $result = mysqli_query($con, $query);

    $size_data = array(); // Initialize an empty array to store data

    while ($row = mysqli_fetch_assoc($result)) {
        // Append data to the array for each row
        $size_data[0] = $row['size_id'];
        $size_data[1] = $row['size_name'];
    }
    // Output JSON response
    echo json_encode($size_data);

} else {
    // Handle the case where 'AddonsId' is not set in $_POST
    echo json_encode(array('error' => 'CategoryID is missing.'));
}