<?php

session_start();

include '../classes/dbh.classes.php';

class userlvlController extends Dbh {
    public function deleteUl() {
        if (isset($_GET['deleteidul'])) {
            $id = (int)$_GET['deleteidul'];
    
            if ($id == 1) {
                $_SESSION["ErrorMessage"] = "This userlevel cannot be deleted.";
            } else {
                try {
                    // Check if the userlevel_id is in the admin_account table
                    $checkStmt = $this->connect()->prepare('SELECT COUNT(*) FROM admin_account WHERE userlevel_id = ? AND isDeleted != 1');
                    $checkStmt->execute(array($id));
    
                    if ($checkStmt->fetchColumn() > 0) {
                        // Userlevel is in use, display the appropriate message
                        $_SESSION["ErrorMessage"] = "Unable to delete userlevel is currently active.";
                    } else {
                        // Userlevel is not in use, perform the soft delete
                        $updateStmt = $this->connect()->prepare('UPDATE user_level SET isDeleted = 1 WHERE userlevel_id = ?');
                        if ($updateStmt->execute(array($id))) {
                            $_SESSION["DeletedSuccess"] = "Deleted Successfully";
                        } else {
                            throw new Exception("Statement execution failed");
                        }
                    }
                } catch (Exception $e) {
                    $_SESSION["ErrorMessage"] = "Error: " . $e->getMessage();
                }
            }
        }
    
        header("location: ../back-end/userLevel.php");
        exit();
    }
    public function deleteProduct() {
        if (isset($_GET['deleteidproduct'])) {
            $id = (int)$_GET['deleteidproduct'];
    
            try {
                $stmt = $this->connect()->prepare('UPDATE product SET isDeleted = 1 WHERE product_id = ?');
    
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
            } catch (Exception $e) {
                // Handle any exceptions that occur
                header("location: ../adminProducts.php?error=" . $e->getMessage());
                exit();
            }
        }
    
        header("location: ../back-end/adminProducts.php");
        exit();
    }

    public function archiveProduct() {
        if (isset($_GET['archiveidproduct'])) {
            $id = (int)$_GET['archiveidproduct'];
    
            try {
                $stmt = $this->connect()->prepare('UPDATE product SET isHide = 1 WHERE product_id = ?');
    
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
            } catch (Exception $e) {
                // Handle any exceptions that occur
                header("location: ../adminProducts.php?error=" . $e->getMessage());
                exit();
            }
        }
    
        header("location: ../back-end/adminProducts.php");
        exit();
    }

    public function deleteAdminAccount() {
        if (isset($_GET['deleteAdmin'])) {
            $id = (int)$_GET['deleteAdmin'];
    
            try {
                $stmt = $this->connect()->prepare('UPDATE admin_account SET isDeleted = 1 WHERE admin_id = ?');
    
                if (!$stmt) {
                    // Handle SQL query preparation error
                    header("location: ../back-end/adminAccount.php?error=stmtpreparefailed");
                    exit();
                }
    
                if (!$stmt->execute(array($id))) {
                    // Handle SQL query execution error
                    $stmt = null;
                    header("location: ../back-end/adminAccount.php?error=stmtfailed");
                    exit();
                }
    
                $stmt = null;
            } catch (Exception $e) {
                // Handle any exceptions that occur
                header("location: ../back-end/adminAccount.php?error=" . $e->getMessage());
                exit();
            }
        }
        $_SESSION['DeletedAdmin'] = "Admin Account Has been deleted successfully";
        header("location: ../back-end/adminAccount.php");
        exit();
    }
    
    public function deleteCustomerAccount() {
        if (isset($_GET['deleteCustomer'])) {
            $id = (int)$_GET['deleteCustomer'];
    
            try {
                $stmt = $this->connect()->prepare('UPDATE customer_account SET isDeleted = 1 WHERE customer_id = ?');
    
                if (!$stmt) {
                    // Handle SQL query preparation error
                    header("location: ../back-end/CustomerAccount.php?error=stmtpreparefailed");
                    exit();
                }
    
                if (!$stmt->execute(array($id))) {
                    // Handle SQL query execution error
                    $stmt = null;
                    header("location: ../back-end/CustomerAccount.php?error=stmtfailed");
                    exit();
                }
    
                $stmt = null;
            } catch (Exception $e) {
                // Handle any exceptions that occur
                header("location: ../back-end/CustomerAccount.php?error=" . $e->getMessage());
                exit();
            }
        }
        
        $_SESSION['DeletedCustomer'] = "Customer Account Has been deleted successfully";
        header("location: ../back-end/CustomerAccount.php");
        exit();
    }
    
    
}

// Create an object of the class and call the method
$controller = new userlvlController();

if (isset($_GET['deleteidul'])) {
    $controller->deleteUl();
}

if (isset($_GET['deleteidproduct'])) {
    $controller->deleteProduct();
}

if (isset($_GET['archiveidproduct'])) {
    $controller->archiveProduct();
}

if (isset($_GET['deleteAdmin'])) {
    $controller->deleteAdminAccount();
}

if (isset($_GET['deleteCustomer'])) {
    $controller->deleteCustomerAccount();
}