<?php

class UpdateCategoryContr extends addCategory{

    private $category;
    private $categoryID;

    public function __construct($category, $categoryID){
        $this ->categoryID = $categoryID;
        $this ->category = $category;
       
        
    }

    public function updateCategory(){
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
        if($this->CategoryTaken() == false) 
        {
            header("location: ../back-end/viewCategory.php?error=addonsalreadyexist");
            exit();
        }
        $this->updateNewCategory($this ->category, $this ->categoryID );
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

    private function CategoryTaken() {
        return $this->checkCategory($this->category);
    }
}