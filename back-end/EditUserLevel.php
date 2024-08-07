<?php
    foreach ($userlevels as $userlevel):
?>
     <div class="modal fade" id="edit<?= $userlevel['userlevel_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User-Level</h5>
                    <button class="form_close"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../includes/user_level.inc.php" enctype="multipart/form-data" method="POST"
                        id="userLevelForm">
                        <div class="scrollable-form">
      
                            <div class="form-group">
                                <label for="usname"><b>Name</b></label>
                                <input type="text" class="form-control" value="<?= $userlevel['user_level_name'] ?>" name="usname">
                                <input type="hidden" value ="<?= $userlevel['userlevel_id']?>" name ="UserLevel_id">
                            </div>

                            <div class="body d-flex form-check mb-2 p-0" style="flex-direction: row;">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Permissions</th>
                                        <th scope="col">View</th>
                                        <th scope="col">Create</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                        <th scope="col">Archive</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                    <th scope="row">Dashboard</th>
                                        <td><input type="checkbox" class="form-check-input position-static" id="dashboard_view"
                                            name="permissions[dashboard][view]" <?php if ($userlevel['dashboard_view'] == true) echo 'checked'; ?>></td>
                                        <td></td>
                                        <!-- <td><input type="checkbox" class="form-check-input position-static" id="dashboard_edit"
                                            name="permissions[dashboard][edit]"  ></td> -->
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Order Management</th>
                                        <td><input type="checkbox" class="form-check-input position-static" id="orderManagement_view"
                                            name="permissions[orderManagement][view]" <?php if ($userlevel['orderManagement_view'] == true) echo 'checked'; ?>></td>
                                        <td><input type="checkbox" class="form-check-input" id="orderManagement_create"
                                            name="permissions[orderManagement][create]" <?php if ($userlevel['orderManagement_create'] == true) echo 'checked'; ?> ></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Content Management</th>
                                        <td><input type="checkbox" class="form-check-input position-static" id="contentManagement_view"
                                            name="permissions[contentManagement][view]" <?php if ($userlevel['contentManagement_view'] == true) echo 'checked'; ?>></td>
                                        <td></td>
                                        <!-- <td><input type="checkbox" class="form-check-input position-static" id="contentManagement_create"
                                            name="permissions[contentManagement][create]"  ></td> -->
                                        <td><input type="checkbox" class="form-check-input position-static" id="contentManagement_edit"
                                            name="permissions[contentManagement][edit]"<?php if ($userlevel['contentManagement_edit'] == true) echo 'checked'; ?>  ></td>
                                        <!-- <td><input type="checkbox" class="form-check-input position-static" id="contentManagement_delete"
                                            name="permissions[contentManagement][delete]"></td> -->
                                        <td></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">File Management</th>
                                        <td><input type="checkbox" class="form-check-input position-static" id="fileManagement_view"
                                            name="permissions[fileManagement][view]"<?php if ($userlevel['fileManagement_view'] == true) echo 'checked'; ?>></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="fileManagement_create"
                                            name="permissions[fileManagement][create]" <?php if ($userlevel['fileManagement_create'] == true) echo 'checked'; ?> ></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="fileManagement_edit"
                                            name="permissions[fileManagement][edit]" <?php if ($userlevel['fileManagement_edit'] == true) echo 'checked'; ?> ></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="fileManagement_delete"
                                            name="permissions[fileManagement][delete]" <?php if ($userlevel['fileManagement_delete'] == true) echo 'checked'; ?> ></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="fileManagement_archive"
                                                    name="permissions[fileManagement][archive]"<?php if ($userlevel['fileManagement_archive'] == true) echo 'checked'; ?> ></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Statistics Management</th>
                                        <td><input type="checkbox" class="form-check-input position-static" id="statisticsManagement_view"
                                            name="permissions[statisticsManagement][view]" <?php if ($userlevel['statisticsManagement_view'] == true) echo 'checked'; ?>></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="statisticsManagement_create"
                                            name="permissions[statisticsManagement][create]" <?php if ($userlevel['statisticsManagement_create'] == true) echo 'checked'; ?>  ></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <th scope="row">Chat Management</th>
                                        <td><input type="checkbox" class="form-check-input position-static" id="chatManagement_view"
                                            name="permissions[chatManagement][view]" <?php if ($userlevel['chatManagement_view'] == true) echo 'checked'; ?>></td>
                                        <td> <input type="checkbox" class="form-check-input position-static" id="chatManagement_create"
                                            name="permissions[chatManagement][create]" <?php if ($userlevel['chatManagement_create'] == true) echo 'checked'; ?>  ></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <th scope="row">Marketing Management</th>
                                        <td> <input type="checkbox" class="form-check-input position-static" id="marketingManagement_view"
                                                    name="permissions[marketingManagement][view]"<?php if ($userlevel['marketingManagement_view'] == true) echo 'checked'; ?>></td>
                                        <td> <input type="checkbox" class="form-check-input position-static" id="marketingManagement_create"
                                                    name="permissions[marketingManagement][create]" <?php if ($userlevel['marketingManagement_create'] == true) echo 'checked'; ?>  ></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="marketingManagement_edit"
                                                    name="permissions[marketingManagement][edit]" <?php if ($userlevel['marketingManagement_edit'] == true) echo 'checked'; ?> ></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="marketingManagement_delete"
                                                    name="permissions[marketingManagement][delete]" <?php if ($userlevel['marketingManagement_delete'] == true) echo 'checked'; ?> ></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="marketingManagement_archive"
                                                    name="permissions[marketingManagement][archive]" <?php if ($userlevel['marketingManagement_archive'] == true) echo 'checked'; ?> ></td>
                                    </tr>
                                </tbody>
                                </table> 
                            </div>
                        
                          
                      
                        </div>

                        <div class="form-group mt-3 d-flex justify-content-center text-center">
                            <button type="submit" class="btn1"
                                id="addUserLevelButton" name="editUserLvl">Update User-Level</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
endforeach;
?>