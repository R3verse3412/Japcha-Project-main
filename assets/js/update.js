$(document).ready(function(){
  get_records();
  close_update();
});

function close_update(){
    $(document).on('click', '.close2', function() {
      // Assuming 'modalupdate' is the ID of your modal element
      document.getElementById('modalupdate').style.display = "none";
      document.getElementById('popup2').classList.remove("open-modal-container2");
    });
  }

function get_records(){

    $(document).on('click', '.update', function() {
      // Assuming 'modalupdate' is the ID of your modal element
        // document.getElementById('modalupdate').style.display = "flex";
        // document.getElementById('popup2').classList.add("open-modal-container2");
      
     var ide = $(this).attr('data-id');
    //  console.log(id);
      $.ajax(
        {
            url: '../controller/get_data_category.php',
            method: 'post',
            data:{categoryid:ide},
            dataType: 'JSON',
            success: function(data) 
            {
              if (data && data.length >= 2) {
                    // Assuming data[0] is category_id and data[1] is category_name
                    $("#categoryid").val(data[0]);
                    $("#categoryname").val(data[1]);
                    
                    // Show the modal
                    document.getElementById('modalupdate').style.display = "flex";
                    document.getElementById('popup2').classList.add("open-modal-container2");
                } else {
                    // Handle the case where the data is not as expected
                    console.error("Invalid data received from the server");
                }
            },
            error: function(xhr, textStatus, errorThrown) {
              console.error("AJAX request failed:", textStatus, errorThrown);
              // Handle the error here, e.g., show an error message to the user
          }
  
      });
    });
  }