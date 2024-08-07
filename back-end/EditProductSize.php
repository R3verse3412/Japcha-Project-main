<?php
     $count = 1;      
     foreach ($data as $productVariation):
          $prodVariationID = $productVariation['prodsizes_id'];
          $productName = $productVariation['product_name'];
          $sizeName = $productVariation['size_name'];
          $price = $productVariation['price'];
          $quantity = $productVariation['quantity'];
?>
<div class="modal fade" id="edit<?= $productVariation['prodsizes_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Product Size and Price Variation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../includes/EditProductVariation.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name = "prodvar_id" value="<?= $productVariation['prodsizes_id']; ?> ">
                        <label for="product">Product:</label>
                        <select class="form-control" name="product">
                            <option value="<?= $productVariation['product_id']; ?>" selected ><?= $productVariation['product_name']; ?></option>
                            <?php
                            $query = "SELECT product_id, product_name FROM product WHERE product_id != {$productVariation['product_id']}";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $ProductId = $row['product_id'];
                                $ProductName = $row['product_name'];
                                echo '<option value="' . $ProductId . '">' . $ProductName . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="size">Size:</label>
                        <select class="form-control" name="size">
                            <option value="<?= $productVariation['sizes_id']; ?>" selected ><?= $productVariation['size_name']; ?></option>
                            <?php
                            $query = "SELECT sizes_id, size_name FROM product_sizes WHERE sizes_id != {$productVariation['sizes_id']}";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $SizeId = $row['sizes_id'];
                                $SizeName = $row['size_name'];
                                echo '<option value="' . $SizeId . '">' . $SizeName . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" name="price" step="0.01" min="0" placeholder="0.00" value="<?= $productVariation['price']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" step="1" min="0" placeholder="0" value="<?= $productVariation['quantity']; ?>" required />
                    </div>
                    <button type="submit" class="btn1" name="submit">Update Variation</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    endforeach;
?>