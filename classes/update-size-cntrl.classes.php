<?php

class UpdateSizeContr extends addSize{

    private $size;
    private $sizeID;

    public function __construct($size, $sizeID){
        $this ->sizeID = $sizeID;
        $this ->size = $size;
       
        
    }

    public function updateSize(){
        if($this->emptyInput() == false) 
        {
            header("location: ../back-end/admin-sizes.php?error=emptyinput");
            exit();
        }
        // if($this->invalidName() == false) 
        // {
        //     header("location: ../viewCategory.php?error=invalidname");
        //     exit();
        // }
        if($this->SizeTaken() == false) 
        {
            header("location: ../back-end/admin-sizes.php?error=addonsalreadyexist");
            exit();
        }
        $this->updateNewSize($this ->size, $this ->sizeID );
    }

    private function emptyInput(){
        $result;
        if(empty($this ->size)) 
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

    private function SizeTaken() {
        return $this->checkSize($this->size);
    }
}