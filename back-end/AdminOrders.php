<?php
    include "adminHeader.php";
    require_once "../classes/dbh.classes.php";
    require_once "../classes/OrderModel.php";
    $OrderModel = new Order();
    $order_data = $OrderModel->getOrders();
?>
<style>
  .addon{
    padding: 5px;
  }
  .addon video{
    max-height: 100px;

  }
  .dynamic-div {
    background-color: #fff; /* Set background color */
    border: 1px solid #000; /* Set border */
    padding: 10px; /* Set padding */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Add shadow */
    right: 50% !important;
    /* Add more styles as needed */
}
</style>
<?php
    if(isset($_SESSION["orderManagement_view"]) && $_SESSION["orderManagement_view"] == 1){
?>     
    <div class="container" style="margin-left: 300px; height: 100vh;">
      <div class="manage-order">
        <div class="row m-auto">
            <h2>Manage Order</h2>

            <button type="button" class="SetTimerButton" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" title="Set Timer Interval" style="border:none; background:none; cursor: pointer; focus: none; outline: none;">
                <i class="fa fa-cog" aria-hidden="true" style="font-size:30px; color: #7e7e7a;
    text-shadow: 2px 3px 1px rgba(0, 0, 0, 0.25);"></i>
            </button>

        </div>
      </div>
      <div class="status-bar">
        <button class="New" id="newStatus" style="height: 50px;">New <span class="badge badge-success">4</span></button>
        <button class="Preparing" id="preparingStatus" style="height: 50px;">Preparing <span class="badge badge-success">4</span></button>
        <button class="Delivery" id="deliveryStatus" style="height: 50px;">Delivery <span class="badge badge-success">4</span></button>
        <button class="Complete" id="completeStatus" style="height: 50px;">Complete <span class="badge badge-success">4</span></button>
      </div>
      <!-- New Orders List Section -->
      <div class="order-list d-flex" id="newOrders" style="gap: 5px; height: 500px; overflow: auto;">
        <!-- <h3>List of Orders</h3> -->
    
      </div>
      
      
      <?php
            include_once "SetTimerInterval.php";
        ?>

    <script>
 function checkForNewOrders() {
    fetch('../controller/CountNewOrdersPending.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            var badgeContent = data.new_insert_count != 0
                ? '<span class="badge badge-success">' + data.new_insert_count + '</span>'
                : ''; // If count is 0, set an empty string

            document.getElementById('newStatus').innerHTML = 'New ' + badgeContent;
            // document.getElementById('numberAppointments').textContent = data.count;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}
            
                    function checkForPreparingOrders() {
                        fetch('../controller/CountPreparingOrder.php')
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                var badgeContent = data.new_insert_count != 0
                                    ? '<span class="badge badge-success">' + data.new_insert_count + '</span>'
                                    : ''; // If count is 0, set an empty string

                                document.getElementById('preparingStatus').innerHTML = 'Preparing ' + badgeContent;
                                // document.getElementById('numberAppointments').textContent = data.count;
                            })
                            .catch(error => {
                                console.error('There was a problem with the fetch operation:', error);
                            });
                    }

                    function checkForDeliveryOrders() {
                        fetch('../controller/CountDeliverOrder.php')
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                var badgeContent = data.new_insert_count != 0
                                    ? '<span class="badge badge-success">' + data.new_insert_count + '</span>'
                                    : ''; // If count is 0, set an empty string

                                document.getElementById('deliveryStatus').innerHTML = 'Delivery ' + badgeContent;
                                // document.getElementById('numberAppointments').textContent = data.count;
                            })
                            .catch(error => {
                                console.error('There was a problem with the fetch operation:', error);
                            });
                    }


                    function checkForCompletedOrders() {
                        fetch('../controller/CountCompleteOrder.php')
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                var badgeContent = data.new_insert_count != 0
                                    ? '<span class="badge badge-success">' + data.new_insert_count + '</span>'
                                    : ''; // If count is 0, set an empty string

                                document.getElementById('completeStatus').innerHTML = 'Complete ' + badgeContent;
                                // document.getElementById('numberAppointments').textContent = data.count;
                            })
                            .catch(error => {
                                console.error('There was a problem with the fetch operation:', error);
                            });
                    }


                    setInterval(checkForNewOrders, 5000);
                    setInterval(checkForPreparingOrders, 5000);
                    setInterval(checkForDeliveryOrders, 5000);
                    setInterval(checkForCompletedOrders, 5000);
                    checkForNewOrders();
                    checkForPreparingOrders();
                    checkForDeliveryOrders() 
                    checkForCompletedOrders()

    </script>

      <!-- Preparing Orders List Section -->
      <!-- <div class="order-list" id="preparingOrders" style="display: none;">
      <div class="order">
      <div class="order-details">
        <p>Order No. #00001</p>
        <p>₱200</p>
      </div>
    </div> -->
    <div class="order-list" id="preparingOrders" style="display: none; height: 500px; overflow: auto;">
      <div class="order">
        <div class="order-details">
          <p class="order-no"></p>
          <p class="order-price"></p>
        </div>
        <div class="order-actions">
        <!-- <button class="view-button"></button>     -->
        <!-- <button class="remove-button"></button>
        <button class="deliver-button"></button> -->
      </div>
    </div>
    <!-- Add more preparing order items here -->
  </div>


