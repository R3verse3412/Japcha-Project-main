<?php
include "../config/databaseConnection.php";

try {
    $query = "SELECT MAX(sizes_id) AS maxRow FROM product_sizes";
    $result = $con->query($query);

    if (!$result) {
        throw new Exception("Query failed: " . $con->error);
    }

    $row = $result->fetch_assoc();
    $maxRow = $row['maxRow'];

    // Return the maximum row value as JSON
    header('Content-Type: application/json');
    echo json_encode(array('maxRow' => $maxRow));
} catch (Exception $e) {
    // Handle exceptions (errors)
    header('Content-Type: application/json');
    echo json_encode(array("error" => $e->getMessage()));
}
?>
