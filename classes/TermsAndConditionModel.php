<?php

class TermsModel extends Dbh {

    public function getTerms() {
        try {
            $stmt = $this->connect()->prepare('SELECT * FROM terms_and_conditions LIMIT 1;');
            $stmt->execute();
            $profileData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($profileData === false) {
                // Handle the case when no data is found
                return null;
            }
    
            // Decode HTML entities for each field in the result
            foreach ($profileData as &$value) {
                $value = html_entity_decode($value, ENT_QUOTES, 'UTF-8');
            }
    
            return $profileData;
        } catch (PDOException $e) {
            // Handle any database connection or query errors
            // You can log the error or throw an exception for higher-level error handling
            return null;
        }
    }
    

    public function updateLiability($liability){
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('UPDATE terms_and_conditions SET liability = ?');
            
            // Execute the query
            if(!$stmt->execute(array($liability))) {
                $stmt = null;
                header("location: ../back-end/AdminTermsAndCondition.php?error=stmtfailed");
                exit();
            }
            $stmt = null;
            return true;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/AdminTermsAndCondition.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function updateIdemnification($idemnification){
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('UPDATE terms_and_conditions SET idemnification = ?');
            
            // Execute the query
            if(!$stmt->execute(array($idemnification))) {
                $stmt = null;
                header("location: ../back-end/AdminTermsAndCondition.php?error=stmtfailed");
                exit();
            }
            $stmt = null;
            return true;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/AdminTermsAndCondition.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function updateDispute($dispute){
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('UPDATE terms_and_conditions SET disputes = ?');
            
            // Execute the query
            if(!$stmt->execute(array($dispute))) {
                $stmt = null;
                header("location: ../back-end/AdminTermsAndCondition.php?error=stmtfailed");
                exit();
            }
            $stmt = null;
            return true;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/AdminTermsAndCondition.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function updateRestrictions($restrictions){
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('UPDATE terms_and_conditions SET restrictions = ?');
            
            // Execute the query
            if(!$stmt->execute(array($restrictions))) {
                $stmt = null;
                header("location: ../back-end/AdminTermsAndCondition.php?error=stmtfailed");
                exit();
            }
            $stmt = null;
            return true;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/AdminTermsAndCondition.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function updatePrivacy($privacy){
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('UPDATE terms_and_conditions SET privacy = ?');
            
            // Execute the query
            if(!$stmt->execute(array($privacy))) {
                $stmt = null;
                header("location: ../back-end/AdminTermsAndCondition.php?error=stmtfailed");
                exit();
            }
            $stmt = null;
            return true;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/AdminTermsAndCondition.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function updateCondition($condition){
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('UPDATE terms_and_conditions SET `condition_` = ?');
            
            // Execute the query
            if(!$stmt->execute(array($condition))) {
                $stmt = null;
                header("location: ../back-end/AdminTermsAndCondition.php?error=stmtfailed");
                exit();
            }
            $stmt = null;
            return true;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/AdminTermsAndCondition.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function updateTitle($title){
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('UPDATE terms_and_conditions SET `title_terms` = ?');
            
            // Execute the query
            if(!$stmt->execute(array($title))) {
                $stmt = null;
                header("location: ../back-end/AdminTermsAndCondition.php?error=stmtfailed");
                exit();
            }
            $stmt = null;
            return true;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/AdminTermsAndCondition.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

  
    
    
}