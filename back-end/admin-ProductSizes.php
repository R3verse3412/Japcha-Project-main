<?php
    include "adminHeader.php";
    include_once "../config/databaseConnection.php";
    include_once "../classes/dbh.classes.php";
    include_once "../classes/ProductSizes-Model.php";
    $prodvar = new addProductSizes();
    $data = $prodvar->getProductVar();
?>
<link rel="stylesheet" href="../assets/css/AdminProductSizes.css">
<main class="tableAdmin">
        <div class="card-option">
            <div class="cardHeader">
                <h6>Product Sizing and Pricing</h6>
                <?php
                    if(isset($_SESSION["fileManagement_create"]) && $_SESSION["fileManagement_create"] == 1){
                ?>
                        <button type="button" class="btnAddAdmin"  data-tooltip="tooltip" data-placement="top" title="Edit"
                        data-toggle="modal" data-target="#add" >Add Variation</button>
                <?php
                    }
                ?>
                
            </div>
        </div>
        <section class="table_body">
            <table action="Admin_user_management.php"  >
                <thead>
                  <tr>
                    <th>S.N</th>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <?php
                            if(isset($_SESSION["fileManagement_delete"]) && $_SESSION["fileManagement_delete"] == 1 && isset($_SESSION["fileManagement_edit"]) && $_SESSION["fileManagement_edit"] == 1){
                                echo'<th colspan="2">Action</th>';
                            }
                    ?>
                    
                  </tr>
                </thead>
                <tbody>
                <?php

                     $count = 1;      
                     foreach ($data as $productVariation):
                          $prodVariationID = $productVariation['prodsizes_id'];
                          $productName = $productVariation['product_name'];
                          $sizeName = $productVariation['size_name'];
                          $price = $productVariation['price'];
                          $quantity = $productVariation['quantity'];
                     ?>
                    <tr>
                        <td><?=$count?></td>
                        <td><?=$productName?></td>
                        <td><?=$sizeName?></td>
                        <td><?=$price?></td>
                        <td><?=$quantity?></td>
                        <?php
                            if(isset($_SESSION["fileManagement_delete"]) && $_SESSION["fileManagement_delete"] == 1){
                        ?>
                                <!-- <td><button class='edit' onclick="variationEdit($prodVariationID)">Edit</button></td> -->
                                <td><div class="btnCon">
                                    <button class="btn btn-secondary" data-tooltip="tooltip" data-placement="top" title="Edit"
                                    data-toggle="modal" data-target="#edit<?= $productVariation['prodsizes_id']; ?>" ><i class="fa fa-edit" aria-hidden="true"></i></button>
                                
                        <?php
                            }
            
                            if(isset($_SESSION["fileManagement_edit"]) && $_SESSION["fileManagement_edit"] == 1){
                        ?>
                                    <button class="btn btn-warning" data-tooltip="tooltip" data-placement="top" title="Archive Userlevel"
                                    data-toggle="modal" data-target="#archive<?= $productVariation['prodsizes_id'] ?>"><i class="fa fa-archive" aria-hidden="true"></i></button>

                                    <button class="btn btn-danger" data-tooltip="tooltip" data-placement="top" title="Delete"
                                    data-toggle="modal" data-target="#confirm<?= $productVariation['prodsizes_id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                
                                </td></div>
                        <?php
                            }
                        ?>
                        
                    </tr>
                    <?php  
                            $count++;
                            endforeach;
                     ?>
                </tbody>
                
              </table>
        </section>
    </main>

    <!--triggers can't click outside element when modal is open -->
 
    <?php include "AddProductSize.php" ?>
    <?php include "EditProductSize.php" ?>
    <?php include "ArchiveProductVariation.php" ?>

    <script>
                    let popup = document.getElementById("addAdminPopup");
            // let overlay = document.getElementById("modalOverlay");
            function openAddAdmin()
            {
                popup.classList.add("open-form");
            //    modalOverlay.style.display = "block";
            }
            function closeAddAdmin()
            {
            popup.classList.remove("open-form");
            //   modalOverlay.style.display = "none";
            }
            // function closeModal(event) {
            // if (event.target === modalOverlay || event.key === "Escape") {
            // closePopup();
            // }
            // }

            // Listen for clicks on the modal overlay

            // Listen for keydown events to close the modal when "Escape" key is pressed
            // document.addEventListener("keydown", closeModal);
    </script>
    <!-- Modal script -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../assets/js/aJax.js"></script>
<?php
    include "adminFooter.php";

?>