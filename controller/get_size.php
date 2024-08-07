<?php

include "../config/databaseConnection.php";

try {
   
    // Query to retrieve sizes
    $query = "SELECT sizes_id, size_name FROM product_sizes WHERE isDeleted != 1";
    $result = $con->query($query);

    if (!$result) {
        throw new Exception("Query failed: " . $con->error);
    }

    // Fetch and format the data as an array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);

    // Close the database connection
    $con->close();
} catch (Exception $e) {
    // Handle exceptions (errors)
    header('Content-Type: application/json');
    echo json_encode(array("error" => $e->getMessage()));
}

