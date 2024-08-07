
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

    <button type="submit" class="btn btn-primary" name="saveLink">Save Link</button>
</div>
