<?php
class Order extends Dbh {

    public function setOrder($getOrderNumber, $customerid, $prodid, $product_name, $product_price, $sizesid, $size_name, $subtotal, $quantity, $addons_id, $addons_name, $addons_price, $product_remark, $order_date) {
        try {
            $stmt = $this->connect()->prepare('INSERT INTO `customer_orders` (`orders_id`, `customer_id`, `product_id`, `product_name`, `product_price`, `sizes_id`, `size_name`, `subtotal`, `quantity`, `addons_id`, `addons_name`, `addons_price`, `product_remark`, `order_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    
            // Assuming addons_id can be NULL
            $addons_id_value = ($addons_id !== "") ? $addons_id : null;
    
            $stmt->bindValue(1, $getOrderNumber, PDO::PARAM_INT);
            $stmt->bindValue(2, $customerid, PDO::PARAM_INT);
            $stmt->bindValue(3, $prodid, PDO::PARAM_INT);
            $stmt->bindValue(4, $product_name, PDO::PARAM_STR);
            $stmt->bindValue(5, $product_price, PDO::PARAM_STR);
            $stmt->bindValue(6, $sizesid, PDO::PARAM_INT);
            $stmt->bindValue(7, $size_name, PDO::PARAM_STR);
            $stmt->bindValue(8, $subtotal, PDO::PARAM_STR);
            $stmt->bindValue(9, $quantity, PDO::PARAM_INT);
            
            // Bind addons_id accordingly
            if ($addons_id_value !== null) {
                $stmt->bindValue(10, $addons_id_value, PDO::PARAM_INT);
            } else {
                $stmt->bindValue(10, null, PDO::PARAM_NULL);
            }
    
            $stmt->bindValue(11, $addons_name, PDO::PARAM_STR);
            $stmt->bindValue(12, $addons_price, PDO::PARAM_STR);
            $stmt->bindValue(13, $product_remark, PDO::PARAM_STR);
            $stmt->bindValue(14, $order_date, PDO::PARAM_STR);
            // Execute the query
            $success = $stmt->execute();
    
            // Check if the query was successful
            if (!$success) {
                throw new Exception("Order failed.");
            }
    
            return true;
    
        } catch (\Throwable $th) {
            // Log or handle the exception appropriately
            error_log("Error in setOrder: " . $th->getMessage());
            return false;
        }
    }
    
    
    public function getOrdersV2() {
        try {
            // Set timezone
            date_default_timezone_set('Asia/Manila');
    
            // Get today's date
            $currentDate = date('Y-m-d');
            
            // Get orders
            $orders = [];
            $stmt = $this->connect()->prepare('
                SELECT `order_id`, `customer_id`, `df`, `total_price`, `remark`, `payment_pickup`, `payment_cod`, `customer_address`,`payment_gcash`,`gcash_upload`, `order_date`, `coupon_discount`, `coupon_name`, `coupon_id`, `discount_percent`, `discount_name`, `discount_vaild_id`
                FROM `order`
                WHERE DATE(`order_date`) = :today
                    AND isActive = 1
                    AND preparing != 1
                    AND delivery != 1
                    AND completed != 1
                    AND cancel != 1
                    AND removed != 1
                ORDER BY order_id ASC
            ');
    
            // Bind parameters
            $stmt->bindParam(':today', $currentDate, PDO::PARAM_STR);
    
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $orders[] = $row;
                }
            }
            $stmt->closeCursor();
    
            return $orders;
            
        } catch (\Throwable $th) {
            // Handle the exception
            header("location: ../index.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    }

    public function AlertNewOrder() {
        try {
            // Set timezone
            date_default_timezone_set('Asia/Manila');
    
            // Get today's date
            $currentDate = date('Y-m-d');
            
            // Get orders
            $orders = [];
            $stmt = $this->connect()->prepare('
                SELECT `order_id`, `customer_id`, `df`, `total_price`, `remark`
                FROM `order`
                WHERE DATE(`order_date`) = :today
                    AND isSeen != 1
                    AND isActive = 1
                    AND preparing != 1
                    AND delivery != 1
                    AND completed != 1
                    AND cancel != 1
                    AND removed != 1
                ORDER BY order_id ASC
            ');
    
            // Bind parameters
            $stmt->bindParam(':today', $currentDate, PDO::PARAM_STR);
    
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $orders[] = $row;
                }
            }
            $stmt->closeCursor();
    
            return $orders;
            
        } catch (\Throwable $th) {
            // Handle the exception
            header("location: ../index.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    }
    

public function getOrderNumberByCustomer($customerid) {
    try {

        date_default_timezone_set('Asia/Manila');
    
        // Get today's date
        $currentDate = date('Y-m-d');

        $orders = array();
        $totalPrices = array();
        $count = 0;

        $stmt = $this->connect()->prepare('SELECT `order_id`, `total_price` FROM `order` WHERE customer_id = ? AND preparing != 1 AND delivery != 1 AND completed != 1 AND cancel != 1 AND removed != 1');

        // Bind the parameter
        $stmt->bindParam(1, $customerid, PDO::PARAM_INT);
   
        // Execute the query
        if ($stmt->execute()) {
            // Fetch all order_ids and total_prices directly into arrays
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $orders[] = $row['order_id'];
                $totalPrices[] = $row['total_price'];
            }

            $count = count($orders);
        }

        return array('orders' => $orders, 'total_prices' => $totalPrices, 'count' => $count);

    } catch (\Throwable $th) {
        // Log the error or rethrow the exception for higher-level handling
        error_log('Error in getOrderNumberByCustomer: ' . $th->getMessage());

        // Rethrow the exception
        throw $th;
    }
}

public function getOrderNumberByCustomerPreparing($customerid) {
    try {
        $orders = array();
        $totalPrices = array();
        $count = 0;

        $stmt = $this->connect()->prepare('SELECT `order_id`, `total_price` FROM `order` WHERE customer_id = ? AND preparing = 1 AND delivery != 1 AND completed != 1 AND cancel != 1 AND removed != 1');

        // Bind the parameter
        $stmt->bindParam(1, $customerid, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            // Fetch all order_ids and total_prices directly into arrays
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $orders[] = $row['order_id'];
                $totalPrices[] = $row['total_price'];
            }

            $count = count($orders);
        }

        return array('orders' => $orders, 'total_prices' => $totalPrices, 'count' => $count);

    } catch (\Throwable $th) {
        // Log the error or rethrow the exception for higher-level handling
        error_log('Error in getOrderNumberByCustomer: ' . $th->getMessage());

        // Rethrow the exception
        throw $th;
    }
}
public function getOrderNumberByCustomerDelivery($customerid) {
    try {
        $orders = array();
        $totalPrices = array();
        $count = 0;

        $stmt = $this->connect()->prepare('SELECT `order_id`, `total_price` FROM `order` WHERE customer_id = ? AND preparing != 1 AND delivery = 1 AND completed != 1 AND cancel != 1 AND removed != 1');

        // Bind the parameter
        $stmt->bindParam(1, $customerid, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            // Fetch all order_ids and total_prices directly into arrays
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $orders[] = $row['order_id'];
                $totalPrices[] = $row['total_price'];
            }

            $count = count($orders);
        }

        return array('orders' => $orders, 'total_prices' => $totalPrices, 'count' => $count);

    } catch (\Throwable $th) {
        // Log the error or rethrow the exception for higher-level handling
        error_log('Error in getOrderNumberByCustomer: ' . $th->getMessage());

        // Rethrow the exception
        throw $th;
    }
}
public function getOrderNumberByCustomerComplete($customerid) {
    try {
        $orders = array();
        $totalPrices = array();
        $username = array();
        $lastname = array();
        $count = 0;

        $stmt = $this->connect()->prepare('SELECT o.`order_id`, o.`total_price`, ca.`username`, ca.`last_name` FROM `order` o INNER JOIN `customer_account` ca ON o.`customer_id` = ca.`customer_id` WHERE o.customer_id = ? AND o.preparing != 1 AND o.delivery != 1 AND o.completed = 1 AND o.cancel != 1 AND o.removed != 1 ORDER BY o.order_date DESC');

        // Bind the parameter
        $stmt->bindParam(1, $customerid, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            // Fetch all order_ids and total_prices directly into arrays
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $orders[] = $row['order_id'];
                $totalPrices[] = $row['total_price'];
                $username[] = $row['username'];
                $lastname[] = $row['last_name'];
            }

            $count = count($orders);
        }

        return array('orders' => $orders, 'total_prices' => $totalPrices, 'count' => $count, 'username' =>$username, 'lastname' => $lastname);

    } catch (\Throwable $th) {
        // Log the error or rethrow the exception for higher-level handling
        error_log('Error in getOrderNumberByCustomer: ' . $th->getMessage());

        // Rethrow the exception
        throw $th;
    }
}

public function getOrderNumberByCustomerCancelled($customerid) {
    try {
        $orders = array();
        $totalPrices = array();
        $CancelReason = array();
        $count = 0;

        $stmt = $this->connect()->prepare('SELECT `order_id`, `total_price`, `cancellation_reason` FROM `order` WHERE customer_id = ? AND cancel = 1 AND removed != 1 ORDER BY order_date DESC');

        // Bind the parameter
        $stmt->bindParam(1, $customerid, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            // Fetch all order_ids and total_prices directly into arrays
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $orders[] = $row['order_id'];
                $totalPrices[] = $row['total_price'];
                $CancelReason[] = $row['cancellation_reason'];
            }

            $count = count($orders);
        }

        return array('orders' => $orders, 'total_prices' => $totalPrices, 'cancellation_reason' => $CancelReason,'count' => $count);

    } catch (\Throwable $th) {
        // Log the error or rethrow the exception for higher-level handling
        error_log('Error in getOrderNumberByCustomer: ' . $th->getMessage());

        // Rethrow the exception
        throw $th;
    }
}



public function getOrderNumberOfCustomer($customerid, $totalprice, $order_date) {
    try {
        $stmt = $this->connect()->prepare('SELECT `order_id` FROM `order` WHERE customer_id = ? AND total_price = ? AND order_date = ? AND preparing != 1 AND delivery != 1 AND completed != 1 AND cancel != 1 AND removed != 1');

        // Bind parameters
        $stmt->bindParam(1, $customerid);
        $stmt->bindParam(2, $totalprice);
        $stmt->bindParam(3, $order_date);

        // Execute the query
        if ($stmt->execute()) {
            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Close the cursor
            $stmt->closeCursor();

            // Return the single value
            return $result['order_id'] ?? null;
        } else {
            return null; // or handle the case when the query fails
        }
    } catch (\Throwable $th) {
        // Handle exceptions, you may want to log the error or redirect to an error page
        header("location: ../index.php?errorsada=" . urlencode($th->getMessage()));
        exit();
    }
}



public function getOrderByCustomerV2($ordersid, $customerid) {
    try {
        $orders = array();
        $stmt = $this->connect()->prepare('SELECT co.`order_id`, co.`customer_id`, co.`product_id`, co.`product_name`, co.`product_price`, co.`sizes_id`, co.`size_name`, co.`subtotal`, co.`price`, co.`quantity`, co.`address`, co.`addons_id`, co.`addons_name`, co.`addons_price`, co.`product_remark`, p.image_url FROM `customer_orders` co INNER JOIN product p ON co.`product_id` = p.`product_id` WHERE co.orders_id = ? AND co.customer_id = ? AND co.accepted != 1 AND co.preparing != 1 AND co.shipping != 1 AND co.delivered != 1 AND co.removed != 1 AND co.cancel != 1');

        // Bind the parameters
        $stmt->bindParam(1, $ordersid, PDO::PARAM_INT);
        $stmt->bindParam(2, $customerid, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $orders[] = $row;
            }
        }

        $stmt->closeCursor();
        return $orders;
    } catch (\Throwable $th) {
        // Handle exceptions appropriately, for now redirecting to an error page
        header("location: ../index.php?error=" . urlencode($th->getMessage()));
        exit();
    }
}

