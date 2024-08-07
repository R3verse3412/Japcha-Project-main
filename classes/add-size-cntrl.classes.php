<?php
    
    // require_once("add-size.classes.php");

class AddSizeContr extends addSize{

    private $size;
    public $res;

    public function __construct($size){
        $this ->size = $size;
        
    }

    public function addSize(){
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
            header("location: ../back-end/admin-sizes.php?error=categoryalreadyexist");
            exit();
        }

        $this->setSize($this ->size );
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
    public function fetchSize(){
        $sql = "SELECT * FROM size ORDER BY size_id DESC";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0){
            return mysqli_fetch_assoc($res);
        }
    }
}