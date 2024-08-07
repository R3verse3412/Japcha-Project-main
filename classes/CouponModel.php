<?php

class CouponModel extends Dbh{

    public function getAllCoupon(){
        
        
        try {
            // Your database code here

            $coupons = array();
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('SELECT * FROM coupons WHERE isDeleted != 1 ORDER BY id DESC');
            
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $coupons[] = $row;
                }
            }
            
            
            return $coupons;
        } catch (\Throwable $c) {
           
            // Log the error to a file for debugging
            error_log($c->getMessage());
        
            // Redirect to an error page
            header("location: ../back-end/CouponManagement.php?error=" . urlencode($c->getMessage()));
            exit();
        }
    }

    public function getAllDiscountSenior(){
        
        
        try {
            // Your database code here

            $coupons = array();
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('SELECT * FROM discount_senior');
            
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $coupons[] = $row;
                }
            }
            
            
            return $coupons;
        } catch (\Throwable $c) {
           
            // Log the error to a file for debugging
            error_log($c->getMessage());
        
            // Redirect to an error page
            header("location: ../back-end/CouponManagement.php?error=" . urlencode($c->getMessage()));
            exit();
        }
    }



    public function insertCoupon($getOfferName,$getDiscount,$getQuantity,$formattedStartTime,$formattedEndTime){
        try {

            $stmt = $this->connect()->prepare('INSERT INTO coupons(offer_name,discount_percentage,Quantity,start_time,end_time) VALUES (?,?,?,?,?)');

            // Execute the query
            if (!$stmt->execute(array($getOfferName,$getDiscount,$getQuantity,$formattedStartTime,$formattedEndTime))) {
                throw new Exception("Failed to Add Category");
                header("location: ../back-end/CouponManagement.php?error=addingcouponfailed");
               
            }

    $stmt = null;

        } catch (\Throwable $th) {
            //throw $th;
            header("location: ../back-end/CouponManagement.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function editCoupon($editOfferName,$editDiscount,$editQuantity,$formattedStartTime,$formattedEndTime,$couponID) {
        try {

            $stmt = $this->connect()->prepare('UPDATE coupons SET offer_name=?,discount_percentage=?,Quantity=?,start_time=?,end_time=? WHERE id = ?');
    
            // Execute the query
            if (!$stmt->execute(array($editOfferName,$editDiscount,$editQuantity,$formattedStartTime,$formattedEndTime,$couponID))) {
                throw new Exception("Failed to update category");
            }
    
            // Close the prepared statement
            $stmt = null;
            return true;
        } catch (Exception $e) {
            //throw $th;
            header("location: ../back-end/CouponManagement.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    
    }

    // Set the default timezone for the entire script


    public function GetAllCouponFrontEnd() {
        // date_default_timezone_set('Asia/Manila');
        try {
            $coupons = array();
    
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('SELECT * FROM coupons WHERE Quantity != 0 AND end_time > NOW() AND isDeleted != 1');
    
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $coupons[] = $row;
                }
            }
    
            return $coupons;
        } catch (\Throwable $c) {
            // Log the error to a file for debugging
            error_log($c->getMessage());
    
            // Redirect to an error page
            header("location: ../back-end/CouponManagement.php?error=" . urlencode($c->getMessage()));
            exit();
        }
    }
    

public function updateCoupon($couponID) {
    try {
        $stmt = $this->connect()->prepare('UPDATE coupons SET Quantity = Quantity - 1 WHERE id = ?');

        // Execute the query
        if (!$stmt->execute(array($couponID))) {
            throw new Exception("Failed to update coupon");
        }

        // Close the prepared statement
        $stmt = null;

    } catch (Exception $e) {
        header("location: ../back-end/CouponManagement.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}

public function addBackQuantity($coupon_id){
    try {
        $stmt = $this->connect()->prepare('UPDATE coupons SET Quantity = Quantity + 1 WHERE id = ?');

        // Execute the query
        if (!$stmt->execute(array($coupon_id))) {
            throw new Exception("Failed to update coupon");
        }

        // Close the prepared statement
        $stmt = null;

    } catch (Exception $e) {
        header("location: ../back-end/CouponManagement.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}

public function DeleteCoupon($coupon_id){
    try {
        $stmt = $this->connect()->prepare('UPDATE coupons SET isDeleted = 1 WHERE id = ?');

        // Execute the query
        if (!$stmt->execute(array($coupon_id))) {
            throw new Exception("Failed to update coupon");
        }

        // Close the prepared statement
        $stmt = null;
        return true;
    } catch (Exception $e) {
        header("location: ../back-end/CouponManagement.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}


public function HideDiscount($hideDisocunt,$discoun_id){
    try {
        $stmt = $this->connect()->prepare('UPDATE discount_senior SET isHide = ? WHERE discount_senior_id = ?');

        // Execute the query
        if (!$stmt->execute(array($hideDisocunt, $discoun_id))) {
            throw new Exception("Failed to update coupon");
        }

        // Close the prepared statement
        $stmt = null;
        return true;
    } catch (Exception $e) {
        header("location: ../back-end/CouponManagement.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}


public function UpdateDiscount($discount_percentage,$discoun_id){
    try {
        $stmt = $this->connect()->prepare('UPDATE discount_senior SET discount_percentage = ? WHERE discount_senior_id = ?');

        // Execute the query
        if (!$stmt->execute(array($discount_percentage, $discoun_id))) {
            throw new Exception("Failed to update coupon");
        }

        // Close the prepared statement
        $stmt = null;
        return true;
    } catch (Exception $e) {
        header("location: ../back-end/CouponManagement.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}


    
}
