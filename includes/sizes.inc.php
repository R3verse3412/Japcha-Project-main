<?php


if($_SERVER["REQUEST_METHOD"] == "POST")
{
     // Get the form data
     $size = htmlspecialchars($_POST["size"], ENT_QUOTES, 'UTF-8');

    // instantiate signupContr class
    include "../classes/dbh.classes.php";
    include "../classes/add-size.classes.php";
    include "../classes/add-size-cntrl.classes.php";
    $addSize = new AddSizeContr($size);

    // Runnig error handlers and user signup
    $addSize-> addSize();

    // Going back to page
    header("location: ../back-end/admin-sizes.php?error=none");

}
