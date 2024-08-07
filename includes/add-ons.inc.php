<?php


if($_SERVER["REQUEST_METHOD"] == "POST")
{
     // Get the form data
     $addons = htmlspecialchars($_POST["addons"], ENT_QUOTES, 'UTF-8');
     $addons_price = htmlspecialchars($_POST["addons_price"], ENT_QUOTES, 'UTF-8');
    // instantiate signupContr class
    include "../classes/dbh.classes.php";
    include "../classes/add-addons.classes.php";
    include "../classes/add-addons-cntrl.classes.php";
    $addons = new AddAddonsContr($addons, $addons_price);

    // Runnig error handlers and user signup
    $addons-> addAddons();

    // Going back to page
    header("location: ../back-end/admin-add-ons.php?error=none");

}
