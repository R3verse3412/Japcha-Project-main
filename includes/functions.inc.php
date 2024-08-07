<?php

include "../config/databaseConnection.php";

function emptyInputSignup($username , $email, $password,  $confirm_password, $customer_address,  $contact_number) {
    $result;
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($customer_address) || empty($contact_number) ) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if (preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($password, $confirm_password) {
    $result;
    if ($password !== $confirm_password) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function uidExist($conn, $username,  $email) {
   $sql = "SELECT * FROM customer_account where username = ? OR email = ?; ";
   $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username,  $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function  createUser($conn, $username,  $email,  $password,  $confirm_password, $customer_address,  $contact_number) {
    $sql = "INSERT INTO customer_account  (username,  password,  confirm_password, email,  customer_address,  contact_number) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
         header("location: ../index.php?error=stmtfailed");
         exit();
     }

     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
     $hashedPassword2 = password_hash($confirm_password, PASSWORD_DEFAULT);

     mysqli_stmt_bind_param($stmt, "sssssi",$username, $hashedPassword, $hashedPassword2, $email, $customer_address,  $contact_number);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
     header("location: ../index.php?error=none");
     exit();
 
 }

 function emptyInputLogin($email , $pass) {
    $result;
    if (empty($email) || empty($pass)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $email, $pass) {
    $uidExists = uidExist($conn, $username, $email);

    if ($uidExists === false) {
        header("location: ../index.php?error=wronglogin");
        exit();
    }

    $pwdHashed =  $uidExists["password"];
    $checkPwd = password_verify($pass, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../index.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["customer_id"];
        $_SESSION["username"] = $uidExists["username"];
        header("location: ../index.php");
        exit();
    } 

    function get_record(){
        $addonsID = $_POST['AddonsId'];
        $query = "SELECT * FROM addons WHERE addons_id = '$addonsID'";
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result))
        {
            $addons_data = "ss";
            $addons_data [0] = $row['addons_id'];
            $addons_data [1] = $row['addons_name'];
        }
        echo json_encode($addons_data);
    }
}