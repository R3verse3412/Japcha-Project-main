<?php


// session_start();

class userlvlController extends Dbh {
    
    public function archiveUL($id) {

            if ($id == 1) {
                // $_SESSION["ErrorMessage"] = "This userlevel cannot be archive.";
                return  false;
            } else {
                try {
                    // Check if the userlevel_id is in the admin_account table
                    $checkStmt = $this->connect()->prepare('SELECT COUNT(*) FROM admin_account WHERE userlevel_id = ?');
                    $checkStmt->execute(array($id));
    
                    if ($checkStmt->fetchColumn() > 0) {

                        return  false;
                    } else {
                        // Userlevel is not in use, perform the soft delete
                        $updateStmt = $this->connect()->prepare('UPDATE user_level SET archive = 1 WHERE userlevel_id = ?');
                        if ($updateStmt->execute(array($id))) {
                            // $_SESSION["archiveSucess"] = "Archive Successfully";

                            return true;
                        } else {
                            throw new Exception("Statement execution failed");

                            return false;
                        }
                    }
                } catch (Exception $e) {
                    // $_SESSION["ErrorMessage"] = "Error: " . $e->getMessage();
                    
                    header("location: ../back-end/userLevel.php?error:" + $e);
                    exit();
                }
            }
    }

    public function delete_userlevel($id) {
            if ($id == 1) {
                // $_SESSION["ErrorMessage"] = "This userlevel cannot be deleted.";
                return false;
            } else {
                try {
                    // Check if the userlevel_id is in the admin_account table
                    $checkStmt = $this->connect()->prepare('SELECT COUNT(*) FROM admin_account WHERE userlevel_id = ? AND isDeleted != 1');
                    $checkStmt->execute(array($id));
    
                    if ($checkStmt->fetchColumn() > 0) {

                        return false;
                    } else {
                        // Userlevel is not in use, perform the soft delete
                        $updateStmt = $this->connect()->prepare('UPDATE user_level SET isDeleted = 1 WHERE userlevel_id = ?');
                        if ($updateStmt->execute(array($id))) {
                            // $_SESSION["DeletedSuccess"] = "Deleted Successfully";
                            return true;
                        } else {
                            throw new Exception("Statement execution failed");
                        }
                    }
                } catch (Exception $e) {
                    // $_SESSION["ErrorMessage"] = "Error: " . $e->getMessage();
                    header("location: ../back-end/userLevel.php");
                    exit();
                }
            }

    }

    public function delete_category($id) {
     
            try {
                // Check if the userlevel_id is in the admin_account table
                $checkStmt = $this->connect()->prepare('SELECT COUNT(*) FROM product WHERE category_id = ? AND isDeleted != 1');
                $checkStmt->execute(array($id));

                if ($checkStmt->fetchColumn() > 0) {
            
                    return false;
                } else {
                    // Userlevel is not in use, perform the soft delete
                    $updateStmt = $this->connect()->prepare('UPDATE categories SET isDeleted = 1 WHERE category_id = ?');
                    if ($updateStmt->execute(array($id))) {
                        // $_SESSION["DeletedSuccess"] = "Deleted Successfully";
                        return true;
                    } else {
                        throw new Exception("Statement execution failed");
                    }
                }
            } catch (Exception $e) {
                // $_SESSION["ErrorMessage"] = "Error: " . $e->getMessage();
                header("location: ../back-end/viewCategory.php");
                exit();
            }
        

}


public function deleteAddons($id) {
     
    try {
            // Userlevel is not in use, perform the soft delete
            $updateStmt = $this->connect()->prepare('UPDATE addons SET isDeleted = 1 WHERE addons_id = ?');
            if ($updateStmt->execute(array($id))) {
                // $_SESSION["DeletedSuccess"] = "Deleted Successfully";
                return true;
            } else {
                throw new Exception("Statement execution failed");
                return false;
            }
        
    } catch (Exception $e) {
        // $_SESSION["ErrorMessage"] = "Error: " . $e->getMessage();
        header("location: ../back-end/viewCategory.php");
        exit();
        return false;
    }


}


public function deleteSize($id) {
     
    try {
        // Check if the userlevel_id is in the admin_account table
        $checkStmt = $this->connect()->prepare('SELECT COUNT(*) FROM variation WHERE size_id = ? AND isDeleted != 1');
        $checkStmt->execute(array($id));

        if ($checkStmt->fetchColumn() > 0) {
    
            return false;
        } else {
            // Userlevel is not in use, perform the soft delete
            $updateStmt = $this->connect()->prepare('UPDATE product_sizes SET isDeleted = 1 WHERE sizes_id = ?');
            if ($updateStmt->execute(array($id))) {
                // $_SESSION["DeletedSuccess"] = "Deleted Successfully";
                return true;
            } else {
                throw new Exception("Statement execution failed");
            }
        }
    } catch (Exception $e) {
        // $_SESSION["ErrorMessage"] = "Error: " . $e->getMessage();
        header("location: ../back-end/admin-sizes.php");
        exit();
    }


}


public function banCustomerAccount($id) {
     
    try {
            $updateStmt = $this->connect()->prepare('UPDATE customer_account SET ban_user = 1 WHERE customer_id = ?');
            if ($updateStmt->execute(array($id))) {
                return true;
            } else {
                throw new Exception("Statement execution failed");
                return false;
            }
        
    } catch (Exception $e) {
        header("location: ../back-end/viewCategory.php");
        exit();
        return false;
    }


}



}



