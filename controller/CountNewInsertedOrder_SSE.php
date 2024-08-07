<?php
// Set the timezone to Manila, Philippines
// Function to send updates
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

function sendUpdate($data) {
    echo "data: $data\n\n";
    ob_flush();
    flush();
}

// Function to fetch updated appointment count (replace this with actual data retrieval)
function fetchNewInsertCount() {
    require_once "../classes/dbh.classes.php";
    require_once "../classes/OrderModel.php";

    $OrderModel = new Order();

    // Retrieve the timestamp of the last check from the request, or use a default timestamp
    $lastCheckTimestamp = isset($_GET['lastCheck']) ? $_GET['lastCheck'] : '1970-01-01 00:00:00';

    // Call the method to count new inserts
    $newInsertCount = $OrderModel->CountNewInserts();

    // Return the count in JSON format
    return json_encode(['new_insert_count' => $newInsertCount]);
}

// Simulate real-time updates (replace this with actual database queries)
while (true) {
    $newInsertCount = fetchNewInsertCount(); // Implement this function to fetch updated data
    sendUpdate($newInsertCount);
    sleep(5); // Adjust the polling interval as needed
}

