<div class="cart-drawer" id="cart-drawer">
    <form action="orderCheckout.php" method="POST">
    
            <div class="cart-content">
            <button type="button" class="btn" id="back-to-previous" style="float: right;"><i class="fa-solid fa-x fa-xl"></i></i></button>
                <h2 style="text-align: center">SHOPPING CART</h2>
                <div class="container cartCONT" style="height: 500px; overflow-y: auto;">
                
        
            <div id="productContainer" class="row" style="padding-top: 20px;"></div>

        </div>  
                <!-- <h3 style="text-align: center; margin-left: 50px; margin-top: 25px;">Sub Total: ₱300</h3> -->
                <h3 id="totalPrice" style="text-align: center; margin-left: 50px; margin-top: 25px;">Sub Total: ₱0.00</h3>

                <p style="text-align: center; margin-left: 50px; ">Shipping fee and other add-ons will be calculated at checkout</p>
                <button type="submit" class="bottonCheckout btn-warning" name="buyNowFromCart">Buy Now</button>
            </div>

    </form>
</div>
