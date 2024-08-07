<?php

     foreach ($data as $admin):
?>
<div class="modal fade" id="EditAdminPopup<?=$admin['admin_id']?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="form_close" data-dismiss="modal" style="position: absolute; right: 0; z-index: 99999;">
                <i class="uil uil-times"></i>
            </button>
            <div class="modal-body">
                <form action="../includes/signup-admin.inc.php" method="post">
                    <h2>Signup</h2>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" placeholder="Username" name="userName" value="<?=$admin['username']?>" required/>
                        <input type="hidden" name="AdminId" value="<?=$admin['admin_id']?>">
                 
                    </div>
                    <div class="form-group">
                        <label for="username">Full Name:</label>
                        <input type="text" class="form-control" placeholder="Full Name" name="fullname" value="<?=$admin['fullname']?>" />
                 
                    </div>


                    <div class="form-group">
                        <label for="user_level">User Level:</label>
                        <input type="hidden" name="default_userlevel" value="<?=$admin['userlevel_id']?>">
                        <select class="form-control" name="user_level">
                            <option value="<?=$admin['userlevel_id']?>" selected disabled style="font-style: italic; color:gray;"><?=$admin['user_level_name']?></option>
                            <?php
                            $userlevels = $UserLevel->getUserlevelByID($admin['userlevel_id']);
                            foreach ($userlevels as $userlevel):
                            ?>
                            <option value="<?= $userlevel['userlevel_id']?>"><?= $userlevel['user_level_name']?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Phone:</label>
                        <input type="text" class="form-control"  name="contact" value="<?=$admin['contact']?>"/>
                    </div>
                    <button class="btn1" type="submit" name="EditAdmin">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

    endforeach;
?>
