<?php
    include "adminHeader.php";
    include_once "../config/databaseConnection.php"; 
    require_once "../classes/dbh.classes.php";
    require_once "../classes/ReviewModel.php";
    $RevModel = new ReviewModel();
    
?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="print.css" media="print">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="../assets/css/AdminRating.css">
<style>
.Rating-main{
        margin-top: 110vh;
        margin-left: 200px;
    }

.Category, #rating, #status{
    Width: 150px;
}

    </style>

<div class="Rating-main">
   <div class="Rating-header">
        <div class="Rating-title">
            <h1>Rating Management</h1>
        </div>
        

        <div class="container mt-4 mb-0">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="rating">Rating:</label>
                <select class="form-control Rating" id="rating" name="Rating" onchange="filterTable()" required>
                    <option>All</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control Category" id="category" name="Category" onchange="filterTable()" required>
                    <option>All</option>
                    <?php
                        $query = "SELECT category_id, category_name FROM categories";
                        $result = mysqli_query($con, $query);
                                   
                        while ($row = mysqli_fetch_assoc($result)) {
                        $categoryId = $row['category_id'];
                        $categoryName = $row['category_name'];
          
                    ?>
                        <option value="<?=$categoryName?>" id="category"  ><?=$categoryName?></option>

                    <?php
                    }
                     ?> 
                    <!-- add more categories as needed -->
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control Rating" id="status" name="Rating" onchange="filterTable()" required>
                    <option>All</option>
                    <option>hidden</option>
                    <option>shown</option>
                </select>
            </div>
        </div>
    </div>
</div>

    <div class="container mt-4" style="height: 500px; margin-bottom: 600px;">
        <div class="table-responsive">
            <table id="RatingTable" class="table table-bordered table-bordered-custom" style="width:100%;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #000;">#</th>
                        <th style="border: 1px solid #000; width:210px;">Account Name</th>
                        <th style="border: 1px solid #000; width:140px;">Product</th>
                        <th style="border: 1px solid #000; width:140px;">Category</th>
                        <th style="border: 1px solid #000;">Rating</th>
                        <th style="border: 1px solid #000; min-width: 220px;">Feedback</th>
                        <th style="border: 1px solid #000; width:140px;">Date</th>
                        <th style="border: 1px solid #000; width:80px;">status</th>
                        <th style="border: 1px solid #000; min-width: 140px;">Moderator</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $review_data = $RevModel->GetAllReview();
                    $count = 1;
                    foreach ($review_data as $review):
                    ?>
                    <tr>
                        <td style="border: 1px solid #000; vertical-align: middle !important;"><?= $count ?></td>
                        <td style="border: 1px solid #000; vertical-align: middle !important;"><?= $review['reviewer_name'] ?></td>
                        <td style="border: 1px solid #000; vertical-align: middle !important;"><?= $review['product_name'] ?></td>
                        <td style="border: 1px solid #000; vertical-align: middle !important;"><?= $review['category_name'] ?> </td>
                        <td style="border: 1px solid #000; vertical-align: middle !important;"><?= $review['rating'] ?> Star</td>
                        <td style="border: 1px solid #000; vertical-align: middle !important;"><?= $review['review_comment'] ?></td>
                        <td style="border: 1px solid #000; vertical-align: middle !important;"><?= $review['date'] ?></td>
                        <td style="border: 1px solid #000; vertical-align: middle !important;">
                            <?php if ($review['isHideComment'] == 1): ?>
                                <span style="color: red;">hidden</span>
                            <?php else: ?>
                                <span style="color: green;">shown</span>
                            <?php endif; ?>
                        </td>
                        <td style="border: 1px solid #000; vertical-align: middle !important;">
                           
                            <button class="btn btn-warning btnHideComment" data-review_id="<?= $review['review_id'] ?>" data-toggle="modal" data-target="#HideCommentModal" data-tooltip="tooltip" title="Hide Comment" style="margin-right: 10px;">
                                <i class="fas fa-eye-slash"></i>
                            </button><button class="btn btn-warning btnUnHideComment" data-review_id="<?= $review['review_id'] ?>" data-toggle="modal" data-target="#UnHideCommentModal" data-tooltip="tooltip" title="Hide Comment">
                                <i class="fas fa-eye"></i>
                            </button>
                          
                        </td>
                    </tr>
                    <?php
                     $count++;
                    endforeach;
                    ?>
                </tbody>

            </table>
       
            </div>
    

</div>

<div class="modal fade" id="HideCommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hide Comment?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit_hide" data-dismiss="modal">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="UnHideCommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Unhide Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit_unhide" data-dismiss="modal">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- Include this script at the end of your HTML file, just before the closing </body> tag -->
<script>
function filterTable() {
    var table, rows, i, rating, category, status, selectedRating, selectedCategory, selectedStatus;
    table = document.getElementById("RatingTable");
    rows = table.rows;
    selectedRating = document.getElementById("rating").value;
    selectedCategory = document.getElementById("category").value;
    selectedStatus = document.getElementById("status").value;

    for (i = 1; i < rows.length; i++) {
        rating = rows[i].getElementsByTagName("td")[4].innerText; // Assuming the rating is in the 4th column
        category = rows[i].getElementsByTagName("td")[3].innerText; // Assuming the category is in the 3rd column
        status = rows[i].getElementsByTagName("td")[7].innerText;

        // Extract the numeric part of the rating (excluding " Star" suffix)
        var numericRating = rating.replace(" Star", "");

        var ratingFilter = selectedRating === "All" || numericRating === selectedRating;
        var categoryFilter = selectedCategory.trim().toLowerCase() === "all" || category.trim().toLowerCase() === selectedCategory.trim().toLowerCase();
        var statusFilter = selectedStatus.trim().toLowerCase() === "all" || status.trim().toLowerCase() === selectedStatus.trim().toLowerCase();

        if (ratingFilter && categoryFilter && statusFilter) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

$(document).ready(function(){

    var reviewId;

    $('.btnHideComment').on('click', function () {
        // Access the data-review_id attribute of the clicked button
        reviewId = $(this).data('review_id');
        $(".modal-body").text("Are you sure you want to hide this comment?")
    });

    $("#submit_hide").click(function(){
        $.ajax({
            type: 'POST',
            url: '../controller/ManageReviews.php',
            data: {
                review_id: reviewId,
            },
            success: function(response){
                console.log(response);
            
                window.location.href = 'AdminRating.php';
               
            },
            error: function(error){
                console.log("encountered error: " +error)
            }
        });
    });

    $('.btnUnHideComment').on('click', function () {
        // Access the data-review_id attribute of the clicked button
        reviewId = $(this).data('review_id');
        $(".modal-body").text("Are you sure you want to unhide this comment?")
    });


    $("#submit_unhide").click(function(){
        $.ajax({
            type: 'POST',
            url: '../controller/ManageReviews.php',
            data: {
                review_id_unhide: reviewId,
            },
            success: function(response){
                window.location.href = 'AdminRating.php';
               
            },
            error: function(error){
                console.log("encountered error: " +error)
            }
        });
    });

    $('#RatingTable').DataTable({
        "pagingType": "simple",  // Display simple pagination
        "searching": true,      // Disable search feature
        "order": [[0, 'asc']],   // Order by the first column in ascending order
        "lengthMenu": [5,10,20],
        "lengthChange": true,          // Enable the ability to change the number of rows displayed per page
        "info": true,                  // Enable information display
        "autoWidth": false,            // Disable automatic column width calculation
        "columnDefs": [
            { "width": "150px", "targets": 6 }  // Set a specific width for the first column
        ]

    });


});

</script>




<?php
    include "adminFooter.php";
?>