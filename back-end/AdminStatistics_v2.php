<?php
    include "adminHeader.php";
    require_once "../classes/dbh.classes.php";
    require_once "../classes/StatisticsModel.php";
    $Stat = new StatisticsModel();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="print.css" media="print">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
 
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


<style>
    .gradient-1 {
        background: linear-gradient(to bottom, #ff7e5f, #feb47b);
        color: #fff;
    }

    .gradient-2 {
        background: linear-gradient(to bottom, #5f76e8, #7b8fea);
        color: #fff;
    }

    .gradient-3 {
        background: linear-gradient(to bottom, #25b8bd, #44cbf7);
        color: #fff;
    }

    .gradient-4 {
        background: linear-gradient(to bottom, #2ecc71, #87d68d);
        color: #fff;
    }
    
    .print-button {
        display: inline-block;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        color: #fff;
        background-color: #007bff;
        border: 1px solid #007bff;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .print-button:hover {
        background-color: #0056b3;
    }
    
    select {
        width: 30%;
        margin: 0;
        font-size: 100%;
        padding: 5px 10px 5px 10px;
        font-family: Segoe UI, Helvetica, sans-serif;
        border: 0;
        border: 1px solid #D0D0D0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        outline: none;    
        }

        .date-picker-container {
    display: flex;
    align-items: center;
    gap: 10px; /* Puwedeng baguhin ang gap depende sa iyong pangangailangan */
  }

  .date-picker-container select {
    width: auto; /* I-set ang width sa 'auto' para ma-adjust base sa laman */
    margin: 0;
    font-size: 100%;
    padding: 5px 10px 5px 10px;
    font-family: Segoe UI, Helvetica, sans-serif;
    border: 1px solid #D0D0D0;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    outline: none;
  }

  .date-picker-container label {
    margin-right: 10px; /* Puwedeng baguhin ang margin depende sa iyong pangangailangan */
  }

</style>
<?php
                if(isset($_SESSION["statisticsManagement_view"]) && $_SESSION["statisticsManagement_view"] == 1){
?>  
<div class="stat-main">
    <div class="stat-header">
        <div class="stat-title" style="margin-top: 20px;">
            <h1>Statistics</h1>
        </div>
        </div>

        <div class="StatisticsContainer">
    <div class="col-xs-12" style="width: 100%;">
        <div>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Tab 1</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tab 2</a>
            </div>
        </div>

        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="container-fluid mt-3">
                <div class="row"  style="margin-bottom: 50px;">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-black">Products Sold</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-black productSold"></h2>
                                    <!-- <p class="text-black mb-0">Jan - March 2019</p> -->
                                </div>
                                <span class="float-right display-5 opacity-5" style="font-size: 30px;"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-2">
                                <div class="card-body">
                                    <h3 class="card-title text-black">Revenue</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-black ovarallSales"></h2>
                                        <!-- <p class="text-black mb-0">Jan - March 2019</p> -->
                                    </div>
                                    <span class="float-right display-5 opacity-5" style="font-size: 30px;"><i class="fa fa-money"></i></span>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-black">Total Orders</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-black totalOrders"></h2>
                                    <!-- <p class="text-black mb-0">Jan - March 2019</p> -->
                                </div>
                                <span class="float-right display-5 opacity-5" style="font-size: 30px;"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-black">Reviews</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-black totalReviews">4565</h2>
                                    <!-- <p class="text-black mb-0">Jan - March 2019</p> -->
                                </div>
                                <span class="float-right display-5 opacity-5" style="font-size: 30px;"><i class="fa fa-heart"></i></span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                <div class="col-lg-11">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow"> 
                                <div class="card-body pb-0 d-flex justify-content-between">
                                    <div>
                                        <h4 class="mb-1 title_placeholder">Product Sales</h4>
                                        <p class="subtitle_placeholder"></p>
                                        <!-- <h3 class="m-0">$ 12,555</h3> -->
                                    </div>
                                    <div class="d-flex">
                                        <div class="dropdown mr-2">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select Data
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <!-- <a class="dropdown-item" href="#" onclick="changeData('Product Sales')">Product Sales</a> -->
                                                <a class="dropdown-item" href="#" onclick="changeData('Sales Report')">Sales Report</a>
                                                <!-- <a class="dropdown-item" href="#" onclick="changeData('Total Deliveries')">Total Deliveries</a> -->
                                                <a class="dropdown-item" href="#" onclick="changeData('Total Orders')">Total Orders</a>
                                                <a class="dropdown-item" href="#" onclick="changeData('Best Sellers')">Best Sellers</a>
                                            </div>
                                        </div>
                                        <!-- Additional Dropdown -->
                                        <div class="dropdown  mr-2" id="date_range_best_seller" >
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="additionalDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Date
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="additionalDropdownButton" >
                                                <a class="dropdown-item" href="#" onclick="changeDateBestSeller('Year')">Year</a>
                                                <a class="dropdown-item" href="#" onclick="changeDateBestSeller('Month')">Month</a>
                                                <a class="dropdown-item" href="#" onclick="changeDateBestSeller('Weeks')">Weeks</a>
                                                <a class="dropdown-item" href="#" onclick="changeDateBestSeller('Day')">Day</a>
                                                <!-- Add more options as needed -->
                                            </div>                                  
                                        </div>

                                        <!-- DROPDOWN DATE FOR TOTAL ORDERS-->
                                        <div class="dropdown  mr-2" id="date_range_total_orders" style="display: none;">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="additionalDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Date
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="additionalDropdownButton" >
                                                <a class="dropdown-item" href="#" onclick="changeDateTotalOrder('Year')">Year</a>
                                                <a class="dropdown-item" href="#" onclick="changeDateTotalOrder('Month')">Month</a>
                                                <a class="dropdown-item" href="#" onclick="changeDateTotalOrder('Weeks')">Weeks</a>
                                                <a class="dropdown-item" href="#" onclick="changeDateTotalOrder('Day')">Day</a>
                                                <!-- Add more options as needed -->
                                            </div>                                  
                                        </div>

                                         <!-- DROPDOWN DATE FOR TOTAL SALES-->
                                         <div class="dropdown  mr-2" id="date_range_total_sales" style="display: none;">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="additionalDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Date
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="additionalDropdownButton" >
                                                <a class="dropdown-item" href="#" onclick="changeDateTotalSales('Year')">Year</a>
                                                <a class="dropdown-item" href="#" onclick="changeDateTotalSales('Month')">Month</a>
                                                <a class="dropdown-item" href="#" onclick="changeDateTotalSales('Weeks')">Weeks</a>
                                                <a class="dropdown-item" href="#" onclick="changeDateTotalSales('Day')">Day</a>
                                                <!-- Add more options as needed -->
                                            </div>                                  
                                        </div>

                                        <!-- print button -->
                                        <div>
                                            <button class="btn btn-secondary print-button" onclick="printChart()">Print</button>

                                        </div>
                                        <!-- End of Additional Dropdown -->
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas id="chart_widget_2"></canvas>
                                </div>
                                <!-- <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="w-100 mr-2">
                                            <h6>Fruit Tea</h6>
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-danger" style="width: 40%"></div>
                                            </div>
                                        </div>
                                        <div class="ml-2 w-100">
                                            <h6>Iced Tea</h6>
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" style="width: 80%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                    <div class="row"  style="margin-top: 50px;">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Order Summary</h4>
                                    <div class="form-group">
                                        <label for="filter">Filter:</label>
                                        <select id="filter" class="form-control">
                                            <option value="days">Days</option>
                                            <option value="weeks">Weeks</option>
                                            <option value="months">Months</option>
                                            <option value="years">Years</option>
                                        </select>
                                    </div>
                                    <div id="morris-bar-chart"></div>
                                </div>
                            </div>
                            
                        </div>    
                        <!-- <div class="col-lg-3 col-md-6">
                            <div class="card card-widget">
                                <div class="card-body">
                                    <h5 class="text-muted">Order Overview </h5>
                                    <h2 class="mt-4">5680</h2>
                                    <span>Total Revenue</span>
                                    <div class="mt-4">
                                        <h4>30</h4>
                                        <h6>Online Order <span class="pull-right">30%</span></h6>
                                        <div class="progress mb-3" style="height: 7px">
                                            <div class="progress-bar bg-primary" style="width: 30%;" role="progressbar"><span class="sr-only">30% Order</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <h4>20</h4>
                                        <h6 class="m-t-10 text-muted">Cash On Develery <span class="pull-right">20%</span></h6>
                                        <div class="progress mb-3" style="height: 7px">
                                            <div class="progress-bar bg-warning" style="width: 20%;" role="progressbar"><span class="sr-only">20% Order</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

            </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" style="margin-bottom: 500px;">
            <div class="container mt-4">
    <div class="mt-4">
      <h1>Sales Table</h1>
      <div class="date-picker-container">
        <label for="bear-dates">Select Date:</label>
        <select class="bear-weeks" id="bear-weeks"></select> Weeks
        <select class="bear-dates" id="bear-dates"></select> Days
        <select class="bear-months" id="bear-months"></select> Months
        <select class="bear-years" id="bear-years"></select> Years
        <button class="btn btn-secondary" type="button" id="datePickerBtn">Show</button>
    </div>
            <table id="salesTable" class="table table-bordered table-bordered-custom" style="width:1100px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #000;">#</th>
                        <th style="border: 1px solid #000;">Order Count</th>
                        <th style="border: 1px solid #000;">Total Revenue</th>
                        <th style="border: 1px solid #000;">Date (yyyy-mm-dd-weeks)</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- <tr id="TdContainer">
                        <td style="border: 1px solid #000;" id="Count">1</td>
                        <td style="border: 1px solid #000;" id="OrderCount">100</td>
                        <td style="border: 1px solid #000;" id="Total Revenue">$500</td>
                        <td style="border: 1px solid #000;" id="Date">2023-January-02-01</td>
                    </tr>
                    <tr id="TdContainer">
                        <td style="border: 1px solid #000;" id="Count">1</td>
                        <td style="border: 1px solid #000;" id="OrderCount">100</td>
                        <td style="border: 1px solid #000;" id="Total Revenue">$500</td>
                        <td style="border: 1px solid #000;" id="Date">2023-January-02-01</td>
                    </tr>
                    <tr id="TdContainer">
                        <td style="border: 1px solid #000;" id="Count">1</td>
                        <td style="border: 1px solid #000;" id="OrderCount">100</td>
                        <td style="border: 1px solid #000;" id="Total Revenue">$500</td>
                        <td style="border: 1px solid #000;" id="Date">2023-January-02-02</td>
                    </tr>
                    <tr id="TdContainer">
                        <td style="border: 1px solid #000;" id="Count">1</td>
                        <td style="border: 1px solid #000;" id="OrderCount">100</td>
                        <td style="border: 1px solid #000;" id="Total Revenue">$500</td>
                        <td style="border: 1px solid #000;" id="Date">2023-January-02-02</td>
                    </tr> -->
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
            <button class="btn btn-secondary print-button" onclick="printsalesTable()">Print Sales</button>
        </div>
    </div>
</div>    
    </div>
            </div>
        </div>
    </div>
</div>

<script>
 $(document).ready(function () {


    let selectedDate, selectedWeek, selectedMonth, selectedYear;

    // Custom filtering function
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        let dateParts = data[3].split('-');
        let date = new Date(`${dateParts[0]}-${dateParts[1]}-${dateParts[2]}`); // Extract and format the date
        let week = parseInt(dateParts[3]); // Extract the week part

        if (
        (!selectedDate || date.getDate() == selectedDate) &&
        (!selectedWeek || week == selectedWeek) &&
        (!selectedMonth || date.getMonth() == selectedMonth) &&
        (!selectedYear || date.getFullYear() == selectedYear)
        ) {
        return true;
        }
        if
        (
        (!selectedWeek || week == selectedWeek) &&
        (!selectedMonth || date.getMonth() == selectedMonth) 
        ){
        return true;
        }
         
        if(
            (!selectedDate || date.getDate() == selectedDate) ||
            (!selectedWeek || week == selectedWeek) &
        (!selectedYear || date.getFullYear() == selectedYear) &&
        (!selectedMonth || date.getMonth() == selectedMonth) 
        )
        {
            return true;
        }
        
        if(
        (!selectedWeek || week == selectedWeek) &&
        (!selectedYear || date.getFullYear() == selectedYear) &&
        (!selectedMonth || date.getMonth() == selectedMonth) 
        )
        {
            return true;
        }


        return false;
    });

    // Initialize dropdowns
    let today = new Date();
    let maxYear = today.getFullYear();
    let table
    for (let i = 1; i <= 31; i++) {
        $('#bear-dates').append(`<option value="${i}">${i}</option>`);
    }

    for (let i = 0; i <= 4; i++) {
        $('#bear-weeks').append(`<option value="${i}">${i}</option>`);
    }

    // Initialize dropdowns for months using month names
    let monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    for (let i = 0; i < monthNames.length; i++) {
        $('#bear-months').append(`<option value="${i + 1}">${monthNames[i]}</option>`);
    }

    for (let i = maxYear + 1; i >= maxYear - 5; i--) {
        $('#bear-years').append(`<option value="${i}">${i}</option>`);
    }

    // DataTables initialization
    // let table = $('#salesTable').DataTable();
    // Handle date range selection
    $('#datePickerBtn').on('click', function () {
        selectedDate = parseInt($('#bear-dates').val());
        selectedWeek = parseInt($('#bear-weeks').val());
        selectedMonth = parseInt($('#bear-months').val()) - 1; // Months are zero-based
        selectedYear = parseInt($('#bear-years').val());

        table.draw();
    });



    // start
    function appendDataToTable(data) {
        var tableBody = $("#tableBody");

        // Clear existing rows
        tableBody.empty();
        let count = 1;
        // Append new rows
        data.forEach(function (row) {

            var newRow = $("<tr>");
            newRow.append("<td id='id_" + row.id + "' style='border: 1px solid #000;'>" +count+ "</td>");
            newRow.append("<td id='quantity_" + row.id + "' style='border: 1px solid #000;'>" + row.total_orders + "</td>");
            newRow.append("<td id='totalPrice_" + row.id + "' style='border: 1px solid #000;'> ₱" + row.total_price + "</td>");
            newRow.append("<td id='orderDate_" + row.id + "' style='border: 1px solid #000;'>" + row.formatted_date + "</td>");

            tableBody.append(newRow);
            count ++;
        });
    }

    // Make an AJAX request to fetch data from the server
    $.ajax({
        url: '../controller/get_product_count.php', // Replace with the actual endpoint
        type: 'GET',
        data: {Get_Sales_table: "sales_table"},
        dataType: 'json', // Assuming the server returns JSON data
        success: function (data) {
            // Call the function to append data to the table
            appendDataToTable(data);
            // $('#salesTable').DataTable();
            table = $('#salesTable').DataTable();
        },
        error: function (error) {
            console.error('Error fetching data:', error);
        }
    });


});
</script>





<script>
    function printsalesTable() {
    var tableContent = document.getElementById("salesTable").outerHTML;

    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Sales Table</title></head><body>');
    printWindow.document.write('<h1>Sales Table</h1>');
    printWindow.document.write(tableContent);
    printWindow.document.write('</body></html>');

    printWindow.print();
}
    </script>

<script>
    function printChart() {
    // Kunin ang buong nilalaman ng chart-wrapper
    var chartContent = document.querySelector('.chart-wrapper').innerHTML;

    // Kunin ang URI ng graph (ito ay base64-encoded image)
    var chartURI = document.getElementById('chart_widget_2').toDataURL('image/png');

    // I-create ang HTML ng bagong window na maglalaman ng graph
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Chart</title></head><body>');
    printWindow.document.write('<div class="chart-wrapper">' + chartContent + '</div>');
    printWindow.document.write('<img src="' + chartURI + '" alt="Chart Image"/>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    // I-print ang bagong window
    printWindow.print();
}
</script>

<script>
    // Sample data for the chart
    var chartData = {
        labels: [],
        datasets: [
            {
                data: [],
                backgroundColor: [],
                
            },
        ],
    };


    $('.title_placeholder').text("Best Sellers");
            $('.subtitle_placeholder').empty();
            // Fetch best-selling products data from the server
            $.ajax({
                url: '../controller/get_product_count.php', // Replace with the actual path to your PHP file
                method: 'GET',
                dataType: 'json',
                data: { best_sellers: 'best_sellers' }, // Add any additional parameters needed
                success: function(data) {
                    // Update chart data and labels
                    myChart.data.labels = data.map(item => item.product_name);
                    myChart.data.datasets[0].data = data.map(item => item.total_quantity);
                    myChart.data.datasets[0].backgroundColor = data.map(() => getRandomColor()); 
                    myChart.update();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching best sellers:', status, error);
                }
            });
function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

    // Create the chart
    var ctx = document.getElementById("chart_widget_2").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "bar",
        theme: "light2",
        data: chartData,
    });


    function changeData(dataType) {
    // Update the chart data based on the selected data type
    switch (dataType) {
        case 'Best Sellers':
            $('.title_placeholder').text("Best Sellers");
            $('.subtitle_placeholder').empty();
            $('#date_range_best_seller').show();
            $('#date_range_total_orders').hide();
            $('#date_range_total_sales').hide();
            // Fetch best-selling products data from the server
            $.ajax({
                url: '../controller/get_product_count.php', // Replace with the actual path to your PHP file
                method: 'GET',
                dataType: 'json',
                data: { best_sellers: 'best_sellers' }, // Add any additional parameters needed
                success: function(data) {
                    // Update chart data and labels
                    myChart.data.labels = data.map(item => item.product_name);
                    myChart.data.datasets[0].data = data.map(item => item.total_quantity);
                    myChart.data.datasets[0].backgroundColor = data.map(() => getRandomColor()); 
                    myChart.update();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching best sellers:', status, error);
                }
            });
            break;
        case 'Total Orders':
            $('.title_placeholder').text("Total Orders");
            $('.subtitle_placeholder').empty();
            $('#date_range_best_seller').hide();
            $('#date_range_total_sales').hide();
            $('#date_range_total_orders').show();
            $.ajax({
                url: '../controller/get_product_count.php',
                method: 'GET',
                dataType: 'json',
                data: { daily_order: 'daily_order' },
                success: function(data) {
                    // Update chart data and labels
                    if (data.length > 0 && 'formatted_date' in data[0]) {
                        myChart.data.labels = data.map(item => item.formatted_date);
                        myChart.data.datasets[0].data = data.map(item => item.total_orders);
                        
                        myChart.data.datasets[0].backgroundColor = data.map(() => getRandomColor()); 
                        
                        myChart.update();

                        var overallTotal = 0;

                        for (var i = 0; i < data.length; i++) {
                            overallTotal += data[i].total_orders;
                        }

                        $('.subtitle_placeholder').text('Overall Total Orders: ' + overallTotal);

                    } else {
                        console.error('Invalid data structure for Total Orders:', data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching total orders:', status, error);
                }
            });
            break;

        case 'Sales Report':
            $('.title_placeholder').text("Sales Report");
            $('#date_range_best_seller').hide();
            $('#date_range_total_orders').hide();
            $('#date_range_total_sales').show();


            $.ajax({
                url: '../controller/get_product_count.php',
                method: 'GET',
                dataType: 'json',
                data: { sales_report: 'sales_report' },
                success: function(data) {
                    if (data.length > 0 && 'formatted_date' in data[0]) {
                        myChart.data.labels = data.map(item => `${item.formatted_date}\nTotal Price: ${item.total_price} PHP`);
                        myChart.data.datasets[0].data = data.map(item => item.total_price);
                        myChart.data.datasets[0].backgroundColor = data.map(() => getRandomColor()); 
                        myChart.update();

                       // Calculate the overall total of all total prices
                         var overallTotal = data.reduce((acc, item) => acc + parseFloat(item.total_price), 0);
                        $('.subtitle_placeholder').text('Overall Total: ' + overallTotal.toFixed(2) + ' PHP');
                    } else {
                        console.error('Invalid data structure for Total Orders:', data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching total orders:', status, error);
                }
            });
            break;

        // case 'Product Sales':
        //     $('.title_placeholder').text("Product Sales");
        //     $.ajax({
        //         url: '../controller/get_product_count.php',
        //         method: 'GET',
        //         dataType: 'json',
        //         data: { sales_product: 'sales_product' },
        //         success: function(data) {
        //             if (data.length > 0 && 'formatted_date' in data[0]) {
        //                 // Create arrays to store chart data and labels
        //                 var labels = data.map(item => `Product Name: ${item.product_name}\n Date: ${item.formatted_date}`);
        //                 var dataValues = data.map(item => item.total_price);

        //                 // Update chart with the new data
        //                 myChart.data.labels = labels;
        //                 myChart.data.datasets[0].data = dataValues;
        //                 myChart.data.datasets[0].backgroundColor = data.map(() => getRandomColor()); 
        //                 myChart.update();

        //                 // Calculate the overall total of all total prices
        //                 var overallTotal = data.reduce((acc, item) => acc + parseFloat(item.total_price), 0);
        //                 $('.subtitle_placeholder').text('Overall Total: ₱' + overallTotal.toFixed(2));
        //             } else {
        //                 console.error('Invalid data structure for Product Sales:', data);
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error fetching product sales:', status, error);
        //         }
        //     });
        //      break;
        // Handle other cases as needed
        default:
            break;
    }
}

function changeDateBestSeller(dataType) {
    $('.subtitle_placeholder').empty();
    $('#date_range_best_seller').show();

    // Fetch best-selling products data from the server
    $.ajax({
        url: '../controller/get_product_count.php',
        method: 'GET',
        dataType: 'json',
        data: {
            best_sellers_days: 'best_sellers',
            date_range_type: dataType, // Add the selected date range type
        },
        success: function(data) {
            // Update chart data and labels
            myChart.data.labels = data.map(item => `${item.formatted_date} ${item.product_name}`);
            myChart.data.datasets[0].data = data.map(item => item.total_quantity);
            myChart.data.datasets[0].backgroundColor = data.map(() => getRandomColor());
            myChart.update();
        },
        error: function(xhr, status, error) {
            console.error('Error fetching best sellers:', status, error);
        }
    });
}

function changeDateTotalOrder(dataType){
    // $('.subtitle_placeholder').empty();
    $('#date_range_total_orders').show();

    // Fetch best-selling products data from the server
    $.ajax({
        url: '../controller/get_product_count.php',
        method: 'GET',
        dataType: 'json',
        data: {
            total_orders_date_range: 'total_orders',
            date_range_type: dataType, // Add the selected date range type
        },
        success: function(data) {
            // Update chart data and labels
            if (data.length > 0 && 'formatted_date' in data[0]) {
                        myChart.data.labels = data.map(item => item.formatted_date);
                        myChart.data.datasets[0].data = data.map(item => item.total_orders);
                        
                        myChart.data.datasets[0].backgroundColor = data.map(() => getRandomColor()); 
                        
                        myChart.update();

                   
                    } else {
                        console.error('Invalid data structure for Total Orders:', data);
                    }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching best sellers:', status, error);
        }
    });
}

function changeDateTotalSales(dataType){
    $('.title_placeholder').text("Sales Report");
            $.ajax({
                url: '../controller/get_product_count.php',
                method: 'GET',
                dataType: 'json',
                data: {  
                    total_sales_date_range: 'total_orders',
                    date_range_type: dataType, // Add the selected date range type
             },
                success: function(data) {
                    if (data.length > 0 && 'formatted_date' in data[0]) {
                        myChart.data.labels = data.map(item => `${item.formatted_date}\nTotal Price: ${item.total_price} PHP`);
                        myChart.data.datasets[0].data = data.map(item => item.total_price);
                        myChart.data.datasets[0].backgroundColor = data.map(() => getRandomColor()); 
                        myChart.update();

                       // Calculate the overall total of all total prices
                         var overallTotal = data.reduce((acc, item) => acc + parseFloat(item.total_price), 0);
                        $('.subtitle_placeholder').text('Overall Total: ₱' + overallTotal.toFixed(2));
                    } else {
                        console.error('Invalid data structure for Total Orders:', data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching total orders:', status, error);
                }
            });
}

</script>


<script>
    $(document).ready(async function () {


    await fetchTotalOrders();
    await fetchTotalSalesOverall();
    await fetchTotalProductSold();
    await fetchTotalReviews();
        // Sample data (replace this with your actual data)
        var data = [
            { y: 'April', a: 50 },
            { y: 'May', a: 75 },
            { y: 'June', a: 30 },
            // Add more data points as needed
        ];

        // Morris.js Bar Chart
        // Morris.Bar({
        //     element: 'morris-bar-chart',
        //     data: data,
        //     xkey: 'y',
        //     ykeys: ['a'],
        //     labels: ['Quantity Sold'],
        //     barColors: ['#007bff'], // Customize the bar color
        //     hideHover: 'auto',
        //     resize: true
        // });

//  MORRISS CHART HERE ###################################


// Function to update the Morris chart with a transition effect
// Function to update the Morris chart with a transition effect
function updateChart(filter) {
    // Hide the existing chart with a fade-out effect
    $('#morris-bar-chart').fadeOut(500, function () {
        // Empty the chart container after fade-out
        $(this).empty();
        new Promise((resolve) =>{
                $.ajax({
                url: '../controller/get_product_count.php',
                type: 'GET',
                data: { days: filter },
                dataType: 'json',
                success: function (data) {
                    renderChart(data);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', status, error);
                }
            });
        });
      
    });
}

var defaultFilter = 'days';
updateChart(defaultFilter);

$('#filter').on('change', function () {
    var selectedFilter = $(this).val();
    updateChart(selectedFilter);
});

// Example: Function to render the Morris chart with a transition effect
function renderChart(data) {
    // Render the new chart with the selected data
    Morris.Bar({
        element: 'morris-bar-chart',
        data: data,
        xkey: 'y',
        ykeys: ['quantity', 'order_count', 'revenue'],
        labels: ['Product Sold', 'Total Order', 'Revenue ₱'],
        barColors: ['#007bff'],
        // hideHover: '',
        resize: true
    });

    // Show the updated chart with a fade-in effect
    $('#morris-bar-chart').fadeIn(500);
}


 



// MORRIS ENDS HEREE
    function fetchTotalOrders() {
        new Promise((resolve) =>{
            $.ajax({
                url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
                type: 'GET',
                data:{total_order: "total_order"},
                dataType: 'json',
                success: function(response) {
                    // Update the card with the fetched product count
                    updateOrderCount(response.CountTotalOrder)
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        });
      
    }

    
    function fetchTotalSalesOverall() {
        new Promise((resolve) =>{
            $.ajax({
                url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
                type: 'GET',
                data:{sales_overall: "sales_overall"},
                dataType: 'json',
                success: function(response) {
                    // Update the card with the fetched product count
                    updateSalesOverall(response.TotalSales)
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        });
      
    }

    function fetchTotalProductSold() {
        new Promise((resolve) =>{
            $.ajax({
                url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
                type: 'GET',
                data:{product_sold: "product_sold"},
                dataType: 'json',
                success: function(response) {
                    // Update the card with the fetched product count
                    updateProductSold(response.total_ProductSold)
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        });
      
    }

    function fetchTotalReviews() {
        new Promise((resolve) =>{
            $.ajax({
                url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
                type: 'GET',
                data:{total_reviews: "total_reviews"},
                dataType: 'json',
                success: function(response) {
                    // Update the card with the fetched product count
                    fetchALlReviews(response.total_reveiws)
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        });
      
    }


    function updateOrderCount(count){
        $('.totalOrders').text(count);
    }

    function updateSalesOverall(count){
        $('.ovarallSales').text(count + " PHP");
    }

    function updateProductSold(count){
        $('.productSold').text(count);
    }

    function fetchALlReviews(count){
        $('.totalReviews').text(count);
    }

    });
</script>

<?php
                }
    include "adminFooter.php";
?>
