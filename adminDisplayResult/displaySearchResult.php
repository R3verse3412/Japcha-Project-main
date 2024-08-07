<?php
include "../config/databaseConnection.php";

if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $limit = 8; // Change this value to the desired number of rows to fetch
    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number from the URL parameter
    // Calculate the offset to determine which rows to fetch from the database
    $offset = ($page - 1) * $limit;

    $query = "SELECT * FROM customer_account WHERE email LIKE '$input%' LIMIT $limit OFFSET $offset";
        // Execute the query
        $result = mysqli_query($con, $query);   

        // Generate HTML table rows for search results
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) 
            {


                // Generate table row for each row of search results here
                echo "<tr>";
                    echo "<td>" . $row['customer_id'] . "</td>";
                    echo "<td><img src='image/user.jpg' alt='user image'></td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['customer_address'] . "</td>";
                    echo "<td>" . $row['contact_number'] . "</td>";
                    echo "<td><button class='remove'>Remove</button></td>";
                    echo "<td><button class='block'>Block</button></td>";
                echo "</tr>";

            
            }
    } else {
        echo '<tr><td colspan="2">No results found.</td></tr>';
    }
} else {
    // If 'input' key is not set in the $_POST array, handle the situation accordingly
    // For example, you can display an error message or show the original data
    echo "Search input not provided.";
}

?>