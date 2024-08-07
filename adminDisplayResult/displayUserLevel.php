<?php
     $con = mysqli_connect('localhost', 'root', '', 'japcha');
    
     // Check connection
     if (mysqli_connect_error()) {
        echo "Failed to connect to MySQL:  " .mysqli_connect_error();
        exit();
     }

    $query = "SELECT userLevel_id, user_level FROM user_level LIMIT 6";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Looping through each row and displaying the data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['userLevel_id'] . "</td>";
            echo "<td>" . $row['user_level'] . "</td>";
            echo "<td><button class='edit'>Edit</button></td>";
            echo "<td><button class='remove'>Remove</button></td>";
            echo "</tr>";
        }
            
    } else {
        echo "<tr><td colspan='6'>No categories found.</td></tr>";
    }

?>