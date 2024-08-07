<!-- HINDI NA SYA KASAMA -->
<!-- HINDI NA SYA KASAMA -->
<!-- HINDI NA SYA KASAMA -->
<!-- HINDI NA SYA KASAMA -->
<!-- HINDI NA SYA KASAMA -->
<!-- HINDI NA SYA KASAMA -->
<!-- HINDI NA SYA KASAMA -->
<!-- HINDI NA SYA KASAMA -->
<?php
    include "c_header.php";
?>

<!--Product Details-->
 <div class="Pmaincont">
        <div class="PleftCont">
            <div class="Productbg">
                <img src="image/Mango-shake.png" alt="img" class="mango">
            </div>
        </div>

        <div class="PrightCont">
            <div class="textcont">
                <h2 class="prodName">Mango Graham</h2>
                <h2 class="pprice">₱120.00</h2>
                <h3 class="desctitle">Details:</h3>
                <p class="prodDesc">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown 
                    printer took a galley of type and scrambled it to make a type specimen book
                </p>

                
                <h3 class="adsTitle">Add ons:</h3>

                <form >
                    <input type="radio" id="pearl" name="addons" value="pearl">
                    <label for="pearl">Pearls</label><br>
                    <input type="radio" id="blkpearl" name="addons" value="blkpearl">
                    <label for="blkpearl">Black Pearl</label><br>
                    <input type="radio" id="crmCheese" name="addons" value="crmCheese">
                    <label for="crmCheese">Cream Cheese</label><br>
                    <input type="radio" id="nata" name="addons" value="nata">
                    <label for="nata">Nata</label><br>
                </form>


            </div>
            <div class="btncont">
                <button class="btnAddtoCart"><a href="#id" class = "add">Add To Card</a></button>
                <button class="buyNow"><a href="#id" class = "buy" id = "buynow">Buy Now</a></button>

                <script>
                    document.getElementById("buynow").addEventListener("click", function() {
                    window.location.href = "orderCheckout.php"; 
                    });
                </script>
            </div>

        </div>
    </div>


    <?php 
        include "c_footer.php";
    ?>