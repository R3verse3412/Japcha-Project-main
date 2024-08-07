<?php
    include "adminHeader.php";
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    $CustomerData = new Signup();
    $customerData = $CustomerData->getCustomerData();
    $data = $customerData['data'];
    $page = $customerData['page'];
    $total_rows = $customerData['total_rows'];
    // $limit = $customerData['limit'];

    $count = 1;
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<style>
    .active-page {
        color: yellow !important;
    }
</style>
    <?php
        include_once "DeleteCustomerAccount.php";
    ?>
<main class="table">
<!-- <div id="pagination-container">
    <ul class="pagination"></ul>
</div> -->
        <section class="table_header">
            <h1>Customer Account</h1>
            
                <input type="text" class="search" id="live_search" placeholder="Search....">
        </section>
        <div class="alert alert-success SuccessAction" role="alert" style="display: none;">
          This is a success alert—check it out!
        </div>
        <a href="AdminArchive.php">See archives</a>

        <?php
            if(isset($_SESSION['DeletedCustomer'])){
                echo '<div class="alert alert-danger" role="alert">' .
                        $_SESSION['DeletedCustomer'] .
                    '</div>';
                unset($_SESSION['DeletedCustomer']);
            }
        ?>

        
        <section class="table_body">
        <div id="pagination-container">
            <ul class="pagination"></ul>
        </div>
            <table action="Admin_user_management.php"  id="user_account_table">
                <thead>
                  <tr>
                    <th>id</th>
                    <!-- <th>Profile</th> -->
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <?php
                            if(isset($_SESSION["fileManagement_delete"]) && $_SESSION["fileManagement_delete"] == 1){
                                ?>

                                <th>Ban</th>
                    <?php

                            }
                    ?>
                    
                  </tr>
                </thead>
                <tbody id="userTable">
                <?php
// Get customer data and pagination variables


// Check if there are customer accounts
if (empty($data)) {
    echo "<tr><td colspan='6'>No customer accounts found.</td></tr>";
} else {
    $count;
    foreach ($data as $customer) {
        
        $id = $customer['customer_id'];

        $fullname = $customer['username'] . ' ' . $customer['last_name'];

?>
        <tr class="customer-row">
            <td><?= $count ?></td>
            <!-- <td><img src='../image/user.jpg' alt='user image'></td> -->
            <td><?= $fullname ?></td>
            <td><?= $customer['email'] ?></td>
            <td><?= $customer['customer_address'] ?>,  <?= $customer['city'] ?>, <?= $customer['region'] ?></td>
            <td><?= $customer['contact_number'] ?></td>
            <?php
            if (isset($_SESSION["fileManagement_delete"]) && $_SESSION["fileManagement_delete"] == 1) {
            ?>
                <td>
                    <!-- <div class="row"> -->
                    <button type="button" class="btn btn-danger ban_button" data-toggle="modal" data-target="#BanAccountModal" data-tooltip="tooltip" title="Ban account" data-ban-id="<?= $id ?>" data-ban-name ="<?=$fullname?>" data-ban-emaildd ="<?=$customer['email']?>"><i class="fa fa-ban" aria-hidden="true" ></i></button>

                    <!-- <button class="btn btn-danger" data-toggle="modal" data-target="#DeleteCustomer = $id ?>" ><i class="fa fa-trash" aria-hidden="true" data-tooltip="tooltip" title="Permanently ban account"></i></button>
                    </div> -->
                 
                </td>
            <?php
            }
            ?>
        </tr>
<?php
        $count++;
    }
}
?>
    


<!-- Pagination -->
<div class="pagination-container">
    <ul class="pagination">
        <?php
        // Check if there are previous pages
        // $prevPage = $page - 1;
        // $nextPage = $page + 1;
        
        // Disable and style "Previous" button if $page is less than or equal to 1
        // echo '<li class="page-item ' . ($page <= 1 ? 'disabled' : '') . '">';
        // echo '<a class="page-link" href="?page=' . ($page <= 1 ? 1 : $prevPage) . '">Previous</a>';
        // echo '</li>';
        
        // Display page numbers
        // for ($i = 1; $i <= ceil($total_rows / $limit); $i++) {
        //     // Add the "active-page" class to the current page number when it's active
        //     $activeStyle = ($page == $i) ? 'style="background: #EBC749; color: black; border: 1px solid #EBC749;"' : '';

        //     echo '<li class="page-item"><a class="page-link" ' . $activeStyle . ' href="?page=' . $i . '">' . $i . '</a></li>';
            
        // }

        // Disable and style "Next" button if there are no more next pages
        // echo '<li class="page-item ' . (($page * $limit) >= $total_rows ? 'disabled' : '') . '">';
        // echo '<a class="page-link" href="?page=' . (($page * $limit) >= $total_rows ? $page : $nextPage) . '">Next</a>';
        // echo '</li>';
        ?>
    </ul>
