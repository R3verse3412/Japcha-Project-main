<?php
    include_once "adminHeader.php";
    include "../classes/dbh.classes.php";
    include "../classes/ChatbotModel.php";
    require_once "../classes/signup.classes.php";

    $chatbot = new ChatbotModel();
    $CustomerData = new Signup();

    $getchatQuestions = $chatbot->getAllChatQuestions();
?>
<style>
  .gap-4 > * {
    margin-bottom: 1rem; /* Adjust the margin as needed */
  }
  .name::-webkit-scrollbar{
    width: 0px;
  }

  .rightCont::-webkit-scrollbar{
    width: 0px;
  }
</style>

<?php
    if(isset($_SESSION["chatManagement_view"]) && $_SESSION["chatManagement_view"] == 1){
?>
<link rel="stylesheet" href="../assets/css/adminMessage.css">

<div class="mainContainer">
    <div class="leftCont">
        <div class="searchCont">
            <span style="font-weight: bold; font-size: 30px; margin-right: 10px;">CHAT</span>
           
            <!-- <img src="../image/searchButton.png"alt=""> -->
            <i class="fa fa-cog fa-2x" id="chatbotManagerIcon" aria-hidden="true"></i>
        </div>
        <div class="d-flex justify-content-center"> 
            <form class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search" aria-label="Search" aria-describedby="searchIcon">
                    <div class="input-group-append">
                        <span class="input-group-text" id="searchIcon">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    
       
    <?php
        $customerData = $CustomerData->getAllCustomerAccounts();
        foreach( $customerData as $customer):
        
                ?>
  
    
            <div class="chatCont" style="border: solid #bba9a9 thin; padding: 5px;" data-customer_id=<?= $customer['customer_id']?>>

                <div class="profileCont">
                    <img src="../image/sample1.png" alt="" class="img-fluid rounded-circle">
                </div>

                <div class="messageCont">
                    <p class="name" ><?= $customer['combined_name']?></p>
                    <p class="message"></p>
                </div>

                <div class="timeCont text-right">
                    <p><?= $customer['latest_timestamp'] ?></p>
                </div>
            </div>

    <?php
        endforeach;
    ?>
    </div>

    <div class="rightCont">
        
        <div class="conatiner">
            <div class="container-body d-flex flex-column gap-4">

              

                <!-- <div class="client-chat-Container">
                    <div class="client-profile-Container">
                        <img src="../image/sample1.png" alt="" style="height: 50px;">
                    </div>

                    <div class="clientMessageCont">
                        <p>Sample Message Sample Message Sample Message Sample Message Sample MessageSample Message</p>
                    </div>
                </div>


                <div class="convoCont" >
                    <div class="sampleMessageCont">
                        <p class="sampleMess m-0" alt="">sada</p>
                    </div>

                    <div class="chat-profile-Container">
                        <img src="../image/japcha_logo.png" alt="" style="height: 50px;">
                    </div>
                </div> -->

                

            </div>
            
            <div class="container-footer" >
            <div class="alert alert-danger" role="alert" style="width: 100%; display: none;" id="alert_contains_curse">Alert Danger!</div>
                <div class="inputCont">
                    <input type="text" placeholder="Type here..." name="" id="chat-input-text">
                    <button type="button" class="btn btn-link" id="send_chat"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
       
        
    </div>

<input type="hidden" id="admin_id_chat" value="<?= $_SESSION['adminID']?>">


<script>
$(document).ready(function () {

    $("#searchInput").on("input", function() {
            var searchTerm = $(this).val().toLowerCase();
            
            // Loop through each name and show/hide based on the search term
            $(".name").each(function() {
                var name = $(this).text().toLowerCase();
                var chatCont = $(this).closest(".chatCont");
                
                if (name.includes(searchTerm)) {
                    chatCont.show();
                } else {
                    chatCont.hide();
                }
            });
        });

    // Initialize customerID
    var customerID = null;

    // Event listener for clicking on customer containers
    $('.chatCont').click(function () {
        // Get the customer_id attribute value
        customerID = $(this).data('customer_id');
        let ms_id = $(".msg_id").val();



        getCustomerChat(customerID);
        setInterval(() => {
            getCustomerChat(customerID);
        }, 500);

       
    });

    // Event listener for sending a chat message
    $("#send_chat").click(function () {
        sendMessage(customerID);

    });

    // Bind keypress event to the input field
    $("#chat-input-text").keypress(function (e) {
        // Check if the pressed key is Enter (key code 13)
        if (e.which == 13) {
            sendMessage(customerID);
        }
    });

    // Function to send a chat message
    function sendMessage(customerID) {
        let message = $("#chat-input-text").val();
        if (typeof customerID == 'undefined') {
            alert("Select a customer");
        } else {
            $.ajax({
                type: 'POST',
                url: '../controller/SendChatMessageCustomer.php',
                data: {
                    customer_id: customerID,
                    message: message,
                },
                success: function (response) {

                    if (response.success) {
                        // After successfully sending the message, update the chat
                        console.log("success");
                        // Clear the input field
                        $("#chat-input-text").val('');
                    } else {
                        // Display error message
                        $("#alert_contains_curse").fadeIn();
                        $("#alert_contains_curse").text(response.error);
                        $("#alert_contains_curse").show();
                        $("#chat-input-text").val('');
                        setTimeout(() => {
                            $("#alert_contains_curse").hide();
                            $("#alert_contains_curse").fadeOut();
                        }, 3000);
                        console.log("failed");
                    }
                },
                error: function (error) {
                    console.log("error has occurred: " + error);
                }
            });
        }
    }


$('.container-body').mouseenter(function () {
    $(this).addClass("active");
});

$('.container-body').mouseleave(function () {
    $(this).removeClass("active");
});


function getCustomerChat(customerID) {
        $.ajax({
            type: 'GET',
            url: '../controller/SendChatMessageCustomer.php',
            data: {
                customer_id_backend: customerID,
            },
            success: function (response) {
                if (response.error) {
                console.error('Error:', response.error);
                    // Handle the error case if needed
                } else {
                    // Display the chat messages in the chat container
                    $('.container-body').html(response);
                    if (!$('.container-body').hasClass('active')) {
                        $('.container-body').scrollTop($('.container-body')[0].scrollHeight);
                    }

                    
                }
            },
            error: function (error) {
                console.log("Error fetching customer chat: " + error);
        }
    });

}

function updateIsSeen(){

}

});

</script>
    <div class = "Chatbot-Manager">
            <div class="Chat-title-cont">
                <p>Chatbot Manager</p>
                <div class="chatbot-add">
                <i class="fa fa-plus-square-o fa-2x" aria-hidden="true"></i>
                <i class="fa fa-times fa-2x" id="closeChatbotManager" aria-hidden="true"></i>
                </div>
            </div>
        <table class ="chatbotTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    $count =1;
                foreach($getchatQuestions as $gChatbot):
                ?>

                <tr>
                <td><?= $count?></td>
                <td><?= $gChatbot['chatQuestion']?></td>
                <td><?= $gChatbot['chatAnswer']?></td>
                <td><button type="button" id ="editButton"class="btn" style="background-color: black; border-color: black; color: #ffffff;" data-toggle="modal" data-target="#editModal <?=$gChatbot['id']?>">Edit</button>
                <button type="button" class="btn btnDeleteChatbot" style="background-color: #dc3545; border-color: #dc3545; color: #ffffff;" data-toggle="modal" data-target="#delete" data-id_chatbot="<?=$gChatbot['id']?>">Delete</button></td>
            </tr>
                <?php
                    $count++; endforeach;
                ?>
                </tbody>
            </table>
            
    </div>
       
    
    <div class="Chatbot-add-Modal">
        <form action="../includes/add-chatbot.inc.php" method="POST">
            <textarea required class ="typeQuestion" name="addQuestion" id="" cols="10" rows="1" placeholder="Add Question Here..."></textarea>
            <textarea required class="typeAnswer" name="addAnswer" id="" cols="10" rows="1" placeholder="Add Answer Here..."></textarea>

            <div class="buttonModal">
                <button type="submit" name="addChatbot" class="answerAdd">Add</button>
                <button type="button" class="answerCancel" onclick="closeAddModal()">Cancel</button>


            </div>

        </form>
    </div> 

         
    <?php
        include "EditChatbot.php";
      ?> 
             
</div>

        
<div class="modal fade justify-content-center align-items-center" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true" style="z-index: 99999;">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                        <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
               
                    <div class="alert alert-danger mb-0" role="alert">
                        Do you want to delete this?
                    </div>
      
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger confirm_delete" data-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    const chatbotManagerIcon = document.getElementById('chatbotManagerIcon');
    const chatbotManagerModal = document.querySelector('.Chatbot-Manager');

    chatbotManagerIcon.addEventListener('click', function() {
        if (chatbotManagerModal.style.display == 'none' || chatbotManagerModal.style.display == '') {
            chatbotManagerModal.style.display = 'block';
        } else {
            chatbotManagerModal.style.display = 'none';
        }
    });

    const addIcon = document.querySelector('.fa-plus-square-o');
    const addModal = document.querySelector('.Chatbot-add-Modal');

    addIcon.addEventListener('click', function() {
        if (addModal.style.display == 'none' || addModal.style.display == '') {
            addModal.style.display = 'block';
        } else {
            addModal.style.display = 'none';
        }
    });

    const editButtons = document.querySelectorAll('#editButton');
    const editModals = document.querySelectorAll('.Chatbot-edit-Modal');

    editButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            if (editModals[index].style.display == 'none' || editModals[index].style.display == '') {
                editModals.forEach(modal => modal.style.display = 'none');
                editModals[index].style.display = 'block';
            } else {
                editModals[index].style.display = 'none';
            }
        });
    });

    
</script>

<script>
    const closeIcon = document.getElementById('closeChatbotManager');
    const chatbotCloseModal = document.querySelector('.Chatbot-Manager');

    closeIcon.addEventListener('click', function() {
        chatbotManagerModal.style.display = 'none';
    });

    function closeAddModal() {
        const chatbotManagerModal = document.querySelector('.Chatbot-Manager');
        const addModal = document.querySelector('.Chatbot-add-Modal');

        addModal.style.display = 'none';
        chatbotManagerModal.style.display = 'block';
    }

    $(document).ready(function(){
        $('.btnDeleteChatbot').click(function(){
            var id = $(this).data('id_chatbot');
            $("#delete").find(".confirm_delete").val(id);
        });

        $('.confirm_delete').click(function(){
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '../controller/SendChatMessageCustomer.php',
                data: {
                    chatbot_id: id
                },
                success: function(response) {

                    if (response && typeof response === 'object') {
                        if (response.success) {
                            alert("Deleted successfully!");
                            
                                window.location.href = 'adminMessage.php';
                           
                        } else {
                            alert("Invalid response from the server");
                        }
                    } else {
                        alert("Invalid response from the server");
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });
    });
</script>

    

<?php
    }
    include "adminFooter.php";
?>