<?php


if($_SERVER["REQUEST_METHOD"] == "POST")
{
     // Get the form data
     $category = $_POST['c_name'];

    // instantiate signupContr class
    include "../classes/dbh.classes.php";
    include "../classes/add-category.classes.php";
    include "../classes/add-category-cntrl.classes.php";
    $addCategory = new AddCategoryContr($category);

    // Runnig error handlers and user signup
    $addCategory-> addCategory();
    

    // Going back to front page
    header("location: ../back-end/viewCategory.php?error=none");

}
