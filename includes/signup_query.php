<?php
    $username = $_POST['userName'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['confirm_pass'];
    $email = $_POST['email'];
    $customer_address = $_POST['address'];
    $contact_number = $_POST['contact'];

       
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (preg_match('/\d/', $username)) {
        echo '<script>alert("Invalid username. Usernames should not contain numbers.");</script>';
        exit;
    }
    if ($password !== $confirm_password) {
        echo '<script>alert("Password and Confirm Password do not match.");</script>';
        exit;
    } 
    if (strlen($contact_number) !== 11) {
        echo '<script>alert("Invalid phone number. Please enter a 11-digit number.");</script>';
        exit;
    }
    
    if (strlen($password) < 8|| !preg_match('/^(?=.*[A-Z])/', $password)) {
        echo '<script>alert("Password should be at least 8 characters long and contain at least one uppercase letter.");</script>';
        exit;
    }
    
    $conn = new mysqli('localhost', 'root', '', 'japcha');
    if($conn -> connect_error){
        die('Connection Failed: ' . $conn->connect_error);
        exit();

    }

    // $email_query = "SELECT email FROM customer_account WHERE email = ?";
    // $stmt = $conn->prepare($email_query);
    // $stmt->bind_param("s", $email);
    // $stmt->execute();
    // $result = $stmt->get_result();

    // // if ($result->num_rows > 0) {
    // //     echo '<script>alert("Email already exists. Please use a different email.");</script>';
    // //     exit;
    // // }

    else{
        $stmt = $conn -> prepare("insert  into customer_account(username, password, confirm_password, email, customer_address, contact_number)
                values (?,?,?,?,?, ?)");
        $stmt -> bind_param("sssssi", $username,$hashedPassword, $confirm_password, $email,$customer_address, $contact_number );
        $stmt -> execute();
        session_start();
        $_SESSION["flash_message"] = "Registered Successfully";
        header("Location:index.php");
        
    } 
    $stmt ->close();
    $conn ->close();
?>