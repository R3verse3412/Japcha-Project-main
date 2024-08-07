<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="formProducts1" action="../includes/Product.inc.php" method="POST" autocomplete="off" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Combo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product1">Product 1:</label>
                        <select class="form-control" name="product1">
                            <option value="default" selected disabled style="font-style: italic; color: gray;">Select Product</option>
                            <?php
                            $productModel = new ProductModel();
                            $products = $productModel->getAllProducts();
                            foreach ($products as $product):
                            ?>
                            <option value="<?= $product['product_id'] ?>"><?= $product['product_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product2">Product 2:</label>
                        <select class="form-control" name="product2">
                            <option value="default" selected disabled style="font-style: italic; color: gray;">Select Product</option>
                            <?php
                            $productModel = new ProductModel();
                            $products = $productModel->getAllProducts();
                            foreach ($products as $product):
                            ?>
                            <option value="<?= $product['product_id'] ?>"><?= $product['product_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comboName">Combo Name:</label>
                        <input type="text" class="form-control" id="comboName" name="comboName" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" cols="30" rows="2" style="resize: none;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select class="form-control" name="category" required>
                            <?php
                            $query = "SELECT category_id, category_name FROM categories where category_id = 5";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $categoryId = $row['category_id'];
                                $categoryName = $row['category_name'];
                                echo '<option value="' . $categoryId . '" selected>' . $categoryName . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
