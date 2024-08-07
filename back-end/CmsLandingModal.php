<!-- TITLE -->
<div class="modal fade bd-example-modal-lg" id="title" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Title</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="titleInput" id="titleModal"><?= $cms['title_data']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="">Close</button>
            <button type="submit" class="btn btn-primary" name="title_data">Save title</button>
        </div>

    </div>
  </div>
</div>

<!-- subtitle MODAL -->
<div class="modal fade bd-example-modal-lg" id="subtitle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Subtitle</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="subInput" id="subtitleModal"><?= $cms['subtitle']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="sub">Save changes</button>
        </div>

    </div>
  </div>
</div>

<!-- Logo MODAL -->
<div class="modal fade bd-example-modal-lg" id="logo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Logo</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <label for="product_image">Logo:</label>
            <input class="form-control-file" type="file" accept="image/*" name="logoInput" id="logo_image">
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="update_logo">Save changes</button>
        </div>

    </div>
  </div>
</div>


<!-- landing image  MODAL -->
<div class="modal fade bd-example-modal-lg" id="landingImage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Landing Image</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <label for="product_image">Logo:</label>
            <input class="form-control-file" type="file" accept="image/*" name="Landing_image" id="Landing_image">
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="update_landing_img">Save changes</button>
        </div>

    </div>
  </div>
</div>



<script>
    // var $j = jQuery.noConflict();
    $(document).ready(function () {
            initializeSummernote('#titleModal');
            initializeSummernote('#subtitleModal');
            
        });
</script>
