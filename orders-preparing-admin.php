<?php
    include "adminHeader.php";
?>
    <link rel="stylesheet" href="./assets/css/global.css" />
    <link rel="stylesheet" href="./assets/css/orders-preparing-admin.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700display=swap"/>
 
    <div class="orders-preparing-admin">
      <div class="orders-preparing-admin-child"></div>
      <div class="rectangle-parent36">
        <div class="group-child37"></div>
        <div class="order-000044">Order #00004</div>
        <b class="b16">₱200</b>
        <div class="rectangle-parent37">
          <div class="group-child38"></div>
          <b class="deliver4">Deliver</b>
        </div>
        <div class="rectangle-parent38">
          <div class="group-child39"></div>
          <b class="remove8">Remove</b>
        </div>
      </div>
      <div class="rectangle-parent39">
        <div class="group-child37"></div>
        <b class="b17">₱200</b>
        <div class="order-000034">Order #00003</div>
        <div class="rectangle-parent40">
          <div class="group-child38"></div>
          <b class="deliver4">Deliver</b>
        </div>
        <div class="rectangle-parent41">
          <div class="group-child39"></div>
          <b class="remove8">Remove</b>
        </div>
      </div>
      <div class="rectangle-parent42">
        <div class="group-child37"></div>
        <div class="order-000024">Order #00002</div>
        <div class="rectangle-parent43">
          <div class="group-child38"></div>
          <b class="deliver4">Deliver</b>
        </div>
        <div class="rectangle-parent44">
          <div class="group-child39"></div>
          <b class="remove8">Remove</b>
        </div>
      </div>
      <div class="rectangle-parent45" id="groupContainer11">
        <div class="group-child46"></div>
        <div class="rectangle-parent46">
          <div class="group-child38"></div>
          <b class="deliver4">Deliver</b>
        </div>
        <div class="order-000014">Order #00001</div>
        <b class="b18">₱200</b>
        <div class="rectangle-parent44">
          <div class="group-child39"></div>
          <b class="remove8">Remove</b>
        </div>
      </div>
      <b class="b19">₱200</b>
      <b class="manage-orders4">Manage Orders</b>
      <div class="rectangle-parent48">
        <div class="frame-child11"></div>
        <div class="frame-child12"></div>
        <b class="complete8" id="completeText">Complete</b>
        <b class="preparing4">Preparing</b>
        <b class="new4" id="newText">New</b>
        <b class="delivery4" id="deliveryText">Delivery</b>
      </div>
    </div>

    <script>
      var groupContainer11 = document.getElementById("groupContainer11");
      if (groupContainer11) {
        groupContainer11.addEventListener("click", function (e) {
          window.location.href = "./orders-info-admin.php";
        });
      }
      
      var completeText = document.getElementById("completeText");
      if (completeText) {
        completeText.addEventListener("click", function (e) {
          window.location.href = "./orders-complete-admin.php";
        });
      }
      
      var newText = document.getElementById("newText");
      if (newText) {
        newText.addEventListener("click", function (e) {
          window.location.href = "./orders-list-admin.php";
        });
      }
      
      var deliveryText = document.getElementById("deliveryText");
      if (deliveryText) {
        deliveryText.addEventListener("click", function (e) {
          window.location.href = "./orders-delivery-admin.php";
        });
      }
      </script>
<?php
    include "adminFooter.php";

?>

