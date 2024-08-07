$(document).ready(function() {

    $("#change_address").click(function() {
        var user_id = $("#userid").val();
        var Block = $("#Block_myProfile").val();
        var Postal = $("#Postal_myProfile").val();
        var City = $("#City_myProfile").val();
        var Region = $("#Region_myProfile").val();

      
        $.ajax({
            type: 'POST',
            url: 'includes/change_address.php',
            data: {
                userid: user_id,
                block: Block,
                postal: Postal,
                city: City,
                region: Region,
            },
            success: function(response) {

                                    // Handle the success response
                if (response === 'Address updated successfully') {
           
                    $("#SuccessInput").text(response);
                    $("#SuccessInput").fadeIn();
                    $("#SuccessInput").show();
                    // alert("Address updated successfully");
                } else {
                    // Show the error message
                    $("#InvalidInput").text(response);
                    $("#InvalidInput").fadeIn();
                    $("#InvalidInput").show();
                }
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle the error
                alert("Error updating address");
                console.log('Error:', error);
            }
        });
    });

    $("#close_address_modal").click(function(){
        $("#InvalidInput").hide();
        $("#SuccessInput").hide();    
     
    });
});