<?php
      foreach ($category as $categories):
    ?>
    <div class="modal fade" id="edit<?= $categories['category_id'] ?>">
        <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Category Item</h4>
                    <button type="button" class="close" onclick="closePopup()" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="../includes/update-category.inc.php" method="post" id="formCategory">
                        <div class="form-group">
                            <label for="addons">Category Name:</label>
                            <input type="hidden" class="form-control" name="categoryid" id="categoryid" value="<?= $categories['category_id'] ?>">
                            <input type="text" class="form-control" name="categoryname" id="categoryname" value="<?= $categories['category_name'] ?>"required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" style="height: 40px" name="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
      endforeach;
    ?>