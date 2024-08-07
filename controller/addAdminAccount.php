<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ 
    include "../config/databaseConnection.php"; // Include the database connection

    // Get the form data
    $username = $_POST["userName"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $userLevel = $_POST["user_level"];
    $phone = $_POST["contact"];


    if (preg_match('/\d/', $username)) {
       echo '<script>alert("Invalid username. Usernames should not contain numbers.");</script>';
       exit;
   }
   if (strlen($phone) !== 11) {
       echo '<script>alert("Invalid phone number. Please enter a 11-digit number.");</script>';
       exit;
   }
   if (strlen($password) < 8|| !preg_match('/^(?=.*[A-Z])/', $password)) {
       echo '<script>alert("Password should be at least 8 characters long and contain at least one uppercase letter.");</script>';
       exit;
   }
//    if (strcasecmp($userLevel, "default") === 0) {
//         echo '<script>alert("Please select a valid user level.");</script>';
//         exit;
    
//    }


if($con -> connect_error)
    {
        die('Connection Failed: ' . $con->connect_error);
        exit();
    }
else
    {
        $stmt = $con -> prepare("INSERT INTO admin_account (username, email, password, user_level, contact) 
        VALUES (?,?,?,?,?)");
        $stmt -> bind_param("ssssi", $username,$email, $password, $userLevel, $phone );
        $stmt -> execute();
        session_start();
        $_SESSION["flash_message"] = "Registered Successfully";
        // header("Location:customer_LandingPage.php");
        
    } 
$stmt ->close();
$con ->close();
   
}

?>