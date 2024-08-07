<?php

class Cms extends Dbh {

    public function getCms() {
        try {
            $stmt = $this->connect()->prepare('SELECT * FROM cms ORDER BY cms_id DESC LIMIT 1;');
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
    
    

    protected function setNewCms($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact){
        $stmt = $this->connect()->prepare('UPDATE cms SET cms_logo_url = ?, cms_image_url = ?, cms_bg_url = ?, cms_title = ?, cms_subtitle = ?, cms_japcha = ?, cms_how_to_order = ?, cms_socials = ?, cms_policy = ?, cms_location = ?, cms_contact_us = ? ;');

        if(!$stmt->execute(array($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact))) {
            $stmt = null;
            header("location: ../back-end/admin-cms.php?error=stmtfailed");
            exit();
        }

        $stmt = null;

    }

    // protected function setCms($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact){
    //     // Prepare the SQL statement with placeholders
    //     $stmt = $this->connect()->prepare('INSERT INTO cms (cms_logo_url, cms_image_url, cms_bg_url, cms_title, cms_subtitle, cms_japcha, cms_how_to_order, cms_socials, cms_policy, cms_location, cms_contact_us) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
    
    //     if (!$stmt) {
    //         // Check if the statement preparation failed
    //         header("location: ../cms.php?error=stmtfailed");
    //         exit();
    //     }
    
    //     // Bind parameters and execute the statement
    //     $stmt->bind_param("sssssssssss", $cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact);
    
    //     if (!$stmt->execute()) {
    //         // Check if the statement execution failed
    //         $stmt->close();
    //         header("location: ../cms.php?error=stmtfailed");
    //         exit();
    //     }
    
    //     // Close the statement
    //     $stmt->close();
    // }
    

    protected function setCms($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact){
        $stmt = $this->connect()->prepare('INSERT INTO cms (cms_logo_url, cms_image_url, cms_bg_url, cms_title, cms_subtitle, cms_japcha, cms_how_to_order, cms_socials, cms_policy, cms_location, cms_contact_us) VALUES (?,?,?,?,?,?,?,?,?,?,?);');

        if(!$stmt->execute(array($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact))) {
            $stmt = null;
            header("location: ../back-end/admin-cms.php?error=stmtfailed");
            exit();
        }

        $stmt = null;

    }
}