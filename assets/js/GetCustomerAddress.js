$(document).ready(async function(){
    var user_id = $("#userid").val();

    function getCustomerAddress(){
        new Promise((resolve) =>{
            $.ajax({
                type: 'GET',
                url: 'controller/GetCustomerAddress.php',
                data:{
                    userid: user_id
                },
                success: function(response){
                    $("#CustomerAddressField").html(response);
                },
                error: function(xhr, status, error){

                }
            });

        });
   
    }

    await getCustomerAddress()

    setInterval(async () => {
        await getCustomerAddress();
    }, 5000);
}); 