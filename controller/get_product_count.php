<?php

require_once "../classes/dbh.classes.php";
require_once "../classes/StatisticsModel.php";
$Stat = new StatisticsModel();

if(isset($_GET['product'])){
    $productCount = $Stat->getProductsCount();

    echo json_encode(['count' => $productCount]);
    exit;
}

if(isset($_GET['admin'])){
    $adminCount = $Stat->getAdminCount();

    echo json_encode(['count' => $adminCount]);
    exit;
}
// ORDER COMPLETED DASHBOARD

if(isset($_GET['order'])){
    $countOrder = $Stat->CountCompleteOrders();

    echo json_encode(['countOrder' => $countOrder]);
    exit;
}

if(isset($_GET['order_week'])){
    $countOrder = $Stat->CountCompleteOrdersWeek();

    echo json_encode(['countOrder' => $countOrder]);
    exit;
}

if(isset($_GET['order_month'])){
    $countOrder = $Stat->CountCompleteOrdersMonth();

    echo json_encode(['countOrder' => $countOrder]);
    exit;
}

if(isset($_GET['order_year'])){
    $countOrder = $Stat->CountCompleteOrdersYear();

    echo json_encode(['countOrder' => $countOrder]);
    exit;
}

// COMPLETED ORDER - END
// DELIVERIES DASHBOARD

if(isset($_GET['deliveries'])){
    $CountDeliver = $Stat->CountOrderDeliveries();

    echo json_encode(['CountDeliver' => $CountDeliver]);
    exit;
}


///DELIVERIES DASHBOARD

// DASHBOARD ///
if(isset($_GET['sales'])){
    $TotalSales = $Stat->CountTotalPrice();

    echo json_encode(['CountTotalSales' => $TotalSales]);
    exit;
}

if(isset($_GET['sales_week'])){
    $TotalSales = $Stat->CountTotalPriceWeekDashboard();

    echo json_encode(['CountTotalSales' => $TotalSales]);
    exit;
}

if(isset($_GET['sales_month'])){
    $TotalSales = $Stat->CountTotalPriceMonthDashboard();

    echo json_encode(['CountTotalSales' => $TotalSales]);
    exit;
}

if(isset($_GET['sales_years'])){
    $TotalSales = $Stat->CountTotalPriceYearDashboard();

    echo json_encode(['CountTotalSales' => $TotalSales]);
    exit;
}

// DASHBOARD ///
if(isset($_GET['total_order'])){
    $total_order = $Stat->CountTotalCompletedOrder();

    echo json_encode(['CountTotalOrder' => $total_order]);
    exit;
}

if(isset($_GET['sales_overall'])){
    $TotalSales = $Stat->CountTotalPriceOverall();

    echo json_encode(['TotalSales' => $TotalSales]);
    exit;
}


if(isset($_GET['product_sold'])){
    $TotalProductSold = $Stat->CountProductSold();

    echo json_encode(['total_ProductSold' => $TotalProductSold]);
    exit;
}

if(isset($_GET['total_reviews'])){
    $total_reviews = $Stat->CountAllReviews();

    echo json_encode(['total_reveiws' => $total_reviews]);
    exit;
}


if(isset($_GET['days'])){
    // $month = $_GET['month']; // Assuming you pass the month as a parameter, adjust as needed
// Perform database query to get data for the specified month
// ...
$filter = $_GET['days'];
switch ($filter) {
    case 'days':
    case 'weeks':
    case 'months':
    case 'years':
        $data = $Stat->CountTotalQuantityByFilter($filter);
        break;
    default:
        // Handle invalid filter values or provide a default action
        // For example, you might want to return an error message or default to a specific filter
        break;
}


// $data = $Stat->CountTotalQuantityByFilter($filter);

// Format the data as JSON
echo json_encode($data);
exit;
}


if(isset($_GET['best_sellers'])){
    // $month = $_GET['month']; // Assuming you pass the month as a parameter, adjust as needed
// Perform database query to get data for the specified month
// ...
$best_sellers = $Stat->BestSellerProduct();

// Format the data as JSON
echo json_encode($best_sellers);
exit;
}

if (isset($_GET['daily_order'])) {
    // Get the selected time period (Year, Month, Weeks)
 
    // Call the TotalOrderDaily() function to get total order data based on the selected time period
    $DailyOrder = $Stat->TotalOrderDaily();

    // Return the data as JSON
    // header('Content-Type: application/json');
    echo json_encode($DailyOrder);
    exit; // Ensure no further processing is done after sending the JSON response
}

if (isset($_GET['sales_report'])) {
    // Get the selected time period (Year, Month, Weeks)
 
    // Call the TotalOrderDaily() function to get total order data based on the selected time period
    $SalesReport = $Stat->GetTotalPriceDaily();

    // Return the data as JSON
    // header('Content-Type: application/json');
    echo json_encode($SalesReport);
    exit; // Ensure no further processing is done after sending the JSON response
}

if (isset($_GET['sales_product'])) {
    // Get the selected time period (Year, Month, Weeks)
 
    // Call the TotalOrderDaily() function to get total order data based on the selected time period
    $productSalesReport = $Stat->GetTotalProductSalesDaily();

    // Return the data as JSON
    // header('Content-Type: application/json');
    echo json_encode($productSalesReport);
    exit; // Ensure no further processing is done after sending the JSON response
}

if (isset($_GET['Get_Sales_table'])) {
    // Get the selected time period (Year, Month, Weeks)
 
    // Call the TotalOrderDaily() function to get total order data based on the selected time period
    $GetSalesTable = $Stat->TotalOrderDaily();

    // Return the data as JSON
    // header('Content-Type: application/json');
    echo json_encode($GetSalesTable);
    exit; // Ensure no further processing is done after sending the JSON response
}

if (isset($_GET['best_sellers_days'])) {
    $dateRangeType = isset($_GET['date_range_type']) ? $_GET['date_range_type'] : 'Day';

    // Assuming $Stat is an instance of your class
    $get_bestseller_by_dates = $Stat->BestSellerProductByDate($dateRangeType);

    // You can then return or echo the $get_bestseller_by_dates as needed
    echo json_encode($get_bestseller_by_dates);
    exit;
}

if (isset($_GET['total_orders_date_range'])) {
    $dateRangeType = isset($_GET['date_range_type']) ? $_GET['date_range_type'] : 'Day';

    // Assuming $Stat is an instance of your class
    $get_totalorders_by_dates = $Stat->TotalOrderByDates($dateRangeType);

    // You can then return or echo the $get_bestseller_by_dates as needed
    echo json_encode($get_totalorders_by_dates);
    exit;
}

if (isset($_GET['total_sales_date_range'])) {
    $dateRangeType = isset($_GET['date_range_type']) ? $_GET['date_range_type'] : 'Day';

    // Assuming $Stat is an instance of your class
    $get_totalsales_by_dates = $Stat->GetTotalPriceByDateRange($dateRangeType);

    // You can then return or echo the $get_bestseller_by_dates as needed
    echo json_encode($get_totalsales_by_dates);
    exit;
}