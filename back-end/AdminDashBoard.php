<?php
    // date_default_timezone_set('Asia/Manila');

    include "adminHeader.php";
    require_once "../classes/dbh.classes.php";
    require_once "../classes/StatisticsModel.php";
    $Stat = new StatisticsModel();
?>
<link rel="stylesheet" href="../assets/css/admindashboard.css">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
<!-- <link rel="stylesheet" href="adminDashboard.css"> -->
<?php
        if(isset($_SESSION["dashboardview"]) && $_SESSION["dashboardview"] == 1){                 
?>    
<style>

  .card-header{
    /* background-color: pink; */
    background-color: transparent;
  }

  .more-info{
    font-size: 20px;
  }

  .Products{
    background-color: #a6e3ff;
    box-shadow: -1px 2px 4px 1px rgba(0, 0, 0, 0.25);
  }

  .Sales {
    background-color: #a1f1c2;
    box-shadow: -1px 2px 4px 1px rgba(0, 0, 0, 0.25);
  }

  .Orders{
    background-color: #e4b8f8;
    box-shadow: -1px 2px 4px 1px rgba(0, 0, 0, 0.25);
  }

  .Deliveries{
    background-color: #eaefa9;
    box-shadow: -1px 2px 4px 1px rgba(0, 0, 0, 0.25);
  }

  </style>
<div class="container mt-4 mr-0 mb-0 pd-0 pl-0  float: right;" >
    <p class="Dashboard text-left"  style="margin-top: 50px;">Dashboard</p>
      <div class="row">

        <div class="col-md-3">
          <div class="card" style="width: 270px; margin-left: 20px;">
            <div class="card-header Products py-3 text-center ">
            <h5 class="card-header">TOTAL PRODUCTS</h5>
        
                <div class="card-body">
                <span><?php echo date('F j, Y'); ?></span>
                <h1 class="card-title prodCount"></h1>
                  <div class="more-info">
                <a href="adminProducts.php" id="#">More Info</a>
              </div>
              </div>
            </div>
          </div>
        </div>
    
        <div class="col-md-3">
          <div class="card" style="width: 270px; ">
            <div class="card-header Sales py-3 text-center">       
                <h5 class="card-header">TOTAL SALES </h5>
      
              <!-- <h1 class="card-title totalSales"></h1>
                    <div class="more-info">
                      <a href="AdminStatistics_v2.php" id="#">More Info</a>
                    </div> -->

                <div class="card-body pr-0 pl-0">
                   <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                   
                      <div class="carousel-inner">

                        <div class="carousel-item active">
                          <span class="totalSales_day"></span>
                          <h1 class="card-title totalSales"></h1>
                        </div>

                        <div class="carousel-item">
                           <span class="totalSales_week"></span>
                          <h1 class="card-title totalSalesWeek"></h1>
                        </div>

                        <div class="carousel-item">
                          <span class="totalSales_month"></span>
                          <h1 class="card-title totalSalesMonth"></h1>
                        </div>

                        <div class="carousel-item">
                          <span class="totalSales_year"></span>
                          <h1 class="card-title totalSalesYear"></h1>
                        </div>

                      </div>

                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>

                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                  </div>

                    <div class="more-info">
                      <a href="AdminStatistics_v2.php" id="#">More Info</a>
                    </div>
                </div>
            </div>
          </div>
        </div>
    
        <div class="col-md-3">
          <div class="card" style="width: 270px;">
            <div class="card-header Orders py-3 text-center">
            <h5 class="card-header ">ORDER COMPLETED</h5>

                <!-- <h1 class="card-title orderCount"></h1>
                  <div class="more-info">
                    <a href="AdminOrders.php" id="#">More Info</a>
                  </div> -->
                <div class="card-body">
                    <div id="carouselOrderCompleted" class="carousel slide" data-ride="carousel">
                      
                      <div class="carousel-inner">

                        <div class="carousel-item active">
                          <span class="ordercount_day"></span>
                          <h1 class="card-title orderCount"></h1>
                        </div>

                        <div class="carousel-item">
                          <span class="ordercount_weeks"></span>
                            <h1 class="card-title orderCount_week"></h1>
                        </div>

                        <div class="carousel-item">
                          <span class="ordercount_months"></span>
                          <h1 class="card-title orderCount_month"></h1>
                        </div>

                        <div class="carousel-item">
                          <span class="ordercount_years"></span>
                          <h1 class="card-title orderCount_year"></h1>
                        </div>

                      </div>

                      <a class="carousel-control-prev" href="#carouselOrderCompleted" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>

                      <a class="carousel-control-next" href="#carouselOrderCompleted" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                  </div>

                    <div class="more-info">
                      <a href="AdminStatistics_v2.php" id="#">More Info</a>
                    </div>
                </div>
          </div>
        </div>
        </div>
    
        <div class="col-md-3">
          <div class="card" style="width: 270px;">
            <div class="card-header Deliveries py-3 text-center">
            <h5 class="card-header ">TOTAL DELIVERIES</h5>
     
                <div class="card-body">
                <span><?php echo date('F j, Y'); ?></span>
                <h1 class="card-title DeliveryCount"></h1>
              <div class="more-info">
                <a href="AdminOrders.php" id="#">More Info</a>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="row2">
      <div class="col-12 col-xl-8 mb-4 mb-lg-0">
            <div class="card">
                <h5 class="card-header" style="background-color: white;">Active Orders</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Order No.</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Total</th>
                                <th scope="col">Payment Mode</th>
                                <!-- <th scope="col"></th> -->
                              </tr>
                            </thead>
                            <tbody id="table-body-dashboard">
                            </tbody>
                          </table>
                    </div>
                      <a href="AdminOrders.php" class="btn btn-block btn-light">View all</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <!-- Another widget will go here -->
        </div>
    
</div>
<?php
      }
