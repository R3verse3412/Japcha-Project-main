<?php
    include "adminHeader.php";
?>
<?php
    if(isset($_SESSION["adminID"]) ){
 ?>
<?php  
        include "../config/databaseConnection.php";
        include "../classes/dbh.classes.php";
        include "../classes/ProductsModel.php";
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();
?>
<?php
        if (isset($_GET["error"])){
            if ($_GET["error"] == "deletedsuccessfully") {
                echo '<script>alert("Deleted Successfully");</script>';
                unset($_GET['error']);
            }
        }
            
?>

    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/AdminProductBootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<div class="adminSection">

    <div class="headerSection">
        <h3>Product List  <span class="badge badge-warning">TOTAL: <span class="totalProduct"></span></span></h3>
           
        <?php
          if(isset($_SESSION["fileManagement_create"]) && $_SESSION["fileManagement_create"] == 1){
                echo'<button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New</button>';
          }
        ?>
       
            <!-- <a href="#" id="addNew">Add new</a> -->
    </div>

    <?php
    if (isset($_SESSION['successfully_AddedProducts']) || isset($_SESSION['successfully_EditProducts'])) {
        // Determine which session variable is set
        $message = isset($_SESSION['successfully_AddedProducts']) ? 'Successfully added a product' : 'Successfully edited a product';
    ?>
        <div class="alert alert-success sessionAlert" role="alert" style="position: fixed; z-index: 90999; top: 10px;">
            <span id="alertMessage"><?= $message ?></span>
            <button type="button" class="close" aria-label="Close" onclick="closeAlert()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        unset($_SESSION['successfully_AddedProducts']);
        unset($_SESSION['successfully_EditProducts']);
    }
    ?>

<script>

        // Show the alert with fade-in animation
        $(".sessionAlert").fadeIn();

        // Automatically hide the alert after 3000 milliseconds (adjust as needed)
        setTimeout(function () {
            closeAlert();
        }, 5000);
    

    function closeAlert() {
        // Hide the alert with fade-out animation
        $(".sessionAlert").fadeOut();
    }
</script>

    <div class="searchSection">
        <!-- <input type="text" placeholder = "Search"> -->
        <a href="AdminArchive.php">See archives here</a>
        <select name="Category" class = "Category" id="Category">
            <option value="" selected >All Products</option>
                    <?php
                        $query = "SELECT category_id, category_name FROM categories WHERE isDeleted != 1 ORDER BY category_name ASC";
                        $result = mysqli_query($con, $query);
                                   
                        while ($row = mysqli_fetch_assoc($result)) {
                        $categoryId = $row['category_id'];
                        $categoryName = $row['category_name'];
                        echo '<option value="' . $categoryId . '">' . $categoryName . '</option>';
                    }
                     ?> 
        </select>
    </div>

    <div class="productSection">
        <?php       
               
               foreach ($products as $product):
        ?>
            
                <div class="card p-2" style="width: 18rem; height: 350px">
                    <div class="header d-flex justify-content-center p-2" style="height: 60%">
                    <?php
                    // Assuming $images contains the file path to the image or video
                    if (strpos($product['image_url'], '.mp4') !== false) {
                        // If $images contains '.mp4', it's a video
                        ?>
                        <video controls style="max-width: 100%">
                        <source src="../upload/<?= $product['image_url']?>" type="video/mp4">
                        <p>Your browser does not support the video tag</p>
                        </video>
                    <?php
                        } else {
                    ?>
                        <img src="../upload/<?= $product['image_url']?>" alt="" style="max-width: 100%" >
                    <?php
                        }
                    ?>
                    </div>
                    <div class="card-body" style="height:40%">
                        <div class="body" style="height:50%">
                            <h5 class="card-title"><?= $product['product_name']?></h5>

                        </div>
                            
                        <div class="card-footer d-flex justify-content-center gap-2" style="background-color: transparent; height:50%;">
                
                        <?php
                               if(isset($_SESSION["fileManagement_edit"]) && $_SESSION["fileManagement_edit"] == 1){
                        ?>
                        <button class="btn btn-info" data-tooltip="tooltip" data-placement="top" title="View product"
                                    data-toggle="modal" data-target="#viewProd<?= $product['product_id']?>"><i class="fa fa-eye" aria-hidden="true"></i></button>

                                    <button class="btn btn-secondary" data-tooltip="tooltip" data-placement="top" title="Edit product"
                                    data-toggle="modal" data-target="#edit<?= $product['product_id']?>"><i class="fa fa-edit" aria-hidden="true"></i></button>

                                    <button class="btn btn-warning" data-tooltip="tooltip" data-placement="top" title="Archive product"
                                    data-toggle="modal" data-target="#archiveProduct<?= $product['product_id']?>"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>

                                    <button class="btn btn-danger" data-tooltip="tooltip" data-placement="top" title="Delete product"
                                    data-toggle="modal" data-target="#deleteProduct<?= $product['product_id']?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        <?php
                                }
                        ?> 
                        </div>
                    </div>
                </div>
            
            <?php 
            endforeach;
        ?>
    </div>
</div>

<?php 

if (isset($_GET['error'])) {
    $error = $_GET['error'];
    echo '<script>alert("' . $error . '");</script>';
    echo '<p>' . $error . '</p>';
    unset($_GET['error']); // Optionally unset the parameter if needed
    $_SESSION['error'] = $error; // Store the error message in a session variable
}

// To clear the error message from the session after displaying it:
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}?>
    
    <!-- modal for drinks-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button type="button" class="btn btn-light" id="#" data-bs-dismiss="modal" data-toggle="modal" data-target="#modal1">Product</button>
        <button type="button" class="btn btn-light"  id="#" data-bs-dismiss="modal" data-toggle="modal" data-target="#modal2">Combo</button>
      </div>
    </div>
  </div>
</div>
<!-- Vertically centered scrollable modal -->



<!-- MODAL FOR MEALS -->
    <?php
            include "ViewProduct.php";
            include "EditProduct.php";
            include "DeleteProduct.php";
       ?>
       
    <?php
            include "ProductModal1.php";
       ?>
       <?php
            include "ProductModal2.php";
       ?>



<!--END MODAL FOR MEALS -->
<?php
if (isset($_SESSION["fileManagement_delete"]) && $_SESSION["fileManagement_delete"] == 1) {
    $showRemove = true;
} else {
    $showRemove = false;
}

if (isset($_SESSION["fileManagement_edit"]) && $_SESSION["fileManagement_edit"] == 1) {
    $showEdit = true;
} else {
    $showEdit = false;
}
?>

    <script src="../assets/js/admin-products.js">
    </script> 
    <script>
    var showRemove = <?php echo json_encode($showRemove); ?>;
    var showEdit = <?php echo json_encode($showEdit); ?>;

   
    </script>

<script>
$(document).ready(async function() {
    await fetchProductCount();
    
    $("#Category").change(async function() {
        var selectedCategory = $(this).val();

        // Make an AJAX request to fetch content based on the selected category
        new Promise((resolve) =>{
                $.ajax({
                url: '../classes/SortByCategoryFunction.php', // Replace with the actual URL to fetch data
                method: 'POST',
                data: { category: selectedCategory },
                success: function(response) {
                    $(".productSection").html(response);
                }
            });
        });
    });


   
    function fetchProductCount() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
            type: 'GET',
            data:{product: "product"},
            dataType: 'json',
            success: function(response) {
                $(".totalProduct").text(response.count)
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
      });
      
    }

});
</script>

    <?php
            
        }
     ?>
<?php
    include "adminFooter.php";

?>