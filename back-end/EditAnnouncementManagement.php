<?php
    foreach($getAnnouncement as $gAnnouncement):
?>

<div class="modal fade" id="editModal <?=$gAnnouncement['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editAnnouncementModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <!-- Add a form element with the appropriate method and action attributes -->
                      <form action="../includes/add-announcement.inc.php" method="post">
                          <div class="form-group"> 
                              <input type="hidden" value ="<?= $gAnnouncement['id']?>" name="announcementID">
                              <label for="editStartTime">Start Date</label>
                              <input required type="datetime-local" class="form-control" id="editStartTime" value ="<?= $gAnnouncement['starting_date'] ?>" name="editStartTime">
                          </div>
                          <div class="form-group">
                              <label for="editEndTime">End Date</label>
                              <input required type="datetime-local" class="form-control" id="editEndTime" value ="<?= $gAnnouncement['ending_date'] ?>" name="editEndTime" placeholder="Enter Title here...">
                          </div>
                          <div class="form-group">
                              <label for="editTitle">Announcement Title</label>
                              <input required type="text" class="form-control" id="couponCode" value="<?= $gAnnouncement['announcement'] ?>" name="editTitle" placeholder="Enter Title here...">
                            </div>
                          <div class="form-group">
                              <label for="announcementContent">Content</label>
                              <textarea required class="form-control" id="announcementContent"rows="3" name="editContent" placeholder="Enter content here..."> <?= $gAnnouncement['content'] ?></textarea>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" name ="ConfirmButton"data-toggle ="modal" data-target="#confirmationModal<?= $gAnnouncement['id'] ?>" style="background-color: #D0BC05; border-color: #D0BC05; color: #ffffff;">Save Changes</button>
                          </div>


                          <!-- Confirmation Modal -->

                            <div class="modal fade" id="confirmationModal<?= $gAnnouncement['id'] ?>" tabindex="-1" role="dialog"aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Announcement</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to have changes?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="updateButton">Confirm Changes</button>
                                    
                                    <script>
                                            function submitForm(formId) {
                                        document.getElementById(formId).submit();
                                        }
                                        </script>
                                </div>
                                </div>
                            </div>
                            </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>

<?php 
        endforeach;
?> 