<?php
require_once "../classes/dbh.classes.php";
require_once "../classes/ProductsModel.php";
require_once "../classes/user-level-Model.php";
require_once "../classes/signup.classes.php";
require_once "../classes/mailer_function.php";
$mailer = new YourEmailClass();

$products = new ProductModel();
$userlevel = new UserLevel();
$customer = new Signup();
if(isset($_GET['product'])){


$ArchivedProd = $products->getProductArchived();

    if(!empty($ArchivedProd)){
        $arhiveProd = [];


        foreach ($ArchivedProd as $archived) {
        

            $arhiveProd[] = [
                'product_id' => $archived['product_id'],
                'image_url' => $archived['image_url'],
                'product_name' => $archived['product_name'],
                'category_name' => $archived['category_name'],
            ];
        }

        // Send the latest orders as JSON response
        header('Content-Type: application/json');
        echo json_encode(['prod' => $arhiveProd]);
    }


}

if(isset($_POST['product_id'])){
    $product_id = $_POST['product_id'];
    $unarchiveProduct = $products->UnarchivedProduct($product_id );

    $reporting;
    
    if($unarchiveProduct != false){
        $reporting = 'Product has been unarchived';
    }else{
        $reporting = 'An error occured during archiving the product.';
    }

    echo json_encode($reporting);
}

if(isset($_POST['product_id_delete'])){
    $product_id = $_POST['product_id_delete'];
    $unarchiveProduct = $products->DeleteProduct($product_id );

    $reporting;
    
    if($unarchiveProduct != false){
        $reporting = 'Product has successfully deleted';
    }else{
        $reporting = 'An error occured during deleting the product.';
    }

    echo json_encode($reporting);
}

if(isset($_GET['userlevel'])){


    $ArchivedUserlevel = $userlevel->getArchivedUserlevel();
    
        if(!empty($ArchivedUserlevel)){
            $arhiveUL = [];
    
    
            foreach ($ArchivedUserlevel as $archived) {
            
    
                $arhiveUL[] = [
                    'userlevel_id' => $archived['userlevel_id'],
                    'user_level_name' => $archived['user_level_name'],
                ];
            }
    
            // Send the latest orders as JSON response
            header('Content-Type: application/json');
            echo json_encode(['usl' => $arhiveUL]);
        }
    
    
}

if(isset($_POST['userlevel_id'])){

    $userlevel_id = $_POST['userlevel_id'];

    $unarchiveUL = $userlevel->UnarchivedUserlevel($userlevel_id);

    $reporting;
    
    if($unarchiveUL != false){
        $reporting = 'Userlvel has been unarchived';
    }else{
        $reporting = 'An error occured during archiving the userlevel.';
    }

    echo json_encode($reporting);
    
}

if(isset($_POST['userlevel_id_delete'])){

    $userlevel_id = $_POST['userlevel_id_delete'];

    $DeleteUL = $userlevel->DeleteUserlevel($userlevel_id);

    $reporting;
    
    if($DeleteUL != false){
        $reporting = 'Userlvel has been permanently deleted';
    }else{
        $reporting = 'An error occured during deleting the userlevel.';
    }

    echo json_encode($reporting);
    
}

if(isset($_GET['customer_account'])){


    $customer_banned = $customer->getCustomerDataArchived();
    
        if(!empty($customer_banned)){
            $banUL = [];
    
    
            foreach ($customer_banned as $banned) {
            
              
                
                $banUL[] = [
                    'customer_id' => $banned['customer_id'],
                    'username' => $banned['username'],
                    'last_name' => $banned['last_name'],
                    'email' => $banned['email'],
                    'address' => implode(', ', [
                        $banned['customer_address'],
                        $banned['city'],
                        $banned['region'],  
                        $banned['postal_code'],
                    ]),
                ];
            }
    
            // Send the latest orders as JSON response
            header('Content-Type: application/json');
            echo json_encode(['user' => $banUL]);
        }
    
    
}


if(isset($_POST['userid'])){

    $userid = $_POST['userid'];
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    
    $unban_account = $customer->unbanCustomer($userid);

    $reporting;
    
    if($unban_account != false){
        $reporting = 'Customer account has been reactivated';
        $mailer->send_notif_reactivate_account($email);
    }else{
        $reporting = 'An error occured during archiving the userlevel.';
    }

    echo json_encode($reporting);
    
}


if(isset($_POST['userid_delete'])){

    $userid = $_POST['userid_delete'];
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $delete_account = $customer->deleteCustomerAccount($userid);

    $reporting;
    
    if($delete_account != false){
        $reporting = 'Customer has been permanently banned and deleted.';
        $mailer->send_notif_perma_banned($email);
    }else{
        $reporting = 'An error occured during archiving the userlevel.';
    }

    echo json_encode($reporting);
    
}