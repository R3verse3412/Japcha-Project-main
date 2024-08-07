<?php
include "../classes/dbh.classes.php";
include "../classes/login.classes.php";
include "../classes/login-cntrl.classes.php";
$login = new Login();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pass"], ENT_QUOTES, 'UTF-8');

    $adminData = $login->adminLogin($email, $pwd);
    if ($adminData) {
        // Successful admin login
        echo "success_admin";
        exit();
    }

    // If admin login failed or was not attempted, check customer login
    $customerData = $login->getUser($email, $pwd);
    if ($customerData) {
        // Successful customer login
        echo "success_customer";
        exit();
    }

    // Both admin and customer login failed
    echo "failure";
    exit();
}
?>
