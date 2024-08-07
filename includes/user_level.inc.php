<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    include "../classes/dbh.classes.php";
    include "../classes/user-level-Model.php";
    $AddNewUserLevel = new UserLevel();

    if(isset($_POST['AddUserLvl'])){
        $name = htmlspecialchars($_POST["usname"]);
    
        // Process permissions for different modules
        $dashboard_view = isset($_POST["permissions"]["dashboard"]["view"]) ? 1 : 0;
        $dashboard_edit = isset($_POST["permissions"]["dashboard"]["edit"]) ? 1 : 0;
    
        //order Management
        $orderManagement_view = isset($_POST["permissions"]["orderManagement"]["view"]) ? 1 : 0;
        $orderManagement_create = isset($_POST["permissions"]["orderManagement"]["create"]) ? 1 : 0;
    
        // Initialize variables for contentManagement permissions
        $contentManagement_view = isset($_POST["permissions"]["contentManagement"]["view"]) ? 1 : 0;
        $contentManagement_create = isset($_POST["permissions"]["contentManagement"]["create"]) ? 1 : 0;
        $contentManagement_edit = isset($_POST["permissions"]["contentManagement"]["edit"]) ? 1 : 0;
        $contentManagement_delete = isset($_POST["permissions"]["contentManagement"]["delete"]) ? 1 : 0;
    
        // Initialize variables for fileManagement permissions
        $fileManagement_view = isset($_POST["permissions"]["fileManagement"]["view"]) ? 1 : 0;
        $fileManagement_create = isset($_POST["permissions"]["fileManagement"]["create"]) ? 1 : 0;
        $fileManagement_edit = isset($_POST["permissions"]["fileManagement"]["edit"]) ? 1 : 0;
        $fileManagement_delete = isset($_POST["permissions"]["fileManagement"]["delete"]) ? 1 : 0;
        $fileManagement_archive= isset($_POST["permissions"]["fileManagement"]["archive"]) ? 1 : 0;
    
        //statistics Management
        $statisticsManagement_view = isset($_POST["permissions"]["statisticsManagement"]["view"]) ? 1 : 0;
        $statisticsManagement_create = isset($_POST["permissions"]["statisticsManagement"]["create"]) ? 1 : 0;
       
       
        //Chat Management
        $chatManagement_view = isset($_POST["permissions"]["chatManagement"]["view"]) ? 1 : 0;
        $chatManagement_create = isset($_POST["permissions"]["chatManagement"]["create"]) ? 1 : 0;
    
        // Initialize variables for marketing management permissions
        $marketingManagement_view = isset($_POST["permissions"]["marketingManagement"]["view"]) ? 1 : 0;
        $marketingManagement_create = isset($_POST["permissions"]["marketingManagement"]["create"]) ? 1 : 0;
        $marketingManagement_edit = isset($_POST["permissions"]["marketingManagement"]["edit"]) ? 1 : 0;
        $marketingManagement_delete = isset($_POST["permissions"]["marketingManagement"]["delete"]) ? 1 : 0;
        $marketingManagement_archive = isset($_POST["permissions"]["marketingManagement"]["archive"]) ? 1 : 0;
    
    
    
    
        $AddNewUserLevel->setUserLevel($name, $dashboard_view, $dashboard_edit,$orderManagement_view ,  $orderManagement_create, $contentManagement_view, $contentManagement_create, $contentManagement_edit,$contentManagement_delete,  $fileManagement_view, $fileManagement_create,  $fileManagement_edit, $fileManagement_delete, $fileManagement_archive, $statisticsManagement_view, $statisticsManagement_create, $chatManagement_view, $chatManagement_create,   $marketingManagement_view,  $marketingManagement_create,  $marketingManagement_edit, $marketingManagement_delete,  $marketingManagement_archive );
    
        // $AddNewUserLevel->setUserLevel($name, $dashboard_view, $dashboard_edit,$appointmentManagement_view,  $appointmentManagement_create, $appointmentManagement_edit, $appointmentManagement_delete,$accountManagement_view,  $accountManagement_create, $accountManagement_edit, $accountManagement_delete,$accountManagement_archive,  $accountManagement_ban, $contentManagement_view, $contentManagement_create, $contentManagement_edit,$contentManagement_delete,  $fileManagement_view, $fileManagement_create,  $fileManagement_edit, $fileManagement_delete);
    
        header("location: ../back-end/userLevel.php?error=none");
    }
   
    if(isset($_POST['editUserLvl'])){
        $name = htmlspecialchars($_POST["usname"]);
        $userlvlID = htmlspecialchars($_POST["UserLevel_id"]);
        // Process permissions for different modules
        $dashboard_view = isset($_POST["permissions"]["dashboard"]["view"]) ? 1 : 0;
        $dashboard_edit = isset($_POST["permissions"]["dashboard"]["edit"]) ? 1 : 0;
    
        //order Management
        $orderManagement_view = isset($_POST["permissions"]["orderManagement"]["view"]) ? 1 : 0;
        $orderManagement_create = isset($_POST["permissions"]["orderManagement"]["create"]) ? 1 : 0;
    
        // Initialize variables for contentManagement permissions
        $contentManagement_view = isset($_POST["permissions"]["contentManagement"]["view"]) ? 1 : 0;
        $contentManagement_create = isset($_POST["permissions"]["contentManagement"]["create"]) ? 1 : 0;
        $contentManagement_edit = isset($_POST["permissions"]["contentManagement"]["edit"]) ? 1 : 0;
        $contentManagement_delete = isset($_POST["permissions"]["contentManagement"]["delete"]) ? 1 : 0;
    
        // Initialize variables for fileManagement permissions
        $fileManagement_view = isset($_POST["permissions"]["fileManagement"]["view"]) ? 1 : 0;
        $fileManagement_create = isset($_POST["permissions"]["fileManagement"]["create"]) ? 1 : 0;
        $fileManagement_edit = isset($_POST["permissions"]["fileManagement"]["edit"]) ? 1 : 0;
        $fileManagement_delete = isset($_POST["permissions"]["fileManagement"]["delete"]) ? 1 : 0;
        $fileManagement_archive= isset($_POST["permissions"]["fileManagement"]["archive"]) ? 1 : 0;
    
        //statistics Management
        $statisticsManagement_view = isset($_POST["permissions"]["statisticsManagement"]["view"]) ? 1 : 0;
        $statisticsManagement_create = isset($_POST["permissions"]["statisticsManagement"]["create"]) ? 1 : 0;
       
       
        //Chat Management
        $chatManagement_view = isset($_POST["permissions"]["chatManagement"]["view"]) ? 1 : 0;
        $chatManagement_create = isset($_POST["permissions"]["chatManagement"]["create"]) ? 1 : 0;
    
        // Initialize variables for marketing management permissions
        $marketingManagement_view = isset($_POST["permissions"]["marketingManagement"]["view"]) ? 1 : 0;
        $marketingManagement_create = isset($_POST["permissions"]["marketingManagement"]["create"]) ? 1 : 0;
        $marketingManagement_edit = isset($_POST["permissions"]["marketingManagement"]["edit"]) ? 1 : 0;
        $marketingManagement_delete = isset($_POST["permissions"]["marketingManagement"]["delete"]) ? 1 : 0;
        $marketingManagement_archive = isset($_POST["permissions"]["marketingManagement"]["archive"]) ? 1 : 0;
    
        
        $AddNewUserLevel->updateUserLevel($name, $dashboard_view, $dashboard_edit,$orderManagement_view ,  $orderManagement_create, $contentManagement_view, $contentManagement_create, $contentManagement_edit,$contentManagement_delete,  $fileManagement_view, $fileManagement_create,  $fileManagement_edit, $fileManagement_delete, $fileManagement_archive, $statisticsManagement_view, $statisticsManagement_create, $chatManagement_view, $chatManagement_create,   $marketingManagement_view,  $marketingManagement_create,  $marketingManagement_edit, $marketingManagement_delete,  $marketingManagement_archive, $userlvlID);
        header("location: ../back-end/userLevel.php?error=none");
    }
}