<?php
    include_once "adminHeader.php";
    include_once "../config/databaseConnection.php";
    require_once "../classes/dbh.classes.php";
    require_once "../classes/add-addons.classes.php";
    $AddonsModel = new addAddons();
    $AddonsData = $AddonsModel->getAddons();
?>

    <main class="table_category">
        <section class="table_header d-flex p-3" style="gap: 10px;">
            <h2>Add-ons </h2>
            <?php
                  if(isset($_SESSION["fileManagement_create"]) && $_SESSION["fileManagement_create"] == 1){
                      echo'  <div class="btnAddCategory">
                                  <!-- Trigger the modal with a button -->
                                <button type="button" class="btn1" style="height:40px" data-toggle="modal" data-target="#modalOverlay" data-backdrop="false">
                                        Add Addons</button>
                            </div>';
                  }
            ?>
        </section>
        <div class="alert alert-success SuccessAction" role="alert" style="display: none;">
          This is a success alert—check it out!
        </div>
        <section class="table_body">
            <table>
                <thead>
                  <tr>
                    <th>Add-ons</th>
                    <th>Price</th>
                    <th>Created At</th>
                    <?php
                            if(isset($_SESSION["fileManagement_delete"]) && $_SESSION["fileManagement_delete"] == 1 && isset($_SESSION["fileManagement_edit"]) && $_SESSION["fileManagement_edit"] == 1){
                                echo'<th colspan="2">Action</th>';
                            }
                    ?>
                  </tr>
                  <tbody>
                  <?php
                     $query = "SELECT * FROM addons WHERE isDeleted != 1";
                     $result = mysqli_query($con, $query);
                 
                     if (mysqli_num_rows($result) > 0) {
                         // Looping through each row and displaying the data
                         while ($row = mysqli_fetch_assoc($result)) {
                          $addonsName = $row['addons_name'];
                          $price = $row['price'];
                          $timeCreate = $row['created_at'];
                          $addonsid = $row['addons_id'];

                     ?>
                    <tr>
                      <td><?=$addonsName?></td>
                      <td><?=$price?></td>
                      <td><?=$timeCreate?></td>
                      <?php
                            if(isset($_SESSION["fileManagement_delete"]) && $_SESSION["fileManagement_delete"] == 1){
                      ?>
                               <td><div class="btnCon">
                                    <button class='update btn btn-secondary' data-id='$addonsid' data-toggle="modal" data-target="#modalupdate<?=  $addonsid ?>" data-backdrop="false"><i class="fa fa-edit" aria-hidden="true"></i></button>
                      <?php      
                            }
                            if(isset($_SESSION["fileManagement_edit"]) && $_SESSION["fileManagement_edit"] == 1){
                      ?>            

                              <button class="btn btn-danger btn_delete_addons" data-tooltip="tooltip" data-placement="top" title="Delete Userlevel"
                                    data-toggle="modal" data-target="#delete" data-delete-id="<?=  $addonsid ?>" data-delete-name="<?=$addonsName?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </div></td>
                      <?php 
                          }
                      ?> 
                    </tr>
                    <?php } } ?> 
                  </tbody>
                </thead>
            </table>
    </main>

   
  

    <!--triggers can't click outside element when modal is open -->
    <div class="modal fade" id="modalOverlay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Addons Item</h4>
                <button type="button" class="close" onclick="closePopup()" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="../includes/add-ons.inc.php" method="post" id="formCategory">
                    <div class="form-group">
                        <label for="addons">Addons Name:</label>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="addons" required >
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="addons_price" step="0.01" min="0" placeholder="Price (0.00)" required >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn1" style="height: 40px;" name="submit">Add Addons</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- ################################################################################# -->
  <?php
    foreach($AddonsData as $addons):
  ?>
    <div class="modal fade" id="modalupdate<?= $addons['addons_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Addonns Item</h4>
                <button type="button" class="close close2" onclick="closePopup()" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="../includes/update-addons.inc.php" method="post" id="formCategory">
                    <div class="form-group">
                        <label for="addons">Addonns Name:</label>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="addons" required value="<?= $addons['addons_name']?>">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="addons_price" step="0.01" min="0" placeholder="Price (0.00)" value="<?= $addons['price']?>">
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="addonsid" id="addonsID" value="<?= $addons['addons_id']?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn1" style="height: 40px" name="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
  endforeach;
?>
    <!-- ################################################################################# -->


        
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
                        Do you want to delete <span class="name_delete"></span> addons?
                    </div>
      
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger confirm_delete" data-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>

  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    let popup = document.getElementById("popup");
    let overlay = document.getElementById("modalOverlay");
    function openPopup()
    { 
        popup.classList.add("open-modal-container");
       modalOverlay.style.display = "block";
    }
    function closePopup()
    {
      popup.classList.remove("open-modal-container");
      modalOverlay.style.display = "none";
    }
    function closeModal(event) {
  if (event.target === modalOverlay || event.key === "Escape"){
    closePopup();
   }
  }

  // Listen for clicks on the modal overlay
  modalOverlay.addEventListener("click", closeModal);

  // Listen for keydown events to close the modal when "Escape" key is pressed
  document.addEventListener("keydown", closeModal);

  $(document).ready(function(){

    // get_record();
    close_update();
  });

function close_update(){
  $(document).on('click', '.close2', function() {
    // Assuming 'modalupdate' is the ID of your modal element
    document.getElementById('modalupdate').style.display = "none";
    document.getElementById('popup2').classList.remove("open-modal-container2");
  });
}
// function get_record(){
  $(".btn_delete_addons").click(function(){

    var archive_id = $(this).data('delete-id');
    var archive_name = $(this).data('delete-name');
    $("#delete").find(".name_delete").text(archive_name);
    $("#delete").find(".confirm_delete").val(archive_id);

  });


  $(".confirm_delete").click(function(){
            var delete_addons = $(this).val();
            $.ajax({
              type: 'POST',
              url: '../controller/UserLevelManagement.php',
              data:{
                delete_addons: delete_addons
              },
              success: function(response){

                if (response && typeof response == 'object') {
                      if (response.success) {
                             $(".SuccessAction").text(response.success);
                              $(".SuccessAction").show()
                            setTimeout(function(){
                                  window.location.href = 'admin-add-ons.php';
                              }, 3000);
              
                        }else{
                          alert("Invalid response from the server");
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



  
  </script>
    
<?php
    include_once "adminFooter.php";

?>