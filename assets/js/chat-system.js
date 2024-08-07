$(document).ready(function () {
    const userid = $("#userid_chat").val();
    let username = $("#username_chat").val();
    let lname = $("#lname_chat").val();
    let fullname = username + ' ' + lname;



    $('.question-cont').on('click', function () {

            var chatbotId = $(this).data('chatbot-id');
            var question = $(this).data('chatbot-question');
            var answer = $(this).data('chatbot-answer');

            $.ajax({
                type: 'POST',
                url: 'controller/SendChatMessageCustomer.php',
                data:{
                    chatbotId: chatbotId,
                    userid: userid,
                    fullname: fullname,
                    question: question,
                    answer: answer
                },
                success: function(response){
                    console.log(response);
                },
                error: function(error){
                    console.log("error has occured: " + error);
                }
            });

        });



    $("#send_chat").click(function () {
        sendMessage();
    });

  $("#chat-input-text").keypress(function (e) {
    // Check if the pressed key is Enter (key code 13)
    if (e.which == 13) {
        e.preventDefault();  // Prevent the default form submission
        sendMessage();
    }
});


    function sendMessage() {
        let message = $("#chat-input-text").val();

        $.ajax({
            type: 'POST',
            url: 'controller/SendChatMessageCustomer.php',
            data: {
                sender_id: userid,
                fullname: fullname,
                message: message,
            },
            success: function (response) {


                if (response.success) {
                    $("#chat-input-text").val('');
                } else {
                    // alert("Error: " + response.error);
                    $("#alert_contains_curse").fadeIn();
                    $("#alert_contains_curse").text(response.error);
                    $("#alert_contains_curse").show();
                    $("#chat-input-text").val('');
                    setTimeout(() => {
                        $("#alert_contains_curse").fadeOut();
                        $("#alert_contains_curse").hide();
                    }, 5000);
                }
                // Clear the input field
      
            },
            error: function (error) {
                console.log("error has occurred: " + error);
            }
        });
    }


$('.chatcon').mouseenter(function () {
    $(this).addClass("active");
});

$('.chatcon').mouseleave(function () {
    $(this).removeClass("active");
});


function getCustomerChat() {
    $.ajax({
        type: 'GET',
        url: 'controller/SendChatMessageCustomer.php',
        data: {
            senderid: userid
        },
        success: function (response) {
            if (response.error) {
                console.error('Error:', response.error);
                // Handle the error case if needed
            } else {
                // Display the chat messages in the chat container
                $('.chatcon').html(response);
                if (!$('.chatcon').hasClass('active')) {
                    scrollToBottom();
                }

                
            }
        },
        error: function (xhr, status, error) {
            console.log("Error Status:", status);
            console.log("Error Message:", error);
            console.log("XHR Object:", xhr);
        }
    });
}


    getCustomerChat();
    setInterval(() => {
        getCustomerChat();
    }, 500);


const container = document.getElementById('scrollableContainer');

window.addEventListener('load', scrollToBottom);



function scrollToBottom() {
    var chatBox = document.querySelector('.chatcon');
    chatBox.scrollTop = chatBox.scrollHeight;
}

window.addEventListener('load', scrollToBottom);


// CHATBOT 



});