<!-- <?php -->
// Currently not used!!

    // $con = new mysqli('localhost', 'root', '', 'japcha');

    // if($con -> connect_error){
    //     die('Connection Failed: ' . $con->connect_error);
    //     exit();
    // }else{
        
    // $limit = 8; //number of rows to fetch
    // $page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number from the URL parameter
    // // Calculate the offset to determine which rows to fetch from the database
    // $offset = ($page - 1) * $limit;
    // $query = "SELECT admin_id, username, email, user_level, contact FROM admin_account LIMIT $limit OFFSET $offset";
    // $result = mysqli_query($con, $query);

    // Checking if any rows were returned
    // if (mysqli_num_rows($result) > 0) {
        // Looping through each row and displaying the data
//         while ($row = mysqli_fetch_assoc($result)) {
//             echo "<tr>";
//             echo "<td>" . $row['admin_id'] . "</td>";
//             echo "<td><img src='image/user.jpg' alt='user image'></td>";
//             echo "<td>" . $row['username'] . "</td>";
//             echo "<td>" . $row['email'] . "</td>";
//             echo "<td>" . $row['user_level'] . "</td>";
//             echo "<td>" . $row['contact'] . "</td>";
//             echo "<td><button class='remove'>Remove</button></td>";
//             echo "</tr>";
//         }
            
//     } else {
//         echo "<tr><td colspan='6'>No admin accounts found.</td></tr>";
//     }
//     $con ->close();
//     } 
// ?>