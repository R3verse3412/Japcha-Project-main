<?php
    include "adminHeader.php";
?>
<style>
    
</style>
 <div class="table_category">

<style>
.scrollable-form {
    max-height: 400px; /* Set the desired height */
    overflow-y: hidden; /* Hide vertical scrollbar by default */
    padding: 10px; /* Add padding for spacing */
    scrollbar-width: thin; /* Thin scrollbar */
    scrollbar-color: #555 #f5f5f5;
}
.scrollable-form::-webkit-scrollbar {
    width: 6px;/* Width of the scrollbar */
}

/* Show the scrollbar when hovering over .scrollable-form */
.scrollable-form:hover {
  
  overflow-y: scroll; /* Show vertical scrollbar on hover */
}

/* Customize the scrollbar thumb */
.scrollable-form::-webkit-scrollbar-thumb {
    background-color: #555; /* Thumb color */
}

/* Customize the scrollbar thumb on hover */
.scrollable-form::-webkit-scrollbar-thumb:hover {
    background-color: #333; /* Thumb color on hover */
}
</style>
<?php
   include "../classes/dbh.classes.php";
   include "../classes/user-level-Model.php";
   $UserLevel = new UserLevel();
?>
<?php   
   if(isset($_SESSION["file_view"]) && $_SESSION["file_view"] == 1){                
?>    
        <section class="table_header d-flex p-3" style="gap: 10px;">
            <h2>User Level</h2>   
            <?php
                if(isset($_SESSION["fileManagement_create"]) && $_SESSION["fileManagement_create"] == 1){
            ?>
                <div class="btnAddCategory">
                    <button type="button" class="btn1"  data-toggle="modal" data-target="#myModal" >Add Userlevel</button>
                </div>
            <?php
                }
            ?>
        </section>
        <section class="table_body">
          <a href="AdminArchive.php">See archives</a>
            <table>
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <?php
                            if(isset($_SESSION["fileManagement_delete"]) && $_SESSION["fileManagement_delete"] == 1){
                                echo '<th>Action</th>';
                            }
                        
                        ?>
                  </tr>
                  <tbody>
                  <?php
                     $userlevels = $UserLevel->getUserlevel();
                     $count = 1;
                     foreach ($userlevels as $userlevel):
                  ?>
                      <tr>
                        <td><?= $count?></td>
                        <td><?= $userlevel['user_level_name']?></td>
                        <?php
                            if(isset($_SESSION["fileManagement_edit"]) && $_SESSION["fileManagement_edit"] == 1){
                        ?>
                                <td><div class="btnCon">
                                    <!-- <button class="btn btn-info" data-tooltip="tooltip" data-placement="top" title="View userlevel"
                                    data-toggle="modal" data-target="#view"><i class="fa fa-eye" aria-hidden="true"></i></button> -->

                                    <button class="btn btn-secondary" data-tooltip="tooltip" data-placement="top" title="Edit userlevel"
                                    data-toggle="modal" data-target="#edit<?= $userlevel['userlevel_id'] ?>"><i class="fa fa-edit" aria-hidden="true"></i></button>

                                    <button class="btn btn-warning archive_userlevel_btn" data-tooltip="tooltip" data-placement="top" title="Archive userlevel"
                                    data-toggle="modal" data-target="#archive" data-archive-id="<?= $userlevel['userlevel_id'] ?>" data-archive-name="<?= $userlevel['user_level_name'] ?>"><i class="fa fa-archive" aria-hidden="true"></i></button>

                                    <button class="btn btn-danger delete_userlevel_btn" data-tooltip="tooltip" data-placement="top" title="Delete userlevel"
                                    data-toggle="modal" data-target="#delete"  data-delete-id="<?= $userlevel['userlevel_id'] ?>" data-delete-name="<?= $userlevel['user_level_name'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div></td>
                                
                        <?php    
                            }
                        ?>
                        
                      </tr>
                  <?php 
                       $count++; endforeach;
                  ?>
                  </tbody>
                </thead>
            </table>
           
        </section>
        <div class="alert alert-success SuccessAction" role="alert" style="display: none;">
          This is a success alert—check it out!
        </div>
        <div class="alert alert-warning FailAction" role="alert" style="display: none;">
          This is a success alert—check it out!
        </div>
        <?php
            foreach (["DeletedSuccess", "AddedSuccess", "cantdelete", "cantarchive", "archiveSucess", "ErrorMessage"] as $key) {
              if (isset($_SESSION[$key])) {
                  $alertClass = in_array($key, ["cantdelete", "cantarchive", "ErrorMessage"]) ? "alert-danger" : "alert-success";
                  echo '<div class="alert ' . $alertClass . '" role="alert">';
                  echo $_SESSION[$key];
                  echo '</div>';
                  unset($_SESSION[$key]);
              }
          }          
        ?>
    </div>



    
    
    <?php include "../back-end/AddUserLevel.php"?>
    <?php include "../back-end/ViewUserLevel.php" ?>
    <?php include "../back-end/EditUserLevel.php" ?>
    <?php 
    // include "../back-end/ArchiveUserLevel.php"
     ?>
    <?php 
    // include "../back-end/DeleteUserLevel.php"
    ?>
    <!-- Confirm Modal -->
    <div class="modal fade justify-content-center align-items-center archive_modal" id="archive" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Archive <span class="name_archive"></span>?</h5>
                        <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger mb-0" role="alert">
                        Do you want to archive <span class="name_archive"></span> userlevel?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning confirm_archive" data-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>
    
<div class="modal fade justify-content-center align-items-center" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete <span class="name_delete"></span> ?</h5>
                        <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
               
                    <div class="alert alert-danger mb-0" role="alert">
                        Do you want to delete <span class="name_delete"></span> userlevel?
                    </div>
      
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger confirm_delete" data-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <script>
      $(document).ready(function(){

          $(".archive_userlevel_btn").click(function(){

          var archive_id = $(this).data('archive-id');
          var archive_name = $(this).data('archive-name');
          $("#archive").find(".name_archive").text(archive_name);
          $("#archive").find(".confirm_archive").val(archive_id);
       
          });

          $(".delete_userlevel_btn").click(function(){

          var archive_id = $(this).data('delete-id');
          var archive_name = $(this).data('delete-name');
          $("#delete").find(".name_delete").text(archive_name);
          $("#delete").find(".confirm_delete").val(archive_id);

          });

    


          $(".confirm_archive").click(function(){
            var archiveul = $(this).val();

            $.ajax({
              type: 'POST',
              url: '../controller/UserLevelManagement.php',
              data:{
                archiveul: archiveul
              },
              success: function(response){

                if (response && typeof response == 'object') {
                      if (response.success) {
                             $(".SuccessAction").text(response.success);
                              $(".SuccessAction").show()
                            setTimeout(function(){
                                  window.location.href = 'userLevel.php';
                              }, 3000);
              
                        } else if (response.unable) {
                              $(".FailAction").text(response.unable);
                              $(".FailAction").show()
                        }
                    } else {
                            alert("Invalid response from the server");
                    }
           
            
              },
              error: function(error){
                console.log(error);
              }
            });
          });


          $(".confirm_delete").click(function(){
            var deleteul = $(this).val();
            $.ajax({
              type: 'POST',
              url: '../controller/UserLevelManagement.php',
              data:{
                deleteul: deleteul
              },
              success: function(response){

                if (response && typeof response == 'object') {
                      if (response.success) {
                             $(".SuccessAction").text(response.success);
                              $(".SuccessAction").show()
                            setTimeout(function(){
                                  window.location.href = 'userLevel.php';
                              }, 3000);
              
                        } else if (response.unable) {
                              $(".FailAction").text(response.unable);
                              $(".FailAction").show()
                        }
                    } else {
                            alert("Invalid response from the server");
                    }
           
                  console.log(response);  
            
              },
              error: function(error){
                console.log(error);
              }
            });
          });

      });
    </script>



<?php
   }
    include "adminFooter.php";
?>

