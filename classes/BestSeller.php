<?php
    date_default_timezone_set('Asia/Manila');

    class BestSeller extends Dbh {
        public function BestSellerProduct() {
            try {
                // Get the current year and month
                $currentYear = date('Y');
                $currentMonth = date('m');
        
                // Calculate the ISO-8601 week number for the current week
                $currentWeek = date('W');
        
                $stmt = $this->connect()->prepare('SELECT 
                    co.product_id,
                    p.product_name,
                    p.image_url,
                    SUM(co.quantity) as total_quantity
                FROM 
                    `customer_orders` co
                INNER JOIN 
                    product p ON co.product_id = p.product_id
                WHERE 
                    co.`delivered` = 1
                    AND YEAR(co.order_date) = :currentYear
                    AND MONTH(co.order_date) = :currentMonth
                    AND WEEK(co.order_date, 1) = :currentWeek
                GROUP BY 
                    co.product_id
                ORDER BY 
                    total_quantity DESC
                LIMIT 3');
        
                $stmt->bindParam(':currentYear', $currentYear, PDO::PARAM_INT);
                $stmt->bindParam(':currentMonth', $currentMonth, PDO::PARAM_INT);
                $stmt->bindParam(':currentWeek', $currentWeek, PDO::PARAM_INT);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                return $results;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        
        


    }
