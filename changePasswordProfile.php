<?php
    include "customerProfileHeader.php";
?>
<div class="rightContainer">
    <div class="ManageAccountSection"><h2>Change Password</h2></div>
        <div class="containerFormSection">
            <form action="" autocomplete="off">
                <label for="oldpass">Old Password</label>
                <input type="password" name="oldpass">
                <label for="newPass">New Password</label>
                <input type="password" name="newPass">
                <label for="confirmPass">Confirm Password</label>
                <input type="password" name="confirmPass">
                <div class="buttonChangePass">
                    <button>Save Changes</button>
                    <button><a href="customerManageAccount.php">Back</a></button>
                </div>
            </form>
        </div>
</div>
<?php
    include "customerProfileFooter.php";
?>