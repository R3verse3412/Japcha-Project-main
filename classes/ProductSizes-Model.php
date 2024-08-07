<?php

class addProductSizes extends Dbh {

    protected function setProductSizes($product, $size, $price, $quantity) {
            try {

                $stmt = $this->connect()->prepare('INSERT INTO product_variation (product_id, sizes_id, price, quantity) VALUES (?,?,?,?)');

                // Execute the query
                if (!$stmt->execute(array($product, $size, $price, $quantity))) {
                    throw new Exception("Failed to Add Category");
                    header("location: ../back-end/admin-ProductSizes.php?error=addingcategoryfailed");
                   
                }

        $stmt = null;

            } catch (\Throwable $th) {
                //throw $th;
                header("location: ../back-end/admin-ProductSizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        
    }

    protected function checkProductSize($product, $size) {
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('SELECT product_id FROM product_variation WHERE product_id=? AND sizes_id = ?');
            
            // Execute the query
            if (!$stmt->execute(array($product, $size))) {
                // throw new Exception("User existence check failed.");
                $stmt = null;
                header("location: ../back-end/admin-ProductSizes.php?error=categorydoesnotexist");
                exit();

            }
            
            $resultCheck = ($stmt->rowCount() > 0) ? false : true;
            return $resultCheck;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/admin-ProductSizes.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    protected function updateProdVar($prodvar_id, $product, $size, $price, $quantity) {
        try {

            $stmt = $this->connect()->prepare('UPDATE product_variation SET product_id = ?, sizes_id = ?, price =?, quantity=? WHERE prodsizes_id = ?');
    
            // Execute the query
            if (!$stmt->execute(array($product, $size, $price, $quantity, $prodvar_id,))) {
                throw new Exception("Failed to update category");
            }
    
            // Close the prepared statement
            $stmt = null;

        } catch (Exception $e) {
            //throw $th;
            header("location: ../back-end/viewCategory.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    
}

    public function getProductVar(){
        $stmt = $this->connect()->prepare('SELECT ps.prodsizes_id, ps.prodsizes_id, p.product_id, p.product_name, s.sizes_id, s.size_name, ps.price, ps.quantity FROM product_variation ps INNER JOIN product p ON ps.product_id = p.product_id  INNER JOIN product_sizes s ON ps.sizes_id = s.sizes_id ORDER BY p.product_name ASC;');
    
            if(!$stmt->execute()) {
                $stmt = null;
                header("location: ../back-end/adminAccount.php?error=stmtfailed");
                exit();
            }
    
            if($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../back-end/adminAccount.php?error=nocmsfound");
                exit();
            }
    
            $productData = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $productData;
    }
}