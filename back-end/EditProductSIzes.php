<?php
    include_once "../config/databaseConnection.php";
?>
<link rel="stylesheet" href="../assets/css/EditProductSizes.css">
<div class="form2 signup_form" id="addAdminPopup">
                <div class="formBody">
                        <?php
                        if (isset($_POST['var'])) {
                            //     echo "connected";
                                $variationID = htmlspecialchars($_POST["var"], ENT_QUOTES, 'UTF-8');
                                
                                $query = "SELECT * FROM product_variation WHERE prodsizes_id = '$variationID'";
                                $result = mysqli_query($con, $query);

                                    while ($row1 = mysqli_fetch_assoc($result)) {
                                        $vID=$row1['prodsizes_id'];
                                        $pID=$row1["product_id"];
                                        $sID=$row1["sizes_id"];
                                        $price=$row1["price"];
                                        $quantity=$row1["quantity"];

                        ?>
                    <form action="../includes/EditProductSizes.inc.php" method="post">
                        <h2>Product Size and Price Variation</h2>
                        <input type="text" class="form-control" id="v_id" value="<?= $vID?>" hidden>
                        <div class="input_box">
                            <label for="product">Product:</label>
                            <select name="product" >
                            <?php

                                $sql="SELECT product_id, product_name from product where product_id=$pID";
                                $result = mysqli_query($con, $sql);

                                while($row = mysqli_fetch_assoc($result)){
                                    $prodID = $row['product_id'];
                                    $prodName = $row['product_name'];
                                    ?>
                                   <option value="<?= $prodID?>" selected disabled style="font-style: italic; color:gray;"><?= $prodName?></option>
                                <?php
                                        }
                                ?>
                                
                                    <?php
                                      
                                        $query = "SELECT product_id, product_name FROM product WHERE product_id!=$pID";
                                        $result = mysqli_query($con, $query);
                                    
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $ProductId = $row['product_id'];
                                            $ProductName = $row['product_name'];
                                            echo '<option value="' . $ProductId . '">' . $ProductName . '</option>';
                                        }
                                    ?> 
                            </select>
                        </div>
                        <div class="input_box">
                            <label for="size">Size:</label>
                            <select name="size">
                                <?php

                                $sql="SELECT sizes_id, size_name from product_sizes where sizes_id=$sID";
                                $result = mysqli_query($con, $sql);

                                while($row = mysqli_fetch_assoc($result)){
                                    $sizeID = $row['sizes_id'];
                                    $sizeName = $row['size_name'];
                                    ?>
                                    <option value="<?= $sizeID?>" selected disabled style="font-style: italic; color:gray;"><?= $sizeName?></option>
                                <?php
                                        }
                                ?>
                                    <?php
                                        $query = "SELECT sizes_id, size_name FROM product_sizes where sizes_id!=$sID";
                                        $result = mysqli_query($con, $query);
                                    
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $SizeId = $row['sizes_id'];
                                            $SizeName = $row['size_name'];
                                            echo '<option value="' . $SizeId . '">' . $SizeName . '</option>';
                                        }
                                    ?> 
                            </select>
                        </div>
                        <div class="input_box-EditProd">
                            <label for="price">Price:</label>
                            <input type="number"  name="price" step="0.01" min="0" placeholder="0.00" value="<?= $price?>"required />            
                        </div>
                        <div class="input_box-EditProd">
                            <label for="quantity">Quantity:</label>
                            <input type="number"  name="quantity" step="0" min="0" placeholder="0" value="<?= $quantity?>" required />
                        </div>
                        <!-- <input type="submit" class="btnLogin btn-primary"> -->
                        <button class="btnSignup" type="submit" name="submit">Add Variation</button>
                    </form>
                    <?php
                        }
                    }
            ?>
                </div>
            </div>
            