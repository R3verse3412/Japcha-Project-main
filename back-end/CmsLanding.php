<style>
.cmsDetailCon{
  max-width: 100%;
  /* border: thin solid black; */
  padding: 5px;
}
</style>
<?php
                if(isset($_SESSION["contentManagement_view"]) && $_SESSION["contentManagement_view"] == 1){
?>
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Title <button type="button" class="btn btn-link" data-toggle="modal" data-target="#title"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
      <p class="cmsDetailCon" style="max-width: 100%"><?= $cms['title_data']?></p>
      <!-- <input type="text" class="form-control" id="exampleFormControlInput1" value=""> -->
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Subtitle <button type="button" class="btn btn-link" data-toggle="modal" data-target="#subtitle"><i class="fa fa-pencil" aria-hidden="true"></i></button></label></label>
      <p class="cmsDetailCon"><?= $cms['subtitle']?></p>
    </div>
    <div class="mb-3">
 

    <div class="input-file-container" >
   
      <label for="logo">Logo</label>
      <button type="button" class="btn btn-link" id="customFileButton" data-toggle="modal" data-target="#logo">
          <i class="fa fa-pencil" aria-hidden="true"></i>
      </button>
      <input type="file" id="fileInput" name="logo" style="display: none;">
      <span id="fileName"></span>

      
     
    </div>

      <div class="input-group mb-3 d-flex gap-3" style="height: 70px;">
   
        <img src="../upload-content/<?= $cms['logo_url']?>" alt="" style="max-width: 100%;  max-height: 100%;" >
        <img id="imagePreview" src="" alt="Image Preview" style="max-width: 100%; max-height: 100% !important; display: none;">  
      </div>
    
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Landing Image <button type="button" class="btn btn-link" data-toggle="modal" data-target="#landingImage"><i class="fa fa-pencil" aria-hidden="true"></i></button></label></label>
      <div class="input-group mb-3 d-flex ">
                   
        <img src="../upload-content/<?= $cms['landing_image_url']?>" alt="" style="max-width: 100%" >
                    
      </div>
    
    </div>
  </div>

  <script>
    // JavaScript function to update the displayed file name
</script>
  <!-- Modal -->
  <?php
                }
  ?>