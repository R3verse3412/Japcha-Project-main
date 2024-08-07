<div class="order-list" id="preparingOrders" style="display: none;">
    <div class="order">
        <div class="order-details">
            <p class="order-no"></p>
            <p class="order-price"></p>
        </div>
    </div>
</div>

<script>

function updatePreparingOrders() {
    // Make an AJAX request to fetch the order data
    $.ajax({
        url: '../controller/OrdersPreparing.php', // Replace with your actual server endpoint
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Assuming the response is an array of orders
            const orders = response.orders;

            // Clear the existing order list
            $('#preparingOrders').empty();

            // Iterate through the orders and append them to the list
            orders.forEach(function (order) {
                const orderItem = $('<div>').addClass('order');
                const orderDetails = $('<div>').addClass('order-details');
                orderDetails.append($('<p>').text('Order No. #' + order.orderNo));
                orderDetails.append($('<p>').text('₱' + order.price));
                orderItem.append(orderDetails);

                const orderActions = $('<div>').addClass('order-actions');
                orderActions.append($('<button>').addClass('remove-button').text('Remove'));
                orderActions.append($('<button>').addClass('deliver-button').text('Deliver'));
                orderItem.append(orderActions);

                $('#preparingOrders').append(orderItem);
            });

            // Set a timeout to call this function again after a certain interval
            setTimeout(updatePreparingOrders, 5000); // Poll every 5 seconds (adjust as needed)
        },
        error: function (xhr, status, error) {
            console.log('Error: ' + error);

            // If there's an error, retry after the same interval
            setTimeout(updatePreparingOrders, 5000);
        }
    });
}
</script>