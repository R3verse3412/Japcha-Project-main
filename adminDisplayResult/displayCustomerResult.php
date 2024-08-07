<?php

$conn = new mysqli('localhost', 'root', '', 'japcha-new');

    if($conn -> connect_error){
        die('Connection Failed: ' . $conn->connect_error);
        exit();
    }else{
        
    $limit = 8; //number of rows to fetch
    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number from the URL parameter
    // Calculate the offset to determine which rows to fetch from the database
    $offset = ($page - 1) * $limit;
    $query = "SELECT customer_id, username, password, email, customer_address, contact_number FROM customer_account LIMIT $limit OFFSET $offset";
    $result = mysqli_query($conn, $query);

    // Checking if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Looping through each row and displaying the data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['customer_id'] . "</td>";
            echo "<td><img src='../image/user.jpg' alt='user image'></td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['customer_address'] . "</td>";
            echo "<td>" . $row['contact_number'] . "</td>";
            if(isset($_SESSION["fileManagement_delete"]) && $_SESSION["fileManagement_delete"] == 1){
                 echo "<td><button class='remove'>Remove</button></td>";
            }
            echo "</tr>";
        }
            
    } else {
        echo "<tr><td colspan='6'>No customer accounts found.</td></tr>";
    }
    $conn ->close();
    } 
?>