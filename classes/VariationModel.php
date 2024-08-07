<?php
class VariationModel extends Dbh{
    public function getPrice($product_id){
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('SELECT price FROM variation WHERE product_id = :product_id AND isDeleted != 1 ORDER BY product_id ASC');
            
            // Bind the parameter
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        
            // Execute the query
            if ($stmt->execute()) {
                // Fetch a single row
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
                // Return the result directly (or null if no rows found)
                return $row;
            }
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location:../customerSHOP.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }
    
}