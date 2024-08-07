<?php

class ChatModel extends Dbh{

 
    public function SendMessageCustomer($sender_id, $receiver_id, $customer_name, $message, $chat_time){
        try {
            $stmt = $this->connect()->prepare('INSERT INTO `messages` (`sender_id`, `receiver_id`,  `username`, `message_text`, `timestamp` ) VALUES (?, ?, ?, ?, ?)');
    
            // Bind the parameters
            $stmt->bindParam(1, $sender_id, PDO::PARAM_INT);
            $stmt->bindParam(2, $receiver_id, PDO::PARAM_INT);
            $stmt->bindParam(3, $customer_name, PDO::PARAM_STR);
            $stmt->bindParam(4, $message, PDO::PARAM_STR);
            $stmt->bindParam(5, $chat_time, PDO::PARAM_STR);
    
            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("User chat message failed.");
            }
        } catch (\Throwable $th) {
            // Log the error
            error_log($th->getMessage(), 0);
    
            // Redirect with an error message
            header("location: ../chatFront.php?error=unabletosendmessage");
            exit();
        }
    }
    

    public function SendMessageAdmin($senderid, $receiver,$username, $message_text, $time){
        try {
            $stmt = $this->connect()->prepare('INSERT INTO `messages` (`sender_id`, `receiver_id`,  `username`, `message_text`, `timestamp` ) VALUES (?, ?, ?, ?, ?)');
    
            // Execute the query
            if (!$stmt->execute(array($senderid, $receiver,$username, $message_text, $time))) {
                throw new Exception("User chat message failed.");
                header("location: ../back-end/adminMessage.php?error=unabletosendmessage");
                exit();
            }
    
            $stmt = null;
            return true;
        } catch (\Throwable $th) {
            // Log the error
            error_log($th->getMessage(), 0);
    
            // Redirect with an error message
            header("location: ../back-end/adminMessage.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    }

    public function GetChatByCustomer($senderid, $receiverid) {
        try {
            $output = "";
            $stmt = $this->connect()->prepare('SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY message_id ASC');
        
            // Bind the parameters
            $stmt->bindParam(1, $senderid, PDO::PARAM_INT);
            $stmt->bindParam(2, $receiverid, PDO::PARAM_INT);
            $stmt->bindParam(3, $receiverid, PDO::PARAM_INT);
            $stmt->bindParam(4, $senderid, PDO::PARAM_INT);
        
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Decode HTML entities in the message text
                    $decodedMessage = html_entity_decode($row['message_text'], ENT_QUOTES, 'UTF-8');

                    // Use strip_tags to remove any remaining HTML tags
                    $row['message_text'] = strip_tags($row['message_text']);
                    
                    if ($row['sender_id'] == $senderid) {
                        $output .= '<div class="chat outgoing">         
                                        <div class="details">
                                            <p>'. $row['message_text'] .'</p>
                                        </div>
                                    </div>';
                    } else {
                        $output .= '<div class="chat incoming">
                                        <i class="fa fa-user-circle" aria-hidden="true"></i>     
                                        <div class="details">
                                            <p>'. $row['message_text'] .'</p>
                                        </div>
                                    </div>';
                    }
                }
            }
    
            $stmt->closeCursor();
            return $output;
        } catch (\Throwable $th) {
            // Handle exceptions appropriately, for now redirecting to an error page
            header("location: ../orderstatus.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    }
    
    public function GetChatBackend($senderid, $receiverid) {
        try {
            $output = "";
            $stmt = $this->connect()->prepare('SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY message_id ASC');
        
            // Bind the parameters
            $stmt->bindParam(1, $senderid, PDO::PARAM_INT);
            $stmt->bindParam(2, $receiverid, PDO::PARAM_INT);
            $stmt->bindParam(3, $receiverid, PDO::PARAM_INT);
            $stmt->bindParam(4, $senderid, PDO::PARAM_INT);
        
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Decode HTML entities in the message text
                    $decodedMessage = html_entity_decode($row['message_text'], ENT_QUOTES, 'UTF-8');

                    // Use strip_tags to remove any remaining HTML tags
                    $row['message_text'] = strip_tags($row['message_text']);
    
                    if ($row['sender_id'] == $receiverid) {
                        $output .= '<div class="client-chat-Container">
                        <div class="client-profile-Container">
                            <img src="../image/sample1.png" alt="" style="height: 50px;">
                        </div>
                        <div class="clientMessageCont">
                            <p>'. $row['message_text'] .'</p>
                        </div>
                    </div>';
                    } else {
                        $output .= '<div class="convoCont" >
                        <div class="sampleMessageCont">
                            <p class="sampleMess m-0" alt="">'. $row['message_text'] .'</p>
                        </div>
    
                        <div class="chat-profile-Container">
                            <img src="../image/japcha_logo.png" alt="" style="height: 50px;">
                        </div>
                    </div>';
                    }
                }
            }
    
            $stmt->closeCursor();
            return $output;
        } catch (\Throwable $th) {
            // Handle exceptions appropriately, for now redirecting to an error page
            header("location: ../orderstatus.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    }
    




    public function GetReplyAdmin($sender_id, $receiver_id) {
        try {
            $reviews = array();
            $stmt = $this->connect()->prepare('SELECT * FROM messages WHERE sender_id = ? AND receiver_id = ? ORDER BY timestamp ASC');
    
            // Bind the parameters
            $stmt->bindParam(1, $sender_id, PDO::PARAM_INT);
            $stmt->bindParam(2, $receiver_id, PDO::PARAM_INT);
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $reviews[] = $row;
                }
            }
    
            $stmt->closeCursor();
            return $reviews;
        } catch (\Throwable $th) {
            // Handle exceptions appropriately, for now redirecting to an error page
            header("location: ../orderstatus.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    }



    public function GetChatAdmin($adminid, $customerid) {
        try {
            $reviews = array();
            $stmt = $this->connect()->prepare('SELECT * FROM admin_to_customer_chat WHERE admin_id = ? AND customer_id = ? ORDER BY timestamp ASC');
    
            // Bind the parameters
            $stmt->bindParam(1, $adminid, PDO::PARAM_INT);
            $stmt->bindParam(2, $customerid, PDO::PARAM_INT);
            // Execute the query
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $reviews[] = $row;
                }
            }
    
            $stmt->closeCursor();
            return $reviews;
        } catch (\Throwable $th) {
            // Handle exceptions appropriately, for now redirecting to an error page
            header("location: ../back-end/adminMessage.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    }
    
}