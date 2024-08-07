<?php

class ProductSizesController extends addProductSizes{

    private $product;
    private $size;
    private $price;
    private $quantity;

    public function __construct($product, $size, $price, $quantity){
        $this ->product = $product;
        $this ->size = $size;
        $this ->price = $price;
        $this ->quantity = $quantity;
        
    }

    public function addProductSizes(){
        if($this->emptyInput() == false) 
        {
            header("location: ../back-end/admin-ProductSizes.php?error=emptyinput");
            exit();
        }
        // if($this->invalidName() == false) 
        // {
        //     header("location: ../viewCategory.php?error=invalidname");
        //     exit();
        // }
        if($this->ProductSizeVariationExisting() == false) 
        {
            header("location: ../back-end/admin-ProductSizes.php?error=ProductVariationAlreadyexist");
            exit();
        }

        $this->setProductSizes($this ->product, $this ->size, $this ->price, $this ->quantity );
    }

    private function emptyInput(){
        $result;
        if(empty($this ->product) || empty($this ->size) || empty($this ->price) || empty($this ->quantity) ) 
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

    private function ProductSizeVariationExisting() {
        return $this->checkProductSize($this->product, $this->size);
    }
}