<!-- Dynamic Container -->

      <!-- Order Info Section -->
      <div class="order-info" id="orderInfo" style="display:none; ">
        <h3>Order Info</h3>
        <table>
          <tr>
            <th>Order No.</th>
            <th>Email</th>
            <th>Address</th>
            <th>Customer Name</th>
          </tr>
          <tr>
            <td id="orderNumber"></td>
            <td id="customerEmail"></td>
            <td id="customerAddress"></td>
            <td id="customerName"></td>
        </tr>
          <!-- Add more rows for additional orders -->
        </table>
     <!-- Add-ons Section -->
    <div class="addons-section" id="addons-section">
      <div class="addon">
        <div class="addon" id="imageOrVideo">
            <!-- The image or video will be inserted here dynamically -->
        </div>

        <p class="addon-details">
            <span class="product-name" id="productName"></span>
            <span class="quantity" id="productQuantity"></span>
            <span class="sample" id="productSample"></span>
            <span class="addons" id="productAddons"></span>
            <span class="price" id="productPrice"></span>
        </p>
      </div>
      <!-- Add more add-ons here -->
    </div>
    <div class="overall_remarks d-flex flex-column" style="display: none;">
        <span style="font-weight: bold;" >Remarks: <span id="overall_remark_container"></span></span> 
        <span style="font-size: 12px;" >Coupon Name: <span id="coupon_container"></span></span>
        <span style="font-size: 12px;">Coupon Discount: <span id="discount_container"></span></span>
        <span style="font-size: 12px;">Promo Discount Name: <span id="promo_discount_name"></span></span>
        <span style="font-size: 12px;">Promo Discount: <span id="promo_discount_container"></span></span>
    </div>
    <div class="validation_promo" style="display:none;">
        <a class="btn btn-link p-0" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Validate ID
        </a>

        <div class="collapse" id="collapseExample">
            <div class="card card-body promo_container_valid_id">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>
    </div>
    <div class="Cash-On-delivery">
        <!-- <p style="font-size: 20px; font-weight: bold;">Cash On Delivery</p>
        <p id="cashOnDelivery"></p> -->
    </div>

    <div class="buttons" id="buttons">
        <button class="button cancel" data-toggle="modal" data-target="#ReasonModal">Cancel Order</button>
        <button class="button accept">Accept Order</button>
      </div>
    </div>

    <?php
      // include_once "AdminOrderModal.php";
    ?>
    
    <div class="order-list" id="deliveryOrders" style="display: none; height: 500px; overflow: auto; ">
    <div class="order">
      <div class="order-details">
          <p class="order-no"></p>
          <p class="order-price"></p>
      </div>
      <div class="order-actions">
      <button class="view-button"></button>    
        <button class="complete-button"></button>
      </div>
    </div>
   


  </div>
  
  <!-- <div class="order-list" id="completeOrders" style="display: none;"> -->
    <!-- Clear All Button (Initially Hidden) -->
    <!-- Sample order -->
    <!-- <div> -->
     <!-- <button class="clear-all-button" id="clearAllButton" style="display: none;">Clear All</button> -->
     <!-- </div> -->
    <!-- <div class="order">
      <p>Order #00001</p>
      <div class="order1">
      <p>Complete</p>
      </div>
      <button class="remove-button">Remove</button>
    </div> -->

    <div class="order-list" id="completeOrders" style="display: none; height: 500px; overflow: auto;">
        <!-- Clear All Button (Initially Hidden) -->
        <!-- <div>
            <button class="clear-all-button" id="clearAllButton" style="display: none;">Clear All</button>
        </div> -->
        <!-- Sample order element (you can create multiple such elements dynamically using JavaScript) -->
        <div class="order">
            <p class="order-no"></p>
            <div class="order1">
                <p></p>
            </div>
            <button class="view-button"></button>  
            <button class="remove-button"></button>
        </div>
    </div>



    </div>
    <!-- Add more orders following the same structure -->
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <div class="modal fade" id="ReasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="textarea">Enter your reason:</label>
                <textarea id="textarea_reason" class="form-control reason"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="CancelOrder" data-dismiss="modal">Submit</button>
            </div>
            </div>
        </div>
    </div>

    <script>
 $(document).ready(async function() {

// Default notification interval


// Default notification interval
let notificationInterval = localStorage.getItem('notificationInterval') || 300000; // 5 minutes in milliseconds

// Function to set the timer interval dynamically
function setTimerInterval(interval) {
    notificationInterval = interval;
    localStorage.setItem('notificationInterval', interval);
    console.log(`Notification interval set to ${interval / 1000} seconds.`);
    alert(`Notification interval set to ${interval / 1000} seconds.`);
}

// Event handler for the "Set Timer" button click
$('#setTimerBtn').on('click', function () {
    const timerInput = $('#timerInput').val();
    const parsedInput = parseInt(timerInput, 10);

    if (!isNaN(parsedInput) && parsedInput > 0) {
        // Check if the input includes "m" for minutes
        if (timerInput.includes('m')) {
            setTimerInterval(parsedInput * 60 * 1000); // Convert minutes to milliseconds
        } else {
            setTimerInterval(parsedInput * 1000); // Convert seconds to milliseconds
        }
        // Clear the input field
        $('#timerInput').val('');
    } else {
        console.log('Invalid input. Please enter a valid number greater than 0.');
    }
});

// Fetch and display orders when the page loads
// Default notification interval
await fetchOrders();
await fetchOrderDetails();
await fetchDeliveryOrderDetails();
await fetchCompleteOrderDetails() ;
// Poll for updates every 5 seconds
// setInterval(fetchOrders, 5000);
setInterval(async () => {
    await fetchOrders();
    await fetchOrderDetails();
    await fetchDeliveryOrderDetails();
    await fetchCompleteOrderDetails() ;
}, 5000);

var selectedOrderId;
var selectedCustomerEmail;
var selectedCustomerName;
var selectedCustomerAddress;
var totalprice;

// Create an object to track the last displayed time for each order
const lastDisplayTime = {};

function fetchOrders() {
    new Promise((resolve) => {
        $.ajax({
            url: '../controller/get_latest_orders.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // Update the order list
                updateOrderList(response.orders);

                response.orders.forEach(function (order) {
                    if (!order.accepted) {
                        const currentTime = new Date().getTime();
                        const lastTime = lastDisplayTime[order.orderId] || 0;
                        // Display notification only if 10 seconds have passed since the last display
                        if (currentTime - lastTime >= notificationInterval) {
                            startTimer(order.orderId, notificationInterval);
                            lastDisplayTime[order.orderId] = currentTime;
                        }
                    }
                });
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    })
}

function startTimer(orderId, duration) {
    setTimeout(function () {
        // Check if the order is still unaccepted
        if (!orderIsAccepted(orderId)) {
            displayNotification(orderId, duration / 1000); // Pass timer duration in seconds
        }
    }, duration);
}

function orderIsAccepted(orderId) {
    // You need to implement a function to check if an order is accepted based on its orderId
    // You can make an AJAX request to your server to check the order's status
    // For simplicity, I'll assume an order is accepted if it's assigned an "accepted" flag
    // Replace this logic with your own order acceptance check
    const acceptedOrders = [/* List of accepted order IDs */];
    return acceptedOrders.includes(orderId);
}

function displayNotification(orderId, timerInSeconds) {
    // Create and play an audio notification
    var audio = new Audio('../audio/notification.mp3');
    audio.play();

    // Customize the notification message with dynamic timer text
    const minutes = Math.floor(timerInSeconds / 60);
    const seconds = timerInSeconds % 60;
    const timerText = `${minutes} minute(s) and ${seconds} second(s)`;

    alert(`Order #${orderId} hasn't been accepted within ${timerText}.`);
}

function updateOrderList(orders) {
    // Clear the existing order list
    $("#newOrders").empty();
    $("#newOrders").append("<h3>List of Orders</h3>");
    // Iterate through the orders and add them to the list
    orders.forEach(function (order) {
        var orderItem = document.createElement('div');
        orderItem.classList.add('list');
        orderItem.style.cursor = 'pointer';
        // orderItem.dataset.orderId = order.orderId;
        orderItem.dataset.customerId = order.customerid;

        var ul = document.createElement('ul');
        ul.innerHTML = '<li>Order #' + order.orderId + '</li>' +
            '<li>' + order.price + '</li>';
        // Add more order details as needed

        orderItem.appendChild(ul);
        $("#newOrders").append(orderItem);

        // Attach a click event handler to this order item

    // Attach a click event handler to this order item
    orderItem.addEventListener('click', function() {
      var customerId = order.customerid; // Change from orderId to customerId
       // Lo
        var orderId = order.orderId;
        selectedOrderId = orderId;
        SelectedCustomerid = customerId;
        selectedCustomerName = order.customer_name;
        selectedCustomerAddress = order.address;
        selectedCustomerEmail = order.customer_email;
        Selected_pickup = order.payment_pickup;
        Selected_cod = order.payment_cod;
        Selected_gcash = order.payment_gcash;
        selected_gcash_upload = order.gcash_upload;
        CustomerLastName = order.customer_lname;
        CustomerPostalCode= order.customer_postal_code;
        CustomerCity = order.customer_city;
        CustomerRegion= order.customer_region;
        CustomerAddressId = order.customer_address_id;
        totalprice = order.price;
        order_date = order.OrderDate;
        overall_remark = order.remark;
        coupon_name = order.coupon_name;
        coupon_discount = order.coupon_discount;
        coupon_id = order.coupon_id;
        discount_percent = order.discount_percent;
        discount_name = order.discount_name;
        discount_image = order.discount_valid_id;
        // console.log(customerId);
        // Make an AJAX request to fetch order details
        $.ajax({
            url: '../controller/get_order_details.php', // Replace with the actual URL to fetch order details
            type: 'GET',
            data: { 
                customerId: customerId,
                order_id: selectedOrderId

            },
            success: function(response) {
                var orderDetails = JSON.parse(response);

                if (Array.isArray(orderDetails)) {
                    orderDetails.forEach(function(order) {
                        // Access the addons array for each order
                        var addons = order.addons;
                        // Now you can use addons as needed
                        console.log("Addons:", addons);

                        // If you want to iterate through addons, you can do something like:
                        for (var i = 0; i < addons.length; i++) {
                            var addon = addons[i];
                            console.log("Addon:", addon);
                        }
                    });
                }

                // console.log("Received order details:", orderDetails);
                console.log(orderDetails.orderDetails);
                updateOrderInfo(orderDetails);
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });
});
}


function updateOrderInfo(orderDetails) {
    // Update the placeholders with dynamic data
    console.log(orderDetails);
    $("#orderNumber").text(selectedOrderId);
    $("#customerEmail").text(selectedCustomerEmail);
    $("#customerAddress").text(selectedCustomerAddress);
    $("#customerName").text(selectedCustomerName + CustomerLastName);
    $("#addons-section").empty();
    
    // if (overall_remark != "") {
        $("#overall_remark_container").show();
        $("#overall_remark_container").text(overall_remark);
        // $("#coupon_container").show();
        $("#coupon_container").text(coupon_name);
        // $("#discount_container").show();
        $("#discount_container").text("₱" + coupon_discount);
        $("#promo_discount_name").text(discount_name);
        $("#promo_discount_container").text(discount_percent + "%");
    // }


    // Check if orderDetails is an array
    if (Array.isArray(orderDetails)) {
        orderDetails.forEach(function (order, index) {

            // Create a container for each order detail
            var orderContainer = document.createElement('div');
            orderContainer.classList.add('addon');

            // Create a div for the image or video
            var imageOrVideoElement = document.createElement('div');
            imageOrVideoElement.id = 'imageOrVideo_' + index;

            // Populate the image or video dynamically
            if (order.addons.imageURL.includes('.mp4')) {
                // It's a video
                imageOrVideoElement.innerHTML = `
                    <video controls style="max-width: 100%">
                        <source src="${order.addons.imageURL}" type="video/mp4">
                        <p>Your browser does not support the video tag</p>
                    </video>
                `;
            } else {
                // It's an image
                imageOrVideoElement.innerHTML = `
                    <img src="${order.addons.imageURL}" alt="Sample Product" style="max-width: 100%">
                `;
            }

            // Create a paragraph for addon details
            var addonDetails = document.createElement('p');
            addonDetails.classList.add('addon-details');

            // Populate the addon details dynamically
            addonDetails.innerHTML = `
                <span class="product-name" id="productName_${index}">${order.addons.productName}</span>
                <span class="quantity" id="productQuantity_${index}">${order.addons.size_name}</span>
                <span class="sample" id="productSample_${index}">${order.addons.quantity}</span>
                <span class="addons" id="productAddons_${index}">${order.addons.addons_name}</span>
                <span class="price" id="productPrice_${index}">${order.addons.price}</span>
                <span class="remarks" id="productRemark_${index}">${order.addons.remarks_}</span>
            `;

            // Append the image or video and addon details to the order container
            orderContainer.appendChild(imageOrVideoElement);
            orderContainer.appendChild(addonDetails);

            // Append the order container to the newOrders container
            $("#addons-section").append(orderContainer);
        });
    }

    // Update the cash on delivery
    if (Selected_pickup == 1 && Selected_gcash != 1 && Selected_cod != 1) {
        // Cash On Delivery
        $(".Cash-On-delivery").html(`
            <p style="font-size: 20px; font-weight: bold;">Pickup</p>
            <p id="cashOnDelivery">₱${totalprice}</p>
        `);
    } else if (Selected_gcash == 1 && Selected_pickup != 1 && Selected_cod != 1) {
        // G-Cash Payment Mode or Pickup
        $(".Cash-On-delivery").html(`
            <p style="font-size: 10px; font-weight: bold;">Default Shipping Fee: ₱10.00</p>
            <p style="font-size: 20px; font-weight: bold;">G-CASH</p>
            <p id="cashOnDelivery">₱${totalprice}</p>
            <img src="../upload-content/${selected_gcash_upload}" alt="Proof of Payment" style="max-width: 100% height: 300px;">
            `);
    } else if (Selected_cod == 1 && Selected_pickup != 1 && Selected_gcash != 1) {
        $(".Cash-On-delivery").html(`
            <p style="font-size: 10px; font-weight: bold;">Default Shipping Fee: ₱10.00</p>
            <p style="font-size: 20px; font-weight: bold;">Cash on Delivery</p>
            <p id="cashOnDelivery">₱${totalprice}</p>
        `);
    }
if(discount_image != null){
    $(".validation_promo").show();

    $(".promo_container_valid_id").html(`
        <img src="../upload-content/${discount_image}" alt="Proof of Payment" style="max-width: 100% height: 300px;">
        `);
}else{
    $(".validation_promo").hide();
}
    

    // $("#cashOnDelivery").text(totalprice);
    $("#orderInfo").css("display", "block");
}



    $("#CancelOrder").click(function() {
        if (selectedOrderId && SelectedCustomerid) {
            // var reason = prompt("Please provide a reason for canceling order #" + selectedOrderId + ":");
 
            let reason = $("#textarea_reason").val();
            if (reason != "") {  // User clicked OK

                $.ajax({
                    url: '../controller/cancellation_order.php', // Replace with the actual URL for updating the order
                    type: 'POST', // You may use POST to send data securely
                    data: {
                        updateorder: selectedOrderId,
                        customerid: SelectedCustomerid,
                        accepted: false,  // Indicate that the order is not accepted
                        reason: reason,
                        coupon_id: coupon_id,  // Include the cancellation reason
                    },
                    success: function(response) {
                        // Remove the container for the order
                        // console.log("Connected to updateorder in PHP");
                   
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: " + error);
                    }
                });
          
            }else{
                console.log("empty reason!")
            }
        } else {
            alert("Please select an order to cancel.");
        }
    });

    $(".accept").click(function() {

        if (selectedOrderId && SelectedCustomerid) {
            // Display a confirmation dialog with the order ID
            var confirmation = confirm("Are you sure you want to accept order #" + selectedOrderId +"?");

            if (confirmation) {
                // Make an AJAX request to update the order status
                $.ajax({
                    url: '../controller/update_order.php', // Replace with the actual URL for updating the order
                    type: 'POST', // You may use POST to send data securely
                    data: { updateorder: selectedOrderId,
                            customerid: SelectedCustomerid,
                            email: selectedCustomerEmail,
                            fname: selectedCustomerName,
                            total_price: totalprice,
                            OrderDate: order_date,
                            accepted: true,
                    },
                    success: function(response) {
                        // Remove the container for the order
                        $("#orderInfo").css("display", "none");
                        selectedOrderId = null; // Reset the selected order ID
                        alert(response);
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: " + error);
                    }
                });
            }
        } else {
            alert("Please select an order to accept.");
        }
    });


    function fetchOrderDetails() {
    // Make an AJAX request to your server to fetch order details
    new Promise((resolve) =>{

   
    $.ajax({
        url: '../controller/OrdersPreparing.php', // Replace with your server's URL
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Append the order details to the container
            $('#preparingOrders').empty(); // Clear the existing orders first
            response.orders.forEach(function (order) {
                // Create a new order element
                var orderDiv = document.createElement('div');
                orderDiv.classList.add('order');

                // Create a container for order details
                var orderDetailsDiv = document.createElement('div');
                orderDetailsDiv.classList.add('order-details');

                // Create and populate order details
                var orderNoP = document.createElement('p');
                orderNoP.classList.add('order-no');
                orderNoP.textContent = 'Order No. #' + order.orderId;

                var orderPriceP = document.createElement('p');
                orderPriceP.classList.add('order-price');
                orderPriceP.textContent = '₱' + order.price;

                // Create a container for order actions (buttons)
                var orderActionsDiv = document.createElement('div');
                orderActionsDiv.classList.add('order-actions');

                var viewButton = document.createElement('button');
                viewButton.classList.add('btn', 'btn-link', 'view-button');
                viewButton.textContent = 'View';
                

                // Add a data-toggle and data-target attributes for Bootstrap modal
                viewButton.setAttribute('data-toggle', 'modal');
                viewButton.setAttribute('data-target', '#orderModal' + order.orderId);

                // Add click event listener to populate modal content
                viewButton.addEventListener('click', function () {
                    populateModal(order);
                });


                // Create and populate "Remove" button
                var removeButton = document.createElement('button');
                removeButton.classList.add('remove-button');
                removeButton.textContent = 'Remove';

                // Create and populate "Deliver" button
                var deliverButton = document.createElement('button');
                deliverButton.classList.add('deliver-button');
                deliverButton.textContent = 'Deliver';

                removeButton.addEventListener('click', function () {
                    var confirmRemove = confirm('Are you sure you want to remove this order?');
                    if (confirmRemove) {
                        removeOrder(order.orderId, order.customer_id);
                        // console.log(order.orderId);
                    }
                });

                deliverButton.addEventListener('click', function () {
                    var confirmDeliver = confirm('Are you sure you want to deliver this order?');
                    if (confirmDeliver) {
                        deliverOrder(order.orderId, order.customer_id, order.order_date, order.email, order.fname, order.price );

                        // console.log(order.orderId, order.customer_id);
                    }
                });

                orderDiv.addEventListener('click', function () {
  
                });


                // Append elements to their respective containers
                orderDetailsDiv.appendChild(orderNoP);
                orderDetailsDiv.appendChild(orderPriceP);

                orderActionsDiv.appendChild(viewButton);
                orderActionsDiv.appendChild(removeButton);
                orderActionsDiv.appendChild(deliverButton);

                // Append the containers to the order element
                orderDiv.appendChild(orderDetailsDiv);
                orderDiv.appendChild(orderActionsDiv);

                // Append the order details to the container
                $('#preparingOrders').append(orderDiv);
            });
        },
        error: function (xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
});

}

/// START MODAL VIEW FUNCTION IN PREPARING, DELIVERY AND COMPLETE

function populateModal(order) {
    // Create a modal element
    var modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.id = 'orderModal' + order.orderId;

    // Create a modal dialog with a larger size
    var modalDialog = document.createElement('div');
    modalDialog.classList.add('modal-dialog', 'modal-lg');

    // Create a modal content
    var modalContent = document.createElement('div');
    modalContent.classList.add('modal-content');

    // Create a modal header
    var modalHeader = document.createElement('div');
    modalHeader.classList.add('modal-header');
    modalHeader.innerHTML = '<h4 class="modal-title">Order Details</h4><button type="button" class="close" data-dismiss="modal">&times;</button>';

    // Create a modal body
    var modalBody = document.createElement('div');
    modalBody.classList.add('modal-body');
    
    // Add the order details to the modal body
    modalBody.innerHTML = '<p>Order No. #' + order.orderId + '</p>' +
                          '<p>Price: ₱' + order.price + '</p>';

    // Create an HTML table for the order details
//     var tableData = [
//     { productName: 'Fruit Tea', size: 'Medium', price: '$5', quantity: 2, addons: 'None', itemSubtotal: '$10' },
//     { productName: 'Iced Tea', size: 'Large', price: '$7', quantity: 1, addons: 'Lemon', itemSubtotal: '$7' }
// ];



var tableContent = '<table class="table">' +
                    '<thead>' +
                        '<tr>' +
                            '<th></th>' +
                            '<th>Product Name</th>' +
                            '<th>Size</th>' +
                            '<th>Price</th>' +
                            '<th>Quantity</th>' +
                            '<th>Addons</th>' +
                            '<th>Item Subtotal</th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody>';

// Populate the table rows with data
// tableData.forEach(function (row) {
// Assuming order.details is an array of products
    order.details.forEach(function (product) {
        var imageUrl = '../upload/' + product.image_url;

        // Check if the file extension is for a video
        var isVideo = imageUrl.toLowerCase().endsWith('.mp4');

        // Concatenate the appropriate HTML based on the file extension
        var mediaContent = isVideo
        ? '<video controls style="max-width: 100%">' +
            '<source src="' + imageUrl + '" type="video/mp4">' +
            '<p>Your browser does not support the video tag</p>' +
            '</video>'
        : '<img src="' + imageUrl + '" alt="">';

        tableContent += '<tr>' +
                            '<td>' + mediaContent + '</td>' +
                            '<td>' + product.product_name + '</td>' +
                            '<td>' + product.size_name + '</td>' +
                            '<td>' + product.product_price + '</td>' +
                            '<td>' + product.quantity + '</td>' +
                            '<td>' + product.subtotal + '</td>' +
                            '<td>' + product.subtotal + '</td>' +
                        '</tr>';
    });

// });

// Close the table body and table tags
tableContent += '</tbody></table>';


    // Close the table body and table tags
    tableContent += '</tbody></table>';

    // Append the table to the modal body
    modalBody.innerHTML += tableContent;

    // Append modal header and body to modal content
    modalContent.appendChild(modalHeader);
    modalContent.appendChild(modalBody);

    // Append modal content to modal dialog
    modalDialog.appendChild(modalContent);

    // Append modal dialog to modal
    modal.appendChild(modalDialog);

    // Append modal to body
    document.body.appendChild(modal);

    // Show the modal
    // $(modal).class('show');
}

// END MODAL VIEW FUNCTION IN PREPARING, DELIVERY AND COMPLETE



function removeOrder(orderId, customerid) {
    $.ajax({
        url: '../controller/RemoveOrder.php', // Replace with your server's URL for delivering orders
        type: 'POST',
        data: { customer_id: customerid,
                orderId: orderId,        
        },
        success: function (response) {
            if (response.success) {
                // Order delivered successfully, you can update the UI or perform any other necessary actions
                // alert("Order #" + orderId + " is up for delivery.");
                alert(response);
                // Optionally, you can remove the order from the UI or update its status
            } else {
                alert(response);
                // alert("Failed to deliver the order. Please try again.");
            }
        },
        error: function (xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
}


// Function to deliver an order
function deliverOrder(orderId, customerid, order_date, email, fname, price) {
    $.ajax({
        url: '../controller/DeliverOrder.php', // Replace with your server's URL for delivering orders
        type: 'POST',
        data: { customer_id: customerid,
                orderId: orderId,
                email: email,
                fname: fname,
                total_price: price,
                order_date: order_date,   
        },
        success: function (response) {
            if (response.success) {
                // Order delivered successfully, you can update the UI or perform any other necessary actions
                // alert("Order #" + orderId + " is up for delivery.");
                alert(response);
                // Optionally, you can remove the order from the UI or update its status
            } else {
                alert(response);
                // alert("Failed to deliver the order. Please try again.");
            }
        },
        error: function (xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
}


// Function to fetch delivery order details
function fetchDeliveryOrderDetails() {
    // Make an AJAX request to your server to fetch delivery order details
    new Promise((resolve) =>{
    $.ajax({
        url: '../controller/OrdersDelivery.php', // Replace with your server's URL
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Append the delivery order details to the container
            $('#deliveryOrders').empty(); // Clear the existing delivery orders first
            response.orders.forEach(function (order) {
                // Create a new order element
                var orderDiv = document.createElement('div');
                orderDiv.classList.add('order');

                // Create a container for order details
                var orderDetailsDiv = document.createElement('div');
                orderDetailsDiv.classList.add('order-details');

                // Create and populate order details
                var orderNoP = document.createElement('p');
                orderNoP.classList.add('order-no');
                orderNoP.textContent = 'Order No. #' + order.orderId;

                var orderPriceP = document.createElement('p');
                orderPriceP.classList.add('order-price');
                orderPriceP.textContent = '₱' + order.price;

                // Create a container for order actions (buttons)
                var orderActionsDiv = document.createElement('div');
                orderActionsDiv.classList.add('order-actions');

                var viewButton = document.createElement('button');
                viewButton.classList.add('btn', 'btn-link', 'view-button');
                viewButton.textContent = 'View';

                 // Add a data-toggle and data-target attributes for Bootstrap modal
                 viewButton.setAttribute('data-toggle', 'modal');
                viewButton.setAttribute('data-target', '#orderModal' + order.orderId);

                // Add click event listener to populate modal content
                viewButton.addEventListener('click', function () {
                    populateModal(order);
                });

                // Create and populate "Complete" button
                var completeButton = document.createElement('button');
                completeButton.classList.add('complete');
                completeButton.textContent = 'Complete';

                completeButton.addEventListener('click', function () {
                    var confirmDeliver = confirm('Are you sure you want to mark this order as completed?');
                    if (confirmDeliver) {
                        completeOrder(order.orderId, order.customer_id, order.order_date, order.email, order.fname, order.price );
                    }
                });

                // Append elements to their respective containers
                orderDetailsDiv.appendChild(orderNoP);
                orderDetailsDiv.appendChild(orderPriceP);

                orderActionsDiv.appendChild(viewButton);
                orderActionsDiv.appendChild(completeButton);

                // Append the containers to the order element
                orderDiv.appendChild(orderDetailsDiv);
                orderDiv.appendChild(orderActionsDiv);

                // Append the order details to the "deliveryOrders" container
                $('#deliveryOrders').append(orderDiv);
            });
        },
        error: function (xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
});
}








function completeOrder(orderId, customerid, order_date, email, fname, price) {

    $.ajax({
        url: '../controller/CompleteOrder.php', // Replace with your server's URL for delivering orders
        type: 'POST',
        data: { customer_id: customerid,
                orderId: orderId,
                email: email,
                fname: fname,
                total_price: price,
                order_date: order_date,           
        },
        success: function (response) {
            if (response.success) {
                // Order delivered successfully, you can update the UI or perform any other necessary actions
                // alert("Order #" + orderId + " is up for delivery.");
                alert(response);
                // Optionally, you can remove the order from the UI or update its status
            } else {
                alert(response);
                // alert("Failed to deliver the order. Please try again.");
            }
        },
        error: function (xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
}


function fetchCompleteOrderDetails() {
    // Make an AJAX request to your server to fetch complete order details
    new Promise((resolve) =>{
    $.ajax({
        url: '../controller/OrdersCompleted.php', // Replace with your server's URL
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Append the complete order details to the container
            $('#completeOrders').empty(); // Clear the existing complete orders first
            response.orders.forEach(function (order) {
                // Create a new order element
                var orderDiv = document.createElement('div');
                orderDiv.classList.add('order');

                // Create and populate order details
                var orderNoP = document.createElement('p');
                orderNoP.classList.add('order-no');
                orderNoP.textContent = 'Order #' + order.orderId;

                var order1Div = document.createElement('div');
                order1Div.classList.add('order1');
                var completeP = document.createElement('p');
                completeP.textContent = 'Complete';

                // Create a container for order actions (buttons)
                var orderActionsDiv = document.createElement('div');
                orderActionsDiv.classList.add('order-actions');

                var viewButton = document.createElement('button');
                viewButton.classList.add('btn', 'btn-link', 'view-button');
                viewButton.textContent = 'View';

                 // Add a data-toggle and data-target attributes for Bootstrap modal
                 viewButton.setAttribute('data-toggle', 'modal');
                viewButton.setAttribute('data-target', '#orderModal' + order.orderId);

                // Add click event listener to populate modal content
                viewButton.addEventListener('click', function () {
                    populateModal(order);
                    // console.log();
                });



                // Create and populate "Remove" button
                var removeButton = document.createElement('button');
                removeButton.classList.add('remove-button');
                removeButton.textContent = 'Remove';

                removeButton.addEventListener('click', function () {
                    var confirmRemove = confirm('Are you sure you want to remove this order?');
                    if (confirmRemove) {
                        DeleteOrder(order.orderId, order.customer_id);
                    }
                });

                // Append elements to their respective containers
                order1Div.appendChild(completeP);

                // Append elements to the order element
                orderDiv.appendChild(orderNoP);
                orderDiv.appendChild(order1Div);
                orderDiv.appendChild(viewButton);
                orderDiv.appendChild(removeButton);

                // Append the order details to the "completeOrders" container
                $('#completeOrders').append(orderDiv);
            });
        },
        error: function (xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
});
}



function DeleteOrder(orderId, customerid) {
    $.ajax({
        url: '../controller/DeleteOrder.php', // Replace with your server's URL for delivering orders
        type: 'POST',
        data: { customer_id: customerid,
                orderId: orderId,        
        },
        success: function (response) {
            if (response.success) {
                // alert("Order #" + orderId + " is up for delivery.");
                alert(response);
                // Optionally, you can remove the order from the UI or update its status
            } else {
                alert(response);
            }
        },
        error: function (xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
}

// setInterval(fetchOrders, 5000);
// fetchOrders();
// Call the fetchOrderDetails function to initially populate orders


});


    </script>
    <script src="../assets/js/AdminOrderButton.js">
    </script>

<?php
    }
    include "adminFooter.php";
?>
  