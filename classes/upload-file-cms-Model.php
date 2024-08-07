<?php

    class uploadFile extends Dbh{

        public function saveFileDetails($filename) {

            try {
              
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms_landing_page SET logo_url = ?');
                
                // Execute the query
                if(!$stmt->execute(array($filename))) {
                    $stmt = null;
                    header("location: ../myProfile.php?error=stmtfailed");
                    exit();
                }
                return true;
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-ProductSizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
           
            
        }
    }