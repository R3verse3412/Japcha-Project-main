<?php
    foreach($getchatQuestions as $gchatbot):
?>

<div class="Chatbot-edit-Modal" id= "editModal<?= $gchatbot['id'] ?>" data-chatbot-id="<?= $gchatbot['id'] ?>">
            <form action="../includes/add-chatbot.inc.php" method="POST">
                <input type="hidden" name="chatbot_id" value="<?= $gchatbot['id'] ?>">
                <textarea required class ="typeQuestion" name="editQuestion" id="" cols="10" rows="1" placeholder="Edit Question Here..."><?= $gchatbot['chatQuestion'] ?> </textarea>
                <textarea required class="typeAnswer" name="editAnswer" id="" cols="10" rows="1" placeholder="Edit Answer Here..."><?= $gchatbot['chatAnswer'] ?></textarea>


                <div class="buttonModal">
                    <button type="submit" name="updateChatbot"class="answerEdit">Update</button>
                    <button type="button" class="answerCancel" data-dismiss="modal">Cancel</button>
                </div>

            </form>

</div>

<?php
  endforeach;
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('#editButton');
    const editModals = document.querySelectorAll('.Chatbot-edit-Modal');

    editButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            editModals.forEach(modal => modal.style.display = 'none');
            editModals[index].style.display = 'block';

            const chatQuestion = document.querySelectorAll('.typeQuestion');
            const chatAnswer = document.querySelectorAll('.typeAnswer');

            chatQuestion[index].value ='<?= $gChatbot['chatQuestion'] ?>';
            chatAnswer[index].value ='<?= $gchatbot['chatAnswer'] ?>';
        });
    });

    const closeIcons = document.querySelectorAll('#closeChatbotManager, .answerCancel');
    closeIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            document.querySelectorAll('.Chatbot-Manager, .Chatbot-edit-Modal, .Chatbot-add-Modal').forEach(modal => {
                modal.style.display = 'none';
                
            });
        });
    });
});

</script>



