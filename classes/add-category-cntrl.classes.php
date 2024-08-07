<?php

class AddCategoryContr extends addCategory{

    private $category;

    public function __construct($category){
        $this ->category = $category;
        
    }

    public function addCategory(){
        if($this->emptyInput() == false) 
        {
            header("location: ../back-end/viewCategory.php?error=emptyinput");
            exit();
        }
        // if($this->invalidName() == false) 
        // {
        //     header("location: ../viewCategory.php?error=invalidname");
        //     exit();
        // }
        if($this->categoryTaken() == false) 
        {
            header("location: ../back-end/viewCategory.php?error=categoryalreadyexist");
            exit();
        }

        $this->setCategory($this ->category );
    }

    private function emptyInput(){
        $result;
        if(empty($this ->category)) 
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

    private function categoryTaken() {
        return $this->checkCategory($this->category);
    }
}