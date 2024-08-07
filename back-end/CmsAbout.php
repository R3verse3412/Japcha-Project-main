<?php
                if(isset($_SESSION["contentManagement_view"]) && $_SESSION["contentManagement_view"] == 1){
?>
<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">What is Japcha? <button type="button" class="btn btn-link" data-toggle="modal" data-target="#japchaModal"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
        <p><?= $cms['japcha']?></p> 
        <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea> -->
    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">How to Order? <button type="button" class="btn btn-link" data-toggle="modal" data-target="#orderModal"><i class="fa fa-pencil" aria-hidden="true"></i></button></label></label>
        <p><?= $cms['order_note']?></p>  
        <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea> -->
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Our Socials <button type="button" class="btn btn-link" data-toggle="modal" data-target="#socialModal"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
        <p><?= $cms['socials']?></p> 
        <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea> -->
    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Our Policy <button type="button" class="btn btn-link" data-toggle="modal" data-target="#policyModal"><i class="fa fa-pencil" aria-hidden="true"></i></button></label></label>
        <p><?= $cms['policy']?></p>  
        <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea> -->
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Our Location <button type="button" class="btn btn-link" data-toggle="modal" data-target="#locationModal"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
        <p><?= $cms['location']?></p> 
        <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea> -->
    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Contact Us <button type="button" class="btn btn-link" data-toggle="modal" data-target="#contactModal"><i class="fa fa-pencil" aria-hidden="true"></i></button></label></label>
        <p><?= $cms['contact']?></p> 
        <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea> -->
    </div>
 
</div>

<?php
                }
?>