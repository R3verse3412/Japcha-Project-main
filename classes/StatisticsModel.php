    <?php
    date_default_timezone_set('Asia/Manila');

    class StatisticsModel extends Dbh {
        public function getProductsCount(){
            try {
                $count = 0;
                // Prepare the SQL query to count the products
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as total_count FROM product p WHERE p.isDeleted != 1 AND p.isHide != 1');
                
                // Execute the query
                if ($stmt->execute()) {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $count = $result['total_count'];
                }
                return $count;

            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location:../back-end/adminStatistic.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function getAdminCount(){
            try {
                $count = 0;
                // Prepare the SQL query to count the products
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as total_count FROM admin_account  WHERE isDeleted != 1');
                
                // Execute the query
                if ($stmt->execute()) {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $count = $result['total_count'];
                }
                return $count;

            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location:../back-end/adminStatistic.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function getCategoryCount(){
            try {
                $count = 0;
                // Prepare the SQL query to count the products
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as total_count FROM categories c WHERE c.isDeleted != 1');
                
                // Execute the query
                if ($stmt->execute()) {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $count = $result['total_count'];
                }
                return $count;

            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location:../back-end/adminStatistic.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function getSizesCount(){
            try {
                $count = 0;
                // Prepare the SQL query to count the products
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as total_count FROM product_sizes ps WHERE ps.isDeleted != 1');
                
                // Execute the query
                if ($stmt->execute()) {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $count = $result['total_count'];
                }
                return $count;

            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location:../back-end/adminStatistic.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function getAddonsCount(){
            try {
                $count = 0;
                // Prepare the SQL query to count the products
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as total_count FROM addons a WHERE a.isDeleted != 1 AND a.isHide != 1');
                
                // Execute the query
                if ($stmt->execute()) {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $count = $result['total_count'];
                }
                return $count;

            } catch (Exception $e) {
                // Log the error or handle it appropriately
                header("location:../back-end/adminStatistic.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
// CompleteOrder
        public function CountCompleteOrders() {
            try {
                // Get today's date
                $today = date('Y-m-d');
                $formattedToday = date('F j Y', strtotime($today));

                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE DATE(`order_date`) = :today AND `completed` = 1');

                $stmt->bindParam(':today', $today, PDO::PARAM_STR);

                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                return [
                    'new_insert_count' => $result['new_insert_count'],
                    'current_date' => $formattedToday,
                ];
            } catch (\Throwable $th) {
                throw $th;
            }
        }


        public function CountCompleteOrdersWeek() {
            try {
                // Get today's date
                $today = date('Y-m-d');
                $formattedToday = date('Y F j', strtotime($today));
        
                // Get the week number of the year
                $weekNumber = date('W', strtotime($today));
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE YEARWEEK(`order_date`, 1) = YEARWEEK(:date, 1) AND `completed` = 1');
        
                $stmt->bindParam(':date', $today, PDO::PARAM_STR);
        
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return [
                    'weekly' => $result['new_insert_count'],
                    'week_format' => date('Y F', strtotime($today)) . ' Week ' . $weekNumber,
                ];
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        
        public function CountCompleteOrdersMonth() {
            try {
                // Get the current month and year
                $month = date('m');
                $year = date('Y');
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE MONTH(`order_date`) = :month AND YEAR(`order_date`) = :year AND `completed` = 1');
        
                $stmt->bindParam(':month', $month, PDO::PARAM_INT);
                $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                // Format the date after the SQL execution
                $formattedDate = date('Y F', strtotime("{$year}-{$month}-01"));
        
                return [
                    'monthly' => $result['new_insert_count'],
                    'month_format' => $formattedDate,
                ];
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        
        
        
        public function CountCompleteOrdersYear() {
            try {
                // Get today's date
                $today = date('Y-m-d');
                $formattedToday = date('Y F j', strtotime($today));
        
                // Get the year
                $year = date('Y', strtotime($today));
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE YEAR(`order_date`) = :year AND `completed` = 1');
        
                $stmt->bindParam(':year', $year, PDO::PARAM_STR);
        
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return [
                    'yearly' => $result['new_insert_count'],
                    'year_format' => $year
                ];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        // total order dashboard - end
        

        public function CountOrderDeliveries() {
            try {

        
                // Get today's date
                $today = date('Y-m-d');
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE DATE(`order_date`) = :today AND `delivery` = 1');
                
                $stmt->bindParam(':today', $today, PDO::PARAM_STR);
                
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function CountTotalOrderPresent() {
            try {
        
                // Get today's date
                $today = date('Y-m-d');
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE DATE(`order_date`) = :today AND isActive = 1 OR (DATE(`order_date`) = :today AND `preparing` = 1 AND isActive = 1) OR (DATE(`order_date`) = :today AND `delivery` = 1  AND isActive = 1) OR (DATE(`order_date`) = :today AND `completed` = 1  AND isActive = 1) AND `cancel` != 1 AND `removed` != 1');
                
                $stmt->bindParam(':today', $today, PDO::PARAM_STR);
                
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function CountTotalCompletedOrder() {
                try {
                    
                    $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE `completed` = 1');

                    
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
                    return $result['new_insert_count'];
                } catch (\Throwable $th) {
                    throw $th;
                }
            }

    // public function CountTotalPrice() {
    //     try {
    //         $today = date('Y-m-d');
    //         $stmt = $this->connect()->prepare('SELECT total_price FROM `order` WHERE DATE(`order_date`) = :today  AND `completed` = 1 ');

    //         $stmt->bindParam(':today', $today, PDO::PARAM_STR);
    //         $stmt->execute();
    //         $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //         $totalPrice = 0;

    //         foreach ($results as $row) {
    //             $totalPrice += $row['total_price'];
    //         }

    //         return $totalPrice;
    //     } catch (\Throwable $th) {
    //         throw $th;
    //     }
    // }

     // sales dashboard // sales dashboard
    public function CountTotalPrice() {
        try {
            $today = date('Y-m-d');
            $formattedToday = date('F j Y', strtotime($today));
    
            $stmt = $this->connect()->prepare('SELECT total_price FROM `order` WHERE DATE(`order_date`) = :today  AND `completed` = 1 ');
    
            $stmt->bindParam(':today', $today, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $totalPrice = 0;
    
            foreach ($results as $row) {
                $totalPrice += $row['total_price'];
            }
    
            return [
                'formattedToday' => $formattedToday,
                'totalPrice' => $totalPrice,
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function CountTotalPriceMonthDashboard() {
        try {
            // Calculate the first and last day of the current month
            $firstDayOfMonth = date('Y-m-01');
            $lastDayOfMonth = date('Y-m-t');
    
            $stmt = $this->connect()->prepare('SELECT total_price FROM `order` WHERE `order_date` BETWEEN :firstDayOfMonth AND :lastDayOfMonth AND `completed` = 1');
    
            $stmt->bindParam(':firstDayOfMonth', $firstDayOfMonth, PDO::PARAM_STR);
            $stmt->bindParam(':lastDayOfMonth', $lastDayOfMonth, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $totalPrice = 0;
    
            foreach ($results as $row) {
                $totalPrice += $row['total_price'];
            }
    
            $formattedMonth = date('Y F', strtotime($firstDayOfMonth));
    
            return [
                'totalPrice' => $totalPrice,
                'formattedMonth' => $formattedMonth,
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function CountTotalPriceYearDashboard() {
        try {
            // Calculate the first and last day of the current year
            $firstDayOfYear = date('Y-01-01');
            $lastDayOfYear = date('Y-12-31');
    
            $stmt = $this->connect()->prepare('SELECT total_price FROM `order` WHERE `order_date` BETWEEN :firstDayOfYear AND :lastDayOfYear AND `completed` = 1');
    
            $stmt->bindParam(':firstDayOfYear', $firstDayOfYear, PDO::PARAM_STR);
            $stmt->bindParam(':lastDayOfYear', $lastDayOfYear, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $totalPrice = 0;
    
            foreach ($results as $row) {
                $totalPrice += $row['total_price'];
            }
    
            $formattedYear = date('Y', strtotime($firstDayOfYear));
    
            return [
                'totalPrice' => $totalPrice,
                'formattedYear' => $formattedYear,
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    

    // SALES DASHBOARD - END
    
    

    public function CountTotalPriceWeekDashboard() {
        try {
            $today = new DateTime('now');
            $formattedToday = $today->format('F j Y');
    
            // Get the current week
            $currentWeek = $today->format('W');
    
            // Calculate the first and last day of the current week
            $firstDayOfWeek = $today->setISODate($today->format('o'), $currentWeek)->format('Y-m-d');
            $lastDayOfWeek = $today->modify('+6 days')->format('Y-m-d');
    
            $stmt = $this->connect()->prepare('SELECT total_price FROM `order` WHERE `order_date` BETWEEN :firstDayOfWeek AND :lastDayOfWeek AND `completed` = 1');
    
            $stmt->bindParam(':firstDayOfWeek', $firstDayOfWeek, PDO::PARAM_STR);
            $stmt->bindParam(':lastDayOfWeek', $lastDayOfWeek, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $totalPrice = 0;
    
            foreach ($results as $row) {
                $totalPrice += $row['total_price'];
            }
    
            $formattedWeek = $today->setISODate($today->format('o'), $currentWeek)->format('Y F \W\e\e\k W');
    
            return [
                'formattedToday' => $formattedToday,
                'totalPrice' => $totalPrice,
                'formattedWeek' => $formattedWeek,
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // sales dashboard
    

    public function CountTotalPriceOverall() {
        try {
            $stmt = $this->connect()->prepare('SELECT SUM(total_price) FROM `order` WHERE  `completed` = 1');
    
            $stmt->execute();
            $totalPrice = $stmt->fetchColumn();
    
            return $totalPrice;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    

    public function CountProductSold() {
        try {
        
            $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `customer_orders` WHERE `delivered` = 1');
            
            
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['new_insert_count'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function countAllReviews() {
        try {
            $stmt = $this->connect()->prepare('SELECT COUNT(*) as totalreview FROM product_review');
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return isset($result['totalreview']) ? (int)$result['totalreview'] : 0;
        } catch (PDOException $e) {
            // Log or handle the exception appropriately
            error_log('Error counting reviews: ' . $e->getMessage());
            return 0; // or throw $e; depending on your application's error-handling strategy
        }
    }
    

    public function CountTotalQuantityByFilter($filter) {
        try {
            // Define default date format and interval
            $dateFormat = "%Y-%m-%d";
            $interval = "1 DAY";

            // Modify date format and interval based on the selected filter
            switch ($filter) {
                case 'weeks':
                    $dateFormat = "%Y-W%u"; // ISO-8601 week format
                    $interval = "1 WEEK";
                    break;
                case 'months':
                    $dateFormat = "%Y-%m";
                    $interval = "1 MONTH";
                    break;
                case 'years':
                    $dateFormat = "%Y";
                    $interval = "1 YEAR";
                    break;
                // Add more cases as needed for other filters

                // Default case for days
                default:
                    break;
            }

            // Prepare the SQL query
            $stmt = $this->connect()->prepare("
            SELECT
                date_group,
                SUM(total_orders) AS total_orders,
                SUM(total_quantity) AS total_quantity,
                SUM(total_revenue) AS total_revenue
            FROM (
                SELECT
                    DATE_FORMAT(co.order_date, '$dateFormat') AS date_group,
                    COUNT(co.order_id) AS total_orders,
                    SUM(co.quantity) AS total_quantity,
                    0 AS total_revenue
                FROM
                    customer_orders co
                WHERE
                    co.delivered = 1
                GROUP BY
                    date_group
        
                UNION ALL
        
                SELECT
                    DATE_FORMAT(o.order_date, '$dateFormat') AS date_group, -- Use the same date as in the first part
                    0 AS total_orders,
                    0 AS total_quantity,
                    SUM(o.total_price) AS total_revenue
                FROM
                    `order` o
                WHERE
                    o.completed = 1
                GROUP BY
                    date_group
            ) AS aggregated_data
            GROUP BY
                date_group
            ORDER BY
                date_group DESC;
        ");
        

            // Execute the query
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Format the data
            $data = [];
            foreach ($results as $row) {
                // Format the date based on the selected filter
                switch ($filter) {
                    case 'weeks':
                        $weekNumber = date('W', strtotime($row['date_group']));
                        $formattedDate = date('F', strtotime($row['date_group'])) . ' Week ' . $weekNumber;
                        break;
                    case 'years':
                        $formattedDate = date('Y', strtotime($row['date_group']));
                        break;
                    case 'months':
                        $formattedDate = date('F', strtotime($row['date_group']));
                        break;
                    default:
                        // For other filters, use the default format
                        $formattedDate = date('F j, Y', strtotime($row['date_group']));
                        break;
                }

                $data[] = ['y' => $formattedDate, 'quantity' => (int)$row['total_quantity'], 'order_count' => (int)$row['total_orders'], 'revenue' => (float)$row['total_revenue']];
            }

            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }




    public function BestSellerProduct() {
        try {
            $stmt = $this->connect()->prepare('SELECT co.product_id, p.product_name, p.image_url, SUM(co.quantity) as total_quantity, co.order_date FROM `customer_orders`co INNER JOIN product p ON co.product_id = p.product_id WHERE co.`delivered` = 1 GROUP BY co.product_id ORDER BY total_quantity DESC');

            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function TotalOrderDaily() {
        try {
            $stmt = $this->connect()->prepare('SELECT COUNT(order_id) as total_orders, 
                                                   SUM(total_price) as total_price,
                                                   CONCAT(DATE_FORMAT(order_date, "%Y-%M-%d"), "-", MOD(WEEK(order_date), 4) + 1) as formatted_date 
                                              FROM `order` 
                                             WHERE `completed` = 1 
                                             GROUP BY formatted_date
                                             ORDER BY order_date DESC');
    
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $results;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    
    
    public function TotalOrderByDates($dateRangeType) {
        try {
            $dateRange = '';
    
            switch ($dateRangeType) {
                case 'Year':
                    $dateRange = 'YEAR(order_date)';
                    break;
                case 'Month':
                    $dateRange = 'LEFT(MONTHNAME(order_date), 3)';
                    break;
                case 'Weeks':
                    $dateRange = 'CONCAT(YEAR(order_date), " - Week ", WEEK(order_date), 1)';
                    break;
                case 'Day':
                    $dateRange = 'CONCAT(LEFT(MONTHNAME(order_date), 3), " ", DAY(order_date))';
                    break;
                // Add more cases as needed
    
                default:
                    $dateRange = 'DATE_FORMAT(order_date, "%Y-%M-%d")';
                    break;
            }
    
            $stmt = $this->connect()->prepare("
                SELECT
                    COUNT(order_id) as total_orders,
                    total_price,
                    {$dateRange} as formatted_date
                FROM
                    `order`
                WHERE
                    `completed` = 1
                GROUP BY
                    formatted_date
                ORDER BY
                    order_date DESC;
            ");
    
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $results;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    

    public function GetTotalPriceDaily() {
        try {
            $stmt = $this->connect()->prepare('SELECT SUM(total_price) as total_price, DATE_FORMAT(order_date, "%M %d %Y") as formatted_date FROM `order` WHERE `completed` = 1 GROUP BY formatted_date');

            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function GetTotalPriceByDateRange($dateRangeType) {
        try {
            $dateRange = '';
    
            switch ($dateRangeType) {
                case 'Year':
                    $dateRange = 'YEAR(order_date)';
                    break;
                case 'Month':
                    $dateRange = 'CONCAT(MONTHNAME(order_date), " ", YEAR(order_date))';
                    break;
                case 'Weeks':
                    $dateRange = 'CONCAT(YEAR(order_date), " - Week ", WEEK(order_date), 1)';
                    break;
                case 'Day':
                    $dateRange = 'CONCAT(YEAR(order_date), " ", LEFT(MONTHNAME(order_date), 3), " ", DAY(order_date))';
                    break;
                // Add more cases as needed
    
                default:
                    $dateRange = 'DATE_FORMAT(order_date, "%M %d %Y")';
                    break;
            }
    
            $stmt = $this->connect()->prepare("
                SELECT
                    SUM(total_price) as total_price,
                    {$dateRange} as formatted_date
                FROM
                    `order`
                WHERE
                    `completed` = 1
                GROUP BY
                    formatted_date
                ORDER BY
                    order_date DESC;
            ");
    
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $results;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    
    

    public function BestSellerProductByDate($dateRangeType) {
        try {
            $dateRange = '';
    
            switch ($dateRangeType) {
                case 'Year':
                    $dateRange = 'YEAR(co.order_date)';
                    break;
                case 'Month':
                    $dateRange = 'CONCAT(LEFT(MONTHNAME(co.order_date), 3)," ", YEAR(co.order_date))';
                    break;
                case 'Weeks':
                    $dateRange = 'CONCAT(LEFT(MONTHNAME(co.order_date), 3)," W-", WEEK(co.order_date, 1))';
                    break;
                case 'Day':
                    $dateRange = 'CONCAT(LEFT(MONTHNAME(co.order_date), 3)," ", DAY(co.order_date))';
                    break;
                // Add more cases as needed
    
                default:
                    $dateRange = 'DATE(co.order_date)';
                    break;
            }
    
            $stmt = $this->connect()->prepare("
                SELECT
                    co.product_id,
                    p.product_name,
                    p.image_url,
                    SUM(co.quantity) as total_quantity,
                    {$dateRange} as formatted_date
                FROM
                    customer_orders co
                INNER JOIN
                    product p ON co.product_id = p.product_id
                WHERE
                    co.delivered = 1
                GROUP BY
                    co.product_id, formatted_date
                ORDER BY
                    co.order_date DESC,
                    total_quantity DESC
                
            ");
    
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $results;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    

    
    public function GetTotalProductSalesDaily() {
        try {
            $stmt = $this->connect()->prepare('SELECT product_name, SUM(quantity * product_price) as total_price, DATE_FORMAT(order_date, "%M %d %Y") as formatted_date FROM `customer_orders` WHERE `delivered` = 1 GROUP BY formatted_date, product_name');

            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function GetCustomerHistoryOrder($customer_id) {
        try {
    
            $orders = array();
            $stmt = $this->connect()->prepare(' SELECT 
            `order_id`, 
            `total_price`, 
            `order_date`, 
            `completed`, 
            `cancel`, 
            `payment_pickup`, 
            `payment_cod`, 
            `payment_gcash`  
        FROM 
            `order` 
        WHERE 
            customer_id = ? 
            AND removed != 1 
            AND (completed = 1 OR (cancel = 1 AND completed = 1))
        ORDER BY 
            order_date DESC');
    
            // Execute the query
            if ($stmt->execute([$customer_id])) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $orders[] = $row;
                }
            }
            
            $stmt->closeCursor();
            return $orders;
        
        } catch (\Throwable $th) {
            //throw $th;
            header("location: ../index.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    
    }

    public function GetCustomerHistoryOrderV2($customer_id) {
        try {
    
            $orders = array();
            $stmt = $this->connect()->prepare(' SELECT 
            `order_id`, 
            `total_price`, 
            `order_date`, 
            `completed`, 
            `cancel`, 
            `payment_pickup`, 
            `payment_cod`, 
            `payment_gcash`  
        FROM 
            `order` 
        WHERE 
            customer_id = ? 
            AND removed != 1 
            AND (completed = 1 OR cancel = 1 )
        ORDER BY 
            order_date DESC');
    
            // Execute the query
            if ($stmt->execute([$customer_id])) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $orders[] = $row;
                }
            }
            
            $stmt->closeCursor();
            return $orders;
        
        } catch (\Throwable $th) {
            //throw $th;
            header("location: ../index.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    
    }


    public function GetCustomerRecentOrders($customer_id) {
        try {
    
            $orders = array();
            $stmt = $this->connect()->prepare('SELECT `order_id`,  `total_price`, `order_date`, `completed`, `payment_pickup`, `payment_cod`, `payment_gcash` FROM `order` WHERE customer_id = ? AND completed = 1  ORDER BY order_date DESC LIMIT 5');
    
            // Execute the query
            if ($stmt->execute([$customer_id])) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $orders[] = $row;
                }
            }
            
            $stmt->closeCursor();
            return $orders;
        
        } catch (\Throwable $th) {
            //throw $th;
            header("location: ../index.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    
    }





    }
