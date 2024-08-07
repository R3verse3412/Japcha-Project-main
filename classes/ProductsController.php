<?php

class ProductController extends ProductModel{

    private $comboName;
    private $ComboDescription;
    private $product1;
    private $product2;
    private $category;

    public function __construct($comboName, $ComboDescription, $product1, $product2, $category){
        $this->comboName = $comboName;
        $this->ComboDescription = $ComboDescription;
        $this->product1 = $product1;
        $this->product2 = $product2;
        $this->category = $category;
    }

    public function addComboProduct(){
        if($this->emptyInput() == false) 
        {
            header("location: ../back-end/adminProducts.php?error=emptyinput");
            exit();
        }
        // if($this->invalidName() == false) 
        // {
        //     header("location: ../viewCategory.php?error=invalidname");
        //     exit();
        // }
        // if($this->ProductSizeVariationExisting() == false) 
        // {
        //     header("location: ../back-end/adminProducts.php?error=ProductVariationAlreadyexist");
        //     exit();
        // }

        $this->setComboProduct($this ->comboName, $this ->ComboDescription, $this ->product1, $this ->product2, $this ->category );
    }

    private function emptyInput(){
        $result;
        if(empty($this ->comboName) || empty($this ->ComboDescription) || empty($this ->product1) || empty($this ->product2) || empty($this ->category)) 
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }


}