<?php
// session_start();
require_once "../classes/dbh.classes.php";
require_once "../classes/signup.classes.php";
require_once "../classes/signup-cntrl.classes.php";
require_once "../classes/mailer_function.php";
$mailer = new YourEmailClass();

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = htmlspecialchars($_POST["fname"], ENT_QUOTES, 'UTF-8');
    $lname = htmlspecialchars($_POST["lname"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pass"], ENT_QUOTES, 'UTF-8');
    $pwdConfirm = htmlspecialchars($_POST["confirm_pass"], ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars($_POST["address"], ENT_QUOTES, 'UTF-8');
    $PostalCode = htmlspecialchars($_POST["Postal"], ENT_QUOTES, 'UTF-8');
    $City = htmlspecialchars($_POST["City"], ENT_QUOTES, 'UTF-8');
    $Region = htmlspecialchars($_POST["Region"], ENT_QUOTES, 'UTF-8');
    $contactNum = isset($_POST["contact"]) ? intval($_POST["contact"]) : 0;

    $signup = new SignupContr($fname, $lname, $pwd, $pwdConfirm, $email, $address, $PostalCode, $City, $Region, $contactNum);

    $errors = $signup->signupUser();

    $_SESSION['register_CustomerName'] = $fname;
    $_SESSION['register_CustomerLastName'] = $lname;
    $_SESSION['register_CustomerPass'] = $pwd;
    $_SESSION['register_CustomerEmail'] = $email;
    $_SESSION['register_CustomerAddress'] = $address;
    $_SESSION['register_CustomerPostalCode'] = $PostalCode;
    $_SESSION['register_CustomerCity'] = $City;
    $_SESSION['register_CustomerRegion'] = $Region;
    $_SESSION['register_CustomerContact'] = $contactNum;
    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'errors' => $errors]);
    } else{
            $mailer->get_email($email, $fname);
            echo json_encode(['status' => 'success', 'message' => 'Verification Code Has been sent to your email']);
           
    }
    
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

