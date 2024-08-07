<?php
    include "adminHeader.php";
    require_once "../classes/dbh.classes.php";
    require_once "../classes/StatisticsModel.php";
    $Stat = new StatisticsModel();
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

<div class="stat-main">
    
    <div class="stat-header">
        <div class="stat-title">
            <h1>Statistics</h1>
        </div>

        <div class="stat-dropdown">
            <div class="cont--drop">
                <select name="Stats" id="stats" class = "Stats">
                    <option>Daily</option>
                    <option>Monthly</option>
                    <option>Annual</option>

                </select>

            </div>
        </div>
    </div>


    <div class="stat-container" >
        
        <div class="nav-cont">
            
            <div class="sales-n" id ="sales-n" onclick="toggleContent('sales-cont')">
                <p>Sales Report</p>
            </div>
        
            <div class="product-n" id="product-n" onclick="toggleContent('product-cont')">
                <p>Total Products</p>
            </div>

            <div class="deliveries-n" id ="deliveries-n" onclick="toggleContent('delivers-cont')">
                <p>Total Deliveries</p>
            </div>

            <div class="orders-n" id ="orders-n" onclick="toggleContent('orders-cont')">
                <p>Total Orders</p>
            </div>

            <div class="best-n" id ="best-n" onclick="toggleContent('best-cont')">
                <p>Best Sellers</p>
            </div>

        </div>

        <div class="statistics" id = "statistics">
            
            <div class="graph-content" id = "sales-cont" >

                <div class="data--cont" id = "data--cont">
                    <div class="data-box" id = "data-box">
                        <p class = "data-tag" id = "data-tag">Past Revenue</p>
                        <h2 class = "data-value" id = "past-rev">22,000</h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Current Revenue</p>
                        <h2 class = "data-value" id = "current-rev">10,000</h2>
                    </div>
                    
                    <div class="data-box">
                        <p class = "data-tag">Total Transactions</p>
                        <h2 class = "data-value" id = "transactions">33</h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Date</p>
                        <h2 class = "data-value" id = "date">10-18-23</h2>
                    </div>

                    
                </div>


                <div class="graph-cont">
        
                    <canvas id="salesChart" style="width: 90%; height: 200px;"></canvas>
        
                </div>

                
            </div>

            <div class="graph-content" id = "product-cont" >

                <div class="data--cont">

                    <div class="data-box">
                        <p class = "data-tag">Total Products</p>
                        <h2 class = "data-value" id = "total-product"><?= $Stat->getProductsCount(); ?></h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Total Categories</p>
                        <h2 class = "data-value" id = "total-category"><?= $Stat->getCategoryCount(); ?></h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Combo Meals</p>
                        <h2 class = "data-value" id = "total-combo">10</h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Total Sizes</p>
                        <h2 class = "data-value" id = "total-size"><?= $Stat->getSizesCount(); ?></h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Total Add-ons</p>
                        <h2 class = "data-value" id = "total-adson"><?= $Stat->getAddonsCount(); ?></h2>
                    </div>

                </div>


                <div class="graph-cont">
                                    
                    <canvas id="productChart" style="width: 90%; height: 200px"></canvas>
                    
                </div>

                
            </div>

            <div class="graph-content" id = "delivers-cont" >

                <div class="data--cont">

                    <div class="data-box">
                        <p class = "data-tag">Total Transactions</p>
                        <h2 class = "data-value" id = "transactions">33</h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Order Delivered</p>
                        <h2 class = "data-value" id = "order-delivered">28</h2>
                    </div> 

                    <div class="data-box">
                        <p class = "data-tag">Out for Delivery</p>
                        <h2 class = "data-value" id = "order-delivered">5</h2>
                    </div> 

                    
                </div>


            

                <div class="graph-cont">
                    
                    <canvas id="deliverChart" style="width: 80%; height: 200px"></canvas>
                    
                </div>
                
            </div>

            <div class="graph-content" id = "orders-cont" >

                <div class="data--cont">

                    <div class="data-box">
                        <p class = "data-tag">Total Transactions</p>
                        <h2 class = "data-value" id = "transactions">8</h2>
                    </div>
                

                    <div class="data-box">
                        <p class = "data-tag">Total Orders</p>
                        <h2 class = "data-value" id = "total-order">33</h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Pending Orders</p>
                        <h2 class = "data-value" id = "total-return">9</h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Returned Orders</p>
                        <h2 class = "data-value" id = "total-return">0</h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Cancelled Orders</p>
                        <h2 class = "data-value" id = "total-return">0</h2>
                    </div>

                </div>


                <div class="graph-cont">

                    <canvas id="transacChart" style="width: 80%; height: 200px"></canvas>


                </div>
                
            </div>

            <div class="graph-content" id = "best-cont" >

                <div class="data--cont">
                    
                    <div class="data-box">
                        <p class = "data-tag">Sold Products</p>
                        <h2 class = "data-value" id = "sold-prod">100</h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Mango Shake</p>
                        <h2 class = "data-value" id = "best-prod1">30</h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Macha Frappe</p>
                        <h2 class = "data-value" id = "best-prod2">20</h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Mango Graham</p>
                        <h2 class = "data-value" id = "best-prod3">15</h2>
                    </div>

                    <div class="data-box">
                        <p class = "data-tag">Others</p>
                        <h2 class = "data-value" id = "best-other">35</h2>
                    </div>


                </div>


                <div class="graph-cont">
                    
                    <canvas id="bestChart" style="width: 90%; height: 200px"></canvas>

                </div>

                
            </div> 
        </div> 
        <div class="print-btn">
            <button class = "printBtn" onclick="printDivWithCanvas()" >
            <i class="fa fa-print" aria-hidden="true"></i>
            Print
            </button>
        </div>
    
    </div>
