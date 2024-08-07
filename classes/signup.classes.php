<?php

class Signup extends Dbh {

    public function setUser($username, $lname, $pwd, $email, $address, $PostalCode,  $City, $Region, $contactNum) {
            try {

                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                $stmt = $this->connect()->prepare('INSERT INTO `customer_account` (`username`, `last_name`,  `password`, `email`,  `customer_address`, `postal_code`, `city`, `region`,  `contact_number`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');

                // Execute the query
                if (!$stmt->execute(array($username,  $lname, $hashedPwd, $email, $address, $PostalCode,  $City, $Region, $contactNum))) {
                    throw new Exception("User registration failed.");
                    header("location: ../index.php?error=userregistrationfailed");
                    exit();
                }
                

        $stmt = null;

            } catch (\Throwable $th) {
                //throw $th;
                header("location: ../index.php?error=sss" . urlencode($th->getMessage()));
                exit();
            }
        
    }

    protected function checkUser($email) {
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('SELECT username FROM customer_account WHERE email = ? AND isDeleted != 1');
            
            // Execute the query
            if (!$stmt->execute(array($email))) {
                // throw new Exception("User existence check failed.");
                $stmt = null;
                header("location: ../index.php?error=Account does not exist");
                exit();

            }
            
            $resultCheck = ($stmt->rowCount() > 0) ? false : true;
            return $resultCheck;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../index.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }


    // ADMIN
    
    protected function setAdmin($username, $fullname, $pwd, $userLevel, $contactNum) {
        try {

            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

            $stmt = $this->connect()->prepare('INSERT INTO admin_account (username, fullname, password,   userLevel_id,  contact) VALUES (?, ?, ?, ?, ?)');

            // Execute the query
            if (!$stmt->execute(array($username, $fullname, $hashedPwd, $userLevel, $contactNum))) {
                throw new Exception("User registration failed.");
                header("location: ../back-end/adminAccount.php?error=userregistrationfailed");
                exit();
            }

            $stmt = null;

        } catch (Throwable $th) {
            //throw $th;
            header("location: ../back-end/adminAccount.php?error=shettwhathappened");
            exit();
        }
    
}

protected function updateAdmin($username, $fullname, $userLevel, $contactNum, $admin_id) {
    try {


        $stmt = $this->connect()->prepare('UPDATE admin_account SET username = ?, fullname = ?, userLevel_id = ?,  contact = ? WHERE admin_id = ?');

        // Execute the query
        if (!$stmt->execute(array($username, $fullname, $userLevel, $contactNum, $admin_id))) {
            throw new Exception("User registration failed.");
            header("location: ../back-end/adminAccount.php?error=unabletoeditaccount");
            exit();
        }

        $stmt = null;

    } catch (Throwable $th) {
        //throw $th;
        header("location: ../back-end/adminAccount.php?error=ss");
        exit();
    }

}

public function updateCustomerAddress($block, $postal, $city, $region, $userid) {
    try {
        $stmt = $this->connect()->prepare('UPDATE `customer_account` SET `customer_address`= ?,`postal_code`= ?,`city`= ?,`region`= ? WHERE customer_id = ?');

        // Execute the query
        if (!$stmt->execute(array($block, $postal, $city, $region, $userid))) {
            $errorInfo = $stmt->errorInfo();
            error_log('Database Error: ' . json_encode($errorInfo)); // Log the database error
            return false;
        }

        $rowCount = $stmt->rowCount();
        error_log('Rows affected: ' . $rowCount);

        return true;
    } catch (Throwable $th) {
        error_log('Exception: ' . $th->getMessage()); // Log the exception
        return false;
    }
}

public function updateCustomerCustomerInfo($fname, $lname, $contact, $userid) {
    try {
        $stmt = $this->connect()->prepare('UPDATE `customer_account` SET `username`= ?,`last_name`= ?,`contact_number`= ? WHERE customer_id = ?');

        // Execute the query
        if (!$stmt->execute(array($fname, $lname, $contact, $userid))) {
            $errorInfo = $stmt->errorInfo();
            error_log('Database Error: ' . json_encode($errorInfo)); // Log the database error
            return false;
        }

        $rowCount = $stmt->rowCount();
        error_log('Rows affected: ' . $rowCount);

        return true;
    } catch (Throwable $th) {
        error_log('Exception: ' . $th->getMessage()); // Log the exception
        return false;
    }
}



