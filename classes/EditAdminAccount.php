<?php

class EditAdminController extends Signup{

    private $username;

    private $fullname;
    private $userLevel;
    private $contactNum;
    private $admin_id;

    public function __construct($username, $fullname, $userLevel, $contactNum, $admin_id){
        $this ->username = $username;
        $this ->fullname = $fullname;
        $this ->userLevel = $userLevel;
        $this ->contactNum = $contactNum;
        $this ->admin_id = $admin_id;
        
    }

    public function editAdmin(){
        if($this->emptyInput() == false) 
        {
            $_SESSION['empty_input_admin'] = "Please fill in all required fields.";
            header("location: ../back-end/adminAccount.php?error=emptyinput");
            exit();
        }
        if($this->invalidName() == false) 
        {
            $_SESSION['inavlid_name_admin_account'] = "Username must be atleast 5 characters long.";
            header("location: ../back-end/adminAccount.php?error=invalidusername");
            exit();
        }

        if($this->validateContact() == false) 
        {
            $_SESSION['invalid_contact_admin_account'] = "Invalid contact number";
            header("location: ../back-end/adminAccount.php?error=invalidContactNumber");
            exit();
        }

        if($this->uidTakenCheck() == false) 
        {
            $_SESSION['uid_taken'] = "Username is already taken";
           
            header("location: ../back-end/adminAccount.php?error=usernametaken");
            exit();
        }

        $this->updateAdmin($this ->username, $this ->fullname, $this ->userLevel,  $this ->contactNum,   $this ->admin_id);
    }



    private function emptyInput(){
        $result;
        if(empty( $this ->username) || empty( $this ->fullname) || empty($this ->contactNum) ) 
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }


    private function invalidName() {
        $result;
        if (preg_match("/^[a-zA-Z0-9\s]{5,}$/", $this->username)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    
    
    
    
    private function validateContact() {
        // Allow phone numbers starting with '0'
        if (strlen($this->contactNum) < 10 || strlen($this->contactNum) > 11) {
            return false;
        }
    
        return true;
    }
    
    private function uidTakenCheck() {
        return $this->checkAdminEdit($this->username, $this ->admin_id);
    }
}