<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-admin-cntrl.classes.php";
    include "../classes/EditAdminAccount.php";

    if(isset($_POST['AddAdmin'])){
        // Get the form data
        // $username = $_POST['userName'];
        // $email = $_POST['email'];
        // $pwd = $_POST['pass'];
        // $userLevel = $_POST['user_level'];
        // $contactNum = $_POST['contact'];


        // Sanitize and validate username
        $username = htmlspecialchars($_POST['userName']);

        // Sanitize and validate email
        $fullname =  htmlspecialchars($_POST['fullname']);
        // Sanitize password (no validation applied here, adjust as needed)
        $pwd = htmlspecialchars($_POST['pass']);
        // Sanitize and validate user_level (assuming it's an integer)
        $userLevel = filter_var($_POST['user_level'], FILTER_SANITIZE_NUMBER_INT);
        // Sanitize and validate contact number (assuming it's a string)
        $contactNum = htmlspecialchars($_POST['contact']);




        // instantiate signupContr class
        $signup = new SignupContrAdmin($username, $fullname, $pwd, $userLevel, $contactNum);

        // Runnig error handlers and user signup
        $signup-> signupAdmin();
        
      
        $_SESSION["AddedSuccess"] = "Added Successfully";
        // Going back to front page
        header("location: ../back-end/adminAccount.php?error=none");
    }
    
    // if(isset($_POST['EditAdmin'])){

    //     $username = isset($_POST['userName']) ? htmlspecialchars($_POST['userName']) ?? null;
    //     $fullname = isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) ?? null;
    //     $pwd = isset($_POST['pass']) ? htmlspecialchars($_POST['pass']) ?? null;
    //     $userLevel = isset($_POST['user_level']) ? htmlspecialchars($_POST['user_level']) : null;
    //     $contactNum = isset($_POST['contact']) ? htmlspecialchars($_POST['contact']) ?? null;
        

    //     $admin_id = htmlspecialchars($_POST['AdminId']);

    //     // echo $admin_id;
    //     // echo '<br>';
    //     // echo $username;
    //     // echo '<br>';
    //     // echo $fullname;
    //     // echo '<br>';
    //     // echo $pwd;
    //     // echo '<br>';
    //     // echo $userLevel;
    //     // echo '<br>';
    //     // echo $contactNum;
    //     // echo '<br>';

    //     $edit_admin_account = new EditAdminController($username, $fullname, $pwd, $userLevel, $contactNum, $admin_id);
    //     $edit_admin_account->editAdmin();
    //     $_SESSION["AddedSuccess"] = "Added Successfully";
    //     // Going back to front page
    //     header("location: ../back-end/adminAccount.php?");

        
    // }
    if (isset($_POST['EditAdmin'])) {
        $username = isset($_POST['userName']) ? htmlspecialchars($_POST['userName']) : htmlspecialchars($_POST['userName']);
        $fullname = isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : null;

        $userLevel = isset($_POST['user_level']) ? htmlspecialchars($_POST['user_level']) :  htmlspecialchars($_POST['default_userlevel']);
        $contactNum = isset($_POST['contact']) ? htmlspecialchars($_POST['contact']) : null;
    
        $admin_id = htmlspecialchars($_POST['AdminId']);
    
        $edit_admin_account = new EditAdminController($username, $fullname, $userLevel, $contactNum, $admin_id);
        $edit_admin_account->editAdmin();
        $_SESSION["EditedAdmin"] = "Admin Account Edit Successfully";
        // Going back to the front page

        header("location: ../back-end/adminAccount.php?");
    }
    
   

}
