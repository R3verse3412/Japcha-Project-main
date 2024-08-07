<?php

class UpdateAddonsContr extends addAddons{

    private $addons;
    private $addonsID;

    public function __construct($addons, $addonsID){
        $this ->addonsID = $addonsID;
        $this ->addons = $addons;
       
        
    }

    public function updateAddons(){
        if($this->emptyInput() == false) 
        {
            header("location: ../back-end/admin-add-ons.php?error=emptyinput");
            exit();
        }
        // if($this->invalidName() == false) 
        // {
        //     header("location: ../viewCategory.php?error=invalidname");
        //     exit();
        // }
        if($this->AddonsTaken() == false) 
        {
            header("location: ../back-end/admin-add-ons.php?error=addonsalreadyexist");
            exit();
        }
        $this->updateNewAddons($this ->addons, $this ->addonsID );
    }

    private function emptyInput(){
        $result;
        if(empty($this ->addons)) 
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    // private function invalidName(){
    //     // $result;
    //     // if(preg_match("/^[a-zA-Z0-9]*$/", $this ->category)) {
    //     //     $result = false;
    //     // }
    //     // else {
    //     //     $result = true;
    //     // }
    //     // return $result;
    // }

    private function AddonsTaken() {
        return $this->checkAddons($this->addons);
    }
}