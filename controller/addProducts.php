<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addProd'])) {
        include "../config/databaseConnection.php";

        $productname = $_POST["productname"];
        $description = $_POST["description"];
        $category = $_POST["category"];
        $sizes = $_POST['sizes'];
        $prices = $_POST['prices'];
        $Addons = isset($_POST["enable_addons"]) ? 1 : 0; 
        $new_img_name = 'japcha_log.png' ; // Default value for image name
       


        // check if size is value = 0
   
        // Check if a file is uploaded
        if ( isset($_FILES['product_image']['name']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
            $img_name = $_FILES['product_image']['name'];

            // Check if the file already exists in the target directory before moving it
            $target_file = '../upload/' . $img_name;

            if (file_exists($target_file)) {
                $em = "Sorry, the file already exists.";
                error_log("File already exists: $target_file"); // Log the message
                header("Location: ../back-end/adminProducts.php?error=$em");
                exit();
            }

            $img_size = $_FILES['product_image']['size'];
            $tmp_name = $_FILES['product_image']['tmp_name'];

            if ($img_size > 49085778) {
                $em = "Sorry, your file is too large.";
                header("Location: ../back-end/adminProducts.php?error=$em");
                exit();
            }

            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png", "mp4");

            if (!in_array($img_ex_lc, $allowed_exs)) {
                $em = "You can't upload files of this type";
                header("Location: ../back-end/adminProducts.php?error=$em");
                exit();
            }

            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = '../upload/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
        }

        // Insert into the database
        $sql = "INSERT INTO product (image_url, product_name, description, category_id, allowAddons) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($con, $sql);

        if ($stmt) {
            // If no file is uploaded, the default value for image_url should be applied
            mysqli_stmt_bind_param($stmt, "sssii", $new_img_name, $productname, $description, $category, $Addons);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                // Handle insertion of sizes and prices here
                $productId = $stmt->insert_id;

                $insertSizeQuery = "INSERT INTO variation (product_id, size_id, price) VALUES (?, ?, ?)";
                $stmt = $con->prepare($insertSizeQuery);
        
                for ($i = 0; $i < count($sizes); $i++) {
                    $stmt->bind_param("iid", $productId, $sizes[$i], $prices[$i]);
                    $stmt->execute();
                }
        
                if ($stmt->affected_rows > 0) {
                    // Successfully inserted sizes and prices for the product
                    $_SESSION['successfully_AddedProducts'] = "succcess fully added a product";
                    // Redirect to the appropriate page
                    header("Location: ../back-end/adminProducts.php");
                    exit();
                } else {
                    // Handle the case where sizes and prices insertion failed
                    header("Location: ../back-end/adminProducts.php?error=sizes_prices_insertion_failed");
                    exit();
                }
            } else {
                // Insertion failed
                header("Location: ../back-end/adminProducts.php?error=insertion_failed");
                exit();
            }

            mysqli_stmt_close($stmt);
        }
    }
    if(isset($_POST['editProd'])){
        include "../config/databaseConnection.php";

        $prodID = $_POST["prodId"];

        $productname = $_POST["PrevProdName"];

        $description = $_POST["PrevDescription"];
        $category = $_POST['PrevCat'];
        // $sizes = $_POST['prevSize'];
        // $prices = $_POST['prevPrice'];
        $Addons = isset($_POST["enable_addons"]) ? 1 : 0; 
        $varId = $_POST['varID'];
        $new_img_name = $_POST['PrevMedia']; // Default value for image name
     

        if(isset($_POST["categoryid"])){
            $category = htmlspecialchars($_POST["categoryid"], ENT_QUOTES, 'UTF-8');
        }
        if(isset($_POST["productname"])){
            $productname = $_POST["productname"];
        }
        if(isset($_POST["description"])){
            $description = $_POST["description"];
        }
   

        // check if size is value = 0
        
        // Check if a file is uploaded
        if ( isset($_FILES['product_image']['name']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
            $img_name = $_FILES['product_image']['name'];

            // Check if the file already exists in the target directory before moving it
            $target_file = '../upload/' . $img_name;

            if (file_exists($target_file)) {
                $em = "Sorry, the file already exists.";
                error_log("File already exists: $target_file"); // Log the message
                header("Location: ../back-end/adminProducts.php?error=$em");
                exit();
            }

            $img_size = $_FILES['product_image']['size'];
            $tmp_name = $_FILES['product_image']['tmp_name'];

            if ($img_size > 49085778) {
                $em = "Sorry, your file is too large.";
                header("Location: ../back-end/adminProducts.php?error=$em");
                exit();
            }

            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png", "mp4");

            if (!in_array($img_ex_lc, $allowed_exs)) {
                $em = "You can't upload files of this type";
                header("Location: ../back-end/adminProducts.php?error=$em");
                exit();
            }

            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = '../upload/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
        }


        // Insert into the database
        $sql = "UPDATE product SET image_url = ?, product_name = ?, description = ?, category_id = ?, allowAddons = ? WHERE product_id = ?";
        $stmt = mysqli_prepare($con, $sql);

        if ($stmt) {
             // If no file is uploaded, the default value for image_url should be applied
        mysqli_stmt_bind_param($stmt, "sssiii", $new_img_name, $productname, $description, $category, $Addons, $prodID);
        mysqli_stmt_execute($stmt);

        if(isset($_POST["sizes"]) && isset($_POST["prices"])){
            // $sizes = $_POST["sizes"];
            // $prices = $_POST["prices"];
            // Loop through sizes and prices to update each variation
            for ($i = 0; $i < count($_POST['sizes']); $i++) {
                $size = $_POST['sizes'][$i];
                $price = $_POST['prices'][$i];
                $varId = $_POST['varID'][$i];

                // Check if the combination of size_id and product_id already exists
                $checkExistenceQuery = "SELECT COUNT(*) FROM variation WHERE size_id = ? AND product_id = ? AND variation_id = ?";
                $stmtCheckExistence = $con->prepare($checkExistenceQuery);
                $stmtCheckExistence->bind_param("iii", $size, $prodID, $varId);
                $stmtCheckExistence->execute();
                $stmtCheckExistence->bind_result($count);
                $stmtCheckExistence->fetch();
                $stmtCheckExistence->close();

                // $checkSizeQuery = "SELECT size_id, product_id FROM variation WHERE size_id = ? AND product_id = ?";
                // $stmtCheckSize = $con->prepare($checkSizeQuery);
                // $stmtCheckSize->bind_param("ii", $size, $prodID);
                // $stmtCheckSize->execute();
                // $stmtCheckSize->bind_result($existingSize);
                // $stmtCheckSize->fetch();
                // $stmtCheckSize->close();
        
                // if ($existingSize == $size) {
                //     // Throw an error because they are trying to update the size_id
                //     header("Location: ../back-end/adminProducts.php?error=sizeidcannotbeupdated");
                //     exit();
                // }

                if ($count > 0) {
                    // The combination already exists, so update the price
                    $updatePriceQuery = "UPDATE variation SET price = ? WHERE product_id = ? AND size_id = ? AND variation_id = ?";
                    $stmtUpdatePrice = $con->prepare($updatePriceQuery);
                    $stmtUpdatePrice->bind_param("diii", $price, $prodID, $size, $varId);
                    $stmtUpdatePrice->execute();
                    // $affectedRows = $stmtUpdatePrice->affected_rows; 
                  
                    
                    // if ($stmtUpdatePrice->affected_rows > 0) {
                    //     header("Location: ../back-end/adminProducts.php?success=priceupdatesuccess");
                    //     exit();
                    // } else {
                    //     // Throw an exception or redirect with an error message
                    //     header("Location: ../back-end/adminProducts.php?error=priceupdatefailed");
                    //     exit();
                    // }
                    $stmtUpdatePrice->close();
                } else {
                    // The combination doesn't exist, so insert it as a new variation
                    $updateSizeAndPriceQuery = "UPDATE variation SET size_id = ?, price = ? WHERE product_id = ? AND variation_id = ?";
                    $stmtUpdateSizeAndPrice = $con->prepare($updateSizeAndPriceQuery);
                    $stmtUpdateSizeAndPrice->bind_param("idii", $size, $price, $prodID, $varId);
                    $stmtUpdateSizeAndPrice->execute();
                    $stmtUpdateSizeAndPrice->close();
                }
            }
        }
       

        if (isset($_POST['sizess']) && isset($_POST['pricess'])) {
            // Insert new sizes and prices
            $newSize = $_POST['sizess'];
            $newPrice = $_POST['pricess'];

            for ($i = 0; $i < count($newSize); $i++) {
                // Check if the combination of size_id and product_id already exists
                $checkExistenceQuery = "SELECT COUNT(*) FROM variation WHERE size_id = ? AND product_id = ?";
                $stmtCheckExistence = $con->prepare($checkExistenceQuery);
                $stmtCheckExistence->bind_param("ii", $newSize[$i], $prodID);
                $stmtCheckExistence->execute();
                $stmtCheckExistence->bind_result($count);
                $stmtCheckExistence->fetch();
                $stmtCheckExistence->close();

                if ($count == 0) {
                    // Insert the new variation
                    $insertSizeQuery = "INSERT INTO variation (product_id, size_id, price) VALUES (?, ?, ?)";
                    $stmtInsertSize = $con->prepare($insertSizeQuery);
                    $stmtInsertSize->bind_param("iid", $prodID, $newSize[$i], $newPrice[$i]);
                    $stmtInsertSize->execute();
                    $stmtInsertSize->close();
                }else{
                    header("Location: ../back-end/adminProducts.php?error=combinationalreadyexist");
                 exit();
                }
            }
        }

        $_SESSION['successfully_EditProducts'] = "succcessfully edit a product";
        header("Location: ../back-end/adminProducts.php");
        exit();
        
        }
    }
}
?>
