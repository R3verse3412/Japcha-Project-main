
<?php
    session_start();
?>
<?php
    require "classes/dbh.classes.php";
    require "classes/cms.classes.php";
    $cms = new Cms();
    $data = $cms->getCms();
    include_once "classes/ProductsModel.php";

    $productModel = new ProductModel();
    // $products = $productModel->getProductShake();
    require_once "classes/profileinfo.classes.php";
    $signup_model = new ProfileInfo();
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="image/japcha_logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="Customer.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <title>Document</title> -->
    <style>
        body{
            background-color: #f4f1ec !important;
        }
        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #d6e9c6;
        }
      
        .cart-drawer {
            position: fixed;
            top: 0;
            right: -100%; 
            width: 700px; 
            height: 100%;
            background-color: #fff;
            box-shadow: -5px 0 10px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease;
            overflow-y: auto; 
            z-index: 999; 
    }
        .cart-drawer.open {
            right: 0;
        }
        .cart-content {
            padding: 20px;
        }

        .bottonCheckout{
            margin-left: 310px;
        }

        .h1{
            font-weight: 10000;
        }

        .card-img-top {
            transition: transform 0.3s;
        }

        .card-img-top:hover {
            transform: scale(1.1);
        }

        .h2{
            margin-top: 50px;
        }

        .container{
            margin-top: 20px;
        }
        .cartCONT{
            margin-top: 0px !important;
            margin-left: 0px !important;
            padding-left: 15px !important;
        }

        .Shopping {
            height: 180px;
            border-radius: 16px;
            background: #EFC900;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) inset;

            display: flex;
            align-items: center;
            justify-content: center;

            padding-top: 10px;
            padding-bottom: 10px;

            margin-right: 20px;
        }

        .row{
            margin-bottom: 0 !important;
        }

        .card-header {
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border: none; 
        }

        .btn-link {
            border: none; 
            text-decoration: underline;
            background: transparent; 
        }

        .card-title {
            border: none; 
            margin: 0; 
        }
       #cart-toggle{
            width: auto !important;
       }
       #search-icon{
        position: relative;
       }
        #search-icon .BellBadge {
        position: absolute;
        top: -5px;
        right: 3px;
        font-size: 10px;
        }
        .cart{
            position: relative;
        }
        .cart .badge-top {
        position: absolute !important;
        right: 3px !important;
        font-size: 10px !important;
        }
        #AnnouncementButton{
            border-radius: 50%;
            box-shadow: -1px 2px 4px 1px rgba(0, 0, 0, 0.25);
            position: fixed;
            bottom: 10px;
            left: 10px;
            z-index: 999999;
        }
        .active{
            color: blue !important;
        }

        .notification-icon {
            margin-right: 10px;
        }

        .large-dropdown {
            max-height: 400px; /* I-adjust ang maximum height base sa iyong kagustuhan */
        overflow-y: auto; /* Magiging scrollable kung lalagpas sa maximum height */
        width: 350px;
        margin: 0 auto; /* Ito ay nagce-center ng element horizontally */
        }

        .notification-icon {
            display: none;
        }

        .no-caret::after {
            display: none !important;
        }

    .customerM{
        display: flex;
        align-items: center;
        border-radius: 6px;
        box-shadow: -1px 2px 4px 1px rgba(0, 0, 0, 0.25);
        margin-bottom: 10px !important;
    }
    .message-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0;
        /* border-bottom: 1px solid #ccc; */
    }

    .message-info {
        /* display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-left: 10px; */
        flex: 1;
        margin-left: 20px;
    }

    .user-image {
        height: 60px;
        width: 50px;
        object-fit: cover; /* para mapanatili ang aspeto ratio */
        border-radius: 5px;
    }

    .message-time{
    font-size:12px;
    color: #6f7485 !important;
}

.message-order{
    font-weight:bold;
    margin-bottom:0;
}

