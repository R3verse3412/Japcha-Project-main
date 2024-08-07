<?php


if($_SERVER["REQUEST_METHOD"] == "POST")
{
     // Get the form data
     if (isset($_POST["addonsid"])){
        $addons = htmlspecialchars($_POST["addons"], ENT_QUOTES, 'UTF-8');
        $addonsID = htmlspecialchars($_POST["addonsid"], ENT_QUOTES, 'UTF-8');
   
       // instantiate signupContr class
       include "../classes/dbh.classes.php";
       include "../classes/add-addons.classes.php";
       include "../classes/update-addons-cntrl.classes.php";

       $update = new UpdateAddonsContr($addons, $addonsID);
   
       // Runnig error handlers and user signup
       $update-> updateAddons();
   
       // Going back to page
       header("location: ../back-end/admin-add-ons.php?error=none");

     }
     
}
