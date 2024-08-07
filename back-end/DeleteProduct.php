<?php
      foreach ($products as $product):
?>
<!-- Confirm Modal -->
    <div class="modal fade justify-content-center align-items-center" id="deleteProduct<?= $product['product_id']?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete <?= $product['product_name'] ?> ?</h5>
                        <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
              
                    <div class="alert alert-danger mb-0" role="alert">
                        Do you want to delete <?= $product['product_name'] ?> product?
                    </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger"><a style="text-decoration: none; color:#ffffff;" href="../controller/RemoveUserlevel.php?deleteidproduct=<?= $product['product_id']?>">Yes</a></button>
                </div>
            </div>
        </div>
    </div>
<?php
endforeach;
?>

<?php
      foreach ($products as $product):
?>
<!-- Confirm Modal -->
    <div class="modal fade justify-content-center align-items-center" id="archiveProduct<?= $product['product_id']?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hide <?= $product['product_name'] ?> ?</h5>
                        <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                
                    <div class="alert alert-warning mb-0" role="alert">
                        Do you want to hide <?= $product['product_name'] ?> product?
                    </div>
             
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger"><a style="text-decoration: none; color:#ffffff;" href="../controller/RemoveUserlevel.php?archiveidproduct=<?= $product['product_id']?>">Yes</a></button>
                </div>
            </div>
        </div>
    </div>
<?php
endforeach;
?>