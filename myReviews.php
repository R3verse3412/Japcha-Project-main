<?php
    include "customerProfileHeader.php";
    require_once "classes/ReviewModel.php";
    $review_model = new ReviewModel();

    $review =  $review_model->GetReviewsByCustomer($_SESSION['userid']);
?>

<div class="rightContainer">
    <div class="addressField"><h2>My Reviews</h2></div>
    <div class="body_con">
        <div class="table_con">
                <table action="" >
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th style="width: 100px;">Ratings</th>
                      <th>Comment</th>
                      <th style="width: 220px;">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(!empty($review)){

                    
                      foreach ($review as $review_history):
                    ?>
                    <tr>
                      <td><?=$review_history['product_name']?></td>
                      <td> <?php for ($i = 0; $i < $review_history['rating']; $i++) : ?>
                            <i class="fa-regular fa-star fa-2xs" style="color: gold;"></i>
                        <?php endfor; ?></td>
                      <td><?=$review_history['review_comment']?></td>
                      <td><?=$review_history['date']?></td>
                    </tr>
                    <?php
                         endforeach; 
                        }else{
                    ?>
                      <td colspan="4">No reviews yet</td>

                     <?php
                       }
                    ?>    
                  </tbody>
               
                 

                </table>
        </div>
    </div>
</div>
    
<?php
    include "customerProfileFooter.php";
?>