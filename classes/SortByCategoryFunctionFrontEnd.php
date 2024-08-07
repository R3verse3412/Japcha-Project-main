<?php
session_start();
require "dbh.classes.php";
require "ProductsModel.php";
$productModel = new ProductModel();

if (isset($_POST['category'])) {
    $category = $_POST['category'];
    $products = $productModel->getProductsByCategory($category);
    $product = $productModel->getAllProducts();

    ?>
    <form action="ProductDetails.php" method="POST">
    <div class="d-flex flex-wrap product-list" style="gap: 65px;">
    <?php
    if($category === ""){

        require_once "../classes/VariationModel.php";
        $VarModel = new VariationModel();
        foreach ($product as $products):
            $productid = $products['product_id'];
            $variation_data = $VarModel->getPrice($productid);
    ?>

        <div class="card" style="width: 18rem;  border-radius: 21px;" data-prod-id="<?= $productid ?>">
            <input type="hidden" name="productid" value="<?= $productid ?>">
            <div class="card-header d-flex justify-content-center" style="height: 400px; background-color:  #EFC900; border-top-left-radius: 21px; border-top-right-radius: 21px;">
                <div class="prodHeader">
                    <?php
                    if (strpos($products['image_url'], '.mp4') !== false) {
                    ?>
                        <video controls style="max-width: 100%">
                            <source src="upload/<?= $products['image_url'] ?>" type="video/mp4">
                            <p>Your browser does not support the video tag</p>
                        </video>
                    <?php
                    } else {
                    ?>
                        <img class="card-img-top" src="upload/<?= $products['image_url'] ?>" alt="" style="max-width: 100%">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex flex-column">
                    <div class="card-text" style="font-size: 20px;"><?= $products['product_name'] ?></div>
                    <div style="color: #007bff;"><?= $products['category_name'] ?></div>
                    <div class="card-text" style="font-size: 20px;">₱ <?= isset($variation_data['price']) ? $variation_data['price'] : 'N/A'; ?></div>
                </div>
                <button type="submit" class="btn btn-link p-0" name="buynow" value="<?= $productid ?>">Buy Now</button>
            </div>
        </div>
    <?php
        endforeach;
    ?>
    
    <?php
    } else {
        require_once "../classes/VariationModel.php";
        $VarModel = new VariationModel();
        foreach ($products as $product):
            $productid = $product['product_id'];
            $variation_data = $VarModel->getPrice($productid);
    ?>
        <div class="card " style="width: 18rem;  border-radius: 21px;" data-prod-id="<?= $productid ?>">
            <input type="hidden" name="productid" value="<?= $productid ?>">
            <div class="card-header d-flex justify-content-center" style="height: 400px; background-color:  #EFC900; border-top-left-radius: 21px; border-top-right-radius: 21px;">
                <div class="prodHeader">
                    <?php
                    if (strpos($product['image_url'], '.mp4') !== false) {
                    ?>
                        <video controls style="max-width: 100%">
                            <source src="upload/<?= $product['image_url'] ?>" type="video/mp4">
                            <p>Your browser does not support the video tag</p>
                        </video>
                    <?php
                    } else {
                    ?>
                        <img class="card-img-top" src="upload/<?= $product['image_url'] ?>" alt="" style="max-width: 100%">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex flex-column">
                    <div class="card-text" style="font-size: 20px;"><?= $product['product_name'] ?></div>
                    <div style="color: #007bff;"><?= $product['category_name'] ?></div>
                    <div class="card-text" style="font-size: 20px;">₱ <?= isset($variation_data['price']) ? $variation_data['price'] : 'N/A'; ?></div>
                </div>
                <button type="submit" class="btn btn-link p-0" name="buynow" value="<?= $productid ?>">Buy Now</button>
            </div>
        </div>
    <?php
        endforeach;
    ?>
      
    <?php
    }
    ?>
          
         

        </div>
            <div class="paginationContainer">
                <button type="button" class="btnPrev" onclick="prevPage()">prev</button>
                <ul id="pagination"></ul>
                <button type="button" class="btnNext" onclick="nextPage()">next</button>
                
            </div>
            <div id="paginationInfo"></div>
        </form>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
           $(document).ready(function () {
    const productsPerPage = 8;
    let currentPage = 1;

    function showProducts(page) {
        const startIndex = (page - 1) * productsPerPage;
        const endIndex = startIndex + productsPerPage;

        $(".card").hide();
        $(".card").slice(startIndex, endIndex).show();
    }

    function generatePaginationLinks() {
        const totalProducts = $(".card").length;
        const totalPages = Math.ceil(totalProducts / productsPerPage);

        $("#pagination").empty();

        for (let i = 1; i <= totalPages; i++) {
            const li = $("<li>", {
                class: "page",
                text: i,
                click: function () {
                    currentPage = i;
                    showProducts(currentPage);
                    updatePagination();
                }
            });

            if (i === currentPage) {
                li.addClass("active");
            }

            $("#pagination").append(li);
        }
    }

    function updatePagination() {
        generatePaginationLinks();
        showProducts(currentPage);
        updatePaginationInfo();
    }

    function updatePaginationInfo() {
        const totalProducts = $(".card").length;
        const totalPages = Math.ceil(totalProducts / productsPerPage);

        $("#paginationInfo").html(`Page ${currentPage} of ${totalPages} (${totalProducts} items)`);
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    }

    function nextPage() {
        const totalProducts = $(".card").length;
        const totalPages = Math.ceil(totalProducts / productsPerPage);

        if (currentPage < totalPages) {
            currentPage++;
            updatePagination();
        }
    }

    // Initial setup
    updatePagination();

    $(".btnPrev").on("click", prevPage);
    $(".btnNext").on("click", nextPage);
    $(".card").click(function(){
    // Get the product ID from the clicked element
    let id = $(this).data("prod-id");
    
    // Create a form element dynamically
    let form = $("<form>", {
        action: 'ProductDetails.php',
        method: 'POST'
    });

    // Add an input field to the form to send the product ID
    form.append($("<input>", {
        type: 'hidden',
        name: 'buynow',
        value: id
    }));

    // Append the form to the body and submit it
    form.appendTo('body').submit();
});

    
});

        </script>
        
    <?php
}
?>
