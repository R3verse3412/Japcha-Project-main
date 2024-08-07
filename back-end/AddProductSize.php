<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Product Size and Price Variation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../includes/ProductSizes.inc.php" method="post">
                    <div class="form-group">
                        <label for="product">Product:</label>
                        <select class="form-control" name="product">
                            <option value="default" selected disabled style="font-style: italic; color: gray;">Select Product</option>
                            <?php
                            $query = "SELECT product_id, product_name FROM product";
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
                            <option value="default" selected disabled style="font-style: italic; color: gray;">Select Size</option>
                            <?php
                            $query = "SELECT sizes_id, size_name FROM product_sizes";
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
                        <input type="number" class="form-control" name="price" step="0.01" min="0" placeholder="0.00" required />
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" step="1" min="0" placeholder="0" required />
                    </div>
                    <button type="submit" class="btn1" name="submit">Add Variation</button>
                </form>
            </div>
        </div>
    </div>
</div>