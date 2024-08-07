<?php

include '../classes/dbh.classes.php';

class RemoveProductCtr extends Dbh{
    public function deleteProduct() {
        if (isset($_GET['deleteid'])){
            $id = $_GET['deleteid'];

            $stmt = $this->connect()->prepare('DELETE FROM product WHERE product_id = ?');

            if (!$stmt->execute(array($id))) {
                $stmt = null;
                header("location: ../back-end/adminProducts.php?error=stmtfailed");
                exit();
            }

            $stmt = null;
        }
           
    }
   
}

// Create an object of the class and call the method
$controller = new RemoveProductCtr();
$controller->deleteProduct();
header("location: ../back-end/adminProducts.php?error=deletedsuccessfully");
