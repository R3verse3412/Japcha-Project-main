<?php
include_once "c_header.php";
require_once "classes/chatbotFrontModel.php";
$chatbot = new chatbotFrontModel();
$getChatQuestions = $chatbot->getAllChatQuestions();
?>
    <link rel="stylesheet" href="frontChat.css">
    <link rel="stylesheet" href="assets/css/chat.css">
    <style>
        .chatcon::-webkit-scrollbar{
            width: 0px;
        }
        .chatbotcon::-webkit-scrollbar{
            width: 0px;
        }
    </style>
<div class="chat-main-cont">
    
    <div class="chat-form">
        <div class="chat-title-cont">
            <h2>CHAT WITH US</h2>
        </div>
        
        <div class="chat-area">
            
           
                <?php
                    // if(isset($_SESSION['userid'])){
                ?>
                <div class="chat-box-cont" id="scrollableContainer">
                <!-- <div class="chatbotcon"> -->
                <?php
                    // }else{
                ?>
                <!-- <div class="chat-box-cont" id="scrollableContainer" >
                 <div class="chatbotcon" style="overflow-y: auto; width:100%"> -->
                 
                <?php
                    // }
                ?>
                    <div class="admin-chat-cont " style="margin-bottom: -10px; ">
                        <!-- admin icon -->
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <!-- admin message -->
                        <div class="admin-message" id="admin-message">
                            <p>Hello and welcome to JapCha, your one-stop destination for delightful beverages and foods! How can we assist you today?</p>
                        </div>

                    </div>

                    <div class="chat-bot-cont">
                        
                        <?php
                                $count = 1;
                                foreach (($getChatQuestions ?? []) as $gchatbot):
                        ?>
                        <?php
                        if(isset($_SESSION['userid'])){
                        ?>
                        <div class="question-cont" data-chatbot-id="<?= $gchatbot['id']?>" data-chatbot-question="<?= $gchatbot['chatQuestion']?>" data-chatbot-answer="<?= $gchatbot['chatAnswer']?>">
                        <?php
                            }else{
                            
                        ?>
                        <div class="question-cont-nonuser" data-chatbot-id="<?= $gchatbot['id']?>" data-chatbot-question="<?= $gchatbot['chatQuestion']?>" data-chatbot-answer="<?= $gchatbot['chatAnswer']?>">
                        <?php
                            }
                        ?>
                            <p><?= $gchatbot['chatQuestion']?> </p>
                            <p style="display: none;"><?= $gchatbot['chatAnswer']?></p>
                            
                        </div>
                        

                        <?php
                            $count++; 
                            endforeach;

                        ?>
                        
                    </div>
            
<!-- 
                    <div class="append_chatbot_answer">

                    </div> -->
                <!-- </div> -->
                <?php
                        if(isset($_SESSION['userid'])){
                ?>
                    <div class="chatcon" style="overflow-y: auto;">
                

                    </div>
                             
                <?php
                    }
                ?>
            </div>
     
               
          
        </div>
     
           
        <!-- <script src="JavaChat.js"></script> -->
       
        
        <div class="alert alert-danger" role="alert" style="width: 100%; display: none;" id="alert_contains_curse"></div>
     
         <!-- <div class="chat-input-cont">
            <textarea name="" id="chat-input-text" cols="30" rows="1" style="width: 100%; padding: 10px; resize: none;"></textarea>
            <button type="button" class="btn btn-link" id="send_chat"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
        </div> -->
        <?php
            if(isset($_SESSION['userid'])){
                
            
        ?>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="hidden" name="" id="userid_chat" value="<?= $_SESSION['userid']?>">
                <input type="hidden" name="" id="username_chat" value="<?= $_SESSION['username']?>">
                <input type="hidden" name="" id="lname_chat" value="<?= $_SESSION['lastname']?>">
                <input type="text" class="input-field" id="chat-input-text">
                <button type="button"  id="send_chat"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </form>
        <?php
             }else{

             
        ?>
        <div class="chat-input-cont">
            <textarea name="" id="n" cols="30" rows="1" style="width: 100%; padding: 10px; resize: none;"></textarea>
            <button type="button" class="btn btn-link" id="log-in-chat"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
        </div>
                <script>
                    $(document).ready(function(){
                        
                        $("#log-in-chat").click(function() {

                            $(".form-container").addClass("show");
                        });

                      
                    });
                </script>
        <?php
             }
        ?>


            
      
            
    </div>

</div>

<script src="assets/js/chat-system.js"></script>
<script src="assets/js/chat-bot.js"></script>

<?php
    include_once "c_footer.php";
?>



