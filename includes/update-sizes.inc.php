<?php


if($_SERVER["REQUEST_METHOD"] == "POST")
{
     // Get the form data
     if (isset($_POST["sizeid"])){
        $size = htmlspecialchars($_POST["sizename"], ENT_QUOTES, 'UTF-8');
        $sizeID = htmlspecialchars($_POST["sizeid"], ENT_QUOTES, 'UTF-8');
   
       // instantiate signupContr class
       include "../classes/dbh.classes.php";
       include "../classes/add-size.classes.php";
       include "../classes/update-size-cntrl.classes.php";

       $update = new UpdateSizeContr($size, $sizeID);
   
       // Runnig error handlers and user signup
       $update-> updateSize();
   
       // Going back to page
       header("location: ../back-end/admin-sizes.php?error=none");

     }
     
}