.message-text{
    font-size: 10px;
    margin-bottom: 5px;
    text-align: end;
    font-weight: 1000;
    
}
.customerM a{
    width: 100% !important;
}
    </style>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <nav style="display: flex !important;">
        <div id ="logo-img">
            <a href="index.php" class="logo__image">
              <img src="upload-content/<?php echo $data['logo_url']; ?>" alt="sss">
            </a>
        </div>
        <div id="menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="navigation__main_ul">
            <li>
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="subnav">
                <a class="subnavbtn nav-link" href="customerSHOP.php">Shop</a>
            </li>
            
            <li>
                <a href="index.php#about-us" class="scroll-link nav-link">About</a>
            </li>
            <li>
                <a href="chatFront.php" class="nav-link">Chat</a>
            </li>
            <?php
                if (isset($_SESSION["userid"])) 
                {
                    $customerId = $_SESSION["userid"];
            ?>
            <li style="position: relative;">
                <a href="orderstatus.php"  id="insertCounter" class="nav-link" >Order<span class="badge badge-danger" style="position: absolute; top:0; right:3px; font-size: 10px;"></span></a>
            </li>

            <script>
                    var customerId = $("#userid_forCART").val();


                function checkForNewInserts(customerId) {
                    fetch('controller/CountNewInsertedOrderFrontEnd.php?customerid=' + customerId)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            var badgeContent = data.new_insert_count != 0
                                ? '<span class="badge badge-danger" style="position: absolute; top:0; right:3px; font-size: 10px;">' + data.new_insert_count + '</span>'
                                : ''; // If count is 0, set an empty string

                            document.getElementById('insertCounter').innerHTML = 'Orders ' + badgeContent;
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                }

                // Initial check
                checkForNewInserts(customerId);

                // Periodically check for new inserts (e.g., every 5 seconds)
                setInterval(function () {
                    checkForNewInserts(customerId);
                }, 5000);

            </script>
            <?php
                }
                
            ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle no-caret" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell" style="color: black;
                    text-shadow: 2px 3px 1px rgba(0, 0, 0, 0.25);" ></i>
                        <span class="badge badge-warning badge-top BellBadge" style="position: absolute;
                    color: #fff;
                    background-color: #dc3545;
                    top: 2px;
                    right: 10px;
                    font-size: 12px;" id="bellsprout"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right large-dropdown" aria-labelledby="messagesDropdown" style="padding: 0 10px 0 10px !important;">
                    <?php
                        if (isset($_SESSION["userid"])) 
                        {
                            $customer_date = $signup_model->getCustomerDataFront($_SESSION["userid"]);
                    ?>
                    <div class="dropdown-header">Hi <?= $_SESSION["username"]?>!<br>Welcome to JapCha's Website</div> 
                    
                    <div class="dropdown-divider"></div>
                    <div>
                        <a class="dropdown-item customerM" href="orderstatus.php" style="display: none; width: 100%;">

                            <div class="message-container">

                                <div class="user-image-container">
                                        <img src="./image/Man.png" alt="B">
                                </div>

                                <div class="message-info">
                                    <p class="message-text"></p>
                                    <p class="message-order"></p>
                                    <p class="message-time"></p>
                                </div>
                            </div>

                        </a> 
                    </div>
                       
                    <?php
                        }else{
                            echo '<div class="dropdown-header">Guest</div>';
                        }
                    ?>
                        

                    </div>
                </li>
            </div>
    <script>


