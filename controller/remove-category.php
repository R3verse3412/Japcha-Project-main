<?php

include '../classes/dbh.classes.php';

class CategroyCtrl extends Dbh{

    public function deleteCategory() {
        if (isset($_GET['deleteidcat'])){
            $id = $_GET['deleteidcat'];

            $stmt = $this->connect()->prepare('DELETE FROM category WHERE category_id = ?');

            if (!$stmt->execute(array($id))) {
                $stmt = null;
                header("location: ../viewCategory.php?error=stmtfailed");
                exit();
            }

            $stmt = null;
        }
        
    }
    
}

// Create an object of the class and call the method
$controller = new CategroyCtrl();
$controller->deleteCategory();
header("location: ../viewCategory.php?error=deletedsuccessfully");