?>
<script>
  $(document).ready(async function() {
    // Call the function to fetch and display the product count
    await fetchProductCount();
    await fetchTotalOrders();
    await fetchTotalDeliveries();
    await fetchTotalSales();
    await fetchTotalSalesWeek();
    await fetchTotalSalesMonth();
    await fetchTotalSalesYear();
    await fetchTotalOrdersWeek();
    await fetchTotalOrdersMonth();
    await fetchTotalOrdersYear();
    function fetchProductCount() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
            type: 'GET',
            data:{product: "product"},
            dataType: 'json',
            success: function(response) {
                // Update the card with the fetched product count
                updateProductCount(response.count);
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
      });
      
    }

// total orders

    function fetchTotalOrders() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
            type: 'GET',
            data:{order: "order"},
            dataType: 'json',
            success: function(response) {
                // Update the card with the fetched product count
                updateOrderCount(response.countOrder.new_insert_count);
                $('.ordercount_day').text(response.countOrder.current_date);

            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
      });
      
    }

    function fetchTotalOrdersWeek() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
            type: 'GET',
            data:{order_week: "order"},
            dataType: 'json',
            success: function(response) {
                // Update the card with the fetched product count
                $('.orderCount_week').text(response.countOrder.weekly);
                $('.ordercount_weeks').text(response.countOrder.week_format);

            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
      });
      
    }

    function fetchTotalOrdersMonth() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
            type: 'GET',
            data:{order_month: "order"},
            dataType: 'json',
            success: function(response) {
                // Update the card with the fetched product count
                $('.orderCount_month').text(response.countOrder.monthly);
                $('.ordercount_months').text(response.countOrder.month_format);

            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
      });
      
    }




    function fetchTotalOrdersYear() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
            type: 'GET',
            data:{order_year: "order"},
            dataType: 'json',
            success: function(response) {
                // Update the card with the fetched product count
                $('.orderCount_year').text(response.countOrder.yearly);
                $('.ordercount_years').text(response.countOrder.year_format);

            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
      });
      
    }



    function fetchTotalDeliveries() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
            type: 'GET',
            data:{deliveries: "deliveries"},
            dataType: 'json',
            success: function(response) {
                // Update the card with the fetched product count
                updateDeliveriesCount(response.CountDeliver)
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
      });
    }

