<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_FILES['logo']) || isset($_FILES['image']) || isset($_FILES['bg']))
    {
        
    // $cmsLogo = $_FILES["logo"];
    // $cmsImage = $_FILES["image"];
    // $cms_bg =  $_FILES["bg"];
    $cms_title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
    $cms_subtitle = htmlspecialchars($_POST["subtitle"], ENT_QUOTES, 'UTF-8');
    $cms_japcha = htmlspecialchars($_POST["japcha"], ENT_QUOTES, 'UTF-8');
    $cms_how_to_order = htmlspecialchars($_POST["order"], ENT_QUOTES, 'UTF-8');
    $cms_socials = htmlspecialchars($_POST["social"], ENT_QUOTES, 'UTF-8');
    $cms_policy = htmlspecialchars($_POST["policy"], ENT_QUOTES, 'UTF-8');
    $cms_location = htmlspecialchars($_POST["loc"], ENT_QUOTES, 'UTF-8');
    $cms_contact = htmlspecialchars($_POST["contact"], ENT_QUOTES, 'UTF-8');

    

    $img_name = $_FILES['logo']['name'];
    $img_size = $_FILES['logo']['size'];
    $tmp_name = $_FILES['logo']['tmp_name'];
    $error = $_FILES['logo']['error'];

    $img_name2 = $_FILES['image']['name'];
    $img_size2 = $_FILES['image']['size'];
    $tmp_name2 = $_FILES['image']['tmp_name'];
    $error2 = $_FILES['image']['error'];

    $img_name3 = $_FILES['bg']['name'];
    $img_size3 = $_FILES['bg']['size'];
    $tmp_name3 = $_FILES['bg']['tmp_name'];
    $error3 = $_FILES['bg']['error'];


    $targetDirectory = "../upload-content";
    // $cmsLogoPath = $targetDirectory . basename($cmsLogoFile["name"]);
    // $cmsImagePath = $targetDirectory . basename($cmsImageFile["name"]);
    // $cmsBgPath = $targetDirectory . basename($cmsBgFile["name"]);


    if ($error === UPLOAD_ERR_OK && $error2 === UPLOAD_ERR_OK && $error3  === UPLOAD_ERR_OK){
        if($img_size > 1250000 || $img_size2 > 1250000 || $img_size3 > 1250000){
            header("location: ../back-end/admin-cms.php?error=fileistoolarge");
        }else{

            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $img_ex2 = pathinfo($img_name2, PATHINFO_EXTENSION);
            $img_ex_lc2 = strtolower($img_ex2);

            $img_ex3 = pathinfo($img_name3, PATHINFO_EXTENSION);
            $img_ex_lc3 = strtolower($img_ex3);

            $allowed_exs = array("jpg", "jpeg", "png");

            if(in_array($img_ex_lc, $allowed_exs) && in_array($img_ex_lc2, $allowed_exs) && in_array($img_ex_lc3, $allowed_exs)){
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $new_img_name2 = uniqid("IMG-", true) . '.' . $img_ex_lc2;
                $new_img_name3 = uniqid("IMG-", true) . '.' . $img_ex_lc3;
                $img_upload_path = '../upload-content/';

                // Move uploaded files to the target directory
                $cmsLogoPath = $img_upload_path  . $new_img_name;
                $cmsImagePath = $img_upload_path  . $new_img_name2;
                $cmsBgPath = $img_upload_path  . $new_img_name3;
                
       
                move_uploaded_file($tmp_name, $cmsLogoPath);
                move_uploaded_file($tmp_name2, $cmsImagePath);
                move_uploaded_file($tmp_name3, $cmsBgPath);

                include "../classes/dbh.classes.php";
                include "../classes/cms.classes.php";
                include "../classes/cms-cntrl.classes.php";
            
                $insert = new CmsContr($new_img_name, $new_img_name2, $new_img_name3, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact);
            
                $insert->defaultProfileInfo($new_img_name, $new_img_name2, $new_img_name3, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact);
                header("location: ../back-end/admin-cms.php?error=none");
            }
        }
    
    }

    }
    
}
