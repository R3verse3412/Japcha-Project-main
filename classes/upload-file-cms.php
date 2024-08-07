<?php

require 'dbh.classes.php';
require 'upload-file-cms-Model.php';
$fileModel = new uploadFile();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDir = '../upload-content/';
    $uploadFile = $uploadDir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {

        $filename = basename($_FILES['file']['name']);

         if ($fileModel->saveFileDetails($filename)) {
            $response = [
                'success' => true,
                'message' => 'File uploaded successfully and details saved to the database.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error saving file details to the database.'
            ];
        }

    } else {
        $response = [
            'success' => false,
            'message' => 'Error uploading the file.'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request or empty input
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request or empty input']);
}