public function getOrderByCustomerPrepaing($ordersid, $customerid) {
    try {
        $orders = array();
        $stmt = $this->connect()->prepare('SELECT co.`order_id`, co.`customer_id`, co.`product_id`, co.`product_name`, co.`product_price`, co.`sizes_id`, co.`size_name`, co.`subtotal`, co.`price`, co.`quantity`, co.`address`, co.`addons_id`, co.`addons_name`, co.`addons_price`, co.`product_remark`, p.image_url FROM `customer_orders` co INNER JOIN product p ON co.`product_id` = p.`product_id` WHERE co.orders_id = ? AND co.customer_id = ? AND co.accepted != 1 AND co.preparing = 1 AND co.shipping != 1 AND co.delivered != 1 AND co.removed != 1 AND co.cancel != 1');

        // Bind the parameters
        $stmt->bindParam(1, $ordersid, PDO::PARAM_INT);
        $stmt->bindParam(2, $customerid, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $orders[] = $row;
            }
        }

        $stmt->closeCursor();
        return $orders;
    } catch (\Throwable $th) {
        // Handle exceptions appropriately, for now redirecting to an error page
        header("location: ../index.php?error=" . urlencode($th->getMessage()));
        exit();
    }
}

public function getOrderByCustomerDelivery($ordersid, $customerid) {
    try {
        $orders = array();
        $stmt = $this->connect()->prepare('SELECT co.`order_id`, co.`customer_id`, co.`product_id`, co.`product_name`, co.`product_price`, co.`sizes_id`, co.`size_name`, co.`subtotal`, co.`price`, co.`quantity`, co.`address`, co.`addons_id`, co.`addons_name`, co.`addons_price`, co.`product_remark`, p.image_url FROM `customer_orders` co INNER JOIN product p ON co.`product_id` = p.`product_id` WHERE co.orders_id = ? AND co.customer_id = ? AND co.accepted != 1 AND co.preparing != 1 AND co.shipping = 1 AND co.delivered != 1 AND co.removed != 1 AND co.cancel != 1');

        // Bind the parameters
        $stmt->bindParam(1, $ordersid, PDO::PARAM_INT);
        $stmt->bindParam(2, $customerid, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $orders[] = $row;
            }
        }

        $stmt->closeCursor();
        return $orders;
    } catch (\Throwable $th) {
        // Handle exceptions appropriately, for now redirecting to an error page
        header("location: ../index.php?error=" . urlencode($th->getMessage()));
        exit();
    }
}

