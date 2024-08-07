<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <?php include "c_header.php"; ?>
    <style>
       .container {
    height: auto;
    width: 100%;
    margin-top: 130px;
    margin-left: auto;
    justify-content: center;
    }

    .OrderStatusImg {
        max-width: 100px;
    }

    .nav-item {
        font-weight: bold;
        font-size: 25px;
    }

    .terms {
        margin-top: 90px;
        text-align: center;
    }

    .table {
        margin-top: 20px;
        text-align: center;
        
    }

    .nav-tab .nav-item {
        text-align: center;
        position: relative;
        color: black;
        padding: 20px 4px;
        max-width: 300%;
    }

    .nav-item::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: 10;
        width: 100%;
        height: 5%;
        background: linear-gradient(transparent, black);
        z-index: -1;
        transition: 0.2s;
        transform: scaleY(0);
        border-bottom: 4px solid !important;
    }
    
    .nav-item.active::before {
        transform: scaleY(1);
    }


    .nav.nav-fill {
    width: 280px; 
    }

    .nav-item.nav-link {
        width: 140px; 
    }

    .tab-pane {
        display: flex;
        justify-content: center;
        width: 100%; 
    }
   
    td.center-content{
        vertical-align: middle !important;
    }
    .nav-item .statusBadge{
        position: absolute; top:20px; font-size: 10px;
    }
    .active{
        color: blue !important
    }
    .rating {
  font-size: 24px;
  cursor: pointer;
}

.star {
  color: gray;
  transition: color 0.3s;
}

.star:hover,
.star.active {
  color: gold !important; 
}

    </style>
    
    <div class="container text-center">
     <div class="orderbar">
        <div class="row d-flex" style="width: 100%; justify-content: center;">
            <ul class="nav nav-tab d-flex justify-content-center gap-3" style="gap: 50px;">

                <li class="nav-item">
                    <a class="nav-item nav-link active" id="nav-Pending-tab" data-toggle="tab" href="#nav-Pending" role="tab" aria-controls="nav-Pending" aria-selected="true" > <span class="badge badge-danger statusBadge"></span></a>
                </li>

                <li class="nav-item  ">
                    <a class="nav-item nav-link" id="nav-Prepairing-tab" data-toggle="tab" href="#nav-Prepairing" role="tab" aria-controls="nav-Prepairing" aria-selected="true"> <span class="badge badge-danger statusBadge"></span></a>
                </li>

                

                <li class="nav-item " >
                    <a class="nav-item nav-link" id="nav-ToReceive-tab" data-toggle="tab" href="#nav-ToReceive" role="tab" aria-controls="nav-ToReceive" aria-selected="false"> <span class="badge badge-danger statusBadge"></span></a>
                </li>

                <li class="nav-item  " >
                    <a class="nav-item nav-link" id="nav-ToReview-tab" data-toggle="tab" href="#nav-ToReview" role="tab" aria-controls="nav-ToReview" aria-selected="false"> <span class="badge badge-danger statusBadge"></span></a>
                </li>

                <li class="nav-item " >
                    <a class="nav-item nav-link" id="nav-cancel-tab" data-toggle="tab" href="#nav-cancel" role="tab" aria-controls="nav-cancel" aria-selected="false">Cancelled</a>
                </li>

                    </ul>
                    </div>
                </div>
            </div>



<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close closeReasonModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="reasonID">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closeReasonModal" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


            <script>
                 var customerId = <?php echo json_encode($_SESSION["userid"]); ?>;

