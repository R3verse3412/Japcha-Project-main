function updateMessageTime(message, orderDate) {
    setInterval(function () {
        // Parse order date to get the timestamp
        let timestamp = new Date(orderDate).getTime();
        // Get the current time
        let currentTime = new Date().getTime();
        // Calculate elapsed time
        let elapsedTime = currentTime - timestamp;

        // Calculate days, hours, minutes
        let elapsedDays = Math.floor(elapsedTime / (1000 * 60 * 60 * 24));
        let elapsedHours = Math.floor((elapsedTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let elapsedMinutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));

        // Display time
        let timeString = '';
        if (elapsedDays > 0) {
            timeString += elapsedDays + ' days ';
        }
        if (elapsedHours > 0) {
            timeString += elapsedHours + ' hours ';
        }
        if (elapsedMinutes > 0 || timeString === '') {
            timeString += elapsedMinutes + ' minutes ';
        }

        // Set the time string in the message element
        message.find(".message-time").text(timeString + ' ago');
    }, 1000); // Update every second
}


$(document).ready(function () {

PopulateNotification();

setInterval(() => {
    PopulateNotification();
}, 5000);


// Function to get the current date in Manila timezone
function getCurrentDateInManila() {
    const options = { timeZone: 'Asia/Manila', year: 'numeric', month: 'numeric', day: 'numeric' };
    const formatter = new Intl.DateTimeFormat('en-US', options);
    return formatter.format(new Date());
}

// Function to format the order date to match the current date format
function formatOrderDateForComparison(orderDate) {
    const date = new Date(orderDate);
    const year = date.getFullYear();
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const day = date.getDate().toString().padStart(2, '0');
    return `${month}/${day}/${year}`;
}

// Function to populate notifications
function PopulateNotification() {
    const current_date = getCurrentDateInManila();

    $.ajax({
        type: 'GET',
        url: '../controller/get_notification_data_back-end.php',
        dataType: 'json',
        success: function (response) {
            // Assuming orders is an array in the response
            response.orders.forEach(function (order) {
                // Clone the template message
                let newMessage = $(".admin-message").first().clone();

                // Set message content
                newMessage.find(".message-text").text("New orders received. Please Check");
                newMessage.find(".message-order").text("ORDER NO. " + order.orderId);
                newMessage.find(".message-time").text(order.OrderDate);

                // Update time dynamically
                updateMessageTime(newMessage, order.OrderDate);

                // Format orderDateOnly to match the current_date format
                const orderDateOnly = formatOrderDateForComparison(order.OrderDate);

                if (order.statusCompleted === 1 || order.statusRemoved === 1) {
                    newMessage.find(".message-text").text("COMPLETED");
                    newMessage.css('background-color', 'rgb(207 242 207');
                    newMessage.find(".message-text").css('color', '#198e02');
                } else if (order.statusPreparing === 1) {
                    newMessage.find(".message-text").text("PREAPARING");
                    newMessage.find(".message-text").css('color', 'rgb(227 35 35)');
                    newMessage.css('background-color', 'rgb(242 213 207)');
                    newMessage.attr('href', 'AdminOrders.php');
                }
                 else if (order.statusDelivery === 1) {
                    newMessage.find(".message-text").text("DELIVERY");
                    newMessage.find(".message-text").css('color', 'rgb(227 35 35)');
                    newMessage.css('background-color', 'rgb(242 213 207)');
                    newMessage.attr('href', 'AdminOrders.php');
                } else if (order.statusActive === 1 && order.statusCompleted === 0 && order.statusDelivery === 0 && order.statusPreparing === 0 && order.statusRemoved === 0 &&
                    orderDateOnly.replace(/\/0/g, '/') !== current_date.replace(/\/0/g, '/')) {
                    newMessage.find(".message-text").text("EXPIRED");
                    newMessage.find(".message-text").css('color', '#e40a0a');
                    newMessage.find(".message-order").css('color', '#e40a0a');
                    newMessage.find(".message-time").css('color', '#776767');
                    newMessage.css('background-color', 'rgb(77 3 3)');
                } else if (order.statusActive === 1 && order.statusCompleted === 0 && order.statusDelivery === 0 && order.statusPreparing === 0 && order.statusRemoved === 0 &&
                    orderDateOnly.replace(/\/0/g, '/') === current_date.replace(/\/0/g, '/')) {
                    newMessage.find(".message-text").text("NEW");
                    newMessage.find(".message-text").css('color', 'rgb(227 35 35)');
                    newMessage.css('background-color', 'rgb(242 213 207)');
                    newMessage.attr('href', 'AdminOrders.php');
                } else if (order.statusCancel === 1) {
                    newMessage.find(".message-text").text("CANCELLED");
                    newMessage.find(".message-text").css('color', '#c5c543');
                    newMessage.css('background-color', 'rgb(242 242 211)');
                }

                // Show the new message
                newMessage.css('display', 'block');

                // Append the new message to the parent
                $(".admin-message").parent().append(newMessage);
            });
        },
        error: function (xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
}

// Call the function to populate notifications

});