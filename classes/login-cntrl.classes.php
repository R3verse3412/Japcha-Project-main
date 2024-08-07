<?php

class LoginContr extends Login{


    private $pwd;
    private $email;

    public function __construct($email, $pwd){
        $this ->pwd = $pwd;
        $this ->email = $email;
    }

    public function loginUser(){
        if($this->emptyInput() == false) 
        {
            header("location: ../index.php?error=emptyinput");
            exit();
        }
       
        if ($this->isAdminLogin()) {
            $this->adminLogin($this->email, $this->pwd);
        } else {
            $this->getUser($this->email, $this->pwd);
        }
    }

    private function emptyInput(){
        $result;
        if(empty( $this ->email) || empty( $this ->pwd) ) 
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function isAdminLogin() {
        try {
            // Prepare SQL query to check if the user has a non-empty userLevel_id
            $stmt = $this->connect()->prepare('SELECT userlevel_id FROM admin_account WHERE email = :email');
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
    
            // Execute the query
            if (!$stmt->execute()) {
                throw new Exception("Database query failed.");
            }
    
            // Fetch the user's data, including userLevel_id
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if userLevel_id exists and is not empty
            if ($userData && !empty($userData['userlevel_id'])) {
                return true; // It's an admin login
            } else {
                return false; // It's not an admin login
            }
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../index.php?error=" . urlencode($e->getMessage()));
            exit();
        } finally {
            // Clean up resources
            $stmt = null;
        }
    }
    

}