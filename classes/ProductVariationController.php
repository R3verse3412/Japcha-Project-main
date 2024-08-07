<?php

class ProdVarController extends addProductSizes{

    private $prodvar_id;
    private $product;
    private $size;
    private $price;
    private $quantity;

    public function __construct($prodvar_id, $product, $size, $price, $quantity){
        $this ->prodvar_id = $product;
        $this ->product = $product;
        $this ->size = $size;
        $this ->price = $price;
        $this ->quantity = $quantity;
        
    }

    public function updateProductVariation(){
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

        $this->updateProdVar($this ->prodvar_id, $this ->product, $this ->size, $this ->price, $this ->quantity );
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