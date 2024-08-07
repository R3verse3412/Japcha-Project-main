<?php
    include "adminHeader.php";
    require_once '../classes/dbh.classes.php';
    require_once '../classes/cms.classes.php';
    $cmsData = new Cms();
    $cms = $cmsData->getCms();
?>
<style>
   section {
    padding: 60px 0;
}

section .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}
#tabs{
	background: #007b5e;
    color: #eee;
}
#tabs h6.section-title{
    color: #eee;
}

#tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 4px solid !important;
 
    font-weight: bold;
}
#tabs .nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #eee;
    font-size: 20px;
}
.cmsDetailCon{
  max-width: 100%;
  /* border: thin solid black; */
  padding: 5px;
}
</style>
<?php
                if(isset($_SESSION["contentManagement_view"]) && $_SESSION["contentManagement_view"] == 1){
?>

<div class="cms-container">

    <div class="header mt-5">
        <div class="header-text">Manage Content</div>
    </div>

    <!-- <div class="buttonContainer">
        <button class="btnLanding active" id="btnLanding" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Landing Page</button>
        <button class="AboutUs" id="AboutUs" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="true">About Us</button>
        <button class="Social" id="SocialLink"><a href="copy.php">Social Media Link</a></button>
    </div> -->
    <div class="CmsBodyContainer" >

            <div class="col-xs-12 " style="width: 100%;">
                        <div>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Landing Page</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">About Us</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Media Link</a>	
                            </div>
                        </div>
            <form action="../classes/save_note.php" method="POST" enctype="multipart/form-data">
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent" style="padding-right: 10px !important;">
                        
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title <?php
          if(isset($_SESSION["contentManagement_edit"]) && $_SESSION["contentManagement_edit"] == 1){?><button type="button" class="btn btn-link" data-toggle="modal" data-target="#title"><i class="fa fa-pencil" aria-hidden="true"></i></button><?php }?></label>
            <p class="cmsDetailCon" style="max-width: 100%"><?= $cms['title_data']?></p>
            <!-- <input type="text" class="form-control" id="exampleFormControlInput1" value=""> -->
            </div>
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Subtitle <?php
          if(isset($_SESSION["contentManagement_edit"]) && $_SESSION["contentManagement_edit"] == 1){?><button type="button" class="btn btn-link" data-toggle="modal" data-target="#subtitle"><i class="fa fa-pencil" aria-hidden="true"></i></button><?php }?></label>
            <p class="cmsDetailCon"><?= $cms['subtitle']?></p>
            </div>
            <div class="mb-3">
        

            <div class="input-file-container" >
        
            <label for="logo">Logo</label><?php
          if(isset($_SESSION["contentManagement_edit"]) && $_SESSION["contentManagement_edit"] == 1){?>
            <button type="button" class="btn btn-link" id="customFileButton" data-toggle="modal" data-target="#logo">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </button><?php }?>
            <input type="file" id="fileInput" name="logo" style="display: none;">
            <span id="fileName"></span>

            
            
            </div>

            <div class="input-group mb-3 d-flex gap-3" style="height: 70px;">
        
                <img src="../upload-content/<?= $cms['logo_url']?>" alt="" style="max-width: 100%;  max-height: 100%;" >
                <img id="imagePreview" src="" alt="Image Preview" style="max-width: 100%; max-height: 100% !important; display: none;">  
            </div>
            
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Landing Image <?php
          if(isset($_SESSION["contentManagement_edit"]) && $_SESSION["contentManagement_edit"] == 1){?><button type="button" class="btn btn-link" data-toggle="modal" data-target="#landingImage"><i class="fa fa-pencil" aria-hidden="true"></i></button><?php }?></label></label>
            <div class="input-group mb-3 d-flex ">
                        
                <img src="../upload-content/<?= $cms['landing_image_url']?>" alt="" style="max-width: 100%" >
                            
            </div>
            
            </div>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">What is Japcha? <?php
          if(isset($_SESSION["contentManagement_edit"]) && $_SESSION["contentManagement_edit"] == 1){?><button type="button" class="btn btn-link" data-toggle="modal" data-target="#japchaModal"><i class="fa fa-pencil" aria-hidden="true"></i></button><?php }?></label>
        <p><?= $cms['japcha']?></p> 

    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">How to Order? <?php
          if(isset($_SESSION["contentManagement_edit"]) && $_SESSION["contentManagement_edit"] == 1){?><button type="button" class="btn btn-link" data-toggle="modal" data-target="#orderModal"><i class="fa fa-pencil" aria-hidden="true"></i></button><?php }?></label>
        <p><?= $cms['order_note']?></p>  

    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Our Socials <?php
          if(isset($_SESSION["contentManagement_edit"]) && $_SESSION["contentManagement_edit"] == 1){?><button type="button" class="btn btn-link" data-toggle="modal" data-target="#socialModal"><i class="fa fa-pencil" aria-hidden="true"></i></button><?php }?></label>
        <p><?= $cms['socials']?></p> 

    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Our Policy <?php
          if(isset($_SESSION["contentManagement_edit"]) && $_SESSION["contentManagement_edit"] == 1){?><button type="button" class="btn btn-link" data-toggle="modal" data-target="#policyModal"><i class="fa fa-pencil" aria-hidden="true"></i></button><?php }?></label>
        <p><?= $cms['policy']?></p>  

    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Our Location <?php
          if(isset($_SESSION["contentManagement_edit"]) && $_SESSION["contentManagement_edit"] == 1){?><button type="button" class="btn btn-link" data-toggle="modal" data-target="#locationModal"><i class="fa fa-pencil" aria-hidden="true"></i></button><?php }?></label>
        <p><?= $cms['location']?></p> 

    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Contact Us <?php
          if(isset($_SESSION["contentManagement_edit"]) && $_SESSION["contentManagement_edit"] == 1){?><button type="button" class="btn btn-link" data-toggle="modal" data-target="#contactModal"><i class="fa fa-pencil" aria-hidden="true"></i></button><?php }?></label>
        <p><?= $cms['contact']?></p> 

    </div>
 
</div>
<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="mb-3">
        <label for="basic-url" class="form-label">Your Facebook link</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">https://facebook.com/users/</span>
            <input type="text" class="form-control" name="fbLink"  id="basic-url" aria-describedby="basic-addon3" value="<?= $cms['fbLink']?>">
        </div>
    </div>

    <div class="mb-3">
        <label for="basic-url" class="form-label">Your Instagram link</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">https://instagram.com/users/</span>
            <input type="text" class="form-control" name="igLink"  id="basic-url" aria-describedby="basic-addon3" value="<?= $cms['instagramLink']?>">
        </div>
    </div>

    <div class="mb-3">
        <label for="basic-url" class="form-label">Your Youtube link</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">https://youtube.com/users/</span>
            <input type="text" class="form-control" name="ytLink" id="basic-url" aria-describedby="basic-addon3" value="<?= $cms['ytLink']?>">
        </div>
    </div>

    <?php
          if(isset($_SESSION["contentManagement_edit"]) && $_SESSION["contentManagement_edit"] == 1){?><button type="submit" class="btn btn-primary" name="saveLink">Save Link</button><?php }?>
</div>

                  
</div>
                 <?php
                    include_once 'CmsLandingModal.php';
                ?>
                <?php
                    include_once 'CmsAboutModal.php';
                ?>
</form>
			
		</div>
    </div>


    </div>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<script>
    function initializeSummernote(elementId) {
    const toolbar = [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      
    ];

    const fontSizes = ['8', '9', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '36', '48',
        '72'
    ];

    const fontNames = ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'];
    
    $(elementId).summernote({
        height: 300,
        maxheight: 300,
        toolbar: toolbar,
        fontSizes: fontSizes,
        fontNames: fontNames
    });
}
</script>



<?php
                }
    include "adminFooter.php";
?>