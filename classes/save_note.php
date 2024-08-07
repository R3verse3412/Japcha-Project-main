<?php
require "dbh.classes.php";
require "save_note_Model.php";
$samplemodel = new SampleModel();

if(isset($_POST['japcha_data'])){
    $japcha = htmlspecialchars($_POST["japchaInput"], ENT_QUOTES, 'UTF-8');
  
    $saveJapcha = $samplemodel->setContent($japcha);
    if ($saveJapcha === false) {
        // Handle the database error here
        echo "Error saving content to the database";
        exit;
    }else{
        header("Location: ../back-end/admin-cms.php");
        exit;
    }
}

if(isset($_POST['order_data'])){
    $orders = htmlspecialchars($_POST["orderInput"], ENT_QUOTES, 'UTF-8');

    $saveOrder = $samplemodel->setOrder($orders);
    if ($saveOrder === false) {
        // Handle the database error here
        echo "Error saving order to the database";
        exit;
    } else {
        // Redirect to another page after successful save
        header("Location: ../back-end/admin-cms.php");
        exit;
    }
}

if(isset($_POST['socials_data'])){
    $social = htmlspecialchars($_POST["socialsInput"], ENT_QUOTES, 'UTF-8');
  
    $saveSocial = $samplemodel->setSocials($social);
    if ($saveSocial === false) {
        // Handle the database error here
        echo "Error saving order to the database";
        exit;
    } else {
        // Redirect to another page after successful save
        header("Location: ../back-end/admin-cms.php");
        exit;
    }
}

if(isset($_POST['policy_data'])){
    $policy = htmlspecialchars($_POST["policyInput"], ENT_QUOTES, 'UTF-8');
  
    $savePolicy = $samplemodel->setPolicy($policy);
    if ($savePolicy === false) {
        // Handle the database error here
        echo "Error saving order to the database";
        exit;
    } else {
        // Redirect to another page after successful save
        header("Location: ../back-end/admin-cms.php");
        exit;
    }
}

if(isset($_POST['location_data'])){
    $location = htmlspecialchars($_POST["locationInput"], ENT_QUOTES, 'UTF-8');

    $saveLocation = $samplemodel->setLocation($location);
    if ($saveLocation === false) {
        // Handle the database error here
        echo "Error saving order to the database";
        exit;
    } else {
        // Redirect to another page after successful save
        header("Location: ../back-end/admin-cms.php");
        exit;
    }
}

if(isset($_POST['contact_data'])){
    $contact = htmlspecialchars($_POST["contactInput"], ENT_QUOTES, 'UTF-8');
  
    $saveContact = $samplemodel->setContact($contact);
    if ($saveContact === false) {
        // Handle the database error here
        echo "Error saving order to the database";
        exit;
    } else {
        // Redirect to another page after successful save
        header("Location: ../back-end/admin-cms.php");
        exit;
    }
}

if(isset($_POST['title_data'])){
    $title_data = htmlspecialchars($_POST["titleInput"], ENT_QUOTES, 'UTF-8');
  
    $saveTitle = $samplemodel->setTitle($title_data);
    if ($saveTitle === false) {
        // Handle the database error here
        echo "Error saving order to the database";
        exit;
    } else {
        // Redirect to another page after successful save
        header("Location: ../back-end/admin-cms.php");
        exit;
    }
}


if (isset($_POST['sub'])) {
    $subt = htmlspecialchars($_POST["subInput"], ENT_QUOTES, 'UTF-8');

    $saveSub = $samplemodel->setSub($subt);
    if ($saveSub === false) {
        // Handle the database error here
        echo "Error saving order to the database";
        exit;
    } else {
        // Redirect to another page after successful save
        header("Location: ../back-end/admin-cms.php");
        exit;
    }
}


if(isset($_POST['update_logo'])){
    if(isset($_FILES['logoInput'])) {
        $file = $_FILES['logoInput'];

        // Check if there was no error during the file upload
        if($file['error'] === 0) {
            $fileType = $file['type'];

            // Define allowed image MIME types
            $allowedImageTypes = array('image/jpeg', 'image/png', 'image/gif');

            if (in_array($fileType, $allowedImageTypes)) {
                // The uploaded file is an image
                echo 'File is an image. You can process it here.';
                $uploadDirectory = '../upload-content/';
                $uploadPath = $uploadDirectory . $_FILES['logoInput']['name'];
                $tmp_name = $_FILES['logoInput']['tmp_name'];
                move_uploaded_file($tmp_name, $uploadPath);

                $logo_name = $_FILES['logoInput']['name'];
                $savs = $samplemodel->setLogo($logo_name);

                if ($savs === false) {
                    // Handle the database error here
                    echo "Error saving order to the database";
                } else {
                    // Specify the directory to move the file to
                }
            } else {
                echo 'File is not an image. Please upload a valid image.';
            }
        } else {
            echo 'Error during file upload. Please try again.';
        }
    } else {
        echo 'No file was uploaded.';
    }
}

if(isset($_POST['update_landing_img'])){
    if(isset($_FILES['Landing_image'])) {
        $file = $_FILES['Landing_image'];

        // Check if there was no error during the file upload
        if($file['error'] === 0) {
            $fileType = $file['type'];

            // Define allowed image MIME types
            $allowedImageTypes = array('image/jpeg', 'image/png', 'image/gif');

            if (in_array($fileType, $allowedImageTypes)) {
                // The uploaded file is an image
                echo 'File is an image. You can process it here.';
                $uploadDirectory = '../upload-content/';
                $uploadPath = $uploadDirectory . $_FILES['Landing_image']['name'];
                $tmp_name = $_FILES['Landing_image']['tmp_name'];
                move_uploaded_file($tmp_name, $uploadPath);
                
                $landing_img = $_FILES['Landing_image']['name'];
                $savs = $samplemodel->setLandingImage($landing_img);

                if ($savs === false) {
                    // Handle the database error here
                    echo "Error saving order to the database";
                } else {
                    // Specify the directory to move the file to
                }
            } else {
                echo 'File is not an image. Please upload a valid image.';
            }
        } else {
            echo 'Error during file upload. Please try again.';
        }
    } else {
        echo 'No file was uploaded.';
    }
}


if (isset($_POST['saveLink'])) {
    $fbLink = htmlspecialchars($_POST["fbLink"], ENT_QUOTES, 'UTF-8');
    $igLink = htmlspecialchars($_POST["igLink"], ENT_QUOTES, 'UTF-8');
    $ytLink = htmlspecialchars($_POST["ytLink"], ENT_QUOTES, 'UTF-8');
  
    $fbUpdateResult = $samplemodel->setFbLink($fbLink, $igLink, $ytLink );
    
}

