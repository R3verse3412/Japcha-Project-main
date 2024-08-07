<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    if (isset($_POST['addChatbot'])) {
        $getQuestion = htmlspecialchars($_POST["addQuestion"], ENT_QUOTES, 'UTF-8');
        $getAnswer = htmlspecialchars($_POST["addAnswer"], ENT_QUOTES, 'UTF-8');

        include "../classes/dbh.classes.php";
        include "../classes/ChatbotModel.php";
        $chatbot = new ChatbotModel();

        try {
            $chatbot->insertChatbot($getQuestion, $getAnswer);
            header("location: ../back-end/adminMessage.php?success=chatbotAdded");
            exit();
        } catch (Exception $e) {
            header("location: ../back-end/adminMessage.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    if (isset($_POST['updateChatbot'])) {
        $chatbot_id = $_POST['chatbot_id'];
        $editQuestion = htmlspecialchars($_POST['editQuestion'], ENT_QUOTES, 'UTF-8');
        $editAnswer = htmlspecialchars($_POST['editAnswer'], ENT_QUOTES, 'UTF-8');

        include "../classes/dbh.classes.php";
        include "../classes/ChatbotModel.php";
        $chatbot = new ChatbotModel();

        try {
            $chatbot->editChatbot($chatbot_id, $editQuestion, $editAnswer);
            header("location: ../back-end/adminMessage.php?success=chatbotUpdated");
            exit();
        } catch(Exception $e) {
            header("location: ../back-end/adminMessage.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }
}
?>
