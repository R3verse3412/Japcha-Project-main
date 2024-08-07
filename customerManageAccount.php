<?php
    include "customerProfileHeader.php";
?>
<div class="rightContainer">
    <div class="ManageAccountSection"><h2>Manage Account</h2></div>
        <div class="containerFormSection">
            <form action="" autocomplete="off">
                
            <div class="form-group">
             
                <div class="row">
                    <div class="col-sm-6">
                        <label for="email">First Name</label>
                        <input type="text" class="form-control" id="f_name" placeholder="First Name" name="Postal" value="<?= $customer_date["username"]?>" disabled  required />
                    </div>
                    <div class="col-sm-6">
                        <label for="email">Last Name</label>
                        <input type="text" class="form-control" id="l_name" placeholder="Last Name" name="City" value="<?= $customer_date["last_name"]?>"  disabled required />
                    </div>
                </div>
            </div>

                
            <div class="form-group">
                    <label for="email">Email</label> <span class="edit-alert" style="color: red; display: none;">This field can't be edited.</span>
                   <input type="text" class="form-control" id="email_" placeholder="Email" name="Region" value="<?= $customer_date["email"]?>"  disabled required />
                  
            </div>
            <div class="form-group">
                    <label for="email">Contact No.</label>
                   <input type="text" class="form-control" id="contact_" placeholder="Contact No." name="Region" value="<?= $customer_date["contact_number"]?>"  disabled required />
                  
            </div>
            <span style="color: green; display: none;" id="success-info"></span>
            <span style="color: red; display: none;" id="error-info"></span>
                <div class="button">
                    <button type="button" class="btn btn-primary" id="edit-profile">Edit Profile</button>
                    <button type="button" class="btn btn-primary" id="save-profile" style="display: none;">Save</button>
                </div>
            </form>
        </div>
</div>
<input type="hidden" id="uid" value="<?= $_SESSION['userid']?>">
   <script>
    $(document).ready(function(){
        var user_id = $("#uid").val();

        $("#edit-profile").click(function () {


            // Toggle the disabled state of input fields
            $("#f_name, #l_name, #contact_").prop("disabled", function (i, val) {
                return !val; // Toggle the disabled state
            });

            // Toggle the visibility of the save button
            $("#save-profile").toggle();
            $(".edit-alert").toggle();
            // Toggle the text of the edit button
            var editButtonText = $(this).text() === "Edit Profile" ? "Cancel" : "Edit Profile";
            $(this).text(editButtonText);
        
        });

        $("#save-profile").click(function(){
            var fname = $("#f_name").val();
            var lname = $("#l_name").val();
            var contact = $("#contact_").val();
            console.log(user_id);
                $.ajax({
                type: 'POST',
                url: 'includes/change_address.php',
                data: {
                    customer_id: user_id,
                    fname: fname,
                    lname: lname,
                    contact: contact,
                },
                success: function(response) {

                                        // Handle the success response
                    if (response === 'Information is successfully updated') {
            
                        $("#success-info").text(response);
                        $("#success-info").fadeIn();
                        $("#success-info").show();

                        $("#error-info").fadeOut();
                        $("#error-info").hide();
                    } else{
                        // Show the error message
                        $("#error-info").text(response);
                        $("#error-info").fadeIn();
                        $("#error-info").show();
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


     

        // function getCustomerInfo(){
          
        //         $.ajax({
        //             type: 'GET',
        //             url: 'controller/GetUserInfo.php',
        //             data:{
        //                 userid: user_id
        //             },
        //             success: function(response){
        //                 $("#ss").text(response);
        //                 console.log(response);
        //             },
        //             error: function(xhr, status, error){
        //                 console.log("error occured: " + error);
        //             }
        //         });

           
       
        // }

        //  getCustomerInfo()

        // setInterval(async () => {
        //     await getCustomerAddress();
        // }, 5000);

    });
   </script>
<?php
    include "customerProfileFooter.php";
?>