</div>


</tbody>
</table>

</section>

    </main>


    <div class="modal fade justify-content-center align-items-center" id="BanAccountModal" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete <span class="ban_name"></span>?</h5>
                        <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
               
                    <div class="alert alert-danger mb-0" role="alert">
                        Do you want to ban <span class="ban_name"></span> customer account?
                    </div>
                    <input type="hidden"  class="email_holderss">
      
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger confirm_ban" data-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function () {
        // Number of items per page
        var itemsPerPage = 10; // Adjust as needed

            // Hide all customer rows
            $(".customer-row").hide();

            // Show the first 'itemsPerPage' rows
            $(".customer-row:lt(" + itemsPerPage + ")").show();

            // Calculate the number of pages
            var totalPages = Math.ceil($(".customer-row").length / itemsPerPage);

            // Generate pagination links
            for (var i = 1; i <= totalPages; i++) {
                $("#pagination-container .pagination").append("<li class='page-item'><a class='page-link' href='#'>" + i + "</a></li>");
            }

            // Handle pagination link click
            $("#pagination-container .pagination a").on("click", function () {
                var currentPage = $(this).text();
                var startIndex = (currentPage - 1) * itemsPerPage;
                var endIndex = startIndex + itemsPerPage;

                // Hide all rows and show the rows for the current page
                $(".customer-row").hide().slice(startIndex, endIndex).show();

                // Update active class for pagination links
                $("#pagination-container .pagination li").removeClass("active");
                $(this).parent().addClass("active");
            });

            // Handle live search
            $("#live_search").on("keyup", function () {
                var searchTerm = $(this).val().toLowerCase();

                // Hide all rows and show the rows that match the search term
                $(".customer-row").hide().filter(function () {
                    return $(this).text().toLowerCase().indexOf(searchTerm) > -1;
                }).show();

                // Update pagination links based on the filtered rows
                $("#pagination-container .pagination").empty();
                var filteredPages = Math.ceil($(".customer-row:visible").length / itemsPerPage);
                for (var i = 1; i <= filteredPages; i++) {
                    $("#pagination-container .pagination").append("<li class='page-item'><a class='page-link' href='#'>" + i + "</a></li>");
                }
            });
    });
</script>
  <script>
  $(document).ready(function () {
        // Initialize DataTable
        var enableSearching = true;

        // var dataTable = $('#user_account_table').DataTable({
        //     "pagingType": 'simple',
        //     "searching": enableSearching,
        //     "order": [[0, 'asc']],
        //     "lengthMenu": [5, 10, 20, 50],
        //     "lengthChange": true,
        // });

        function updateSearch() {
            if (enableSearching) {
                var searchTerm = $('#live_search').val();
                dataTable.search(searchTerm).draw();
            }
        }

        $('#live_search').on('input', function () {
            updateSearch();
        });


        $(".ban_button").click(function(){

            var ban_id = $(this).data('ban-id');
            var ban_name = $(this).data('ban-name');
            var ban_email = $(this).data('ban-emaildd');
            console.log("click");
           console.log({
            ban_id,
            ban_name,
            ban_email
           });
            $("#BanAccountModal").find(".ban_name").text(ban_name);
            $("#BanAccountModal").find(".confirm_ban").val(ban_id);
            $("#BanAccountModal").find(".email_holderss").val(ban_email);
           

        });


        $(".confirm_ban").click(function () {
            var banid = $(this).val();
            var mails_user = $(".email_holderss").val();
            console.log({
                banid,
                mails_user
            });
            $.ajax({
                type: 'POST',
                url: '../controller/UserLevelManagement.php',
                data: {
                    id_customer: banid,
                    mail_customer: mails_user,
                },
                success: function (response) {
                    try {
                        response = JSON.parse(response);

                        if (response && typeof response === 'object') {
                            if (response.success) {
                                $(".SuccessAction").text(response.success);
                                $(".SuccessAction").show();
                                setTimeout(function () {
                                    window.location.href = 'CustomerAccount.php';
                                }, 3000);
                            } else {
                                alert("Invalid response from the server");
                            }
                        } else {
                            alert("Invalid response from the server");
                        }
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                    }
                    console.log(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });




    });

  </script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->

<?php
    include "adminFooter.php";

?>