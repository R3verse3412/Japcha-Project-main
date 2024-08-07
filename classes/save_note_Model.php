<?php
    class SampleModel extends Dbh{

        public function setContent($japcha){
            try {
              
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET japcha = ? ');
                
                // Execute the query
                if(!$stmt->execute(array($japcha))) {
                    $stmt = null;
                    header("location: ../myProfile.php?error=stmtfailed");
                    exit();
                }else{
                    header("location: ../back-end/admin-cms.php?success=successfully");
                    exit();
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-ProductSizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function setOrder($order){
            try {
                
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET order_note = ? ');
                
                // Execute the query
                if(!$stmt->execute(array($order))) {
                    $stmt = null;
                    header("location: ../myProfile.php?error=stmtfailed");
                    exit();
                }else{
                    header("location: ../back-end/admin-cms.php?success=successfully");
                    exit();
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-ProductSizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function setSocials($social){
            try {
                
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET socials = ? ');
                
                // Execute the query
                if(!$stmt->execute(array($social))) {
                    $stmt = null;
                    header("location: ../myProfile.php?error=stmtfailed");
                    exit();
                }else{
                    header("location: ../back-end/admin-cms.php?success=successfully");
                    exit();
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-ProductSizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function setPolicy($policy){
            try {
                
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET policy = ? ');
                
                // Execute the query
                if(!$stmt->execute(array($policy))) {
                    $stmt = null;
                    header("location: ../myProfile.php?error=stmtfailed");
                    exit();
                }else{
                    header("location: ../back-end/admin-cms.php?success=successfully");
                    exit();
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-ProductSizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function setLocation($loc){
            try {
                
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET location = ? ');
                
                // Execute the query
                if(!$stmt->execute(array($loc))) {
                    $stmt = null;
                    header("location: ../myProfile.php?error=stmtfailed");
                    exit();
                }else{
                    header("location: ../back-end/admin-cms.php?success=successfully");
                    exit();
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-ProductSizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        public function setContact($contact){
            try {
                
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET contact = ? ');
                
                // Execute the query
                if(!$stmt->execute(array($contact))) {
                    $stmt = null;
                    header("location: ../back-end/admin-cms.php?error=stmtfailed");
                    exit();
                }else{
                    header("location: ../back-end/admin-cms.php?success=successfully");
                    exit();
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-cms.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function setTitle($title_data){
            try {
                
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET title_data = ?');
                
                // Execute the query
                if(!$stmt->execute(array($title_data))) {
                    $stmt = null;
                    header("location: ../back-end/admin-cms.php?error=stmtfailed");
                    exit();
                }else{
                    header("location: ../back-end/admin-cms.php?success=successfully");
                    exit();
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-cms.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        public function setSub($sub){
            try {
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET `subtitle` = ?');
                
                // Execute the query
                if (!$stmt->execute(array($sub))) {
                    $stmt = null;
                    header("location: ../back-end/admin-cms.php?error=stmtfailed");
                    exit();
                } else {
                    // Omitting the $stmt = null; here as it's unnecessary after exit()
                    header("location: ../back-end/admin-cms.php");
                    exit();
                }
            } catch (Exception $tq) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-cms.php?error=" . urlencode($tq->getMessage()));
                exit();
            }
        }
        
        

        public function setLogo($logo){
            try {
                
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET logo_url = ?');
                
                // Execute the query
                if(!$stmt->execute(array($logo))) {
                    $stmt = null;
                    header("location: ../back-end/admin-cms.php?error=stmtfailed");
                    exit();
                }else{
                    header("location: ../back-end/admin-cms.php?success=successfully");
                    exit();
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-cms.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function setLandingImage($LandingImage){
            try {
                
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET landing_image_url = ?');
                
                // Execute the query
                if(!$stmt->execute(array($LandingImage))) {
                    $stmt = null;
                    header("location: ../back-end/admin-cms.php?error=stmtfailed");
                    exit();
                }else{
                    header("location: ../back-end/admin-cms.php?success=successfully");
                    exit();
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-cms.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function setFbLink($fbLink, $igLink, $ytLink){
            try {
                
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET fbLink = ?, instagramLink = ?, ytLink = ?');
                
                // Execute the query
                if(!$stmt->execute(array($fbLink, $igLink, $ytLink))) {
                    $stmt = null;
                    header("location: ../back-end/admin-cms.php?error=stmtfailed");
                    exit();
                }else{
                    header("location: ../back-end/admin-cms.php?success=successfully");
                    exit();
         
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-ProductSizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function setYtLink($ytLink){
            try {
                
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET ytLink = ?');
                
                // Execute the query
                if(!$stmt->execute(array($ytLink))) {
                    $stmt = null;
                    header("location: ../back-end/admin-cms.php?error=stmtfailed");
                    exit();
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-ProductSizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function setIgLink($igLink){
            try {
                
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('UPDATE cms SET instagramLink = ?');
                
                // Execute the query
                if(!$stmt->execute(array($igLink))) {
                    $stmt = null;
                    header("location: ../back-end/admin-cms.php?error=stmtfailed");
                    exit();
                }
                $stmt = null;
            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location: ../back-end/admin-ProductSizes.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        // public function getContent(){
        //     $stmt = $this->connect()->prepare('SELECT * FROM about_us');

        //     if(!$stmt->execute()) {
        //         $stmt = null;
        //         header("location: ../back-end/admin-cms.php?error=stmtfailed");
        //         exit();
        //     }
    
        //     if($stmt->rowCount() == 0) {
        //         $stmt = null;
        //         header("location: ../back-end/admin-cms.php?error=nocmsfound");
        //         exit();
        //     }
    
        //     $profileData = $stmt->fetchALL(PDO::FETCH_ASSOC);
        //     return $profileData;
    
        // }

        // public function getContentLanding(){
        //     $stmt = $this->connect()->prepare('SELECT * FROM cms_landing_page');

        //     if(!$stmt->execute()) {
        //         $stmt = null;
        //         header("location: ../back-end/admin-cms.php?error=stmtfailed");
        //         exit();
        //     }
    
        //     if($stmt->rowCount() == 0) {
        //         $stmt = null;
        //         header("location: ../back-end/admin-cms.php?error=nocmsfound");
        //         exit();
        //     }
    
        //     $profileData = $stmt->fetchALL(PDO::FETCH_ASSOC);
        //     return $profileData;
    
        // }

        // public function getLinks(){
        //     $stmt = $this->connect()->prepare('SELECT * FROM social_media_links');

        //     if(!$stmt->execute()) {
        //         $stmt = null;
        //         header("location: ../back-end/admin-cms.php?error=stmtfailed");
        //         exit();
        //     }
    
        //     if($stmt->rowCount() == 0) {
        //         $stmt = null;
        //         header("location: ../back-end/admin-cms.php?error=nocmsfound");
        //         exit();
        //     }
    
        //     $profileData = $stmt->fetchALL(PDO::FETCH_ASSOC);
        //     return $profileData;
    
        // }

    }