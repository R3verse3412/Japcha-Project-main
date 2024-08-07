<?php


if($_SERVER["REQUEST_METHOD"] == "POST")
{
     // Get the form data
     if (isset($_POST["categoryid"])){
        $category = htmlspecialchars($_POST["categoryname"], ENT_QUOTES, 'UTF-8');
        $categoryID = htmlspecialchars($_POST["categoryid"], ENT_QUOTES, 'UTF-8');
   
       // instantiate signupContr class
       include "../classes/dbh.classes.php";
       include "../classes/add-category.classes.php";
       include "../classes/update-category-cntrl.classes.php";

       $update = new UpdateCategoryContr($category, $categoryID);
   
       // Runnig error handlers and user signup
       $update-> updateCategory();
   
       // Going back to page
       header("location: ../back-end/viewCategory.php?error=none");

     }
     
}
