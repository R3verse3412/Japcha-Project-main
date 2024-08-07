 <div class="main-scroll-div">
                <div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel" >
                    
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <form  action="ProductDetails.php" method="POST">
                    
                            <div class="carousel-item active p-5" id="carouselContent">

                                <div class="row justify-content-center gap-4">
                            

                                    <div class="col-sm-3 carousel-template" style="display: none; position: relative;">
                                        <img src="image/hot.png" alt="" style="position: absolute; top: 0; right: 0; z-index: 1;">
                                        <div class="card" style="max-width: 100%; height: 500px; overflow: hidden;">
                                            <div class="cheader" style="background-color: #EFC900; height: 80%; overflow: hidden;">
                                                <img class="cardImg" src="" alt="Card image cap">
                                            </div>
                                            <div class="card-body">
                                                
                                                <center>
                                                    <h5 class="card-title"></h5>
                                                    <!-- <span style="font-weight: 300;">₱120.00</span> -->
                                                    <button type="submit" class="btn btn-primary bynw" 
                                                    name="buynow" style="width: 100%;">Buy Now</button>
                                                </center>
                                                
                                           
                                               
                                            </div>
                                        </div>
                                    </div>




                                </div>

                            </div>

                            <div class="carousel-item p-5" id="carouselContent_second">
                                <div class="row justify-content-center gap-4" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

<script>
    $(document).ready(function () {
        function fetchBestSellerProducts(targetIds) {
            $.ajax({
                url: 'getBestSellerProducts.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    displayProducts(data, targetIds);
                 
                },
                error: function (error) {
                    console.error('Error fetching best seller products:', error);
                }
            });
        }

        function displayProducts(products, targetIds) {
            // Limit the number of products to display to 3
            var productsToDisplay = Math.min(3, products.length);

            // Iterate through products and append cloned elements to the targets
            $.each(targetIds, function (index, targetId) {
                var $target = $('#' + targetId + ' .row');

                for (var i = 0; i < productsToDisplay; i++) {
                    var $clonedElement = $(".carousel-template").first().clone();

                    $clonedElement.find(".cardImg").attr("src", "upload/" + products[i].image_url);
                    $clonedElement.find(".card-title").text(products[i].product_name);
                    $clonedElement.find(".bynw").val(products[i].product_id);
                    $clonedElement.css('display', 'block');

                    $clonedElement.removeClass("carousel-template").appendTo($target);
                    // displayPrice(products[i].product_id);
                }
            });
        }

        // function displayPrice(productid){
        //     console.log("tite" + productid);
        //     $.ajax({
        //         url: 'getBestSellerProducts.php',
        //         type: 'GET',
        //         dataType: 'json',
        //         data:{
        //             productid: productid
        //         },
        //         success: function (data) {
        //             con
        //         },
        //         error: function (error) {
        //             console.error('Error fetching best seller products:', error);
        //         }
        //     });
        // }

        // Fetch best seller products for the specified targets
        fetchBestSellerProducts(['carouselContent', 'carouselContent_second']);
    });
</script>