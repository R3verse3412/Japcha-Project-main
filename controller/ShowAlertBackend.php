<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/OrderModel.php";

$OrderModel = new OrderModel();

try {
    // Retrieve the timestamp of the last check from the request, or use a default timestamp
    $lastCheckTimestamp = isset($_GET['lastCheck']) ? $_GET['lastCheck'] : '1970-01-01 00:00:00';

    // Call the method to count new inserts
    $newInsertCount = $OrderModel->CheckInsertOrder();

    // Return the count and the timestamp in JSON format
    echo json_encode(['new_insert_count' => $newInsertCount, 'last_check_timestamp' => time()]);
} catch (Throwable $th) {
    // Handle exceptions
    echo json_encode(['error' => $th->getMessage()]);
}
?>
