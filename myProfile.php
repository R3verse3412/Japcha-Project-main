<?php
    include_once "customerProfileHeader.php";

?>
<div class="rightContainer">
    <div class="addressField"><h2>My Profile</h2></div>
        <div class="headerContainer">
            <div class="accountDetailsContainer">
                <div class="header">
                    <h4>Account Details</h4>
                    <div class="vl"></div>
                    <button><a href="customerManageAccount.php">EDIT</a></button>
                </div>
                <div class="body_">
                    <p>
                        <?=
                            $customer_date["username"] . ' ' .  $customer_date["last_name"] 
                        ?>
                    </p>
                    <p> 
                        <?php
                            echo $customer_date["email"];
                        ?>
                    </p>
                    <p>
                        <?php
                            echo $customer_date["contact_number"];
                        ?>
                    </p>
                </div>
            </div>
            <div class="defaultAddressContainer">
                <div class="header">
                        <h4>Default Address</h4>
                        <div class="vl"></div>
                        <button><a href="#" data-toggle="modal" data-target="#changeAddressModal">EDIT</a></button>
                    </div>
                    <div class="body_">
                        <p id="CustomerAddressField">
                          
                        </p>

                    </div>
            </div>
        </div>
        
        <div class="bodyContainer">
            <div class="header_"><h3>Recent Orders</h3></div>
            <div class="table_container">
                <table action="" >
                  <thead>
                    <tr>
                      <th>Order No.</th>
                      <th>Total Price</th>
                      <th>Payment mode</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $stat =   $stat_model->GetCustomerRecentOrders($_SESSION['userid']);
                        foreach ($stat as $customer_recent):
                    ?>
                    <tr>
                      <td><?= $customer_recent['order_id']?></td>
                      <td><?= $customer_recent['total_price']?></td>
                      <td>
                            <?php if ($customer_recent['payment_pickup'] == 1): ?>
                                <span >Pickup</span>
                            <?php elseif ($customer_recent['payment_cod'] == 1): ?>
                                <span >COD</span>
                            <?php elseif ($customer_recent['payment_gcash'] == 1): ?>
                                <span >G-Cash</span>
                            <?php endif; ?> 
                      </td>
                      <td><?= $customer_recent['order_date']?></td>
                    </tr>
                    <?php
                        endforeach;
                    ?>
                  </tbody>
                 
                </table>
            </div>
        </div>
</div>
    
<input type="hidden" name="userid" id="userid"  value="<?= $_SESSION["userid"] ?>">
<script src="assets/js/GetCustomerAddress.js"></script>
<?php
    include_once "ChangeAddress.php";
?>
<?php
    include "customerProfileFooter.php";
?>