public function getOrderByCustomerComplete($ordersid, $customerid) {
    try {
        $orders = array();
        $stmt = $this->connect()->prepare('SELECT co.`order_id`, co.`customer_id`, co.`product_id`, co.`product_name`, co.`product_price`, co.`sizes_id`, co.`size_name`, co.`subtotal`, co.`price`, co.`quantity`, co.`address`, co.`addons_id`, co.`addons_name`, co.`addons_price`, co.`product_remark`, p.image_url, c.`category_name` FROM `customer_orders` co INNER JOIN product p ON co.`product_id` = p.`product_id` INNER JOIN categories c ON p.`category_id` = c.`category_id` WHERE co.orders_id = ? AND co.customer_id = ? AND co.accepted != 1 AND co.preparing != 1 AND co.shipping != 1 AND co.delivered = 1 AND co.removed != 1 AND co.cancel != 1');

        // Bind the parameters
        $stmt->bindParam(1, $ordersid, PDO::PARAM_INT);
        $stmt->bindParam(2, $customerid, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $orders[] = $row;
            }
        }

        $stmt->closeCursor();
        return $orders;
    } catch (\Throwable $th) {
        // Handle exceptions appropriately, for now redirecting to an error page
        header("location: ../index.php?error=" . urlencode($th->getMessage()));
        exit();
    }
}

public function getOrderByCustomerCancelled($ordersid, $customerid) {
    try {
        $orders = array();
        $stmt = $this->connect()->prepare('SELECT co.`order_id`, co.`customer_id`, co.`product_id`, co.`product_name`, co.`product_price`, co.`sizes_id`, co.`size_name`, co.`subtotal`, co.`price`, co.`quantity`, co.`address`, co.`addons_id`, co.`addons_name`, co.`addons_price`, co.`product_remark`, p.image_url FROM `customer_orders` co INNER JOIN product p ON co.`product_id` = p.`product_id` WHERE co.orders_id = ? AND co.customer_id = ? AND co.cancel = 1 AND removed != 1');

        // Bind the parameters
        $stmt->bindParam(1, $ordersid, PDO::PARAM_INT);
        $stmt->bindParam(2, $customerid, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $orders[] = $row;
            }
        }

        $stmt->closeCursor();
        return $orders;
    } catch (\Throwable $th) {
        // Handle exceptions appropriately, for now redirecting to an error page
        header("location: ../index.php?error=" . urlencode($th->getMessage()));
        exit();
    }
}


