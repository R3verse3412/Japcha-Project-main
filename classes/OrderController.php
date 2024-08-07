<?php

class OrderController extends Order{

    private $customerid;
    private $prodid;
    private $sizesid;
    private $subtotal;
    private $price;
    private $quantity;
    // private $address;
    private $_id;
    private $remark;
    // private $status;



    public function __construct($customerid, $prodid, $sizesid, $subtotal, $price, $quantity, $_id, $remark){
        $this ->customerid = $customerid;
        $this ->prodid = $prodid;
        $this ->sizesid = $sizesid;
        $this ->subtotal = $subtotal;
        $this ->price = $price;
        $this ->quantity = $quantity;
        $this ->_id = $_id;
        // $this ->address = $address;
        $this ->remark = $remark;
        // $this ->status = $status;
        
    }

    public function orderProd(){
        // if($this->emptyInput() == false) 
        // {
        //     header("location: ../index.php?error=emptyinput");
        //     exit();
        // }

        $this->setOrder($this ->customerid,  $this ->prodid,  $this ->sizesid, $this ->subtotal, $this ->price, $this ->quantity, $this ->_id,  $this ->remark);
    }

    // private function emptyInput(){
    //     $result;
    //     if(empty( $this ->username) || empty( $this ->pwd) || empty($this ->pwdConfirm) || empty( $this ->email) || empty(  $this ->address) || empty($this ->contactNum) ) 
    //     {
    //         $result = false;
    //     }
    //     else {
    //         $result = true;
    //     }
    //     return $result;
    // }


}