</div>


<script>

    // Sample data for line chart (Total Sales)
    var data = {
        labels: ["October 15, 2023", "October 16, 2023", "October 17, 2023", "Now"],
        datasets:[
            {
                data: [13000, 12000, 22000, 10000],
                backgroundColor: ["red", "blue", "green"],                                        
            },
        ],
    };

    // Create the line chart
    var ctx = document.getElementById("salesChart").getContext("2d");
    var mySalesChart = new Chart(ctx, 
    {
        type: "line",
        data: data,
                                            
    });     

    // Sample data for bar chart (Total Products)
    var data = {
        labels: ["Frappe", "Meal", "Shakes", "Fries", "Cheestea", "Combo Meals"],
        datasets:[
        {
            data: [20, 10, 15, 15, 10, 10],
            backgroundColor: ["red", "blue", "green"],
            barThickness: 40,
        },
        ],
        
    };

    // Creating the bar chart
    var ctx = document.getElementById("productChart").getContext("2d");
    var myProductChart = new Chart(ctx, 
    {
        type: "bar",
        data: data,
        
                                
    });


    // Sample data for the bar chart (Total Deliveries)
    var data = {
        labels: ["October 15, 2023", "October 16, 2023", "October 17, 2023", "Now"],
        datasets:[
        {
            data: [20, 18, 15, 21],
            backgroundColor: ["red", "blue", "green"],
            barThickness: 40,
        },
        ],
    };

    // Create the bar chart
    var ctx = document.getElementById("deliverChart").getContext("2d");
    var myDeliverChart = new Chart(ctx, 
    {
        type: "bar",
        data: data,
        

                                
    });

    // Sample data for the bar chart (Total Orders)
    var data = {
        labels: ["October 15, 2023", "October 16, 2023", "October 17, 2023", "Now"],
        datasets:[
        {
            data: [20, 18, 15, 21],
            backgroundColor: ["red", "blue", "green"],
            barThickness: 40,
        },
        ],
    };

    // Create the bar chart
    var ctx = document.getElementById("transacChart").getContext("2d");
    var myTransacChart = new Chart(ctx, 
    {
        type: "bar",
        data: data,
        
                                
    });


    // Sample data for the bar chart (Best Selling Products)
    var data = {
        labels: ["Mango Shake", "Macha Frappe", "Mango Graham" ],
        datasets:[
        {
            data: [ 30, 20, 15, ],
            backgroundColor: ["red", "blue", "green", ],
            barThickness: 40,
        },
        ],
    };

    // Create the bar chart
    var ctx = document.getElementById("bestChart").getContext("2d");
    var mybestChart = new Chart(ctx, 
    {
        type: "bar",
        data: data,
                                
    });
    


    // Initially show the default content
    document.getElementById('sales-cont').style.display = 'block';
    document.getElementById('product-cont').style.display = 'none';
    document.getElementById('delivers-cont').style.display = 'none';
    document.getElementById('orders-cont').style.display = 'none';
    document.getElementById('best-cont').style.display = 'none';
    

    function toggleContent(contentId) {
        const content = document.getElementById(contentId);

        // Get all elements with the class 'graph-content'
        const contents = document.querySelectorAll('.graph-content');

        // Hide all content divs except for the selected content
        contents.forEach(div => {
            if (div.id === contentId) {
                div.style.display = 'block';
            } else {
                div.style.display = 'none';
            }
        });
    }

    function printDivWithCanvas() {
            var printableDiv = document.getElementById('statistics').outerHTML;
            var printWindow = window.open('', '', 'width=900, height=1200');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Japcha Statistics</title>');
            printWindow.document.write('<link rel="stylesheet"  href="../assets/css/adminStat.css">'); // Link your CSS file
            printWindow.document.write('</head><body>');
            printWindow.document.write(printableDiv);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            
       
            
            printWindow.onload = function () {
                printWindow.print();
                printWindow.close();
            };
        }
    

</script>



<?php
    include "adminFooter.php";
?>
