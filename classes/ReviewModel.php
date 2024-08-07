<?php

class ReviewModel extends Dbh{
    
    public function SendReview($product_id, $product_name, $customer_id, $customer_name, $rating, $customer_review, $review_date){
        try {


            $stmt = $this->connect()->prepare('INSERT INTO `product_review` (`product_id`, `product_name`,  `customer_id`, `reviewer_name`,  `rating`, `review_comment`, `date` ) VALUES (?, ?, ?, ?, ?, ?, ?)');

            // Execute the query
            if (!$stmt->execute(array($product_id, $product_name, $customer_id, $customer_name, $rating, $customer_review, $review_date))) {
                throw new Exception("User review failed.");
                header("location: ../orderstatus.php?error=unabletowriteareview");
                exit();
            }
            

            $stmt = null;
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            header("location: ../orderstatus.php?error=sss" . urlencode($th->getMessage()));
            exit();
        }
    }

    public function GetReviewsByProduct($product_id) {
        try {
            $reviews = array();
            $stmt = $this->connect()->prepare('SELECT * FROM product_review WHERE product_id = ? ORDER BY date DESC');
    
            // Bind the parameters
            $stmt->bindParam(1, $product_id, PDO::PARAM_INT);
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $reviews[] = $row;
                }
            }
    
            $stmt->closeCursor();
            return $reviews;
        } catch (\Throwable $th) {
            // Handle exceptions appropriately, for now redirecting to an error page
            header("location: ../orderstatus.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    }

    public function GetAllReview() {
        try {
            $reviews = array();
            $stmt = $this->connect()->prepare('
                SELECT pr.*, c.category_name
                FROM product_review pr
                INNER JOIN product p ON pr.product_id = p.product_id
                INNER JOIN categories c ON p.category_id = c.category_id
                GROUP BY pr.review_id
                ORDER BY pr.date DESC
            ');
    
            // Bind the parameters
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $reviews[] = $row;
                }
            }
    
            $stmt->closeCursor();
            return $reviews;
        } catch (\Throwable $th) {
            // Handle exceptions appropriately, for now redirecting to an error page
            header("location: ../orderstatus.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    }

    public function hideComment($review_id){
        try {

            $stmt = $this->connect()->prepare('UPDATE product_review SET isHideComment = 1 WHERE review_id = ? AND isHideComment != 1');
    
            // Execute the query
            if (!$stmt->execute(array($review_id))) {
                throw new Exception("Failed to update addons");
            }
    
            // Close the prepared statement
            $stmt = null;
            return true;

        } catch (Exception $e) {
            //throw $th;
            header("location: ../back-end/AdminRating.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function unhideComment($review_id){
        try {

            $stmt = $this->connect()->prepare('UPDATE product_review SET isHideComment = 0 WHERE review_id = ? AND isHideComment != 0');
    
            // Execute the query
            if (!$stmt->execute(array($review_id))) {
                throw new Exception("Failed to update addons");
            }
    
            // Close the prepared statement
            $stmt = null;
            return true;

        } catch (Exception $e) {
            //throw $th;
            header("location: ../back-end/AdminRating.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function GetReviewsByCustomer($customer_id) {
        try {
            $reviews = array();
            $stmt = $this->connect()->prepare('SELECT * FROM product_review WHERE customer_id = ? ORDER BY date DESC');
    
            // Bind the parameters
            $stmt->bindParam(1, $customer_id, PDO::PARAM_INT);
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $reviews[] = $row;
                }
            }
    
            $stmt->closeCursor();
            return $reviews;
        } catch (\Throwable $th) {
            // Handle exceptions appropriately, for now redirecting to an error page
            header("location: ../orderstatus.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    }
    
    
}