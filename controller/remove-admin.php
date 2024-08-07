<?php

include '../classes/dbh.classes.php';

class adminctrl extends Dbh {
    public function deleteAdmin() {
        if (isset($_GET['deleteidadmin'])) {
            $id = $_GET['deleteidadmin'];

            // Modify the SQL query to perform a soft delete by updating the isDeleted column
            $stmt = $this->connect()->prepare('UPDATE admin_account SET isDeleted = 1 WHERE admin_id = ?');

            if (!$stmt) {
                // Handle SQL query preparation error
                header("location: ../adminProducts.php?error=stmtpreparefailed");
                exit();
            }

            if (!$stmt->execute(array($id))) {
                // Handle SQL query execution error
                $stmt = null;
                header("location: ../adminProducts.php?error=stmtfailed");
                exit();
            }

            $stmt = null;
        }
    }
}

// Create an object of the class and call the method
$controller = new adminctrl();
$controller->deleteAdmin();
session_start();

if (isset($_GET["error"])) {
    if ($_GET["error"] === "stmtpreparefailed") {
        $_SESSION["ErrorMessage"] = "Statement preparation failed.";
    } elseif ($_GET["error"] === "stmtfailed") {
        $_SESSION["ErrorMessage"] = "Statement execution failed.";
    }
}
$_SESSION["DeletedSuccess"] = "Deleted Successfully";

header("location: ../back-end/adminAccount.php");
exit();
