<?php
session_start();
include "../classes/dbh.classes.php";
include "../classes/signup.classes.php";
$signup = new Signup();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['otp'])) {
    $enteredOTP = trim(htmlspecialchars($_POST["otp"], ENT_QUOTES, 'UTF-8'));

    $username = $_SESSION['register_CustomerName'];
    $lname = $_SESSION['register_CustomerLastName'];
    $pwd = $_SESSION['register_CustomerPass'];
    $email = $_SESSION['register_CustomerEmail'];
    $address = $_SESSION['register_CustomerAddress'];
    $PostalCode = $_SESSION['register_CustomerPostalCode'];
    $City = $_SESSION['register_CustomerCity'];
    $Region = $_SESSION['register_CustomerRegion'];
    $contactNum = $_SESSION['register_CustomerContact'];
    // Check if the entered OTP matches the one stored in the session and is not expired
    if (
        isset($_SESSION['verification_code']['code']) &&
        isset($_SESSION['verification_code']['timestamp']) &&
        $enteredOTP === $_SESSION['verification_code']['code'] &&
        (time() - $_SESSION['verification_code']['timestamp']) <= 60 // 1 minute expiration
    ) {
        // Verification successful
        $signup->setUser($username, $lname, $pwd, $email, $address, $PostalCode,  $City, $Region, $contactNum);
        if($signup != false){
            echo "success";
        }else{
            echo "unable";
        }
        
    } else {
        // Invalid or expired OTP
        if ((time() - $_SESSION['verification_code']['timestamp']) > 60) {
            // Session expired
            echo "expired";
        } else {
            echo "failure";
        }
    }
} else {
    // Invalid request
    echo "error";
}
?>
