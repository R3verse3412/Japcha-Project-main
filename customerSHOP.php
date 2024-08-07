<?php
    include "c_header.php"; 
    include_once "config/databaseConnection.php"; 
    // include "classes/dbh.classes.php";
    $products = $productModel->getAllProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JapCha Shop</title>
    <style>
        .paginationContainer ui li.active{
            background-image: linear-gradient(gold, gold) !important;
        }
        .card{
            cursor: pointer;
        }
        
    </style>
</head>
<body>
    

    <div class="shopContainer">
            <div class="filterContainer">
                <div class="filter">
                    <!-- <h2>Sort and Filter</h2> -->
                    <select name="filterField" class = "filterField" id="filterByCategory">
                    <option value="" selected >All Products</option>
                    <?php
                        $query = "SELECT category_id, category_name FROM categories WHERE isDeleted != 1";
                        $result = mysqli_query($con, $query);
                                   
                        while ($row = mysqli_fetch_assoc($result)) {
                        $categoryId = $row['category_id'];
                        $categoryName = $row['category_name'];
                        echo '<option value="' . $categoryId . '">' . $categoryName . '</option>';
                    }
                     ?> 
                    </select>
                </div>
            </div>

        <div class="productContainer">
            <form action="ProductDetails.php" method="POST">

            <div class="d-flex flex-wrap" style="gap: 65px;">
            <?php
                require_once "classes/VariationModel.php";
                $VarModel = new VariationModel();
            
                foreach ($products as $product):
                    $productid = $product['product_id'];
                    $variation_data = $VarModel->getPrice($productid);
            ?>
              
                <div class="card product-card" style="width: 18rem;  border-radius: 21px;" data-prod-id="<?= $productid ?>">
                    <!-- <a   href="ProductDetails.php?productid=" style="text-decoration:none; color: black;"> -->
                    <input type="hidden" name="productid" value="<?= $productid ?>">
                    
                    <div class="card-header d-flex justify-content-center" style="height: 400px; background-color:  #EFC900;    border-top-left-radius: 21px;
                    border-top-right-radius: 21px;">

                  
                    <div id="prodHeader" class="prodHeader" >
                        <!-- <img src="upload/" alt=""> -->
                        <?php
                    // Assuming $images contains the file path to the image or video
                    if (strpos($product['image_url'], '.mp4') != false) {
                        // If $images contains '.mp4', it's a video
                        ?>
                        <video controls style="max-width: 100%">
                        <source src="upload/<?= $product['image_url']?>" type="video/mp4">
                        <p>Your browser does not support the video tag</p>
                        </video>
                    <?php
                        } else {
                    ?>
                        <img class="card-img-top" src="upload/<?= $product['image_url']?>" alt="" style="max-width: 100%" >
                    <?php
                        }
                    ?>
                        
                    </div>
                    </div>
                    <div id="prodFooter" class="card-footer">
                        <div class="d-flex flex-column" >
                            <div class="card-text" style="font-size: 20px;">
                                <?= $product['product_name']?>
                            </div>
                            <div style="color: #007bff;"><?= $product['category_name']?></div>
                            <div class="card-text"  style="font-size: 20px;">₱ <?= isset($variation_data['price']) ? $variation_data['price'] : 'N/A'; ?></div>
                        </div>
                       
                        <button type="submit" class="btn btn-link p-0" name="buynow" value="<?= $productid ?>">Buy Now</button>
                     
                    </div>
                    </a>
                </div>
                
                <?php 
               
                // $_SESSION['prodid'] = $product['product_id'];

                // } } 
                endforeach;
                ?>      
   
            </div>
 
            <div class="paginationContainer">
                <button type="button" class="btnPrev">prev</button>
                <ul id="pagination"></ul>
                <button type="button" class="btnNext">next</button>
               
            </div>
            <div id="paginationInfo"></div>
            </form>
        </div>
        

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     $(document).ready(function () {
    const productsPerPage = 8; // Adjust this based on the number of products you want to display per page
    let currentPage = 1;

    function showProducts(page) {
        const startIndex = (page - 1) * productsPerPage;
        const endIndex = startIndex + productsPerPage;

        $(".product-card").hide();
        $(".product-card").slice(startIndex, endIndex).show();
    }

    function generatePaginationLinks() {
        const totalProducts = $(".product-card").length; // Use this line to get the total count dynamically
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
        updatePaginationInfo(); // Add this line to update pagination info
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    }

    function nextPage() {
        const totalProducts = $(".product-card").length; // Use this line to get the total count dynamically
        const totalPages = Math.ceil(totalProducts / productsPerPage);

        if (currentPage < totalPages) {
            currentPage++;
            updatePagination();
        }
    }

    function updatePaginationInfo() {
        const totalProducts = $(".product-card").length; // Use this line to get the total count dynamically
        const totalPages = Math.ceil(totalProducts / productsPerPage);

        $("#paginationInfo").text(`Page ${currentPage} of ${totalPages} (${totalProducts} items)`);
    }

    // Initial setup
    updatePagination();
    $(".btnPrev").on("click", prevPage);
    $(".btnNext").on("click", nextPage);

    $(".product-card").click(function(){
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


    <script>
        let page = document.getElementsByClassName("page");
        let currentValue = 1;

        function activeLink(){
            for(l of page){
                l.classList.remove("active");
            }
            event.target.classList.add("active");
            currentValue = event.target.value;
        }
        function backBtn(){
            if(currentValue > 1){
                for(l of page){
                    l.classList.remove("active");
                }
                currentValue--;
                page[currentValue-1].classList.add("active");
            }
        }
        function nextBtn(){
            if(currentValue < 3){
                for(l of page){
                    l.classList.remove("active");
                }
                currentValue++;
                page[currentValue-1].classList.add("active");
            }
        }
    //     document.getElementById("itemContainer").addEventListener("click", function() {

    //         var pid = $productid;
    //     window.location.href = "ProductDetails.php?productid="+pid; 
        
    // });
        
    $(document).ready(function() {
    $("#filterByCategory").change(function() {
        var selectedCategory = $(this).val();
        console.log(selectedCategory);
        // Make an AJAX request to fetch content based on the selected category
        $.ajax({
            url: 'classes/SortByCategoryFunctionFrontEnd.php', // Replace with the actual URL to fetch data
            method: 'POST',
            data: { category: selectedCategory },
            success: function(response) {
                $(".productContainer").html(response);
            }
        });
    });
});
    </script>
</body>
</html>
<?php
  include "c_footer.php";
?>