$(document).ready(async function(){
    await checkForNewOrdersNotificationBell(customerId);

// Periodically check for new inserts (e.g., every 5 seconds)
    setInterval(async function () {
        await checkForNewOrdersNotificationBell(customerId);
    }, 5000);


});
       
         var customerId = $("#userid_forCART").val();
          function checkForNewOrdersNotificationBell(customerId) {
            fetch('controller/CountNewInsertedOrderFrontEnd.php?customerid=' + customerId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if(data.new_insert_count != 0){
                        $("#bellsprout").text(data.new_insert_count);
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }


    </script>
            
            <?php
                if (isset($_SESSION["userid"])) 
                {
            
            ?>
                    <li>
                        <div class="cart">
                           <button class="btn" id="cart-toggle" style="background-color: transparent;"><i class="fa-solid fa-cart-shopping fa-lg"></i></button><span class="badge badge-danger badge-top"></span>
                        </div>
                    </li>
                    <li><div id="user-icon"><a href="myProfile.php"><i class='fa fa-user-circle user'></a></i></div></li>
                    <li><a href="includes/logout.inc.php">Logout</a></li>
                    <input type="hidden" id="userid_forCART" value="<?= $_SESSION["userid"] ?>">

            <?php
                }
                else 
                {
            ?>
                    <li><button class="button" id="form-open">Login</button></li>
                    
            <?php 
                }
            ?>
        </ul>
    </nav>

    <script>
        function updateMessageTime(message, orderDate) {
        setInterval(function () {
            // Parse order date to get the timestamp
            let timestamp = new Date(orderDate).getTime();
            // Get the current time
            let currentTime = new Date().getTime();
            // Calculate elapsed time
            let elapsedTime = currentTime - timestamp;

            // Calculate days, hours, minutes
            let elapsedDays = Math.floor(elapsedTime / (1000 * 60 * 60 * 24));
            let elapsedHours = Math.floor((elapsedTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let elapsedMinutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));

            // Display time
            let timeString = '';
            if (elapsedDays > 0) {
                timeString += elapsedDays + ' days ';
            }
            if (elapsedHours > 0) {
                timeString += elapsedHours + ' hours ';
            }
            if (elapsedMinutes > 0 || timeString == '') {
                timeString += elapsedMinutes + ' minutes ';
            }

            // Set the time string in the message element
            message.find(".message-time").text(timeString + ' ago');
        }, 1000); // Update every second
    }



            $(document).ready(async function () {
                var customerId = $("#userid_forCART").val();


                function getCurrentDateInManila() {
                    const options = { timeZone: 'Asia/Manila', year: 'numeric', month: 'numeric', day: 'numeric' };
                    const formatter = new Intl.DateTimeFormat('en-US', options);
                    return formatter.format(new Date());
                }

                // Function to format the order date to match the current date format
                function formatOrderDateForComparison(orderDate) {
                    const date = new Date(orderDate);
                    const year = date.getFullYear();
                    const month = (date.getMonth() + 1).toString().padStart(2, '0');
                    const day = date.getDate().toString().padStart(2, '0');
                    return `${month}/${day}/${year}`;
                }


                function populateNotification() {
    new Promise((resolve) => {
        const current_date = getCurrentDateInManila();

        $.ajax({
            type: 'GET',
            url: 'controller/get_notification_data_front-end.php',
            dataType: 'json',
            data: {
                customerId: customerId
            },
            success: function (response) {
                // Construct HTML for notifications
                let notificationsHTML = '';

                if (response && response.orders) {
                    response.orders.forEach(function (order) {
                        let statusText, backgroundColor, textColor;

                        if (order.statusCompleted == 1 || order.statusRemoved == 1) {
                            statusText = "COMPLETED";
                            backgroundColor = 'rgb(207 242 207)';
                            textColor = '#198e02';
                        } else if (order.statusPreparing == 1) {
                            statusText = "PREPARING";
                            backgroundColor = 'rgb(242 213 207)';
                            textColor = 'rgb(227 35 35)';
                        } else if (order.statusDelivery == 1) {
                            statusText = "DELIVERY";
                            backgroundColor = 'rgb(242 213 207)';
                            textColor = 'rgb(227 35 35)';
                        } else if (order.statusCancel == 1) {
                            statusText = "CANCELLED";
                            backgroundColor = 'rgb(242 242 211)';
                            textColor = '#c5c543';
                        } else {
                            statusText = "PENDING";
                            backgroundColor = '';
                            textColor = '';
                        }

                        notificationsHTML += `
                            <div class="customerM" style="background-color: ${backgroundColor};">
                                <a href="AdminOrders.php">
                                    <div class="message-text" style="color: ${textColor};">${statusText}</div>
                                    <div class="message-order">ORDER NO. ${order.orderId}</div>
                                    <div class="message-time">${order.OrderDate}</div>
                                </a>
                            </div>
                        `;
                    });
                } else {
                    console.log('Invalid response format');
                }

                // Set the HTML of the container
                $(".customerM").parent().html(notificationsHTML);
            },
            error: function (xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    });
}

// Call the function
await populateNotification();

// setInterval(() => {
//     populateNotification();
// }, 5000);

            });


            </script>
<!-- <button type="button" class="btn btn-primary" id="AnnouncementButton" data-toggle="modal" data-target=".bd-example-modal-lg" style="bo"><i class="fa fa-bullhorn" aria-hidden="true" style="font-size: 40px;"></i></button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="col-xs-12 " style="width: 100%;">
                <div>
                     <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Announcement</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">About Us</a>
                    </div>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent" style="padding-right: 10px !important;">
                    
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                        asdadasdadasda

                        </div>
                    </div>
            </div>
        </div>
    </div>
  </div>
</div> -->


    <?php
if(isset($_SESSION["order_placed"])){
?>
<div class="alert alert-success alert-dismissible fade show animated fadeInUp" role="alert" style="position: fixed; top: 5%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
    Order Placed Successfully
    <button type="button" class="btn btn-link close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
 unset($_SESSION["order_placed"]);
 }
?>

<!-- LOGIN FORM MODAL -->
        <?php include_once "LoginSignupModal.php";?>
<!-- CART -->
        <?php include_once "AddToCart.php";?>

<!-- <script src="assets/js/customer.js"></script> -->
<script>
$(document).ready(function() {

    
    // Get the customer ID from the input element or your session
    var customerId = $("#userid_forCART").val();
 // Replace with the actual way you store the customer ID
    // Function to fetch and update content
    function fetchAndUpdateContent() {
        // Perform an Ajax request to fetch product data
        $.ajax({
            type: 'GET',
            url: 'controller/fetch_product_cart.php',
            data: { customer_id: customerId },
            success: function(data) {
                // Update the product container with new data
                // var total = 0;
                // data.forEach(function(product) {
                //     total += parseFloat(product.subtotal);
                // });

                // $('#totalPrice').text('Sub Total: ₱' + total.toFixed(2));

                updateContent(data);
            },
            error: function(xhr, status, error) {
                console.log('Error fetching product data:', error);
            }
        });
    }

    // Function to update the product container with new data
 // Function to update the product container with new data
function updateContent(data) {
    // Initialize an empty product content variable
    var productContent = '';
    var total = 0; 
    // Iterate over each product and append its HTML content
    data.forEach(function(product) {
        // Assuming product.price and product.quantity are numeric values
        var price = parseFloat(product.price);
        var quantity = parseInt(product.quantity);

        // Calculate subtotal
        var subtotal = price * quantity;
        total += subtotal;

        productContent += `
            <div class="col-md-4 Shopping">
                <img src="${product.image_url}" class="card-img-top" alt="Product Image" style="height: 100px; width: 70px;">
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">${product.product_name}
                        <input type="hidden" name="p_name[]" value="${product.product_name}">
                        <input type="hidden" name="p__id" value="${product.product_id}">
                        <input type="hidden" name="cart_id" value="${product.cartids}">
                        <button type="button" class="btn btn-link" style="float: right; border: none; text-decoration: underline;">Remove</button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form-control-static" style="float: left;">${product.sizename}</p>
                                <input type="hidden" name="size_name[]" value="${product.sizename}">
                            </div>
                            <div class="col-sm-6">
                                <p class="form-control-static" style="float: left;"><span style="color: blue;">Addons:</span> ${product.addonsname}</p>
                                <input type="hidden" name="addons_name[]" value="${product.addonsname}">
                            </div>
                            <div class="col-sm-6">
                                <p class="form-control-static price" style="float: left;">₱ ${product.price}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form-control-static quantity" style="float: left;"><span style="color: blue;">Quantity:</span> ${product.quantity}</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="form-control-static subtotal" style="float: left;"><span style="color: blue;">Subtotal:</span> ₱ ${subtotal.toFixed(2)}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });

    // Update the container with the new content
    $('#productContainer').html(productContent);
    $('#totalPrice').text('Sub Total: ₱' + total.toFixed(2));
}


         // Assuming you want two decimal places

//     $('#checkoutButton').click(function() {
//     // Initialize arrays to store cart items
//     var cartIds = [];
//     var quantities = [];

//     // Loop through each product and capture the values
//     $('#productContainer .card').each(function() {
//         var cartId = $(this).find('input[name="cart_id"]').val();
//         var quantity = $(this).find('input[name="quantity"]').val();

//         // Add the values to their respective arrays
//         cartIds.push(cartId);
//         quantities.push(quantity);
//     });

//     console.log(cartIds);
//     console.log(customerId); // Make sure customerId is defined and holds the correct value
//     console.log(quantities);

//     // Send the data to the PHP file using AJAX
//     $.ajax({
//     type: 'POST',
//     url: 'includes/CheckoutCart.php',
//     contentType: 'application/json',
//     data: JSON.stringify({
//         cartIds: cartIds,
//         customerIds: customerId,
//         quantities: quantities
//     }),
//     dataType: 'html', // Set the dataType to 'html'
//     success: function(response) {
//         // This will contain the HTML response from the server
//         // You can insert it into your page as needed
//         $('#yourTargetElement').html(response); // Replace #yourTargetElement with the actual target element
//     },
//     error: function(xhr, status, error) {
//         console.log('Error:', error);
//     }
// });


//     // Optionally, you can use window.location.href to redirect to another page
//     window.location.href = 'includes/CheckoutCart.php'; // Redirect to the PHP file
// });

// function fetchOrdersAlertDiv() {
//             $.ajax({
//                 url: '../controller/AlertOrderComplete.php',
//                 type: 'GET',
//                 data: {customer_id: customerId},
//                 dataType: 'json',
//                 success: function (response) {
//                     // Clear the existing alertContainer
//                     $('#alertContainer').empty();

//                     // Iterate over orders and append new order alerts
//                     response.orders.forEach(function (order) {
//                         // Create the alertDiv for the current order
//                         var alertDiv = $('<div>', {
//                             class: 'alert alert-warning alert-dismissible fade show',
//                             role: 'alert',
//                             html: '<strong>Alert!</strong> A new order has been placed.' +
//                                 '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
//                                 '<span aria-hidden="true">&times;</span></button>' +
//                                 '<div class="mt-2 orderText"><p>Order #' + order.orderId + '</p></div>'
//                         });

//                         // Append the alertDiv to the alertContainer
//                         $('#alertContainer').append(alertDiv);

//                         $('#alertContainer').on('click', '.close', function () {
//                             // Get the orderId from the parent alertDiv
//                             var orderId = $(this).closest('.alert').find('.orderText p').text().match(/\d+/)[0];

//                             // Call the updateDatabase function
//                             UpdateSeenOrder(orderId);

//                         });

//                         $('#alertContainer').on('click', '.alert', function () {
//                             // Get the orderId from the clicked alertDiv
//                             var orderId = $(this).find('.orderText p').text().match(/\d+/)[0];
//                             // Redirect to another page (replace 'your_page_url' with the actual URL)
//                             UpdateSeenOrder(orderId);
//                             window.location.href = 'AdminOrders.php';
//                         });
//                     });

//                     // Set the newOrders variable based on the number of new orders
                 
//                 },
//                 error: function (xhr, status, error) {
//                     console.log("Error: " + error);
//                 }
//             });
//         }

        // Call the function to start fetching orders
        // setInterval(fetchOrdersAlertDiv, 5000);

        // Initial fetch when the page loads
        // fetchOrdersAlertDiv();


    // Attach a click event handler to the button
    $('#cart-toggle').click(function() {
        // Fetch and update content when the button is clicked
        fetchAndUpdateContent();
    });

    // Initial fetch and update when the page loads
    fetchAndUpdateContent();


function removeProductFromCart(customerId, cart_id) {
    // Perform an Ajax request to update the cart with isRemove set to true
    $.ajax({
        type: 'POST',
        url: 'controller/update_remove_cart.php', // Replace with the URL for your update script
        data: {
            customer_id: customerId,
            cartid: cart_id,
        },
        success: function(response) {
            // If the update is successful, you can refresh the cart content
            if (response.success) {
                fetchAndUpdateContent();
            } else {
                console.log('Failed to update the cart.');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error updating the cart:', error);
        }
    });
}

    // Attach a click event handler to the "Remove" button
$('#productContainer').on('click', '.btn-link', function() {
    var productContainer = $(this).closest('.card');
    var productId = productContainer.find('input[name="p__id"]').val(); // Get the product ID
    var cart_id = productContainer.find('input[name="cart_id"]').val(); 
    // console.log(customerId);
    // Call the removeProductFromCart function
    removeProductFromCart(customerId, cart_id);
});
        

});



</script>





<script>
    // JavaScript to toggle the cart drawer
    const cartToggle = document.getElementById('cart-toggle');
    const cartDrawer = document.getElementById('cart-drawer');
    const backToPreviousButton = document.getElementById('back-to-previous');

    cartToggle.addEventListener('click', () => {
        cartDrawer.classList.toggle('open');
    });

    backToPreviousButton.addEventListener('click', () => {
        cartDrawer.classList.remove('open');
    });
</script>
<script>
        $(document).ready(function() {
        

            // Smooth scrolling for anchor links
            $(".scroll-link").on('click', function(event) {
                // Check if the link is pointing to the current page
                if (this.pathname == window.location.pathname) {
                    if (this.hash != "") {
                        event.preventDefault();

                        // Store hash
                        var hash = this.hash;

                        // Using jQuery's animate() method to add smooth page scroll
                        $('html, body').animate({
                            scrollTop: $(hash).offset().top
                        }, 800, function(){
                            // Add hash (#) to URL when done scrolling (default click behavior)
                            window.location.hash = hash;
                        });
                    }
                } else {
                    // If the link is pointing to another page, navigate to that page
                    window.location.href = this.href;
                }
            });
        });
    </script>

<script>
              var customerId = $("#userid_forCART").val();

                function CheckCart(customerId) {
                    fetch('controller/CountCustomerCarts.php?customerid=' + customerId)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            var badgeContent = data.new_insert_count != 0
                                ? '<span class="badge badge-danger badge-top">' + data.new_insert_count + '</span>'
                                : '<span class="badge badge-danger badge-top"></span>'; // If count is 0, set an empty string

                            document.getElementById('cart-toggle').innerHTML = '<i class="fa-solid fa-cart-shopping fa-lg"></i>' + badgeContent;
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                }   

                // Initial check
                CheckCart(customerId);

                // Periodically check for new inserts (e.g., every 5 seconds)
                setInterval(function () {
                    CheckCart(customerId);
                }, 5000);

            </script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
