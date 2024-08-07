<?php
    include "adminHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Quick Responses</title>
    <link rel="stylesheet" href="../assets/css/ChatbotManagement.css">
</head>
<body>
    <div class="chatBotCont">
        <div class="chatBotHeader">
            <p>Chatbot Management</p>
            <div class="chat-add">
                <i class="fa fa-plus-square-o fa-2x" aria-hidden="true"></i>
                <p>Add new</p>

            </div>
        </div>

        <div class="chatBotBody">
            <div class="chatBodyCont">
                <div class="questionCont">
                    <i class="fa fa-pencil-square-o fa-2x" id="editIcon" aria-hidden="true"></i>
                    <div class="questionText">
                        <p>Sample Question 1</p>
                    </div>
                </div>

                <div class="questionCont">
                    <i class="fa fa-pencil-square-o fa-2x" id="editIcon" aria-hidden="true"></i>
                    <div class="questionText">
                        <p>Sample Question 2</p>
                    </div>
                    
                </div>

                <div class="questionCont">
                    <i class="fa fa-pencil-square-o fa-2x" id="editIcon" aria-hidden="true"></i>
                    <div class="questionText">
                        <p>Sample Question 3</p>
                    </div>
                    
                </div>

                <div class="questionCont">
                    <i class="fa fa-pencil-square-o fa-2x" id="editIcon" aria-hidden="true"></i>
                    <div class="questionText">
                        <p>Sample Question 4</p>
                    </div>
                    
                </div>

                <div class="questionCont">
                    <i class="fa fa-pencil-square-o fa-2x" id="editIcon" aria-hidden="true"></i>
                    <div class="questionText">
                        <p>Sample Question 5</p>
                    </div>
                    
                </div>

                <div class="questionCont">
                    <i class="fa fa-pencil-square-o fa-2x" id="editIcon" aria-hidden="true"></i>
                    <div class="questionText">
                        <p>Sample Question 6</p>
                    </div>
                    
                </div>

                <div class="questionCont">
                    <i class="fa fa-pencil-square-o fa-2x" id="editIcon" aria-hidden="true"></i>
                    <div class="questionText">
                        <p>Sample Question 7</p>
                    </div>
                    
                </div>

                <div class="questionCont">
                    <i class="fa fa-pencil-square-o fa-2x" id="editIcon" aria-hidden="true"></i>
                    <div class="questionText">
                        <p>Sample Question 8</p>
                    </div>
                    
                </div>

                
            </div>
        </div>
        
        
        <div class="chatBot-add-Modal">
            
            <form action="">
            <textarea class ="typeQuestion" name="typeQuestion" rows="1" cols="20" placeholder="Type your text here..."></textarea>

                <div class="answerModal">
                    <input type="text" name="answer1" placeholder="Answer 1">
                    <input type="text" name="answer2" placeholder="Answer 2">
                    <input type="text" name="answer3" placeholder="Answer 3">
                    <input type="text" name="answer4" placeholder="Answer 4">
                </div>

                <div class="buttonModal">
                    <button class="answerAdd">Add</button>
                    <button class="answerCancel">Cancel</button>
                </div>
            </form>


        </div>

        
        <div class="chatBot-add-Modal chatBot-edit-Modal">

        <form action="">
            <textarea class ="typeQuestion" name="typeQuestion" rows="1" cols="20" placeholder="Type your text here..."></textarea>

                <div class="answerModal">
                    <input type="text" name="answer1" placeholder="Answer 1">
                    <input type="text" name="answer2" placeholder="Answer 2">
                    <input type="text" name="answer3" placeholder="Answer 3">
                    <input type="text" name="answer4" placeholder="Answer 4">
                </div>

                <div class="buttonModal">
                    <button class="answerAdd">Update</button>
                    <button class="answerCancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>

   
    <script>
       
        const chatAddElement = document.querySelector('.chat-add');
        const chatBotAddModal = document.querySelector('.chatBot-add-Modal');

        
        chatAddElement.addEventListener('click', function() {
            if (chatBotAddModal.style.display === 'none' || chatBotAddModal.style.display === '') {
                chatBotAddModal.style.display = 'block';
            }
        });

    </script>

    
    <script>
        
        const chatAddElement = document.querySelector('.answerCancel');
        const chatBotAddModal = document.querySelector('.chatBot-add-Modal');

        
        chatAddElement.addEventListener('click', function() {
            if (chatBotAddModal.style.display === 'block' || chatBotAddModal.style.display === '') {
                chatBotAddModal.style.display = 'none';
            }
        });

    </script>

    <script>

        const chatEditElement = document.querySelector('#editIcon');
        const chatBotEditModal = document.querySelector('.chatBot-edit-Modal');

        
        chatEditElement.addEventListener('click', function() {
            if (chatBotEditModal.style.display === 'none' || chatBotEditModal.style.display === '') {
                chatBotEditModal.style.display = 'block';
            }
        });
    </script>


</body>
</html>


<?php
    include "adminFooter.php";
?>