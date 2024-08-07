<?php
class chatbotFrontModel extends Dbh
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
            }
            return $chatbot;
        }
        catch(\Throwable $a){
            error_log($a->getMessage());

            return null;
        }
    }
}

?>