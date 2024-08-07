<?php

class SignupContr extends Signup{

    private $username;
    private $lname;
    private $pwd;
    private $pwdConfirm;
    private $email;
    private $address;
    private $PostalCode;
    private $City;
    private $Region;
    private $contactNum;

    public function __construct($username, $lname, $pwd, $pwdConfirm, $email, $address, $PostalCode,  $City, $Region, $contactNum){
        $this ->username = $username;
        $this ->lname = $lname;
        $this ->pwd = $pwd;
        $this ->pwdConfirm = $pwdConfirm;
        $this ->email = $email;
        $this ->address = $address;
        $this ->PostalCode = $PostalCode;
        $this ->City = $City;
        $this ->Region = $Region;
        $this ->contactNum = $contactNum;
        
    }

    public function signupUser(){
        $errors = array();

        if($this->emptyInput() == false) {
            $errors['emptyInput'] = 'Please fill in all fields.';
        }
        if($this->invalidName() == false) {
            $errors['invalidName'] = 'Name should be 2 or 3 characters long / No numbers allowed / maximum of 50 characters.';
        }
        if($this->invalidEmail() == false) {
            $errors['invalidEmail'] = 'Invalid email.';
        }
        if($this->pwdMatch() == false) {
            $errors['pwdMatch'] = 'Passwords do not match.';
        }
        if($this->uidTakenCheck() == false) {
            $errors['uidTakenCheck'] = 'Email is already in use.';
        }
        if($this->validatePassword() == false){
            $errors['validatePassword'] = 'Password should be at least 8 characters long and contain at least one digit, one uppercase letter, and one lowercase letter.';
        }
        if($this->validateContact() == false){
            $errors['validateContact'] = 'Invalid contact number.';
        }
        if($this->validatePostalCode() == false){
            $errors['validatePostalCode'] = 'Invalid Postal Code.';
        }
    
        return $errors;
    }

    private function emptyInput(){
        $result;
        if(empty( $this ->username) || empty( $this ->pwd) || empty($this ->pwdConfirm) || empty( $this ->email) || empty(  $this ->address) || empty($this ->contactNum) ) 
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function invalidName() {
        $result = false;
    
        $namePattern = "/^[a-zA-Z\s'-]{2,50}$/";
    
        if (preg_match($namePattern, $this->username) && preg_match($namePattern, $this->lname)) {
            $result = true;
        }
    
        return $result;
    }
    
    

    private function invalidEmail() {
        $result;
        if (!filter_var($this ->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }
        else {
            $result = true;
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
    

    private function validatePostalCode(){
        if (strlen($this->PostalCode) > 4) {
            return false;
        }
        return true;
    }

    private function validatePassword() {
        // Check if the password is at least 8 characters long
        if (strlen($this->pwd) < 8) {
            return false;
        }
    
        // Check if the password contains at least one digit (0-9)
        if (!preg_match('/\d/', $this->pwd)) {
            return false;
        }
    
        // Check if the password contains at least one uppercase letter
        if (!preg_match('/[A-Z]/', $this->pwd)) {
            return false;
        }
    
        // Check if the password contains at least one lowercase letter
        if (!preg_match('/[a-z]/', $this->pwd)) {
            return false;
        }
    

    
        // If all checks pass, the password is valid
        return true;
    }
    
    
    private function pwdMatch() {
        $result;
        if ($this ->pwd !== $this ->pwdConfirm) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }
    
    
    private function uidTakenCheck() {
        return $this->checkUser($this->email);
    }

    public function fetchCustomerId($username){
        $customerId = $this->getCustomerId($username);
        return $customerId[0]["customer_id"];
    }

}