// SALES - START
    function fetchTotalSales() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
            type: 'GET',
            data:{sales: "sales"},
            dataType: 'json',
            success: function(response) {
              console.log(response.CountTotalSales);
                // Update the card with the fetched product 
                var formattedTotalSales = parseFloat(response.CountTotalSales.totalPrice).toFixed(2);

                updateTotalSales(formattedTotalSales);
        
                $('.totalSales_day').text(response.CountTotalSales.formattedToday);
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
      });
    }

    function fetchTotalSalesWeek() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
            type: 'GET',
            data:{sales_week: "sales"},
            dataType: 'json',
            success: function(response) {
              console.log(response.CountTotalSales);
                // Update the card with the fetched product 
                var formattedTotalSales = parseFloat(response.CountTotalSales.totalPrice).toFixed(2);

                // updateTotalSales(formattedTotalSales);
                $('.totalSalesWeek').text("₱"+formattedTotalSales);
                $('.totalSales_week').text(response.CountTotalSales.formattedWeek);
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
      });
    }

    function fetchTotalSalesMonth() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
            type: 'GET',
            data:{sales_month: "sales"},
            dataType: 'json',
            success: function(response) {
              console.log(response.CountTotalSales);
                // Update the card with the fetched product 
                var formattedTotalSales = parseFloat(response.CountTotalSales.totalPrice).toFixed(2);

                // updateTotalSales(formattedTotalSales);
                $('.totalSalesMonth').text("₱"+formattedTotalSales);
                $('.totalSales_month').text(response.CountTotalSales.formattedMonth);
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
      });
    }

    function fetchTotalSalesYear() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
            type: 'GET',
            data:{sales_years: "sales"},
            dataType: 'json',
            success: function(response) {
              console.log(response.CountTotalSales);
                // Update the card with the fetched product 
                var formattedTotalSales = parseFloat(response.CountTotalSales.totalPrice).toFixed(2);

                // updateTotalSales(formattedTotalSales);
                $('.totalSalesYear').text("₱"+formattedTotalSales);
                $('.totalSales_year').text(response.CountTotalSales.formattedYear);
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
      });
    }
// SALES - END

    function updateProductCount(count) {
        // Update the content of the card with the product count
        $('.prodCount').text(count);
    }

    function updateOrderCount(count) {
        // Update the content of the card with the product count
        $('.orderCount').text(count);
    }

    function updateDeliveriesCount(count) {
        // Update the content of the card with the product count
        $('.DeliveryCount').text(count);
    }

    function updateTotalSales(count) {
        // Update the content of the card with the product count
        $('.totalSales').text("₱"+count);
    }

    function fetchData() {
      new Promise((resolve) =>{
        $.ajax({
            url: '../controller/get_latest_orders.php', // Replace with your server endpoint
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Clear existing table data
                $('#table-body-dashboard').empty();
     
                // Populate table with new data
                data.orders.forEach(function (order){
                  var paymentMethod = '';

                  // Check the payment method and set the corresponding value
                  if (order.payment_cod) {
                      paymentMethod = 'COD';
                  } else if (order.payment_gcash) {
                      paymentMethod = 'GCash';
                  } else if (order.payment_pickup) {
                      paymentMethod = 'Pickup';
                  }

                    var row = '<tr>' +
                        '<th scope="row">' + order.orderId + '</th>' +
                        '<td>' + order.customer_name + order.customer_lname +'</td>' +
                        '<td>' + order.price + '</td>' +
                        '<td>' + paymentMethod + '</td>' +
                        '</tr>';

                    $('#table-body-dashboard').append(row);
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', status, error);
            }
        });
      });
      
    }

    // setInterval(async () => {
    // await fetchOrders();
    // }, 5000);

    // Initial data fetch
    await fetchData();
    
});
</script>


    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" ></script> -->

<?php
    include "adminFooter.php";

?>
