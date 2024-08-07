<!-- TITLE -->


<!-- Condition of Use MODAL -->
<div class="modal fade bd-example-modal-lg" id="conditions" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Condition of Use</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="subInput" id="condition_"><?=$terms['condition_']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="save_condition">Save changes</button>
        </div>

    </div>
  </div>
</div>

<!-- privacy MODAL -->
<div class="modal fade bd-example-modal-lg" id="privacy" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Privacy Policy</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="subInput" id="privacy_"><?=$terms['privacy']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="save_privacy">Save changes</button>
        </div>

    </div>
  </div>
</div>


<!-- Age Restriction MODAL -->
<div class="modal fade bd-example-modal-lg" id="restriction" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Age Restriction</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="subInput" id="restrictions_"><?=$terms['restrictions']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="save_restrictions">Save changes</button>
        </div>

    </div>
  </div>
</div>

<!--Disputes MODAL -->
<div class="modal fade bd-example-modal-lg" id="dispute" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Disputes</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="subInput" id="dispute_"><?=$terms['disputes']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal"   id="save_dispute">Save changes</button>
        </div>

    </div>
  </div>
</div>

<!-- Idenmnification MODAL -->
<div class="modal fade bd-example-modal-lg" id="idemnification" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Idenmnification</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="subInput" id="idemnification_"><?=$terms['idemnification']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal"  id="save_idemnification">Save changes</button>
        </div>

    </div>
  </div>
</div>


<!-- Limitation on Liability:  MODAL -->
<div class="modal fade bd-example-modal-lg" id="liability" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Limitation on Liability</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="subInput" id="liability_"><?=$terms['liability']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="save_liability">Save changes</button>
        </div>

    </div>
  </div>
</div>





<script>
    // var $j = jQuery.noConflict();
    $(document).ready(function () {
            initializeSummernote('#title_terms');
            initializeSummernote('#condition_');
            initializeSummernote('#privacy_');
            initializeSummernote('#restrictions_');
            initializeSummernote('#dispute_');
            initializeSummernote('#idemnification_');
            initializeSummernote('#liability_');
            
            

        $("#save_liability").click(function(){
            let liability = $("#liability_").val();
            $.ajax({
                type: 'POST',
                url: '../controller/ManageTermsAndCondition.php',
                data:{
                    liablity: liability,
                },
                success: function(response){
                    window.location.href = 'AdminTermsAndCondition.php';
                    window.alert('Dispute saved successfully!');
                },
                error: function(error){
                    console.log(error);
                }
            });
        });

        $("#save_idemnification").click(function(){
            let idemnification = $("#idemnification_").val();
            $.ajax({
                type: 'POST',
                url: '../controller/ManageTermsAndCondition.php',
                data:{
                    idemnification: idemnification,
                },
                success: function(response){
                    window.location.href = 'AdminTermsAndCondition.php';
                },
                error: function(error){
                    console.log(error);
                }
            });
        });

        
        $("#save_dispute").click(function(){
            let dispute = $("#dispute_").val();
            $.ajax({
                type: 'POST',
                url: '../controller/ManageTermsAndCondition.php',
                data:{
                    dispute: dispute,
                },
                success: function(response){
                    window.location.href = 'AdminTermsAndCondition.php';
                },
                error: function(error){
                    console.log(error);
                }
            });
        });

        
        $("#save_restrictions").click(function(){
            let restrictions = $("#restrictions_").val();
            $.ajax({
                type: 'POST',
                url: '../controller/ManageTermsAndCondition.php',
                data:{
                    restrictions: restrictions,
                },
                success: function(response){
                    window.location.href = 'AdminTermsAndCondition.php';
                },
                error: function(error){
                    console.log(error);
                }
            });
        });


        
        $("#save_privacy").click(function(){
            let privacy = $("#privacy_").val();
            $.ajax({
                type: 'POST',
                url: '../controller/ManageTermsAndCondition.php',
                data:{
                    privacy: privacy,
                },
                success: function(response){
                    window.location.href = 'AdminTermsAndCondition.php';
                },
                error: function(error){
                    console.log(error);
                }
            });
        });

        $("#save_condition").click(function(){
            let condition = $("#condition_").val();
            $.ajax({
                type: 'POST',
                url: '../controller/ManageTermsAndCondition.php',
                data:{
                    condition: condition,
                },
                success: function(response){
                    window.location.href = 'AdminTermsAndCondition.php';
                },
                error: function(error){
                    console.log(error);
                }
            });
        });


        $("#save_title_terms").click(function(){
            let title = $("#title_terms").val();
            $.ajax({
                type: 'POST',
                url: '../controller/ManageTermsAndCondition.php',
                data:{
                    title_: title,
                },
                success: function(response){
                    // window.location.href = 'AdminTermsAndCondition.php';
                    console.log(response);
                },
                error: function(xhr, status, error) {
        console.log("XHR:", xhr);
        console.log("Status:", status);
        console.log("Error:", error);
    }
            });
        });

    });
</script>
