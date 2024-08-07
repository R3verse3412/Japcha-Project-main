<?php
     $count = 1;      
     foreach ($data as $productVariation):
?>
<!-- Confirm Modal -->
<div class="modal fade justify-content-center align-items-center" id="archive<?= $productVariation['prodsizes_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Archive <?= $productVariation['product_name'] ?> || <?= $productVariation['size_name'] ?>  ?</h5>
                        <button type="button" class="form_close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger mb-0" role="alert">
                        Do you want to archive <?= $productVariation['product_name'] ?> ?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"><a style="text-decoration: none; color:#ffffff;" href="../controller/RemoveUserlevel.php?deleteidul=<?=$productVariation['prodsizes_id']?>">Yes</a></button>
                </div>
            </div>
        </div>
    </div>
<?php
    endforeach;
?>