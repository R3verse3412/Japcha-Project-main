<?php
    include "adminHeader.php";
    include "../classes/dbh.classes.php";
    include "../classes/user-level-Model.php";
    include "../classes/signup.classes.php";
    $UserLevel = new UserLevel();
    $adminData = new Signup();
?>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
<style>
    i{
        bottom: 0 !important;
    }

</style>
<main class="tableAdmin">
        <div class="card-option">
            <div class="cardHeader">
                <h6>Admin Account</h6>
                
                <?php
                    if(isset($_SESSION["fileManagement_create"]) && $_SESSION["fileManagement_create"] == 1){
                        echo'<button type="button" onclick="openAddAdmin()" class="btnAddAdmin">Add Account</button>';
                    }
                ?>
                
            </div>
            <span class="badge badge-warning" style="position: absolute; right:10px;">TOTAL: <span class="totalAdmin"></span></span>
        </div>

        <section class="table_header">
            <!-- <h1>Admin Account</h1> -->
            <input type="search" class="adminSearch" id="searchInput" placeholder="Search....">
        </section>
       
        <section class="table_body">
            <table id="adminTable">
                <thead>
                  <tr>
                    <th>id</th>
                    <!-- <th>Profile</th> -->
                    <th>Username</th>
                    <th>User Level</th>
                    <?php
                            if(isset($_SESSION["fileManagement_delete"]) && $_SESSION["fileManagement_delete"] == 1){
                                echo'<th>Action</th>';

                            }
                    ?>
                  </tr>
                </thead>
                <tbody>
                        <?php
                        $data = $adminData->getAdminData();
                        $count = 1;

                        // Check if there are admin accounts
                        if (empty($data)) {
                            echo "<tr><td colspan='6'>No admin accounts found.</td></tr>";
                        } else {
                            foreach ($data as $admin):
                                $id = $admin['admin_id'];
                        ?>
                            <tr >
                                <td><?= $count ?></td>
                                <!-- <td><img src='../image/user.jpg' alt='user image'></td> -->
                                <td><?= $admin['username'] ?></td>
                                <td><?= $admin['user_level_name'] ?></td>
                                <?php
                                     if(isset($_SESSION["fileManagement_delete"]) && $_SESSION["fileManagement_delete"] == 1){
                                        
                                        ?>
                                        <td>
                                            <!-- <button class="btn btn-info" data-tooltip="tooltip" data-placement="top" title="View Userlevel"
                                            data-toggle="modal" data-target=""><i class="fa fa-eye" aria-hidden="true"></i></button>
                                             -->
                                            <button class="btn btn-secondary" data-tooltip="tooltip" data-placement="top" title="Edit admin account"
                                            data-toggle="modal" data-target="#EditAdminPopup<?=$admin['admin_id']?>"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                            
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#DeleteAdmin<?= $id ?>">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                <?php
                                     }
                                ?>
                                
                            </tr>
                        <?php
                            $count++;
                            endforeach;
                        }
                        ?>

                </tbody>
              </table>
             
        </section>
        <?php
            foreach (["DeletedSuccess", "AddedSuccess", "DeletedAdmin", "EditedAdmin", "uid_taken","empty_input_admin","inavlid_name_admin_account","invalid_contact_admin_account"] as $key) {
                if (isset($_SESSION[$key])) {
                    $alertType = 'success';

                    // Check if EditAdmin or DeleteAdmin is true and set corresponding alert type
                    if ($key === 'EditedAdmin' || $key === 'uid_taken' ||  $key === 'empty_input_admin' || $key === 'inavlid_name_admin_account' || $key === 'invalid_contact_admin_account') {
                        $alertType = 'warning';
                    } elseif ($key === 'DeletedAdmin') {
                        $alertType = 'danger';
                    }

                    echo '<div class="alert alert-' . $alertType . '" role="alert">';
                    echo $_SESSION[$key];
                    echo '</div>';

                    unset($_SESSION[$key]);
                }
            }
        ?>


    </main>

    <!--triggers can't click outside element when modal is open -->

            <div class="form signup_form" id="addAdminPopup">
                <button class="form_close" onclick="closeAddAdmin()"><i class="uil uil-times"></i></button>
                <div class="formBody">
                    <form action="../includes/signup-admin.inc.php" method="post">
                        <h2>Signup</h2>
                        <div class="input_box">
                            <label for="username">Username:</label>
                            <input type="text" placeholder="Username" name="userName" required />
                            <i class="uil uil-user user" style="color: #707070; left: 0;"></i>
                        </div>
                        <div class="input_box">
                            <label for="username">Full Name:</label>
                            <input type="text" placeholder="Full Name"  name="fullname" required />
                            <i class="uil uil-user user" style="color: #707070; left: 0;"></i>
                        </div>
                        <div class="input_box">
                            <label for="username">Password:</label>
                            <input type="password" placeholder="Create password" name="pass" required />
                            <i class="uil uil-lock password"></i>
                            <i class="uil uil-eye-slash pw_hide"></i>
                        </div>
                        <div class="input_box">
                            <label for="user_level">User Level:</label>
                            <select name="user_level" >
                                <option value="default" selected disabled style="font-style: italic; color:gray;">Select user level</option>
                                <?php
                                    $userlevels = $UserLevel->getUserlevel();
                                    foreach ($userlevels as $userlevel):
                                ?>
                                <option value="<?= $userlevel['userlevel_id']?>"><?= $userlevel['user_level_name']?></option>
                                <?php 
                                    endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="input_box">
                            <label for="username">Phone:</label>
                            <input type="tel" placeholder="Phone number (9XX-XXX-XXXX)" name="contact" required />
                            <i class="uil uil-phone phone" style="color: #707070; left: 0;"></i>
                            <!-- <i class="uil uil-eye-slash pw_hide"></i> -->
                        </div>
                        <!-- <input type="submit" class="btnLogin btn-primary"> -->
                        <button class="btnSignup" type="submit" name="AddAdmin">Signup</button>
                    </form>
                </div>
            </div>

    <?php
        include_once "EditAdminAccount.php";
        include_once "DeleteAdmin.php";
    ?>
            
    <!-- <script src="adminJS.js"></script> -->
    <script>
                    let popup = document.getElementById("addAdminPopup");
            // let overlay = document.getElementById("modalOverlay");
            function openAddAdmin()
            {
                popup.classList.add("open-form");
            //    modalOverlay.style.display = "block";
            }
            function closeAddAdmin()
            {
            popup.classList.remove("open-form");
            //   modalOverlay.style.display = "none";
            }
            function closeModal(event) {
            if (event.target === modalOverlay || event.key === "Escape") {
            closePopup();
            }
            }

            // Listen for clicks on the modal overlay
            modalOverlay.addEventListener("click", closeModal);

            // Listen for keydown events to close the modal when "Escape" key is pressed
            document.addEventListener("keydown", closeModal);
    </script>
    <script>
        $(document).ready(async function(){
            await fetchAdminCount();

                function fetchAdminCount() {
                new Promise((resolve) =>{
                    $.ajax({
                        url: '../controller/get_product_count.php', // Update with the actual path to your PHP file
                        type: 'GET',
                        data:{admin: "admin"},
                        dataType: 'json',
                        success: function(response) {
                            $(".totalAdmin").text(response.count)
                        },
                        error: function(xhr, status, error) {
                            console.error("Error: " + error);
                        }
                    });
                });
                
                }

            $("#searchInput").on("keyup", function () {
                var searchText = $(this).val().toLowerCase(); // Get the input value and convert to lowercase
                $("#adminTable tbody tr").filter(function () {
                    // Hide rows that do not match the search text
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });
        });
    </script>
    <!-- Modal script -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="aJax.js"></script>
<?php
    include "adminFooter.php";

?>