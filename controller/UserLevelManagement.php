<?php


include '../classes/dbh.classes.php';

include 'ArchiveUserlevel.php';
$controller = new userlvlController();

require_once "../classes/mailer_function.php";
$mailer = new YourEmailClass();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  

    if (isset($_POST['archiveul'])) {
        header('Content-Type: application/json'); 
        $archiveid = htmlspecialchars($_POST["archiveul"], ENT_QUOTES, 'UTF-8');
        $archvive = $controller->archiveUL($archiveid);

        $response = array();

        if ($archvive != false) {
            $response['success'] = "Archive Successfully";
        } else {
            $response['unable'] = "Unable to archive, userlevel is currently active.";
        }
        
        echo json_encode($response);
    }

    if (isset($_POST['deleteul'])) {
        header('Content-Type: application/json'); 
        $delete_id = htmlspecialchars($_POST["deleteul"], ENT_QUOTES, 'UTF-8');
        $delete = $controller->delete_userlevel($delete_id);

        $response = array();

        if ($delete != false) {
            $response['success'] = "Deleted Successfully";
        } else {
            $response['unable'] = "Unable to delete, userlevel is currently active.";
        }
        
        echo json_encode($response);
    }

    if (isset($_POST['delete_cat'])) {
        header('Content-Type: application/json'); 
        $delete_id = htmlspecialchars($_POST["delete_cat"], ENT_QUOTES, 'UTF-8');
        $delete = $controller->delete_category($delete_id);

        $response = array();

        if ($delete != false) {
            $response['success'] = "Deleted Successfully";
        } else {
            $response['unable'] = "Unable to delete, category is currently in used.";
        }
        
        echo json_encode($response);
    }

    if (isset($_POST['delete_addons'])) {
        header('Content-Type: application/json'); 
        $delete_id = htmlspecialchars($_POST["delete_addons"], ENT_QUOTES, 'UTF-8');
        $delete = $controller->deleteAddons($delete_id);

        $response = array();

        if ($delete != false) {
            $response['success'] = "Deleted Successfully";
        }
        
        echo json_encode($response);
    }

    
    if (isset($_POST['delete_size'])) {
        header('Content-Type: application/json'); 
        $delete_id = htmlspecialchars($_POST["delete_size"], ENT_QUOTES, 'UTF-8');
        $delete = $controller->deleteSize($delete_id);

        $response = array();

        if ($delete != false) {
            $response['success'] = "Deleted Successfully";
        } else {
            $response['error'] = "Unable to delete, size is currently in used.";
        }
        
        echo json_encode($response);
    }

    if (isset($_POST['id_customer'])) {
        $ban_id = htmlspecialchars($_POST["id_customer"], ENT_QUOTES, 'UTF-8');
        $ban_emaissl = htmlspecialchars($_POST["mail_customer"], ENT_QUOTES, 'UTF-8');
      
        $ban = $controller->banCustomerAccount($ban_id);
    
        $response = array();
    
        if ($ban != false) {
            $response['success'] = "User Account has been banned";
            $mailer->send_notif_banned($ban_emaissl); // Use $ban_emaissl here
        }
    
        echo json_encode($response);
    }
    
    

}

