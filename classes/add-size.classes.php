<?php
    // require_once("dbh.classes.php");

class addSize extends Dbh {

    protected function setSize($size) {
            try {

                $stmt = $this->connect()->prepare('INSERT INTO product_sizes (size_name) VALUES (?)');

                // Execute the query
                if (!$stmt->execute(array($size))) {
                    throw new Exception("Failed to Add Size");
                    header("location: ../back-end/admin-sizes.php?error=addingcategoryfailed");
                   
                }

        $stmt = null;

            } catch (\Throwable $th) {
                //throw $th;
                header("location: ../back-end/admin-sizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        
    }

    protected function updateNewSize($size, $sizeID) {
        try {

            $stmt = $this->connect()->prepare('UPDATE product_sizes SET size_name = ? WHERE sizes_id = ? AND isDeleted != 1');
    
            // Execute the query
            if (!$stmt->execute(array($size, $sizeID))) {
                throw new Exception("Failed to update size");
            }
    
            // Close the prepared statement
            $stmt = null;

        } catch (Exception $e) {
            //throw $th;
            header("location: ../back-end/admin-sizes.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    
    }

    protected function checkSize($size) {
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('SELECT size_name FROM product_sizes WHERE size_name = ? AND isDeleted != 1');
            
            // Execute the query
            if (!$stmt->execute(array($size))) {
                // throw new Exception("User existence check failed.");
                $stmt = null;
                header("location: ../back-end/admin-sizes.php?error=sizedoesnotexist");
                exit();

            }
            
            $resultCheck = ($stmt->rowCount() > 0) ? false : true;
            return $resultCheck;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/admin-sizes.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

        protected function getSize($size_name) {
            try {

                $stmt = $this->connect()->prepare('SELECT size_name FROM product_sizes WHERE size_name = ? AND isDeleted != 1');

                // Execute the query
                if (!$stmt->execute(array($size))) {
                    throw new Exception("Failed to Add Size");
                    header("location: ../back-end/admin-sizes.php?error=addingcategoryfailed");
                
                }

        $stmt = null;

            } catch (\Throwable $th) {
                //throw $th;
                header("location: ../back-end/admin-sizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        
    }

    protected function getSizeName($size_id) {
        try {

            $stmt = $this->connect()->prepare('SELECT size_name FROM product_sizes WHERE sizes_id = ? AND isDeleted != 1');

            // Execute the query
            if (!$stmt->execute(array($size_id))) {
                throw new Exception("Failed to Add Size");
                header("location: ../back-end/adminProducts.php?error=addingcategoryfailed");
            
            }

    $stmt = null;

        } catch (\Throwable $th) {
            //throw $th;
            header("location: ../back-end/adminProducts.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    
}

public function getSizeNameCart($size_id) {
    try {
        // Assuming $this->connect() returns a PDO instance
        $conn = $this->connect();

        $stmt = $conn->prepare('SELECT size_name FROM product_sizes WHERE sizes_id = :size_id AND isDeleted != 1');

        // Bind the parameter
        $stmt->bindParam(':size_id', $size_id, PDO::PARAM_INT);

        // Execute the query
        if (!$stmt->execute()) {
            throw new Exception("Failed to fetch Size Name");
        }

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Close the statement
        $stmt->closeCursor();

        // Return the size name
        return $result['size_name'];

    } catch (Exception $e) {
        // Handle exceptions, you may want to log the error or redirect to an error page
        header("location: ../back-end/admin-sizes.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}

    public function getAllSize() {
        try {
            $size = array();
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('SELECT * FROM product_sizes  WHERE isDeleted != 1 ORDER BY sizes_id DESC');
            
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $size[] = $row;
                }
            }
            return $size;

        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location:../back-end/admin-sizes.php?error=" . urlencode($e->getMessage()));
            exit();
        }

    }


}