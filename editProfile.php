<?php
    include "customerProfileHeader.php";
?>
<div class="rightContainer">
    <div class="ManageAccountSection"><h2>Edit Profile</h2></div>
        <div class="containerFormSection">
            <form action="" autocomplete="off">
                <label for="fullname">Fullname</label>
                <input type="text" name="fullname">
                <label for="email">Email</label>
                <input type="text" name="email">
                <label for="contact">Contact No.</label>
                <input type="text" name="contact">
                <div class="buttonSave">
                    <button>Save Changes</button>
                    <button><a href="customerManageAccount.php">Back</a></button>
                </div>
            </form>
        </div>
</div>
    
<?php
    include "customerProfileFooter.php";
?>