function CheckPendingOrder(customerId) {
    fetch('controller/CountPendingOrderFront.php?customerid=' + customerId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            var badgeContent = data.new_insert_count != 0
                ? '<span class="badge badge-danger statusBadge">' + data.new_insert_count + '</span>'
                : ''; // If count is 0, set an empty string

            document.getElementById('nav-Pending-tab').innerHTML = 'Pending ' + badgeContent;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function CheckPreparingOrder(customerId) {
    fetch('controller/CountPreparingOrderFront.php?customerid=' + customerId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            var badgeContent = data.new_insert_count != 0
                ? '<span class="badge badge-danger statusBadge">' + data.new_insert_count + '</span>'
                : ''; // If count is 0, set an empty string

            document.getElementById('nav-Prepairing-tab').innerHTML = 'Preparing ' + badgeContent;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function CheckToReceiveOrder(customerId) {
    fetch('controller/CountToReceiveOrderFront.php?customerid=' + customerId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            var badgeContent = data.new_insert_count != 0
                ? '<span class="badge badge-danger statusBadge">' + data.new_insert_count + '</span>'
                : ''; // If count is 0, set an empty string

            document.getElementById('nav-ToReceive-tab').innerHTML = 'To Receive ' + badgeContent;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function CheckCompletedOrder(customerId) {
    fetch('controller/CountCompleteOrderFront.php?customerid=' + customerId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            var badgeContent = data.new_insert_count != 0
                ? '<span class="badge badge-danger statusBadge">' + data.new_insert_count + '</span>'
                : ''; // If count is 0, set an empty string

            document.getElementById('nav-ToReview-tab').innerHTML = 'Completed ' + badgeContent;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function CheckCancelledOrder(customerId) {
    fetch('controller/CountCompleteOrderFront.php?customeridCancel=' + customerId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            var badgeContent = data.new_insert_count != 0
                ? '<span class="badge badge-danger statusBadge">' + data.new_insert_count + '</span>'
                : ''; // If count is 0, set an empty string

            document.getElementById('nav-cancel-tab').innerHTML = 'Cancelled ' + badgeContent;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

// Initial check
CheckPendingOrder(customerId);
CheckPreparingOrder(customerId);
CheckToReceiveOrder(customerId);
CheckCompletedOrder(customerId);
CheckCancelledOrder(customerId);
// Periodically check for new inserts (e.g., every 5 seconds)
setInterval(function () {
    CheckPendingOrder(customerId);
    CheckPreparingOrder(customerId);
    CheckToReceiveOrder(customerId);
    CheckCompletedOrder(customerId);
    CheckCancelledOrder(customerId);
}, 5000);

            </script>
        
        <div class="tab-content justify-content-center " id="nav-tabContent">

        <div class="tab-pane fade show active" id="nav-Pending" role="tabpanel" aria-labelledby="nav-Pending-tab">
            <!-- <div class="d-flex justify-content-center">ORDER NO. <span></span></div>     -->
            <!-- <button type="button" class="btn btn-link" id="loadOrders">Load Orders</button> -->
            <div id="accordion" style="min-height: 300px;">
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <p style="width: 100%; margin: 0 auto; text-align: center; color: black; font-family: Arial, sans-serif;">No orders yet? go <a href="customerSHOP.php">here</a> to order..</p>
            </div>
            
            
        </div>


            <div class="tab-pane fade" id="nav-Prepairing" role="tabpanel" aria-labelledby="nav-Prepairing-tab">
                <div id="accordion_preparing" style="min-height: 300px;"></div>        
            </div>
        					
            <div class="tab-pane fade" id="nav-ToReceive" role="tabpanel" aria-labelledby="nav-ToReceive-tab">
                <div id="accordion_toreceieve" style="min-height: 300px;"></div>    
			</div>

			<div class="tab-pane fade" id="nav-ToReview" role="tabpanel" aria-labelledby="nav-ToReview-tab">
                <div id="accordion_toreview" style="min-height: 300px;"></div>     
	        </div>

            <div class="tab-pane fade" id="nav-cancel" role="tabpanel" aria-labelledby="nav-cancel-tab">
                <div id="accordion_toship" style="min-height: 300px;"></div>          
			</div>
	</div>
    </div>
    </div>
    </div>
    

    <div class="terms">
    <p>Cancellation will be disabled upon preparation of order, thank you.</p> <br>
    <a href="terms_and_conditions.php" target="_blank">Terms & Conditions</a>
    <br>
  </div>
  <div class="terms">
  
  </div>
<!-- 
  <div class="modal fade" id="ReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->

<style>
    .title{
        width: 30%;
    }
    #txtComment{
        padding: 5px;
    }
</style>
<div class="modal fade" id="ReviewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Product Review</h5>
              <button type="button" class="btn CloseReviewModal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body d-flex flex-row">
              <div class="card-body d-flex justify-content-center p-0" style="width: 40%;">
        
                  <video id="VideoReview" controls style="max-width: 100%; display: none;">
                    <source src="../upload/" type="video/mp4">
                    <p>Your browser does not support the video tag</p>
                  </video>
                
             
                  <img id="ImageReview" src="image/Mango-shake.png" alt="" style="max-width: 100%; display: none;" >
              
              </div>
              <div class="card-body p-2" style="width: 60%;">
              
                    <div class="rating">
                        <span style="font-size: 18px;">Rate: </span>
                        <span class="star" data-rating="1">&#9733;</span>
                        <span class="star" data-rating="2">&#9733;</span>
                        <span class="star" data-rating="3">&#9733;</span>
                        <span class="star" data-rating="4">&#9733;</span>
                        <span class="star" data-rating="5">&#9733;</span>
                    </div>
                <span style="color: red; display: none;" id="empty_review_stars">Please rate the product</span>
                    <input type="hidden" name="rating" id="selected-rating" value="0">

                <div class="body d-flex flex-row gap-2">
                  <label class="title" for="title">Product Name:</label>
                  <p class="card-text pname"> </p>
                </div>
                <div class="body d-flex flex-row gap-2">
                  <label class="title" for = "title">Category:</label>
                  <p class="card-text cname"> sdfdsdfsfsf</p>
                </div>
                <div class="body d-flex flex-column gap-2">
                  <label class="title" for="title">Write your review:</label>
                  <span style="color: red; display: none;" id="empty_review">Empty review field</span>
                  <span style="color: green; display: none;" id="success_review"></span>
                  <textarea name="" id="txtComment" cols="30" rows="6" required></textarea>
                </div>
                <input type="hidden" id="prd_id">
                <input type="hidden" id="pname">
                <input type="hidden" id="cm_id">
                <input type="hidden" id="cm_name">
                <!-- <div class="card-body d-flex flex-row gap-2">
                  <label class="title" for="title">Size:</label>
                  <div class="card-text d-flex flex-row gap-2" >
                  
                    <li class="list-group-item list-group-item-primary p-2 justify-content-betwwen" style="border-radius: 10px">
                    <span class="badge badge-primary badge-pill">₱</span>1231</li>
                  
                  </div>
                </div> -->
              </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="SendReview">Send</button>
                <button type="button" class="btn btn-secondary CloseReviewModal" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>


  <script>
    var userId = <?php echo json_encode($_SESSION["userid"]); ?>; 
    // var cancelledOrders = {}; // Track cancelled orders
    var cancelledOrders = JSON.parse(localStorage.getItem('cancelledOrders')) || {};
    $(document).ready(function() {
    // $("#loadOrders").click(function() {
    
    function fetchAndDisplayOrders(userId) {
    $.ajax({
        url: "controller/get_orders_front_end.php?userId=" + userId,
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.length > 0) {
                $("#accordion").empty(); // Clear existing accordion content

                // Iterate through the orders and create an accordion item for each
                data.forEach(function (order, index) {
                    var orderId = order.orderID;
                    var orderContent = createOrderTable(order);
                    var totalprice = order.total_price;
                    var accordionItem = $(
                        '<div class="card">' +
                        '<div class="card-header" id="heading' + orderId + '">' +
                        '<h5 class="mb-0">' +
                        '<button class="btn btn-link" data-toggle="collapse" data-target="#collapse' + orderId + '" aria-expanded="true" aria-controls="collapse' + orderId + '">' +
                        'ORDER #' + orderId +
                        '</button>' +
                        '</h5>' +
                        '<li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0">Total Price: <span class="badge badge-primary badge-pill ml-1">₱ ' + totalprice + '</span></li></ul>' +
                        '<button class="btn btn-danger cancel-btn" data-orderid="' + orderId + '" data-customerid="' + userId + '">Cancel</button>' +
                        '</div>' +
                        '<div id="collapse' + orderId + '" class="collapse" aria-labelledby="heading' + orderId + '" data-parent="#accordion">' +
                        '<div class="card-body">' +
                        orderContent +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );

                    accordionItem.appendTo("#accordion");
                                    // Attach click event listener to the cancel button
                     accordionItem.find('.cancel-btn').on('click', function() {
                            var orderIdToCancel = $(this).data('orderid');
                            var customerIdToCancel = $(this).data('customerid');
                            cancelOrder(orderIdToCancel, customerIdToCancel);
                        });



                    // Check if the order has been cancelled
                    if (cancelledOrders[orderId] && Date.now() < cancelledOrders[orderId].expiryTime) {
                        disableCancelButton(accordionItem);
                    } 
                });
            }
        },
        error: function () {
            console.log("Failed to load orders.");
        }
    });
   
}

function cancelOrder(orderId, customerId) {
    // Display a confirmation dialog
    var confirmation = confirm("Are you sure you want to cancel this order?");

    if (confirmation) {
    

        $.ajax({
            url: 'controller/CancelOrderFront.php', // Replace with your server-side endpoint
            type: 'POST',
            data: {
                order_id: orderId,
                customer_id: customerId
            },
            dataType: 'json',
            success: function (response) {
                // Handle success response
            
                if (response.status == 'success') {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function (error) {
                // Handle error response
                console.error('Error Request Cancellation order:');
                // Optionally, display an error message or perform any other actions
            }
        });
    } else {
        // User clicked "Cancel" in the confirmation dialog
        console.log("Cancellation aborted.");
        // Optionally, you can perform some action if the user decides not to cancel
    }
}


// Call the function with the userId
fetchAndDisplayOrders(<?php echo json_encode($_SESSION["userid"]); ?>);

    // });
    function disableCancelButton(accordionItem) {
        var cancelBtn = accordionItem.find(".cancel-btn");
        cancelBtn.prop("disabled", true);
        cancelBtn.text("Cancelled"); // Optional: Change button text
    }

    function createOrderTable(order, isCompleted = false) {
    var table = '<table class="table">' +
        '<thead>' +
        '<tr>' +
        '<th scope="col"></th>' +
        '<th scope="col">Product Name</th>' +
        '<th scope="col">Size</th>' +
        '<th scope="col">Price</th>' +
        '<th scope="col">Quantity</th>' +
        '<th scope="col">Addons</th>' +
        '<th scope="col">Item Subtotal</th>';
    
    // Add an additional column for the Action if it's the preparing page
    if (isCompleted) {
        table += '<th scope="col">Rate Products</th>';
    }

    table += '</tr>' +
        '</thead>' +
        '<tbody>';

    order.products.forEach(function(product) {
        // Add rows for each product
        table += '<tr>' +
            '<td class="center-content"><img class="card-img-top OrderStatusImg" src="upload/' + product.image_url + '" alt="Card image cap" style=""></td>' +
            '<td class="center-content">' + product.product_name + '</td>' +
            '<td class="center-content">' + product.size_name + '</td>' +
            '<td class="center-content">' + product.product_price + '</td>' +
            '<td class="center-content"><span>' + product.quantity + '</span></td>' +
            '<td class="center-content">' + product.addons_name + ' <span>' + product.addons_price + '</span></td>' +
            '<td class="center-content">' + product.subtotal + '</td>';
        
        // Add an additional cell for the Action if it's the preparing page
        if (isCompleted) {
            table += '<td class="center-content"><button class="btn btn-link btnREVIEW" data-toggle="modal" data-target="#ReviewModal" data-tooltip="tooltip" title="Write a review" data-pnam="'+ product.product_name +'" data-c_name="'+ product.category_name +'" data-cfname="'+order.customer_fname+'" data-clname="'+order.customer_lname+'" data-customerid="'+ product.customer_id +'" data-media_url="' + product.image_url + '" data-productid="'+ product.product_id+'"><i class="fa fa-star" aria-hidden="true"></i></button></td>';
        }
        
        table += '</tr>';
    });

    $(document).on("click", ".btnREVIEW", function() {
        // Assuming product.media_url is the URL of the media
        var mediaUrl = $(this).data('media_url');
        var customername = $(this).data('cname')  + ' ' + $(this).data('clname');
        console.log($(this).data('productid'));
        // Update the text content of the elements with class pname and cname
        $(".pname").text($(this).data('pnam'));
        $(".cname").text($(this).data('c_name'));
 
        $("#ImageReview").attr('src', 'upload/' + mediaUrl);
        $("#ImageReview").show();

        $("#prd_id").val($(this).data('productid'));
        $("#cm_id").val($(this).data('customerid'));
        var customername = $(this).data('cfname')  + ' ' + $(this).data('clname');
        $("#cm_name").val(customername);

        $("#pname").val($(this).data('pnam'));

        // // Show the modal
        // $("#ReviewModal").modal('show');
    });

    $('#ReviewModal').find('.CloseReviewModal').on('click', function () {
        $('#ReviewModal').modal('hide');
    });

        table += '</tbody></table>';
        return table;
    }


    $("#nav-Prepairing-tab").on("click", function () {
    // Call the function with the userId
    fetchAndDisplayOrdersPreparing(<?php echo json_encode($_SESSION["userid"]); ?>);
});

let selectedRating = 0;

$('.star').click(function() {
  const rating = $(this).data('rating');
  updateStars(rating);
  selectedRating = rating;
});



function updateStars(rating) {
  $('.star').removeClass('active');
  for (let i = 1; i <= rating; i++) {
    $('.star[data-rating="' + i + '"]').addClass('active');
  }
  $('#selected-rating').val(rating);
}


$("#SendReview").click(function(){
    // Display a confirmation dialog
    var isConfirmed = confirm("Are you sure you want to send the review?");

    // Check the user's response
    if (isConfirmed) {
        let customer_review = $("#txtComment").val();
        let product_id = $("#prd_id").val();
        let product_name = $("#pname").val();
        let customer_id = $("#cm_id").val();
        let customer_name =$("#cm_name").val();

        if(customer_review != "" && selectedRating != 0){
            $.ajax({
                type: 'POST',
                url: 'controller/SendReview.php',
                data:{
                    product_id: product_id,
                    product_name: product_name,
                    customer_id: customer_id,
                    customer_name: customer_name,
                    selectedRating: selectedRating,
                    customer_review: customer_review,
                },
                success: function(response) {
                    console.log(response);

                    $("#empty_review").hide();
                    $("#empty_review").fadeOut();

                    // Directly access properties of the response object
                    if (response.hasOwnProperty('success')) {
                        $("#success_review").fadeIn();
                        $("#success_review").text(response.success);
                        $("#success_review").show();
                                    
                        $("#empty_review_stars").fadeOut();
                        $("#empty_review_stars").hide();
            
                    } else if (response.hasOwnProperty('error')) {
                        $("#empty_review").fadeIn();
                        $("#empty_review").text(response.error);
                        $("#empty_review").show();
                    }
                },
                error: function(xhr, status, error){
                    console.error("Error submitting review:", error);
                }

            });
        }else if(customer_review == ""){
            $("#empty_review").fadeIn();
            $("#empty_review").show();
     
            $("#success_review").hide();
            $("#success_review").fadeOut();

            $("#empty_review_stars").fadeOut();
            $("#empty_review_stars").hide();

        }else{
            $("#empty_review").fadeOut();
            $("#empty_review").hide();
     
            $("#success_review").hide();
            $("#success_review").fadeOut();

            $("#empty_review_stars").fadeIn();
            $("#empty_review_stars").show();
        }
   
    }
});



function fetchAndDisplayOrdersPreparing(userId) {

    $.ajax({
        url: "controller/get_order_front_end_preparing.php?userId=" + userId,
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.length > 0) {
                $("#accordion_preparing").empty(); // Clear existing accordion content

                // Iterate through the orders and create an accordion item for each
                data.forEach(function (order, index) {
                    var orderId = order.orderID;
                    var orderContent = createOrderTable(order, false);
                    var totalprice = order.total_price;
                    var accordionItem = $(
                        '<div class="card">' +
                        '<div class="card-header" id="heading' + orderId + '">' +
                        '<h5 class="mb-0">' +
                        '<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_prepare' + orderId + '" aria-expanded="true" aria-controls="collapse' + orderId + '">' +
                        'ORDER #' + orderId +
                        '</button>' +
                        '</h5>' +
                        '<li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0">Total Price: <span class="badge badge-primary badge-pill ml-1">₱ ' + totalprice + '</span></li></ul>' +
                        '</div>' +
                        '<div id="collapse_prepare' + orderId + '" class="collapse" aria-labelledby="heading' + orderId + '" data-parent="#accordion_preparing">' +
                        '<div class="card-body">' +
                        orderContent +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );

                    accordionItem.appendTo("#accordion_preparing");

                });
            }
        },
        error: function () {
            console.log("Failed to load orders.");
        }
    });
}

$("#nav-cancel-tab").on("click", function () {
    // Call the function with the userId
    fetchAndDisplayOrdersToShip(<?php echo json_encode($_SESSION["userid"]); ?>);
});

function fetchAndDisplayOrdersToShip(userId) {

    $.ajax({
        url: "controller/get_orders_front_end_cancelled.php?userId=" + userId,
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.length > 0) {
                $("#accordion_toship").empty(); // Clear existing accordion content

                // Iterate through the orders and create an accordion item for each
                data.forEach(function (order, index) {
                    var orderId = order.orderID;
                    var orderContent = createOrderTable(order, false);
                    var totalprice = order.total_price;
                    var accordionItem = $(
                        '<div class="card">' +
                        '<div class="card-header" id="heading' + orderId + '">' +
                        '<h5 class="mb-0">' +
                        '<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_toship' + orderId + '" aria-expanded="true" aria-controls="collapse' + orderId + '">' +
                        'ORDER #' + orderId +
                        '</button>' +
                        '</h5>' +
                        '<div>' +
                        '</div>' +
                        '<li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0">Total Price: <span class="badge badge-primary badge-pill ml-1">₱ ' + totalprice + '</span></li>' +
                        '<button class="btn btn-link reason-btn" data-toggle="modal" data-target="#exampleModal" data-orderid="' + orderId + '" data-customerid="' + userId + '" data-tooltip="tooltip" title="Cancellation Reason"><i class="fa fa-question-circle" aria-hidden="true"></i></button>' +
                        '</div>' +
                        '<div id="collapse_toship' + orderId + '" class="collapse" aria-labelledby="heading' + orderId + '" data-parent="#accordion_preparing">' +
                        '<div class="card-body">' +
                        orderContent +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );

                    accordionItem.appendTo("#accordion_toship");

                    // Add a click event listener for the reason-btn to dynamically set modal content
                    accordionItem.find('.reason-btn').on('click', function () {
                        $('#exampleModalLabel').text('Order ID: ' + orderId);
                        $("#reasonID").text(order.reason);
                        $('#exampleModal').modal('show');
                    });

                    $('#exampleModal').find('.closeReasonModal').on('click', function () {
                        $('#exampleModal').modal('hide');
                    });
                      
                });
            }
        },
        error: function () {
            console.log("Failed to load orders.");
        }
    });
}


$("#nav-ToReceive-tab").on("click", function () {
    // Call the function with the userId
    fetchAndDisplayOrdersToReceive(<?php echo json_encode($_SESSION["userid"]); ?>);
});

function fetchAndDisplayOrdersToReceive(userId) {
    $.ajax({
        url: "controller/get_orders_front_end_ToReceive.php?userId=" + userId,
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.length > 0) {
                $("#accordion_toreceieve").empty(); // Clear existing accordion content

                // Iterate through the orders and create an accordion item for each
                data.forEach(function (order, index) {
                    var orderId = order.orderID;
                    var orderContent = createOrderTable(order, false);
                    var totalprice = order.total_price;
                    var accordionItem = $(
                        '<div class="card">' +
                        '<div class="card-header" id="heading' + orderId + '">' +
                        '<h5 class="mb-0">' +
                        '<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_toreceive' + orderId + '" aria-expanded="true" aria-controls="collapse' + orderId + '">' +
                        'ORDER #' + orderId +
                        '</button>' +
                        '</h5>' +
                        '<li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0">Total Price: <span class="badge badge-primary badge-pill ml-1">₱ ' + totalprice + '</span></li></ul>' +
                        '</div>' +
                        '<div id="collapse_toreceive' + orderId + '" class="collapse" aria-labelledby="heading' + orderId + '" data-parent="#accordion_preparing">' +
                        '<div class="card-body">' +
                        orderContent +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );

                    accordionItem.appendTo("#accordion_toreceieve");

                });
            }
        },
        error: function () {
            console.log("Failed to load orders.");
        }
    });
}

$("#nav-ToReview-tab").on("click", function () {
    // Call the function with the userId
    fetchAndDisplayOrdersToReview(<?php echo json_encode($_SESSION["userid"]); ?>);
});

function fetchAndDisplayOrdersToReview(userId) {
    $.ajax({
        url: "controller/get_orders_front_end_ToReview.php?userId=" + userId,
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.length > 0) {
                $("#accordion_toreview").empty(); // Clear existing accordion content

                // Iterate through the orders and create an accordion item for each
                data.forEach(function (order, index) {
                    var orderId = order.orderID;
                    var orderContent = createOrderTable(order, true);
                    var totalprice = order.total_price;
                    var accordionItem = $(
                        '<div class="card">' +
                        '<div class="card-header" id="heading' + orderId + '">' +
                        '<h5 class="mb-0">' +
                        '<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_toreview' + orderId + '" aria-expanded="true" aria-controls="collapse' + orderId + '">' +
                        'ORDER #' + orderId +
                        '</button>' +
                        '</h5>' +
                        '<li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0">Total Price: <span class="badge badge-primary badge-pill ml-1">₱ ' + totalprice + '</span></li></ul>' +
                        '</div>' +
                        '<div id="collapse_toreview' + orderId + '" class="collapse" aria-labelledby="heading' + orderId + '" data-parent="#accordion_preparing">' +
                        '<div class="card-body">' +
                        orderContent +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );

                    accordionItem.appendTo("#accordion_toreview");

                });
            }
        },
        error: function () {
            console.log("Failed to load orders.");
        }
    });
}

});

  </script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?php include "c_footer.php"; ?>

