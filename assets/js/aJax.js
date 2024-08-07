$(document).ready(function(){
    $("#live_search").on("keyup",function(){
        var input = $(this).val();
        // alert(input);

        if(input != ""){
            $.ajax({
                url: "adminDisplayResult/displaySearchResult.php",
                method: "POST",
                data:{input: input},

                success: function(data){
                    $("#userTable").html(data);
                }
            });
        }else{
            $.ajax({
                url: "adminDisplayResult/displayCustomerResult.php", //Replace with the correct PHP script to fetch original data
                method: "POST",
                success: function(data) {
                    $("#userTable").html(data);
                },
                error: function() {
                    console.log("Error occurred while fetching original data.");
                }
            });
        }
    });
});

function showCategory(){  
    $.ajax({
        url:"./adminDisplayResult/viewCategoryResult.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}


function variationEdit(id){
    console.log(id);
        $.ajax({
            url:'../back-end/EditProductSizes.php',
            method:"post",
            data:{var:id},
            success:function(data){
                // alert('Successfully Updated');
                // $('.allContent-section').html(data);

                $('.tableAdmin').html(data);
            },
            error: function() {
                console.log('Error fetching content.');
            }
        });
}
function closeVariationModal(){
    document.getElementById('updateVar').classList.remove("open-formUpdate");
}