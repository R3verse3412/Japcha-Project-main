document.addEventListener('DOMContentLoaded', function () {
    var questionContainers = document.querySelectorAll('.question-cont-nonuser');

    questionContainers.forEach(function (container) {
        container.addEventListener('click', function () {
            
            // Get the chat question and answer from the clicked container
            var chatQuestion = container.querySelector('p:nth-child(1)').textContent;
            var chatAnswer = container.querySelector('p:nth-child(2)').textContent;

            // Create a new client message container
            var clientChatContainer = document.createElement('div');
            clientChatContainer.className = 'client-chat-cont';

            

            // Create client message
            var clientMessage = document.createElement('div');
            clientMessage.className = 'client-message';
            clientMessage.innerHTML = '<p>' + chatQuestion + '</p>';
            clientChatContainer.appendChild(clientMessage);

            // Append the client message container to the chat box
            document.querySelector('.chat-box-cont').appendChild(clientChatContainer);

            // Create a new admin message container
            var adminChatContainer = document.createElement('div');
            adminChatContainer.className = 'admin-chat-cont';

            // Create admin icon
            var adminIcon = document.createElement('i');
            adminIcon.className = 'fa fa-user-circle';
            adminIcon.setAttribute('aria-hidden', 'true');
            adminChatContainer.appendChild(adminIcon);

            // Create admin message
            var adminMessage = document.createElement('div');
            adminMessage.className = 'admin-message';
            adminMessage.innerHTML = '<p>' + chatAnswer + '</p>';
            adminChatContainer.appendChild(adminMessage);

            // Append the admin message container to the chat box
            document.querySelector('.chat-box-cont').appendChild(adminChatContainer);
            scrollToBottomChatbot();
        });
    });
});



function scrollToBottomChatbot() {
var chatBox = document.querySelector('.chat-box-cont');
chatBox.scrollTop = chatBox.scrollHeight;
}

window.addEventListener('load', scrollToBottomChatbot);