    protected function checkAdmin($username) {
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('SELECT username FROM admin_account WHERE username = ? AND isDeleted != 1');
            
            // Execute the query
            if (!$stmt->execute(array($username))) {
                // throw new Exception("User existence check failed.");
                $stmt = null;
                header("location: ../adminAccount.php?error=Account does not exist");
                exit();
            }
            
            $resultCheck = ($stmt->rowCount() > 0) ? false : true;
            return $resultCheck;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/adminAccount.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    protected function checkAdminEdit($username,  $admin_id) {
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('SELECT username FROM admin_account WHERE username = ? And admin_id != ? AND isDeleted != 1');
            
            // Execute the query
            if (!$stmt->execute(array($username,  $admin_id))) {
                // throw new Exception("User existence check failed.");
                $stmt = null;
                header("location: ../adminAccount.php?error=Account does not exist");
                exit();
            }
            
            $resultCheck = ($stmt->rowCount() > 0) ? false : true;
            return $resultCheck;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/adminAccount.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }



    protected function getCustomerId($username){
        $stmt = $this->connect()->prepare('SELECT customer_id FROM customer_account WHERE username = ? AND isDeleted != 1 AND ban_user != 1;');

        if(!$stmt->execute(array($username))) {
            $stmt = null;
            header("location: ../myProfile.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../myProfile.php?error=profilenotfoundassomething");
            exit();
        }

        $profileData = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $profileData;

    }

    public function getAdminData(){
        $stmt = $this->connect()->prepare('SELECT ac.admin_id, ac.username, ac.fullname, ac.password, ac.contact, usl.user_level_name, usl.userlevel_id FROM admin_account ac INNER JOIN user_level usl ON ac.userlevel_id = usl.userlevel_id WHERE ac.isDeleted != 1 ORDER BY ac.username;');
    
            if(!$stmt->execute()) {
                $stmt = null;
                header("location: ../back-end/adminAccount.php?error=stmtfailed");
                exit();
            }
    
            if($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../back-end/adminAccount.php?error=nocmsfound");
                exit();
            }
    
            $productData = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $productData;
    }
    
    public function getCustomerData() {
        $limit = 8; // Number of rows to fetch per page
        $page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number from the URL parameter
        // Calculate the offset to determine which rows to fetch from the database
        $offset = ($page - 1) * $limit;
        
        try {
            // Calculate the total number of rows
            $countStmt = $this->connect()->query('SELECT COUNT(*) FROM customer_account WHERE isDeleted != 1 AND ban_user != 1');
            $total_rows = $countStmt->fetchColumn();
            
            $stmt = $this->connect()->prepare('SELECT `customer_id`, `username`, `last_name`,`password`, `email`, `customer_address`, `postal_code`, `city`, `region` , `contact_number` FROM `customer_account` WHERE `isDeleted` != 1 AND ban_user != 1');

            // $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            // $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            
            if (!$stmt->execute()) {
                // Handle database error here
                header("location: ../back-end/CustomerAccount.php?error=stmtfailed");
                exit();
            }
            
            if ($stmt->rowCount() == 0) {
                // Handle no records found here
                header("location: ../back-end/CustomerAccount.php?error=nocmsfound");
                exit();
            }
            
            $productData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Return data along with pagination variables
            return [
                'data' => $productData,
                'page' => $page,
                'total_rows' => $total_rows,
                // 'limit' => $limit,
            ];
        }catch (Exception $e) {
            // Handle the exception (log, redirect, display an error message, etc.)
            header("location: ../back-end/CustomerAccount.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function getCustomerDataFront($customer_id){
        $stmt = $this->connect()->prepare('SELECT * FROM customer_account WHERE customer_id = ? AND isDeleted != 1 AND ban_user != 1;');
    
        if(!$stmt->execute(array($customer_id))) {
            $stmt = null;
            header("location: ../myProfile.php?error=stmtfailed");
            exit();
        }
    
        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../myProfile.php?error=profilenotfoundasexpected");
            exit();
        }
    
        $profileData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $profileData;
    }
    
    
    public function getAllCustomerAccounts(){
    try {
        $stmt = $this->connect()->prepare('
            SELECT
                ca.customer_id,
                ca.username,
                ca.last_name,
                ca.password,
                ca.email,
                MAX(m.message_text) AS latest_message_text,
                MAX(m.timestamp) AS latest_timestamp,
                MAX(m.isSeen) AS latest_isSeen
            FROM
                customer_account ca
            LEFT JOIN messages m ON ca.customer_id = m.sender_id OR ca.customer_id = m.receiver_id
            WHERE 
                ca.isDeleted != 1 AND ca.ban_user != 1
            GROUP BY
                ca.customer_id,
                ca.username,
                ca.last_name,
                ca.password,
                ca.email
            ORDER BY
                MAX(m.timestamp) DESC,  -- Order by the latest timestamp of messages
                latest_timestamp DESC; 
        ');

        if (!$stmt->execute()) {
            throw new Exception("Error executing the statement.");
        }

        if ($stmt->rowCount() == 0) {
            throw new Exception("No customer accounts found.");
        }

        $customerAccounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Conditionally concatenate the latest message text and format the timestamp inside PHP
        foreach ($customerAccounts as &$customer) {
            $combinedName = $customer['username'] . ' ' . $customer['last_name'];
        
            // Check if the combined name is longer than 15 characters
            if (strlen($combinedName) > 15) {
                $customer['combined_name'] = substr($combinedName, 0, 15) . '...';
            } else {
                $customer['combined_name'] = $combinedName;
            }
        
            $latestMessage = $customer['latest_message_text'];
        
            if (strlen($latestMessage) > 7) {
                $customer['latest_message_text'] = substr($latestMessage, 0, 7) . '...';
            }
        
            $timestamp = new DateTime($customer['latest_timestamp']);
            $customer['latest_timestamp'] = $timestamp->format('D g:iA');
        }
        return $customerAccounts;
    } catch (Exception $e) {
        // Log the exception for debugging purposes
        error_log($e->getMessage(), 0);

        // For demonstration purposes, redirect with a generic error message
        header("location: ../back-end/adminAccount.php?error=Something went wrong.");
        exit();
    }
}

public function getCustomerDataArchived(){
    $stmt = $this->connect()->prepare('SELECT * FROM customer_account WHERE isDeleted != 1 AND ban_user = 1;');

    if(!$stmt->execute()) {
        $stmt = null;
        header("location: ../back-end/AdminArchived.php?error=stmtfailed");
        exit();
    }

    if($stmt->rowCount() == 0) {
        $stmt = null;
        header("location: ../back-end/AdminArchived.php?error=profilenotfoundasexpected");
        exit();
    }

    $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $profileData;
}


public function unbanCustomer($id) {
     
    try {
            $updateStmt = $this->connect()->prepare('UPDATE customer_account SET ban_user = 0 WHERE customer_id = ?');
            if ($updateStmt->execute(array($id))) {
                return true;
            } else {
                throw new Exception("Statement execution failed");
                return false;
            }
        
    } catch (Exception $e) {
        header("location: ../back-end/viewCategory.php");
        exit();
        return false;
    }


}

public function deleteCustomerAccount($id) {
     
    try {
            $updateStmt = $this->connect()->prepare('UPDATE customer_account SET isDeleted = 1 WHERE customer_id = ?');
            if ($updateStmt->execute(array($id))) {
                return true;
            } else {
                throw new Exception("Statement execution failed");
                return false;
            }
        
    } catch (Exception $e) {
        header("location: ../back-end/viewCategory.php");
        exit();
        return false;
    }


}


}