public function getOrderByCustomer($customerid) {
    try {
        $stmt = $this->connect()->prepare('SELECT `order_id`, `customer_id`, `product_id`, `sizes_id`, `subtotal`, `price`, `quantity`, `address`, `addons_id`, `product_remark` FROM `customer_orders` WHERE customer_id = ? AND accepted != 1 AND preparing != 1 AND shipping != 1 AND delivered != 1 AND removed != 1 AND cancel != 1 ORDER BY order_id ASC');

        // Bind the parameter
        $stmt->bindParam(1, $customerid, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            // Fetch all rows at once into an array
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $orders;
        }

        $stmt->closeCursor();
        return array(); // Return an empty array if no data is found
    } catch (\Throwable $th) {
        // Handle exceptions appropriately, for now redirecting to an error page
        header("location: ../index.php?error=" . urlencode($th->getMessage()));
        exit();
    }
}



    public function getOrders() {
        try {

            $orders = array();
            $stmt = $this->connect()->prepare('SELECT `order_id`, `customer_id`, `product_id`, `sizes_id`, `subtotal`, `price`, `quantity`, `address`, `addons_id`, `product_remark`FROM `customer_orders` WHERE accepted != 1 AND preparing != 1 AND shipping != 1 AND delivered != 1 ORDER BY order_id DESC');

            // Execute the query
            if ($stmt->execute()) {
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
public function getOrdersPreparing() {
    try {

        $orders = array();
        $stmt = $this->connect()->prepare('SELECT o.`order_id`, o.`customer_id`, o.`df`, o.`total_price`, o.`remark`, o.`order_date`,  ca.`email`, ca.`username`  FROM `order` o INNER JOIN customer_account ca ON o.customer_id = ca.customer_id WHERE o.preparing = 1 AND o.delivery != 1 AND o.completed != 1  AND o.cancel != 1 ORDER BY o.order_id DESC');

        // Execute the query
        if ($stmt->execute()) {
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

public function getOrdersDelivery() {
    try {

        $orders = array();
        $stmt = $this->connect()->prepare('SELECT o.`order_id`, o.`customer_id`, o.`df`, o.`total_price`, o.`remark`, o.`order_date`,  ca.`email`, ca.`username` FROM `order` o INNER JOIN customer_account ca ON o.customer_id = ca.customer_id WHERE o.delivery = 1 AND o.preparing != 1 AND o.completed != 1  AND o.cancel != 1 ORDER BY o.order_id DESC');

        // Execute the query
        if ($stmt->execute()) {
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

public function getOrdersCompleted() {
    try {

        $orders = array();
        $stmt = $this->connect()->prepare('SELECT `order_id`, `customer_id`, `df`, `total_price`, `remark`, `order_date` FROM `order` WHERE completed = 1 AND preparing != 1 AND delivery != 1  AND cancel != 1 AND removed != 1 ORDER BY order_id DESC');

        // Execute the query
        if ($stmt->execute()) {
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

public function getNotificationOrderData() {
    try {

        $orders = array();
        $stmt = $this->connect()->prepare('SELECT `order_id`, `customer_id`, `df`, `total_price`, `remark`, `order_date`, `isSeen`,  `preparing`, `delivery`, `completed`, `isActive`, `removed`, `cancel`  FROM `order` ORDER BY order_id DESC');

        // Execute the query
        if ($stmt->execute()) {
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

public function getNotificationOrderDataFrontEnd($customerid) {
    try {
        $orders = array();
        $stmt = $this->connect()->prepare('SELECT `order_id`, `customer_id`, `df`, `total_price`, `remark`, `order_date`, `isSeen`,  `preparing`, `delivery`, `completed`, `isActive`, `removed`, `cancel`  FROM `order` WHERE `customer_id` = ? ORDER BY order_id DESC');

        // Execute the query
        if ($stmt->execute([$customerid])) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $orders[] = $row;
            }
        }

        $stmt->closeCursor();
        return $orders;

    } catch (\Throwable $th) {
        header("location: ../index.php?error=" . urlencode($th->getMessage()));
        exit();
    }
}



public function getOrder($orderid, $customer_Id) {
    try {
        $stmt = $this->connect()->prepare('SELECT co.`order_id`, co.`customer_id`, co.`product_id`, co.`sizes_id`, co.`subtotal`, co.`price`, co.`quantity`, co.`address`, co.`addons_id`, co.`product_remark`, p.product_name, p.image_url  FROM `customer_orders` co JOIN product p ON co.product_id = p.product_id WHERE `orders_id` = ? AND `customer_id` = ? AND isActive = 1  AND `accepted` != 1 AND `preparing` != 1 AND `shipping` != 1 AND `delivered` != 1 AND `removed` != 1 ORDER BY `order_id` DESC');
        
        $stmt->bindValue(1, $orderid);
        $stmt->bindValue(2, $customer_Id);
        $stmt->execute();
        $order_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($order_data)) {
            return $order_data;
        } else {
            return false; // No matching data found
        }
    } catch (PDOException $e) {
        return false; // Error occurred
    }
}


public function getOrderPrearpingFrontEnd($customer_Id) {
    try {
        $stmt = $this->connect()->prepare('SELECT `order_id`, `customer_id`, `product_id`, `sizes_id`, `subtotal`, `price`, `quantity`, `address`, `addons_id`, `product_remark` FROM `customer_orders` WHERE `customer_id` = ? AND accepted != 1 AND preparing = 1 AND shipping != 1 AND delivered != 1 AND removed != 1 ORDER BY order_id DESC');
        
        $stmt->bindValue(1, $customer_Id);
        $stmt->execute();
        $order_data = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows

        if (!empty($order_data)) {
            return $order_data;
        } else {
            return false; // No matching data found
        }
    } catch (PDOException $e) {
        return false; // Error occurred
    }
}

public function getOrderDeliveryFrontEnd($customer_Id) {
    try {
        $stmt = $this->connect()->prepare('SELECT `order_id`, `customer_id`, `product_id`, `sizes_id`, `subtotal`, `price`, `quantity`, `address`, `addons_id`, `product_remark` FROM `customer_orders` WHERE `customer_id` = ? AND accepted != 1 AND preparing != 1 AND shipping = 1 AND delivered != 1 AND removed != 1 ORDER BY order_id DESC');
        
        $stmt->bindValue(1, $customer_Id);
        $stmt->execute();
        $order_data = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows

        if (!empty($order_data)) {
            return $order_data;
        } else {
            return false; // No matching data found
        }
    } catch (PDOException $e) {
        return false; // Error occurred
    }
}

public function getOrderCompletedFrontEnd($customer_Id) {
    try {
        $stmt = $this->connect()->prepare('SELECT `order_id`, `customer_id`, `product_id`, `sizes_id`, `subtotal`, `price`, `quantity`, `address`, `addons_id`, `product_remark` FROM `customer_orders` WHERE `customer_id` = ? AND accepted != 1 AND preparing != 1 AND shipping != 1 AND `delivered` = 1 AND removed != 1 ORDER BY order_id DESC');
        
        $stmt->bindValue(1, $customer_Id);
        $stmt->execute();
        $order_data = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows

        if (!empty($order_data)) {
            return $order_data;
        } else {
            return false; // No matching data found
        }
    } catch (PDOException $e) {
        return false; // Error occurred
    }
}
// public function getOrder($customerId) {
//     try {
//         $stmt = $this->connect()->prepare('SELECT `order_id`, `customer_id`, `product_id`, `sizes_id`, `subtotal`, `price`, `quantity`, `address`, `addons_id`, `remark` FROM `customer_orders` WHERE customer_id = ? AND accepted != 1 AND preparing != 1 AND shipping != 1 AND delivered != 1 ORDER BY order_id DESC');

//         // Execute the query
//         if ($stmt->execute([$customerId])) {
//             // Fetch the single row
//             $order = $stmt->fetch(PDO::FETCH_ASSOC);
//             $stmt->closeCursor(); // Close the cursor explicitly

//             return $order; // Return the single row
//         }
//     } catch (\Throwable $th) {
//         // Handle the exception or log an error
//         header("location: ../back-end/AdminOrders.php?error=" . urlencode($th->getMessage()));
//         exit();
//     }

//     return null; // Return null in case of an error or no data found
// }

public function getData($orderid) {
    try {
        $stmt = $this->connect()->prepare('SELECT p.product_name, p.image_url, ps.size_name, ca.username, ca.customer_address, ca.email, co.order_id FROM `customer_orders` co INNER JOIN `product` p  ON co.product_id = p.product_id INNER JOIN `product_sizes` ps ON co.sizes_id = ps.sizes_id INNER JOIN customer_account ca ON co.customer_id = ca.customer_id WHERE co.orders_id = ? AND isActive = 1 AND co.accepted != 1 AND co.preparing != 1 AND co.shipping != 1 AND co.delivered != 1 AND co.cancel != 1 AND co.removed != 1');

        // Execute the query
        if ($stmt->execute([$orderid])) {
            // Fetch the single row
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor(); // Close the cursor explicitly

            return $product; // Return the single row
        }
    } catch (\Throwable $th) {
        // Handle the exception or log an error
        header("location: ../back-end/AdminOrders.php?error=" . urlencode($th->getMessage()));
        exit();
    }

    return null; // Return null in case of an error or no data found
}

public function getDataComplete($orderid) {
    try {
        $stmt = $this->connect()->prepare('
            SELECT COUNT(co.orders_id) AS order_count,
                   p.product_name, 
                   p.image_url, 
                   ps.size_name, 
                   ca.username, 
                   ca.customer_address, 
                   ca.email, 
                   co.product_price, 
                   co.quantity, 
                   co.subtotal 
            FROM `customer_orders` co 
            INNER JOIN `product` p  ON co.product_id = p.product_id 
            INNER JOIN `product_sizes` ps ON co.sizes_id = ps.sizes_id 
            INNER JOIN customer_account ca ON co.customer_id = ca.customer_id 
            WHERE co.orders_id = ? AND co.delivered = 1
            GROUP BY co.orders_id, 
                     p.product_name, 
                     p.image_url, 
                     ps.size_name, 
                     ca.username, 
                     ca.customer_address, 
                     ca.email, 
                     co.product_price, 
                     co.quantity, 
                     co.subtotal
        ');

        // Execute the query
        if ($stmt->execute([$orderid])) {
            // Fetch all rows
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor(); // Close the cursor explicitly

            return $products; // Return the result set
        }
    } catch (\Throwable $th) {
        // Handle the exception or log an error
        header("location: ../back-end/AdminOrders.php?error=" . urlencode($th->getMessage()));
        exit();
    }

    return null; // Return null in case of an error or no data found
}


public function getDataPreparing($orderid) {
    try {
        $stmt = $this->connect()->prepare('
            SELECT COUNT(co.orders_id) AS order_count,
                   p.product_name, 
                   p.image_url, 
                   ps.size_name, 
                   ca.username, 
                   ca.customer_address, 
                   ca.email, 
                   co.product_price, 
                   co.quantity, 
                   co.subtotal 
            FROM `customer_orders` co 
            INNER JOIN `product` p  ON co.product_id = p.product_id 
            INNER JOIN `product_sizes` ps ON co.sizes_id = ps.sizes_id 
            INNER JOIN customer_account ca ON co.customer_id = ca.customer_id 
            WHERE co.orders_id = ? AND co.preparing = 1
            GROUP BY co.orders_id, 
                     p.product_name, 
                     p.image_url, 
                     ps.size_name, 
                     ca.username, 
                     ca.customer_address, 
                     ca.email, 
                     co.product_price, 
                     co.quantity, 
                     co.subtotal
        ');

        // Execute the query
        if ($stmt->execute([$orderid])) {
            // Fetch all rows
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor(); // Close the cursor explicitly

            return $products; // Return the result set
        }
    } catch (\Throwable $th) {
        // Handle the exception or log an error
        header("location: ../back-end/AdminOrders.php?error=" . urlencode($th->getMessage()));
        exit();
    }

    return null; // Return null in case of an error or no data found
}


public function getDataDelivery($orderid) {
    try {
        $stmt = $this->connect()->prepare('
            SELECT COUNT(co.orders_id) AS order_count,
                   p.product_name, 
                   p.image_url, 
                   ps.size_name, 
                   ca.username, 
                   ca.customer_address, 
                   ca.email, 
                   co.product_price, 
                   co.quantity, 
                   co.subtotal 
            FROM `customer_orders` co 
            INNER JOIN `product` p  ON co.product_id = p.product_id 
            INNER JOIN `product_sizes` ps ON co.sizes_id = ps.sizes_id 
            INNER JOIN customer_account ca ON co.customer_id = ca.customer_id 
            WHERE co.orders_id = ? AND co.shipping = 1
            GROUP BY co.orders_id, 
                     p.product_name, 
                     p.image_url, 
                     ps.size_name, 
                     ca.username, 
                     ca.customer_address, 
                     ca.email, 
                     co.product_price, 
                     co.quantity, 
                     co.subtotal
        ');

        // Execute the query
        if ($stmt->execute([$orderid])) {
            // Fetch all rows
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor(); // Close the cursor explicitly

            return $products; // Return the result set
        }
    } catch (\Throwable $th) {
        // Handle the exception or log an error
        header("location: ../back-end/AdminOrders.php?error=" . urlencode($th->getMessage()));
        exit();
    }

    return null; // Return null in case of an error or no data found
}




public function getAddons($addonsid){
    try {
       
            $stmt = $this->connect()->prepare('SELECT addons_id, addons_name, price FROM addons WHERE addons_id = ?');

            // Execute the query
            if ($stmt->execute([$addonsid])) {
                // Fetch the single row
                $addons = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor(); // Close the cursor explicitly

                return $addons; // Return the row with addons_id and addons_name
            }
        
    } catch (\Throwable $th) {
        // Handle the exception or log an error
        header("location: ../back-end/AdminOrders.php?error=" . urlencode($th->getMessage()));
        exit();
    }

    return null; // Return null in case of an error or no data found
}

public function getPriceBySize($sizeid, $prodid) {
    try {
        if (is_array($sizeid)) {
            $placeholders = str_repeat('?,', count($sizeid) - 1) . '?';
            $query = "SELECT price FROM variation WHERE size_id IN ($placeholders) AND product_id = ? AND isDeleted != 1";
        } else {
            $query = "SELECT price FROM variation WHERE size_id = ? AND product_id = ? AND isDeleted != 1";
        }

        $stmt = $this->connect()->prepare($query);

        // Execute the query
        $params = is_array($sizeid) ? array_merge($sizeid, [$prodid]) : [$sizeid, $prodid];
        if ($stmt->execute($params)) {
            // Fetch the price value directly (since it's a single value)
            $price = $stmt->fetchColumn();

            return $price;
        }
    } catch (Exception $e) {
        return "Error: " . $e->getMessage(); // Handle the error appropriately
    }
}



public function getCustomerDetails($customerid){
    try {
       
            $stmt = $this->connect()->prepare('SELECT email, username, last_name, customer_address, postal_code, city, region, address_id FROM customer_account WHERE customer_id = ?');

            // Execute the query
            if ($stmt->execute([$customerid])) {
                // Fetch the single row
                $customer = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor(); // Close the cursor explicitly

                return $customer; // Return the row with addons_id and addons_name
            }
        
    } catch (\Throwable $th) {
        // Handle the exception or log an error
        header("location: ../back-end/AdminOrders.php?error=" . urlencode($th->getMessage()));
        exit();
    }

    return null; // Return null in case of an error or no data found
}


        public function acceptOrder($order_id){
            try {

                $stmt = $this->connect()->prepare('UPDATE `customer_orders` SET accepted = 1, preparing = 1  WHERE order_id = ?');

                // Execute the query
                if (!$stmt->execute(array($order_id))) {
                    throw new Exception("Failed to update orders");
                }

                // Close the prepared statement
                $stmt = null;

            } catch (Exception $e) {
                //throw $th;
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function AcceptOrderV2($orderid, $customerid) {
            try {
                $stmt = $this->connect()->prepare('UPDATE `customer_orders` SET preparing = 1 WHERE orders_id = ? AND customer_id = ?');
        
                // Execute the query
                if (!$stmt->execute(array($orderid, $customerid))) {
                    throw new Exception("Failed to update orders");
                }
        
                // Close the prepared statement
                return true;
                $stmt->closeCursor();
        
            } catch (Exception $e) {
                // Handle the exception and log the error
                error_log("Error in AcceptOrderV2: " . $e->getMessage());
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        
        

        public function DeliverOrder($orderid, $customerid) {
            try {
                $stmt = $this->connect()->prepare('UPDATE `customer_orders` SET preparing = 0, shipping = 1 WHERE orders_id = :orderid AND customer_id = :customerid AND preparing = 1 AND delivered != 1 AND cancel != 1 AND shipping != 1');
        
                // Bind the parameters
                $stmt->bindParam(':orderid', $orderid);
                $stmt->bindParam(':customerid', $customerid);
        
                // Execute the query
                if (!$stmt->execute()) {
                    $errorInfo = $stmt->errorInfo();
                    error_log("Database error: " . $errorInfo[2]);
                    throw new Exception("Failed to update orders");
                }
        
                // Close the prepared statement
                $stmt = null;
        
                return true;
            } catch (Exception $e) {
                // Handle the exception and log the error
                error_log("Error in DeliverOrder: " . $e->getMessage());
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        

        public function CompleteOrder($orderid, $customerid) {
            try {
                $stmt = $this->connect()->prepare('UPDATE `customer_orders` SET shipping = 0, delivered = 1  WHERE orders_id = :orderid AND customer_id = :customerid AND shipping = 1 AND preparing != 1 AND cancel != 1 AND delivered != 1');
        
                // Bind the parameters
                $stmt->bindParam(':orderid', $orderid);
                $stmt->bindParam(':customerid', $customerid);
        
                // Execute the query
                if (!$stmt->execute()) {
                    $errorInfo = $stmt->errorInfo();
                    error_log("Database error: " . $errorInfo[2]);
                    throw new Exception("Failed to update orders");
                }
        
                // Close the prepared statement
                $stmt = null;
        
                return true;
            } catch (Exception $e) {
                // Handle the exception and log the error
                error_log("Error in DeliverOrder: " . $e->getMessage());
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        

        public function RemoveOrder($orderid, $customerid) {
            try {
                $stmt = $this->connect()->prepare('UPDATE `customer_orders` SET removed = 1, preparing = 0 WHERE orders_id = ? AND customer_id = ? AND preparing = 1 AND delivered != 1 AND shipping != 1 AND cancel != 1 AND removed != 1');
        
                // Execute the query
                if (!$stmt->execute(array($orderid, $customerid))) {
                    $errorInfo = $stmt->errorInfo();
                    error_log("Database error: " . $errorInfo[2]);
                    throw new Exception("Failed to update orders");
                }
        
                // Close the prepared statement
                $stmt = null;
        
                return true;
            } catch (Exception $e) {
                // Handle the exception and log the error
                error_log("Error in RemoveOrder: " . $e->getMessage());
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        

        public function DeleteOrder($orderid, $customerid) {
            try {
                $stmt = $this->connect()->prepare('UPDATE `customer_orders` SET removed = 1, isActive = 0 WHERE orders_id = ? AND customer_id = ? AND preparing != 1 AND delivered = 1 AND shipping != 1 AND cancel != 1 AND removed != 1');
        
                // Execute the query
                if (!$stmt->execute(array($orderid, $customerid))) {
                    $errorInfo = $stmt->errorInfo();
                    error_log("Database error: " . $errorInfo[2]);
                    throw new Exception("Failed to update orders");
                }
        
                // Close the prepared statement
                $stmt = null;
        
                return true;
            } catch (Exception $e) {
                // Handle the exception and log the error
                error_log("Error in DeleteOrder: " . $e->getMessage());
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        


        public function UpdateToCancelOrder($orderid, $reason){
            try {
                $stmt = $this->connect()->prepare('UPDATE `order` SET cancel = 1, isActive = 0, cancellation_reason = ?  WHERE order_id = ? AND preparing != 1 AND delivery != 1 AND completed != 1 AND cancel != 1');
        
                // Execute the query
                $stmt->execute(array($reason, $orderid));
        
                // Close the prepared statement
                $stmt = null;
                return true;
            } catch (Exception $e) {
                // Handle the exception
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        
        public function UpdateToCancelOrderFront($orderid){
            try {
                $stmt = $this->connect()->prepare('UPDATE `order` SET cancel = 1, isActive = 0 WHERE order_id = ? AND preparing != 1 AND delivery != 1 AND completed != 1 AND cancel != 1');
            
                // Execute the query
                $stmt->execute(array($orderid));
            
                // Close the prepared statement
                $stmt = null;
                return true;
            } catch (Exception $e) {
                // Log the exception
                error_log('Exception in UpdateToCancelOrderFront: ' . $e->getMessage());
        
                // Redirect with an error message
                header("location: ../orderstatus.php?error=" . urlencode("An error occurred. Please try again."));
                exit();
            }
        }
        

        public function UpdatePrepareOrder($orderid){
            try {

                $stmt = $this->connect()->prepare('UPDATE `order` SET preparing = 1  WHERE order_id = ? AND delivery != 1 AND completed != 1 AND cancel != 1');

                // Execute the query
                if (!$stmt->execute(array($orderid))) {
                    throw new Exception("Failed to update orders");
                }

                // Close the prepared statement
                $stmt = null;
                return true;
            } catch (Exception $e) {
                //throw $th;
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        
        public function UpdateDeliverOrder($orderid){
            try {

                $stmt = $this->connect()->prepare('UPDATE `order` SET delivery = 1, preparing = 0  WHERE order_id = ? AND preparing = 1 AND completed != 1 AND cancel != 1');

                // Execute the query
                if (!$stmt->execute(array($orderid))) {
                    throw new Exception("Failed to update orders");
                }

                // Close the prepared statement
                $stmt = null;
                return true;
            } catch (Exception $e) {
                //throw $th;
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
     
        public function UpdateCompleteOrder($orderid){
            try {

                $stmt = $this->connect()->prepare('UPDATE `order` SET delivery = 0, completed = 1  WHERE order_id = ? AND preparing != 1 AND delivery = 1 AND cancel != 1');

                // Execute the query
                if (!$stmt->execute(array($orderid))) {
                    throw new Exception("Failed to update orders");
                }

                // Close the prepared statement
                $stmt = null;
                return true;
            } catch (Exception $e) {
                //throw $th;
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function UpdateSeenOrder($orderid){
            try {

                $stmt = $this->connect()->prepare('UPDATE `order` SET isSeen = 1 WHERE order_id = ? AND preparing != 1 AND delivery != 1 AND cancel != 1 AND removed != 1');

                // Execute the query
                if (!$stmt->execute(array($orderid))) {
                    throw new Exception("Failed to update orders");
                }

                // Close the prepared statement
                $stmt = null;
                return true;
            } catch (Exception $e) {
                //throw $th;
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function UpdateRemoveOrder($orderid){
            try {

                $stmt = $this->connect()->prepare('UPDATE `order` SET cancel = 1, preparing = 0 WHERE order_id = ? AND preparing = 1 AND completed != 1 AND delivery != 1');

                // Execute the query
                if (!$stmt->execute(array($orderid))) {
                    throw new Exception("Failed to update orders");
                }

                // Close the prepared statement
                $stmt = null;
                return true;
            } catch (Exception $e) {
                //throw $th;
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }

        public function UpdateDeleteOrder($orderid){
            try {

                $stmt = $this->connect()->prepare('UPDATE `order` SET removed = 1, isActive = 0 WHERE order_id = ? AND preparing != 1 AND completed = 1 AND delivery != 1 AND cancel != 1 AND removed != 1');

                // Execute the query
                if (!$stmt->execute(array($orderid))) {
                    throw new Exception("Failed to update orders");
                }

                // Close the prepared statement
                $stmt = null;
                return true;
            } catch (Exception $e) {
                //throw $th;
                header("location: ../back-end/AdminOrders.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        }
        public function CancelOrder($orderid){
            try {
                $stmt = $this->connect()->prepare('UPDATE `customer_orders` SET cancel = 1, isActive = 0 WHERE orders_id = ? AND preparing != 1 AND delivered != 1 AND shipping != 1 AND cancel != 1');
            
                // Execute the query
                $stmt->execute(array($orderid));
            
                // Close the prepared statement
                $stmt = null;
                return true;
            } catch (Exception $e) {
                // Log the exception
                error_log('Exception in UpdateToCancelOrderFront: ' . $e->getMessage());
        
                // Redirect with an error message
                header("location: ../orderstatus.php?error=" . urlencode("An error occurred. Please try again."));
                exit();
            }
        }


        public function insertToOrderHeader($userID, $totalprice, $remark, $customer_address, $order_date,  $payment_pickup , $payment_cod , $payment_gcash,  $gcash_upload, $discount, $offerName, $couponId, $discount_percent, $discount_name, $valid_id){
            try {
                $stmt = $this->connect()->prepare('INSERT INTO `order` (`customer_id`, `total_price`, `remark`, `customer_address`, `order_date`, `payment_pickup`, `payment_cod`, `payment_gcash`, `gcash_upload`, `coupon_discount`, `coupon_name`, `coupon_id`, `discount_percent`, `discount_name`, `discount_vaild_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        
                $stmt->bindValue(1, $userID);
                $stmt->bindValue(2, $totalprice);
                $stmt->bindValue(3, $remark);   
                $stmt->bindValue(4, $customer_address);   
                $stmt->bindValue(5, $order_date);   
                $stmt->bindValue(6, $payment_pickup);
                $stmt->bindValue(7, $payment_cod);
                $stmt->bindValue(8, $payment_gcash);
                $stmt->bindValue(9, $gcash_upload);
                $stmt->bindValue(10, $discount);
                $stmt->bindValue(11, $offerName);
                $stmt->bindValue(12, $couponId);
                $stmt->bindValue(13, $discount_percent);
                $stmt->bindValue(14, $discount_name);
                $stmt->bindValue(15, $valid_id);
                if ($stmt->execute()) {
                    return true; // Successfully inserted
                } else {
                    return false; // Failed to insert
                }
            } catch (\Throwable $th) {
                return false; // Failed to insert and caught an exception
            }
        }

        public function insertMultipleOrder($InsertOrder) {
            try {
                $stmt = $this->connect()->prepare('INSERT INTO `customer_orders` (`orders_id`, `customer_id`, `product_id`, `product_name`, `product_price`, `sizes_id`, `size_name`, `subtotal`, `quantity`, `addons_id`, `addons_name`, `addons_price`, `product_remark`, `order_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        
                if ($stmt) { // Check if the statement was prepared successfully
                    foreach ($InsertOrder as $orderData) {
                        $stmt->bindValue(1, $orderData['orders_id']);
                        $stmt->bindValue(2, $orderData['customer_id']);
                        $stmt->bindValue(3, $orderData['product_id']);
                        $stmt->bindValue(4, $orderData['product_name']);
                        $stmt->bindValue(5, $orderData['product_price']);
                        $stmt->bindValue(6, $orderData['sizes_id']);
                        $stmt->bindValue(7, $orderData['size_name']);
                        $stmt->bindValue(8, $orderData['subtotal']);
                        $stmt->bindValue(9, $orderData['quantity']);
        
                        if ($orderData['addons_id'] === "") {
                            $stmt->bindValue(10, null, PDO::PARAM_NULL);
                        } else {
                            $stmt->bindValue(10, $orderData['addons_id'], PDO::PARAM_INT); // Assuming addons_id is an integer
                        }
        
                        $stmt->bindValue(11, $orderData['addons_name']);
                        $stmt->bindValue(12, $orderData['addons_price']);
                        $stmt->bindValue(13, $orderData['product_remark']);
                        $stmt->bindValue(14, $orderData['order_date']);
                        if (!$stmt->execute()) {
                            // Print or log the error details
                            $errorInfo = $stmt->errorInfo();
                            error_log("Error executing statement: " . $errorInfo[2]);
                            return false; // Failed to insert
                        }
                    }
                    
                    return true; // Successfully inserted
                } else {
                    return false; // Failed to prepare the statement
                }
            } catch (\Throwable $th) {
                // Print or log the exception details
                error_log("Exception caught: " . $th->getMessage());
                return false; // Failed to insert and caught an exception
            }
        }

        public function CountNewInserts() {
            try {
                date_default_timezone_set('Asia/Manila');
        
                // Get today's date
                $today = date('Y-m-d');
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE DATE(`order_date`) = :today AND isActive = 1  AND completed != 1 AND `cancel` != 1 AND `removed` != 1');
                
                $stmt->bindParam(':today', $today, PDO::PARAM_STR);
                
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function CountNewOrder() {
            try {
                date_default_timezone_set('Asia/Manila');
        
                // Get today's date
                $today = date('Y-m-d');
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE DATE(`order_date`) = :today AND isActive = 1 AND `completed` != 1 AND `cancel` != 1 AND `removed` != 1');
                
                $stmt->bindParam(':today', $today, PDO::PARAM_STR);
                
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function CountPreparingOrder() {
            try {
                date_default_timezone_set('Asia/Manila');
        
                // Get today's date
                $today = date('Y-m-d');
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE DATE(`order_date`) = :today AND isActive = 1 AND `preparing` = 1 AND `delivery` != 1 AND `completed` != 1 AND `cancel` != 1 AND `removed` != 1');
                
                $stmt->bindParam(':today', $today, PDO::PARAM_STR);
                
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        
        public function CountDeliveryOrder() {
            try {
                date_default_timezone_set('Asia/Manila');
        
                // Get today's date
                $today = date('Y-m-d');
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE DATE(`order_date`) = :today AND isActive = 1 AND `preparing` != 1 AND `delivery` = 1 AND `completed` != 1 AND `cancel` != 1 AND `removed` != 1');
                
                $stmt->bindParam(':today', $today, PDO::PARAM_STR);
                
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function CountCompleteOrder() {
            try {
                // date_default_timezone_set('Asia/Manila');
        
                // Get today's date
                // $today = date('Y-m-d');
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE  `completed` = 1 AND `cancel` != 1 AND `removed` != 1');
                
                // $stmt->bindParam(':today', $today, PDO::PARAM_STR);
                
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

    
        
        public function CountNewInsertsFrontEnd($customerid) {
            try {
                date_default_timezone_set('Asia/Manila');
        
                // Get today's date
                $today = date('Y-m-d');
        
                $stmt = $this->connect()->prepare(' SELECT COUNT(*) as new_insert_count
                FROM `order`
                WHERE 
                    DATE(`order_date`) = :today 
                    AND customer_id = :customerid 
                    AND (isActive = 1 OR completed = 1)
                    AND (`removed` != 1 OR `cancel` = 1)
                    ');
        
                $stmt->bindParam(':today', $today, PDO::PARAM_STR);
                $stmt->bindParam(':customerid', $customerid, PDO::PARAM_INT);
        
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function CountPending($customerid) {
            try {
                date_default_timezone_set('Asia/Manila');
        
                // Get today's date
                $today = date('Y-m-d');
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE DATE(`order_date`) = :today AND customer_id = :customerid AND isActive = 1 AND `preparing` != 1 AND `delivery` != 1 AND `completed` != 1 AND `cancel` != 1 AND `removed` != 1');
        
                $stmt->bindParam(':today', $today, PDO::PARAM_STR);
                $stmt->bindParam(':customerid', $customerid, PDO::PARAM_INT);
        
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        
        public function CountPreparing($customerid) {
            try {
                date_default_timezone_set('Asia/Manila');
        
                // Get today's date
                $today = date('Y-m-d');
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE DATE(`order_date`) = :today AND customer_id = :customerid AND isActive = 1 AND `preparing` = 1 AND `delivery` != 1 AND `completed` != 1 AND `cancel` != 1 AND `removed` != 1');
        
                $stmt->bindParam(':today', $today, PDO::PARAM_STR);
                $stmt->bindParam(':customerid', $customerid, PDO::PARAM_INT);
        
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function CountToReceive($customerid) {
            try {
                date_default_timezone_set('Asia/Manila');
        
                // Get today's date
                $today = date('Y-m-d');
        
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE DATE(`order_date`) = :today AND customer_id = :customerid AND `isActive` = 1  AND `delivery` = 1 AND `preparing` != 1 AND `completed` != 1 AND `cancel` != 1 AND `removed` != 1');
        
                $stmt->bindParam(':today', $today, PDO::PARAM_STR);
                $stmt->bindParam(':customerid', $customerid, PDO::PARAM_INT);
        
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function CountComplete($customerid) {
            try {

                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE customer_id = :customerid AND isActive = 1 AND `preparing` != 1 AND `delivery` != 1 AND `completed` = 1 AND `cancel` != 1 AND `removed` != 1');
        
                $stmt->bindParam(':customerid', $customerid, PDO::PARAM_INT);
        
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function CountCancelled($customerid) {
            try {

                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE customer_id = :customerid AND `cancel` = 1 AND removed != 1');
        
                $stmt->bindParam(':customerid', $customerid, PDO::PARAM_INT);
        
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        public function CheckInsertOrder()
        {
            try {
                date_default_timezone_set('Asia/Manila');
        
                // Get the current date and time
                $now = date('Y-m-d H:i:s');
        
                // Prepare the SQL query
                $stmt = $this->connect()->prepare('SELECT COUNT(*) as new_insert_count FROM `order` WHERE `order_date` >= :now - INTERVAL 5 SECOND AND isActive = 1 AND `preparing` != 1 AND `delivery` != 1 AND `completed` != 1 AND `cancel` != 1 AND `removed` != 1');
        
                // Bind parameters
                $stmt->bindParam(':now', $now, PDO::PARAM_STR);
        
                // Execute the query
                $stmt->execute();
        
                // Fetch the result
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                return $result['new_insert_count'];
            } catch (\Throwable $th) {
                // Log the exception (you might want to use a proper logging system)
                error_log('Exception in CheckInsertOrder: ' . $th->getMessage());
        
                // Return 0 or another default value instead of throwing the exception again
                return 0;
            }
        }
        
        
        


}