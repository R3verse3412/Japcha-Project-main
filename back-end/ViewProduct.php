<style>
  .title{
    width: 30% !important;
  }
  .card-text{
    width: 70% !important;
  }
</style>

<?php
foreach ($products as $product):
  $prodid= $product['product_id'];
    ?>

    <div class="modal fade" id="viewProd<?= $product['product_id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
              <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body flex-row">
              <div class="card-body d-flex justify-content-center" style="width: 40%;">
                <?php
                if (strpos($product['image_url'], '.mp4') !== false) {
                  ?>
                  <video controls style="max-width: 100%">
                    <source src="../upload/<?= $product['image_url']?>" type="video/mp4">
                    <p>Your browser does not support the video tag</p>
                  </video>
                  <?php
                } else {
                  ?>
                  <img src="../upload/<?= $product['image_url']?>" alt="" style="max-width: 100%" >
                  <?php
                }
                ?>
              </div>
              <div class="card-body p-2" style="width: 60%;">
                <div class="body d-flex flex-row gap-2">
                  <label class="title" for="title">Product Name:</label>
                  <p class="card-text"><?= $product['product_name']?></p>
                </div>
                <div class="body d-flex flex-row gap-2">
                  <label class="title" for = "title">Category:</label>
                  <p class="card-text"><?= $product['category_name']?></p>
                </div>
                <div class="body d-flex flex-row gap-2">
                  <label class="title" for="title">Description:</label>
                  <p class="card-text"><?= $product['description']?></p>
                </div>
                <div class="card-body d-flex flex-row gap-2">
                  <label class="title" for="title">Size:</label>
                  <div class="card-text d-flex flex-row gap-2" >
                    <?php
                      $getSize =  $productModel->getSizeVariation($prodid);
                      foreach($getSize as $varSize):
                    ?>
                    <li class="list-group-item list-group-item-primary p-2 justify-content-betwwen" style="border-radius: 10px"><?= $varSize['size_name']?>
                    <span class="badge badge-primary badge-pill">₱<?= $varSize['price']?></span></li>
                    <?php
                      endforeach;
                    ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
endforeach;
?>
