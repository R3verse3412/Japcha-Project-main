<?php

    class ProductModel extends Dbh{

        public function getAllProducts(){
            try {
                $products = array();
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('SELECT p.*, c.* FROM product p INNER JOIN categories c ON p.category_id = c.category_id WHERE p.isDeleted != 1 AND p.isHide != 1 ORDER BY product_id DESC');
                
                // Execute the query
                if ($stmt->execute()) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $products[] = $row;
                    }
                }
                return $products;

            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location:../back-end/adminProducts.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function getProductArchived(){
            try {
                $products = array();
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('SELECT p.*, c.* FROM product p INNER JOIN categories c ON p.category_id = c.category_id WHERE p.isDeleted != 1 AND p.isHide = 1 ORDER BY product_name DESC');
                
                // Execute the query
                if ($stmt->execute()) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $products[] = $row;
                    }
                }
                return $products;

            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location:../back-end/adminProducts.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }



        public function getProductShake(){
            try {
                $products = array();
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('SELECT p.*, c.* FROM product p INNER JOIN categories c ON p.category_id = c.category_id WHERE p.isDeleted != 1 AND p.isHide != 1 AND c.category_id = 3 ORDER BY product_id DESC');
                
                // Execute the query
                if ($stmt->execute()) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $products[] = $row;
                    }
                }
                return $products;

            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location:../back-end/adminProducts.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function getProduct($productid){
            try {
                $products = array();
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('SELECT p.*, c.* FROM product p INNER JOIN categories c ON p.category_id = c.category_id WHERE p.product_id = ?');
                
                // Execute the query
                if ($stmt->execute([$productid])) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $products[] = $row;
                    }
                }
                return $products;

            } catch (Exception $t) {
                // Log the error or handle it appropriately
                // header("location:../customerSHOP.php?error=" . urlencode($t->getMessage()));
                // exit();
            }
        }


        public function getSizeVariation($product_id){
            try {
                $products = array();
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('SELECT v.*, ps.* FROM variation v INNER JOIN product_sizes ps ON v.size_id = ps.sizes_id WHERE v.product_id = ? AND v.isDeleted != 1');
        
                // Execute the query
                if ($stmt->execute([$product_id])) { // Pass the product_id as an array
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $products[] = $row;
                    }
                }
                return $products;
        
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location:../back-end/adminProducts.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        
        public function getProductsByCategory($category){
            try {
                $products = array();
                // Prepare the SQL query
                $stmt = $this->connect()->prepare("SELECT p.*, c.* FROM product p INNER JOIN categories c ON p.category_id = c.category_id WHERE p.category_id = ? AND p.isDeleted != 1 AND p.isHide != 1 ORDER BY p.product_id DESC");
        
                // Execute the query with the category ID wrapped in an array
                if ($stmt->execute([$category])) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $products[] = $row;
                    }
                }
                return $products;
        
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/adminProducts.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        
        public function getProductName(){
            $stmt = $this->connect()->prepare('SELECT product_id, product_name FROM product;');
    
            if(!$stmt->execute()) {
                $stmt = null;
                header("location: ../back-end/adminProducts.php?error=stmtfailed");
                exit();
            }
    
            if($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../back-end/adminProducts.php?error=nocmsfound");
                exit();
            }
    
            $productData = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $productData;
        }

        protected function setComboProduct($comboName, $ComboDescription, $product1, $product2, $category){
            try {

                $stmt = $this->connect()->prepare('INSERT INTO combo_product (combo_name, combo_description, product_one_id, product_two_id, category_id) VALUES (?,?,?,?,?)');

                // Execute the query
                if (!$stmt->execute(array($comboName, $ComboDescription, $product1, $product2, $category))) {
                    throw new Exception("Failed to Add Category");
                    header("location:../back-end/adminProducts.php?error=addingcategoryfailed");
                   
                }

                $stmt = null;

            } catch (\Throwable $th) {
                //throw $th;
                header("location:../back-end/adminProducts.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
       public function getPrice($size) {
            try {
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('SELECT price FROM variation WHERE size_id = ?');
                
                // Execute the query
                if ($stmt->execute($size)) {
                    // Fetch the price value directly (since it's a single value)
                    $price = $stmt->fetchColumn();
                    
                    return $price;
                }
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/adminProducts.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        public function getOneSize($sizeid) {
            try {
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('SELECT size_name FROM product_sizes WHERE sizes_id = ?');
        
                // Execute the query with the size ID wrapped in an array
                if ($stmt->execute([$sizeid])) {
                    // Fetch the size value directly (since it's a single value)
                    $size = $stmt->fetchColumn();
        
                    return $size;
                }
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/adminProducts.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        
        // public function getPriceForSize($size) {
        //     try {
        //         // Prepare the SQL query
        //         $price = array();
        //         $stmt = $this->connect()->prepare('SELECT price FROM variation WHERE size_id = ?');
                
        //         // Execute the query
        //         if ($stmt->execute([$size])) {
        //             // Fetch the price value directly (since it's a single value)
        //             $price[] = $stmt->fetchColumn();
                    
        //             return $price;
        //         }
        //     } catch (Exception $e) {
        //         // Log the error or handle it appropriately
        //         header("location: ../back-end/adminProducts.php?error=" . urlencode($e->getMessage()));
        //         exit();
        //     }
        // }
        public function getPriceBySize($sizeid, $prodid) {
            try {
                if (is_array($sizeid)) {
                    $placeholders = str_repeat('?,', count($sizeid) - 1) . '?';
                    $query = "SELECT price FROM variation WHERE size_id IN ($placeholders) AND product_id = ? AND isDeleted != 1";
                } else {
                    $query = "SELECT price FROM variation WHERE size_id = ? AND product_id = ? AND isDeleted != 1";
                }
        
                $stmt = $this->connect()->prepare($query);
        
                // Execute the query
                $params = is_array($sizeid) ? array_merge($sizeid, [$prodid]) : [$sizeid, $prodid];
                if ($stmt->execute($params)) {
                    // Fetch the price value directly (since it's a single value)
                    $size = $stmt->fetchColumn();
        
                    return $size;
                }
            } catch (Exception $e) {
                return "Error: " . $e->getMessage(); // Handle the error appropriately
            }
        }
    

        public function deleteVariation($sizeid, $prod_id){
            try {

                $stmt = $this->connect()->prepare('UPDATE variation SET isDeleted = 1 WHERE size_id = ? AND product_id = ?');
        
                // Execute the query
                if (!$stmt->execute(array($sizeid, $prod_id))) {
                    throw new Exception("Failed to update addons");
                }
        
                // Close the prepared statement
                $stmt = null;
    
            } catch (Exception $e) {
                //throw $th;
                header("location: ../back-end/adminProducts.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function UnarchivedProduct($product_id){
            try {

                $stmt = $this->connect()->prepare('UPDATE product SET isHide = 0 WHERE product_id = ?');
        
                // Execute the query
                if (!$stmt->execute(array($product_id))) {
                    throw new Exception("Failed to update addons");
                }
        
                // Close the prepared statement
                $stmt = null;
                return true;
    
            } catch (Exception $e) {
                //throw $th;
                header("location: ../back-end/AdminArchive.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function DeleteProduct($product_id){
            try {

                $stmt = $this->connect()->prepare('UPDATE product SET isDeleted = 1, isHide = 0 WHERE product_id = ?');
        
                // Execute the query
                if (!$stmt->execute(array($product_id))) {
                    throw new Exception("Failed to update addons");
                }
        
                // Close the prepared statement
                $stmt = null;
                return true;
    
            } catch (Exception $e) {
                //throw $th;
                header("location: ../back-end/AdminArchive.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }


}