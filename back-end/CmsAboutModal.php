<!-- Jpacha -->
<div class="modal fade bd-example-modal-lg" id="japchaModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="japchaInput" id="japcha"><?= $cms['japcha']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="">Close</button>
            <button type="submit" class="btn btn-primary" name="japcha_data">Save Changes</button>
        </div>

    </div>
  </div>
</div>

<!-- order -->
<div class="modal fade bd-example-modal-lg" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="orderInput" id="order"><?= $cms['order_note']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="order_data">Save changes</button>
        </div>

    </div>
  </div>
</div>

<!-- Socials MODAL -->
<div class="modal fade bd-example-modal-lg" id="socialModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="socialsInput" id="social"><?= $cms['socials']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name ="socials_data">Save changes</button>
        </div>

    </div>
  </div>
</div>
<!-- Policy MODAL -->
<div class="modal fade bd-example-modal-lg" id="policyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="policyInput" id="policy"><?= $cms['policy']?></textarea>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="policy_data">Save changes</button>
        </div>

    </div>
  </div>
</div>
<!-- subtitle MODAL -->
<div class="modal fade bd-example-modal-lg" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="locationInput" id="location"><?= $cms['location']?></textarea>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="location_data">Save changes</button>
        </div>

    </div>
  </div>
</div>
<!-- subtitle MODAL -->
<div class="modal fade bd-example-modal-lg" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="contactInput" id="contact"><?= $cms['contact']?></textarea>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="contact_data">Save changes</button>
        </div>

    </div>
  </div>
</div>

<script>
      
      $(document).ready(function () {
            initializeSummernote('#japcha');
            initializeSummernote('#order');
            initializeSummernote('#social');
            initializeSummernote('#policy');
            initializeSummernote('#location');
            initializeSummernote('#contact');
            
        });
</script>
