<?php
     include "adminHeader.php";
     require_once '../classes/dbh.classes.php';
     require_once '../classes/TermsAndConditionModel.php';
     $term_model = new TermsModel();
     $terms = $term_model->getTerms();
?>
    <div class="cms-container">
        
            <div class="header mt-5">
                <div class="header-text">Manage Terms And Condition</div>
            </div>
            <div class="CmsBodyContainer">
                
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                


                        <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Condition of Use:<button type="button" class="btn btn-link" data-toggle="modal" data-target="#conditions"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
                                <p class="cmsDetailCon"><?=$terms['condition_']?></p>
                        </div>
                        
                        <div class="mb-3">
                                <label for="logo">Privacy Policy</label>
                                
                                <button type="button" class="btn btn-link" id="customFileButton" data-toggle="modal" data-target="#privacy">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                          
                            <p>
                            <?=$terms['privacy']?>
                            </p>
                            
                        </div>

                        <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Age Restriction</label>
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#restriction"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            
                                <p>
                                <?=$terms['restrictions']?>
                                </p>
                            
                        </div>

                        <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Disputes:<button type="button" class="btn btn-link" data-toggle="modal" data-target="#dispute"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
                                <p class="cmsDetailCon"><?=$terms['disputes']?></p>
                        </div>

                        <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Idenmnification:<button type="button" class="btn btn-link" data-toggle="modal" data-target="#idemnification"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
                                <p class="cmsDetailCon"><?=$terms['idemnification']?></p>
                        </div>
                        <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Limitation on Liability:<button type="button" class="btn btn-link" data-toggle="modal" data-target="#liability"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
                                <!-- <div class="cmsDetailCon"></div> -->
                                <div><?=$terms['liability']?></div>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>


    <?php
        require_once "TermsAndConditionModal.php";
    ?>




<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->

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
     include "adminFooter.php";
?>