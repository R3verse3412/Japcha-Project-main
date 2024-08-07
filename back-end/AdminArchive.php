<?php
    include "adminHeader.php";
?>

<style>

    .Archived-main{
        margin-top: 120px;
        margin-left: 200px;
        min-height: 700px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    td{
        vertical-align: middle !important;
    }
    td video{
        display: none !important;
    }
    </style>

<div class="Archived-main">
    <div class="Archived-header">
        <div class="Archived-title" style="margin-top: 20px;">
            <h1>Archives</h1>
        </div>
        </div>

<div class="container mt-4">
<div class="col-xs-12" style="width: 100%;">
    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">PRODUCTS</a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">USERLEVEL</a>
        <a class="nav-item nav-link" id="nav-customer-tab" data-toggle="tab" href="#nav-customer" role="tab" aria-controls="nav-customer" aria-selected="false">CUSTOMER ACCOUNT</a>

    </div>
    </div>

    <div class="tab-content mt-2" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="container mt-4">
                <table id="salesTable" class="table table-bordered table-bordered-custom" style="width:1100px;">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Image</th>
                            <th >Product Name</th>
                            <th >Category</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody id="ArchivedProductTable">
                        <!-- The template row is now hidden by default -->
                        <tr id="ArchivedContainerProduct" style="display: none;">
                            <td id="ArchivedCountProduct" class="center-content">1</td>
                            <td class="center-content">
                                <img src="../image/Mango-shake.png" alt="B" id="product-image" style="display:none;">
                                <video src="" id="video" ></video>
                            </td>
                            <td id="ArchivedProductName" class="center-content"></td>
                            <td id="ArchivedProductCategory" class="center-content">Milk Tea</td>
                            <td id="btnUnarchived" class="center-content">
                                <button class="btn btn-warning unarchiveProduct" data-tooltip="tooltip" title="unarchive product"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                <button class="btn btn-danger deleteProduct"  data-tooltip="tooltip" title="permanently product"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
<script>
$(document).ready(function () {
    // Attach click event handler to the body, targeting the "Unarchive" button
    $("body").on("click", ".unarchiveProduct", function () {
  
        UnarchiveProduct($(this).data("productid"));
    });

    $("body").on("click", ".deleteProduct", function () {
  
        DeleteProduct($(this).data("productid"));
    });


    function getArchivedProducts() {
        $.ajax({
            type: 'GET',
            url: '../controller/GetArchived.php',
            data: {
                product: 'product'
            },
            dataType: 'json',
            success: function (response) {
                let count = 1;
                // Clear existing content in the table


                response.prod.forEach(function (product) {
                    // Clone the template row
                    
                    let ArchivedProductContainer = $("#ArchivedContainerProduct").clone();
           
                    ArchivedProductContainer.find("#ArchivedCountProduct").text(count);

                    // Check if the image_url is an image or video
                    if (product.image_url && product.image_url.match(/\.(png|jpg|gif)$/)) {
    // Display image
                        ArchivedProductContainer.find("#product-image").show();
                        ArchivedProductContainer.find("#product-image").attr("src", "../upload/" + product.image_url);
                        // Clear the video source if it's an image
                        ArchivedProductContainer.find("#video").attr("src", "");
                    } else if (product.image_url) {
                        // Display video
                        ArchivedProductContainer.find("#video").show();
                        ArchivedProductContainer.find("#video").attr("src", product.image_url);
                        // Clear the image source if it's a video
                        ArchivedProductContainer.find("#product-image").attr("src", "");
                    } else {
                        // No image or video, hide both
                        ArchivedProductContainer.find("#product-image").hide();
                        ArchivedProductContainer.find("#video").hide();
                    }


                    ArchivedProductContainer.find("#ArchivedProductName").text(product.product_name);
                    ArchivedProductContainer.find("#ArchivedProductCategory").text(product.product_category);

                    // Update the buttons with the product_id
                    let btnUnarchived = ArchivedProductContainer.find("#btnUnarchived");
                    btnUnarchived.find(".unarchiveProduct").attr("data-productid", product.product_id);
                    btnUnarchived.find(".deleteProduct").attr("data-productid", product.product_id);

                    // Append the new row to the parent table
                    ArchivedProductContainer.css('display', 'table-row');
                    
                    count++;

                    // Append the new row to the parent
                    $("#ArchivedProductTable").append(ArchivedProductContainer);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error fetching archived products:", error);
            }
        });
    }

    getArchivedProducts();

    function UnarchiveProduct(product_id) {
    // Display a confirmation dialog
        if (confirm("Are you sure you want to unarchive this product?")) {
            // User clicked OK, proceed with the AJAX request
            $.ajax({
                type: 'POST',
                url: '../controller/GetArchived.php',
                data: {
                    product_id: product_id,
                },
                success: function (response) {
                    // Handle success response

                    // Parse the JSON response
                    var jsonResponse = JSON.parse(response);

                    // Display an alert with the message
                    alert(jsonResponse);

                    // Reload the page after 3 seconds
                    setTimeout(function () {
                        window.location.href = 'AdminArchive.php';
                    }, 2000);
             
          
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error("Error updating archived products:", error);
                }
            });
        }
    }

    function DeleteProduct(product_id) {
    // Display a confirmation dialog
        if (confirm("Are you sure you want to permanently delete this product?")) {
            // User clicked OK, proceed with the AJAX request
            $.ajax({
                type: 'POST',
                url: '../controller/GetArchived.php',
                data: {
                    product_id_delete: product_id,
                },
                success: function (response) {
                    // Handle success response

                    // Parse the JSON response
                    var jsonResponse = JSON.parse(response);

                    // Display an alert with the message
                    alert(jsonResponse);

                    // Reload the page after 3 seconds
                    setTimeout(function () {
                        window.location.href = 'AdminArchive.php';
                    }, 3000);
          
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error("Error updating archived products:", error);
                }
            });
        } 
    }
 

});

</script>


    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="container mt-4">
            <table id="salesTable" class="table table-bordered table-bordered-custom" style="width:1100px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="ArchiveUserlevelTable">
                    <tr id="UserlevelArchiveContainer" style="display: none;">
                        <td id="UserlevelCount">1</td>
                        <td id="UserlevelName">Admin</td>
                        <td id="btnUSL">  <button class="btn btn-warning" id="unarchiveUserlevel" data-tooltip="tooltip" title="unarchive userlevel"><i class="fa fa-eye" aria-hidden="true"></i></button> <button class="btn btn-danger" id="deleteUserlevel" data-tooltip="tooltip" title="permanently delete userlevel"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>


    <div class="tab-pane fade" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
        <div class="container mt-4">
            <table id="salesTable" class="table table-bordered table-bordered-custom" style="width:1100px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody id="ArchiveUserTable">
                    <tr id="CustomerAccountArchvied" style="display: none;">
                        <td id="userCount">1</td>
                        <td id="userName">Admin</td>
                        <td id="email">Admin</td>
                        <td id="address">Admin</td>

                        <td id="btnCustomer">  
                        <button class="btn btn-warning" id="unbanUser" data-tooltip="tooltip" title="reactivate account"><i class="fa fa-eye" aria-hidden="true"></i></button> 
                        <button class="btn btn-danger" id="deleteUser" data-tooltip="tooltip" title="permanently ban user"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>


<script>
   $(document).ready(function () {

function getArchivedUserlevel() {
    $.ajax({
        type: 'GET',
        url: '../controller/GetArchived.php',
        dataType: 'json',
        data: {
            userlevel: 'userlevel',
        },
        success: function (response) {
            let count = 1;
            // Clear existing content in the table
            response.usl.forEach(function (userlevel) {
                let userlevel_container = $("#UserlevelArchiveContainer").clone();

                userlevel_container.find("#UserlevelCount").text(count)
                userlevel_container.find("#UserlevelName").text(userlevel.user_level_name);

                let btnContainerUserlevl = userlevel_container.find("#btnUSL");

                // Add data attribute to buttons
                btnContainerUserlevl.find("#unarchiveUserlevel").attr("data-ulid", userlevel.userlevel_id);
                btnContainerUserlevl.find("#deleteUserlevel").attr("data-ulid", userlevel.userlevel_id);

                // Attach click event handlers to buttons
                btnContainerUserlevl.find("#unarchiveUserlevel").click(function () {
                    unarchiveUserlevel($(this).data("ulid"));
                });

                btnContainerUserlevl.find("#deleteUserlevel").click(function () {
                    deleteUserlevel($(this).data("ulid"));
                });

                userlevel_container.css('display', 'table-row');
                count++;

                // Append the new row to the parent
                $("#ArchiveUserlevelTable").append(userlevel_container);
            });
        },
        error: function (xhr, status, error) {
            console.error("Error updating archived user levels:", error);
        }
    });
}

function unarchiveUserlevel(userlevel_id) {
    // Display a confirmation dialog
    if (confirm("Are you sure you want to unarchive this user level?")) {
        // User clicked OK, proceed with the AJAX request
        $.ajax({
            type: 'POST',
            url: '../controller/GetArchived.php', // Adjust the URL accordingly
            data: {
                userlevel_id: userlevel_id,
            },
            success: function (response) {
                // Handle success response
                var jsonResponse = JSON.parse(response);


                alert(jsonResponse);

                // Reload the page after 3 seconds
                setTimeout(function () {
                    window.location.href = 'AdminArchive.php';
                }, 3000);
     
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error("Error unarchiving user level:", error);
            }
        });
    }
}

function deleteUserlevel(userlevel_id) {
    // Display a confirmation dialog
    if (confirm("Are you sure you want to permanently delete this user level?")) {
        // User clicked OK, proceed with the AJAX request
        $.ajax({
            type: 'POST',
            url: '../controller/GetArchived.php', // Adjust the URL accordingly
            data: {
                userlevel_id_delete: userlevel_id,
            },
            success: function (response) {
                // Handle success response
                var jsonResponse = JSON.parse(response);

                // Display an alert with the message
                alert(jsonResponse);

                // Reload the page after 3 seconds
                setTimeout(function () {
                    window.location.href = 'AdminArchive.php';
                }, 3000);
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error("Error deleting user level:", error);
            }
        });
    } 
}

function getCustomerTemporaryBanned() {
    $.ajax({
        type: 'GET',
        url: '../controller/GetArchived.php',
        dataType: 'json',
        data: {
            customer_account: 'customer',
        },
        success: function (response) {
            let count = 1;
            // Clear existing content in the table
            response.user.forEach(function (account) {
                let user_container = $("#CustomerAccountArchvied").clone();

                user_container.find("#userCount").text(count)
                user_container.find("#userName").text(account.username);

                user_container.find("#email").text(account.email)
                user_container.find("#address").text(account.address);

                let btnContainerUserlevl = user_container.find("#btnCustomer");
          
                // Add data attribute to buttons
                btnContainerUserlevl.find("#unbanUser")
                .attr("data-userid", account.customer_id)
                .attr("data-email", account.email);
                btnContainerUserlevl.find("#deleteUser").
                attr("data-userid", account.customer_id)
                .attr("data-email", account.email);;

                // Attach click event handlers to buttons
                btnContainerUserlevl.find("#unbanUser").click(function () {
                    unbanCustomer($(this).data("userid"), $(this).data("email"));
                });

                btnContainerUserlevl.find("#deleteUser").click(function () {
                    deleteCustomer($(this).data("userid"), $(this).data("email"));
                });

                user_container.css('display', 'table-row');
                count++;

                // Append the new row to the parent
                $("#ArchiveUserTable").append(user_container);
            });
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error("Error updating archived user levels:", error);
        }
    });
}


function unbanCustomer(userid, email) {
    // console.log(userid);
    // console.log(email);
    if (confirm("Are you sure you want to unban this customer account?")) {
        // User clicked OK, proceed with the AJAX request
        $.ajax({
            type: 'POST',
            url: '../controller/GetArchived.php', // Adjust the URL accordingly
            data: {
                userid: userid,
                email: email,
            },
            success: function (response) {
                // Handle success response
                var jsonResponse = JSON.parse(response);

                alert(jsonResponse);

                // Reload the page after 3 seconds
                setTimeout(function () {
                    window.location.href = 'AdminArchive.php';
                }, 3000);
     
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error("Error unarchiving user level:", error);
            }
        });
    }
}


function deleteCustomer(userid, email) {
    // Display a confirmation dialog
    // console.log(userid);
    if (confirm("Are you sure you want to permanently delete this customer account?")) {
        // User clicked OK, proceed with the AJAX request
        $.ajax({
            type: 'POST',
            url: '../controller/GetArchived.php', // Adjust the URL accordingly
            data: {
                userid_delete: userid,
                email: email,
            },
            success: function (response) {
                // Handle success response
                var jsonResponse = JSON.parse(response);

                // Display an alert with the message
                alert(jsonResponse);

                // Reload the page after 3 seconds
                setTimeout(function () {
                    window.location.href = 'AdminArchive.php';
                }, 3000);
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error("Error deleting user level:", error);
            }
        });
    } 
}



getArchivedUserlevel();

getCustomerTemporaryBanned();

});

</script>


<?php
    include "adminFooter.php";
?>
