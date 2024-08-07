<?php

class ProfileInfoContr extends ProfileInfo {

    private $cusomterId;
    private $username;
    
    public function __construct($cusomterId, $username){
        $this->cusomterId = $cusomterId;
        $this->username = $username;
    }

    public function defaultProfileInfo(){
        $profileAbout = "Something";
        $profileTitle = "Something About" . $this->username;
        $profileText = "Something bout you";
        $this->setProfileInfo($profileAbout, $profileTitle, $profileText, $this->cusomterId);
    }

    public function updateProfileInfo($about, $intro, $text){
        // Error Handlers
        if($this->emptyInputCheck($about, $intro, $text) == true){
            header("location: ../myProfile.php?error=emptyinput");
            exit();
        }



        // Update profile info
        $this->setNewProfileInfo($about, $intro, $text, $this->cusomterId);

    }

    private function emptyInputCheck($about, $intro, $text){
        $result;
        if(empty( $this ->about) || empty( $this ->intro) || empty( $this ->text) ) 
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    
}