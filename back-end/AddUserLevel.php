<style>
    .modal-dialog{
        max-width: 800px !important;
    }
    .table{
        text-align: left !important;
    }
    .form-check-input{
        position: none !important;
    }
</style>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User-Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../includes/user_level.inc.php" enctype="multipart/form-data" method="POST"
                        id="userLevelForm">
                        <div class="scrollable-forms">
      
                          <div class="form-group">
                              <label for="usname"><b>Name</b></label>
                              <input type="text" class="form-control" placeholder="Enter Name" name="usname" required>
                          </div>
                          <div class="form-group">
                              <label for="usname" id="select_all"><b>Select All</b> </label>
                              <input type="checkbox" id="select_all_checkbox">
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
                                            name="permissions[dashboard][view]"></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td><input type="checkbox" class="form-check-input position-static" id="dashboard_edit"
                                            name="permissions[dashboard][edit]" disabled></td> -->
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Order Management</th>
                                        <td><input type="checkbox" class="form-check-input position-static" id="orderManagement_view"
                                            name="permissions[orderManagement][view]"></td>
                                        <td><input type="checkbox" class="form-check-input" id="orderManagement_create"
                                            name="permissions[orderManagement][create]" disabled></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Content Management</th>
                                        <td><input type="checkbox" class="form-check-input position-static" id="contentManagement_view"
                                            name="permissions[contentManagement][view]"></td>
                                        <td></td>
                                        <!-- <td><input type="checkbox" class="form-check-input position-static" id="contentManagement_create"
                                            name="permissions[contentManagement][create]" disabled ></td> -->
                                        <td><input type="checkbox" class="form-check-input position-static" id="contentManagement_edit"
                                            name="permissions[contentManagement][edit]" disabled></td>
                                        <td></td>
                                        <!-- <td><input type="checkbox" class="form-check-input position-static" id="contentManagement_delete"
                                            name="permissions[contentManagement][delete]" disabled></td> -->
                                        <td></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">File Management</th>
                                        <td><input type="checkbox" class="form-check-input position-static" id="fileManagement_view"
                                            name="permissions[fileManagement][view]"></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="fileManagement_create"
                                            name="permissions[fileManagement][create] position-static" disabled></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="fileManagement_edit"
                                            name="permissions[fileManagement][edit]" disabled></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="fileManagement_delete"
                                            name="permissions[fileManagement][delete]" disabled></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="fileManagement_archive"
                                                    name="permissions[fileManagement][archive]" disabled></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Statistics Management</th>
                                        <td><input type="checkbox" class="form-check-input position-static" id="statisticsManagement_view"
                                            name="permissions[statisticsManagement][view]"></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="statisticsManagement_create"
                                            name="permissions[statisticsManagement][create]" disabled ></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <th scope="row">Chat Management</th>
                                        <td><input type="checkbox" class="form-check-input position-static" id="chatManagement_view"
                                            name="permissions[chatManagement][view]"></td>
                                        <td> <input type="checkbox" class="form-check-input position-static" id="chatManagement_create"
                                            name="permissions[chatManagement][create]" disabled ></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <th scope="row">Marketing Management</th>
                                        <td> <input type="checkbox" class="form-check-input position-static" id="marketingManagement_view"
                                                    name="permissions[marketingManagement][view]"></td>
                                        <td> <input type="checkbox" class="form-check-input position-static" id="marketingManagement_create"
                                                    name="permissions[marketingManagement][create]" disabled ></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="marketingManagement_edit"
                                                    name="permissions[marketingManagement][edit]" disabled></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="marketingManagement_delete"
                                                    name="permissions[marketingManagement][delete]" disabled></td>
                                        <td><input type="checkbox" class="form-check-input position-static" id="marketingManagement_archive"
                                                    name="permissions[marketingManagement][archive]" disabled></td>
                                    </tr>
                                </tbody>
                                </table> 
                            </div>
                            
                        </div>

                        <div class="form-group mt-3 d-flex justify-content-center text-center">
                            <button type="submit" class="btn btn-primary custom-btn button-link"
                                id="addUserLevelButton" name="AddUserLvl">Add User-Level</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>


    $(document).ready(function () {
        $("#select_all_checkbox").change(function () {
            const isChecked = $(this).prop("checked");
            $("input:checkbox").prop('checked', isChecked);
            
            if (!isChecked) {
                // If "Select All" is unchecked, disable specific checkboxes
                $("#marketingManagement_create, #marketingManagement_edit, #marketingManagement_delete, #marketingManagement_archive, #chatManagement_create, #statisticsManagement_create,  #fileManagement_create,#fileManagement_edit, #fileManagement_delete, #fileManagement_archive, #contentManagement_create , #contentManagement_edit, #contentManagement_delete, #orderManagement_create").prop('disabled', true);
            } else {
                // If "Select All" is checked, enable specific checkboxes
                $("#marketingManagement_create, #marketingManagement_edit, #marketingManagement_delete, #marketingManagement_archive, #chatManagement_create, #statisticsManagement_create,  #fileManagement_create,#fileManagement_edit, #fileManagement_delete, #fileManagement_archive, #contentManagement_create , #contentManagement_edit, #contentManagement_delete, #orderManagement_create").prop('disabled', false);
            }
        });
    });
   function togglePermissions(section, viewId, createId, editId, deleteId, archiveId, banId) {
    const viewCheckbox = document.getElementById(viewId);
    const createCheckbox = document.getElementById(createId);
    const editCheckbox = document.getElementById(editId);
    const deleteCheckbox = document.getElementById(deleteId);
    const archiveCheckbox = document.getElementById(archiveId);
    const banCheckbox = document.getElementById(banId);

    viewCheckbox.addEventListener("change", function () {
        createCheckbox.disabled = !this.checked;
        if (!this.checked) {
            createCheckbox.checked = false;
            editCheckbox.checked = false;
            deleteCheckbox.checked = false;
            archiveCheckbox.checked = false;

            createCheckbox.disabled = true;
            editCheckbox.disabled = true;
            deleteCheckbox.disabled = true;
            archiveCheckbox.disabled = true;
        }
        createCheckbox.addEventListener("change", function () {
            editCheckbox.disabled = !this.checked;
            if (!this.checked) {
                editCheckbox.checked = false;
                deleteCheckbox.disabled = true;
            }
        });

        editCheckbox.addEventListener("change", function () {
            deleteCheckbox.disabled = !this.checked;
            if (!this.checked) {
                deleteCheckbox.checked = false;
            }
        });

        deleteCheckbox.addEventListener("change", function () {
            archiveCheckbox.disabled = !this.checked;
            if (!this.checked) {
                archiveCheckbox.checked = false;
            }
        });
    });

 
    // 
}


    // Dashboard Permissions
    togglePermissions("dashboard", "dashboard_view", "dashboard_edit");

    // Content Management Permissions
    togglePermissions(
        "contentManagement",
        "contentManagement_view",
        "contentManagement_create",
        "contentManagement_edit",
        "contentManagement_delete"
    );

    // File Management Permissions
    togglePermissions(
        "fileManagement",
        "fileManagement_view",
        "fileManagement_create",
        "fileManagement_edit",
        "fileManagement_delete",
        "fileManagement_archive"
    );
    togglePermissions(
        "orderManagement",
        "orderManagement_view",
        "orderManagement_create"
    );

    togglePermissions(
        "statisticsManagement",
        "statisticsManagement_view",
        "statisticsManagement_create"
    );
    togglePermissions(
        "chatManagement",
        "chatManagement_view",
        "chatManagement_create"
    );
    togglePermissions(
        "marketingManagement",
        "marketingManagement_view",
        "marketingManagement_create",
        "marketingManagement_edit",
        "marketingManagement_delete",
        "marketingManagement_archive"
    );
</script>

    