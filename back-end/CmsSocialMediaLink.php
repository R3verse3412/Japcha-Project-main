
<?php
    require '../classes/dbh.classes.php';
    require '../classes/save_note_Model.php';
    require_once '../classes/save_note_View.php';
    $AboutUsInfo = new SampleView();
?>
<div class="CmsAboutUs-Container">
    <div class="headerAboutUs">Social Media</div>
    <div class="EditFieldCon">
        <label for="title">Facebook</label>
        <input type="text" id="fbLink" placeholder ="<?= $AboutUsInfo->fetchFbLinks(); ?>">
        <input type="submit" id="fbBtn" value="Submit">
    </div>
    <div class="EditFieldCon">
        <label for="Subtitle">Youtube</label>
        <input type="text" id="ytLink" placeholder= "<?= $AboutUsInfo->fetchYtLinks(); ?>">
        <input type="submit" id="ytBtn" value="Submit">
    </div>
    <div class="EditFieldCon">
        <label for="Subtitle">Instragram</label>
        <input type="text" id="igLink" placeholder="<?= $AboutUsInfo->fetchIgLinks(); ?>">
        <input type="submit" id ="igBtn" value="Submit">
    </div>
</div>

<script src="../assets/js/summerNote.js"></script>