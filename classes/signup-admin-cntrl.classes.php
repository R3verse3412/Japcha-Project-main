<?php

class SignupContrAdmin extends Signup{

    private $username;
    private $pwd;
    private $fullname;
    private $userLevel;
    private $contactNum;

    public function __construct($username, $fullname, $pwd, $userLevel, $contactNum){
        $this ->username = $username;
        $this ->pwd = $pwd;
        $this ->fullname = $fullname;
        $this ->userLevel = $userLevel;
        $this ->contactNum = $contactNum;
        
    }

    public function signupAdmin(){
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

        $this->setAdmin($this ->username, $this ->fullname,   $this ->pwd, $this ->userLevel,  $this ->contactNum );
    }

    public function editAdmin($admin_id){
        if($this->emptyInput() == false) 
        {

            header("location: ../back-end/adminAccount.php?error=emptyinput");
            exit();
        }
        if($this->invalidName() == false) 
        {

            header("location: ../back-end/adminAccount.php?error=invalidusername");
            exit();
        }

        if($this->validateContact() == false) 
        {

            header("location: ../back-end/adminAccount.php?error=invalidContactNumber");
            exit();
        }

        if($this->uidTakenCheckEdit($admin_id) == false) 
        {

            header("location: ../back-end/adminAccount.php?error=usernametaken");
            exit();
        }

        $this->updateAdmin($this ->username, $this ->fullname,   $this ->pwd, $this ->userLevel,  $this ->contactNum, $admin_id);
    }

    

    private function emptyInput(){
        $result;
        if(empty( $this ->username) || empty( $this ->pwd) || empty( $this ->fullname) || empty($this ->contactNum) ) 
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
        if (strlen($this->contactNum) != 10) {
            return false;
        }
    
        return true;
    }

    
    private function uidTakenCheck() {
        return $this->checkAdmin($this->username);
    }

    private function uidTakenCheckEdit($admin_id) {
        return $this->checkAdminEdit($this->username, $admin_id);
    }
}