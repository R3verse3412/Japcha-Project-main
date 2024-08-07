<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/signup.classes.php";

$signup_model = new Signup();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['userid'])){
        $userid = htmlspecialchars($_POST['userid'], ENT_QUOTES, 'UTF-8');
        $block = htmlspecialchars($_POST['block'], ENT_QUOTES, 'UTF-8');
        $postal = htmlspecialchars($_POST['postal'], ENT_QUOTES, 'UTF-8');
        $city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
        $region = htmlspecialchars($_POST['region'], ENT_QUOTES, 'UTF-8');
    
        $response = ''; // Initialize the $response variable as a string
      
     
        if (strlen($postal) === 4 || !($postal)) {
   
            $change_add = $signup_model->updateCustomerAddress($block, $postal, $city, $region, $userid);
                if ($change_add) {
                    $response = 'Address updated successfully';
                } else {
                    $response = 'Could not update the address';
                }
        }else{
            $response = "Invalid Postal Code";
        }
    
        // Return the response as a simple string
        echo $response;
    }
    if(isset($_POST['customer_id'])) {

        $userid = htmlspecialchars($_POST['customer_id'], ENT_QUOTES, 'UTF-8');
        $fname = htmlspecialchars($_POST['fname'], ENT_QUOTES, 'UTF-8');
        $lname = htmlspecialchars($_POST['lname'], ENT_QUOTES, 'UTF-8');
        $contact = htmlspecialchars($_POST['contact'], ENT_QUOTES, 'UTF-8');
    
        $response = ''; // Corrected variable name
    
        if (strlen($contact) >= 10 && strlen($contact) <= 11) {
            // Valid length, proceed with your code
            $change_customerinfo = $signup_model->updateCustomerCustomerInfo($fname, $lname, $contact, $userid);
            if ($change_customerinfo) {
                $response = 'Information is successfully updated';
            } else {
                $response = 'Could not update the information';
            }
        } else {
            // Invalid length, handle the error or take appropriate action
            $response = "Invalid contact number";
        }
        
        echo $response; // Corrected variable name
    }
    
 
}
    
   

