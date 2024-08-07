<?php

class ChatbotModel extends Dbh
{
    public function getAllChatQuestions()
    {
        try {
            $chatbot = array();
            $stmt = $this->connect()->prepare('SELECT * FROM chatbot WHERE isDeleted != 1 ORDER BY id ASC');
            if($stmt->execute()){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $chatbot[]=$row;
                }
            } else{
                error_log("Error executing query in getAllChatQuestions");
            }
            return $chatbot;
        }
        catch(\Throwable $a){

            error_log("Error in getAllChatQuestions: " . $a->getMessage());
            
            return array();
        }
    }


    public function insertChatbot($getQuestion, $getAnswer)
    {
        $stmt = $this->connect()->prepare('INSERT INTO chatbot (chatQuestion,chatAnswer) VALUES (?, ?)');
        if (!$stmt->execute(array($getQuestion, $getAnswer))) {
            throw new Exception("Failed to Add Announcement");
        }
    }



    public function editChatbot($chatbot_id, $editQuestion, $editAnswer) {
        try {
            $stmt = $this->connect()->prepare('UPDATE chatbot SET chatQuestion=?, chatAnswer=? WHERE id=?');
            if (!$stmt->execute(array($editQuestion, $editAnswer, $chatbot_id))) {
                throw new Exception("Failed to update Chatbot");
            }
        } catch (Exception $e) {
            throw new Exception("Error updating Chatbot: " . $e->getMessage());
        }
    }
    
    public function deleteChatbot($chatbot_id) {
        try {
            $stmt = $this->connect()->prepare('UPDATE chatbot SET isDeleted = 1 WHERE id = ?');
            
            if (!$stmt->execute(array($chatbot_id))) {
                // Log the database error for debugging
                $errorInfo = $stmt->errorInfo();
                throw new Exception("Error updating Chatbot: " . $errorInfo[2]);
            }
    
            // Check if at least one row was affected
            if ($stmt->rowCount() > 0) {
                return true; // Successfully updated
            } else {
                return false; // No rows were updated, could indicate no matching ID
            }
        } catch (Exception $e) {
            // Log the exception for debugging
            error_log("Exception in deleteChatbot: " . $e->getMessage());
            throw new Exception("Failed to update Chatbot. Please try again later.");
        }
    }
    
    
}