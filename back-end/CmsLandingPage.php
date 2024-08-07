
<?php
    require_once '../classes/dbh.classes.php';
    // require '../classes/save_note_Model.php';
    // require_once '../classes/save_note_View.php';
    require_once '../classes/cms.classes.php';
    $cmsData = new Cms();
    $cms = $cmsData->getCms();
    // $AboutUsInfo = new SampleView();
?>
<?php
    include_once "CmsHeader.php";
?>
<style>
    h1{
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        padding: 0;
        color: white;
        margin-left: 90px;
        text-shadow: 2px 3px 1px rgba(0, 0, 0, 0.25);
        font-size: 64px;
    }
    h2{
        border-radius: 8px;
        padding: 0;
        font-family: 'Inter', sans-serif;
        font-size: 20px;
        color: #444444;
        margin-left: 90px;
        text-shadow: 2px 5px 4px rgba(0, 0, 0, 0.25);
    }
  
</style>

<?php
    foreach($cms as $infoCMS):
?>
<div class="tab-pane fade show active CmsBodyContainer"  id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="CmsAboutUs-Container d-flex flex-column">
        <div class="EditFieldCon mt-5 mb-5">
        <form id="upload-form" enctype="multipart/form-data">
                <div class="label-con">
                    <label for="Title">Title:</label>
                    <!-- <button class="btn btn-secondary" data-tooltip="tooltip" data-placement="top" title="Edit Userlevel"
                    data-toggle="modal" data-target="#edit"><i class="fa fa-edit" aria-hidden="true"></i></button> -->
                
                </div>
            <div class="text-center">
                <h1><?= $cms['title_data']?></h1>
            </div>

        </div>
        <div class="EditFieldCon mt-5 mb-5">
                <div class="label-con">
                    <label for="subtitle">Subtitle:</label>
                    <button class="btn btn-secondary" data-tooltip="tooltip" data-placement="top" title="Edit Userlevel"
                    data-toggle="modal" data-target="#edit"><i class="fa fa-edit" aria-hidden="true"></i></button>
                
                </div>
                <div class="text-center">
                    <h2><?= $cms['subtitle']?></h2>
                </div>

        </div>
        <div class="EditFieldCon mt-5 mb-5">
           
                <div class="label-con">
                    <label for="Logo">Logo:</label>
                    <button class="btn btn-secondary" data-tooltip="tooltip" data-placement="top" title="Edit Logo"
                    data-toggle="modal" data-target="#edit"><i class="fa fa-edit" aria-hidden="true"></i></button>
                    
                </div>

                <div class="text-center">
                    <img src="../image/<?= $cms['logo_url']?>" alt="japcha_logo.png" class="img-fluid">
                </div>         

            </form>
            <div id="result"></div>
        </div>
        <div class="EditFieldCon mt-5 mb-5">
            
                <div class="label-con">
                    <label for="landingPage">Landing Page Image:</label>
                    <button class="btn btn-secondary" data-tooltip="tooltip" data-placement="top" title="Edit Langing Page"
                    data-toggle="modal" data-target="#landingImage"><i class="fa fa-edit" aria-hidden="true"></i></button>
                
                </div>
                <div class="text-center">
                    <img src="../image/<?= $cms['landing_image_url']?>" alt="image hand" class="img-fluid">
                </div>

            </form>
            <div id="result"></div>
        </div>
    </div>
</div>
<?php
    endforeach;
?>

<script>
    $(document).ready(function () {
            initializeSummernote('#title');
            initializeSummernote('#Subtitle');
        });
   
</script>

<?php
    include_once "CmsFooter.php";
?>