
<?php
    require '../classes/dbh.classes.php';
    require '../classes/save_note_Model.php';
    require_once '../classes/save_note_View.php';
    $AboutUsInfo = new SampleView();
    $summerCon = $summerNote->getContent();
?>
 <?php
                if(isset($_SESSION["contentManagement_view"]) && $_SESSION["contentManagement_view"] == 1){
?>
<?php
    include_once "CmsHeader.php";
?>
<div class="tab-pane fade CmsBodyContainer" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
    <div class="CmsAboutUs-Container">
        <form action="">
            <div class="headerAboutUs">About Us</div>
            <div class="EditFieldCon">
                <label for="japcha">What is Japcha?</label>
                <textarea name="whatisjapcha" id="japcha"></textarea>
                <button class="saveJapcha" id="saveJapcha">Save</button>
            </div>
            <div class="EditFieldCon">
                <label for="japcha">How to Order?</label>
                <textarea name="whatisjapcha" id="order"></textarea>
                <button class="saveJapcha" id="saveOrder">Save</button>
            </div>
            <div class="EditFieldCon">
                <label for="japcha">Our Socials</label>
                <textarea name="whatisjapcha" id="socials"></textarea>
                <button class="saveJapcha" id="saveSocials">Save</button>
            </div>
            <div class="EditFieldCon">
                <label for="japcha">Our Policy</label>
                <textarea name="whatisjapcha" id="policy"></textarea>
                <button class="saveJapcha" id="savePolicy">Save</button>
            </div>
            <div class="EditFieldCon">
                <label for="japcha">Our Location</label>
                <textarea name="whatisjapcha" id="location"></textarea>
                <button class="saveJapcha" id="saveLocation">Save</button>
            </div>
            <div class="EditFieldCon">
                <label for="japcha">Contact Us</label>
                <textarea name="whatisjapcha" id="contact"></textarea>
                <button class="saveJapcha" id="saveContact">Save</button>
            </div>
        </form>
   
    </div>
</div>
<script>
    $(document).ready(function () {
            initializeSummernote('#japcha');
            initializeSummernote('#order');
            initializeSummernote('#socials');
            initializeSummernote('#policy');
            initializeSummernote('#location');
            initializeSummernote('#contact');
        });
</script>
<!-- <script src="../assets/js/summerNote.js"></script> -->
<?php
                }
    include_once "CmsFooter.php";
?>