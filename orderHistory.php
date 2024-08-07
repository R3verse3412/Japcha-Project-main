<?php
    include "customerProfileHeader.php";
    $stat =   $stat_model->GetCustomerHistoryOrderV2($_SESSION['userid']);
?>
<div class="rightContainer">
    <div class="addressField"><h2>Order History</h2></div>
    <div class="body_con">
        <div class="table_con">
                <table action="" >
                  <thead>
                    <tr>
                      <th>Count</th>
                      <th>Order No.</th>
                      <th>Price</th>
                      <th>Payment Mode</th>
                      <th>Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $count =1;
                      foreach ($stat as $customer_history):
                    ?>
                    <tr>
                      <td><?= $count?></td>
                      <td><?= $customer_history['order_id']?></td>
                      <td><?= $customer_history['total_price']?></td>
                      <td>
                          <?php if ($customer_history['payment_pickup'] == 1): ?>
                                <span >Pickup</span>
                            <?php elseif ($customer_history['payment_cod'] == 1): ?>
                                <span >COD</span>
                            <?php elseif ($customer_history['payment_gcash'] == 1): ?>
                                <span >G-Cash</span>
                            <?php endif; ?> 
                      </td>
                      <td><?= $customer_history['order_date']?></td>
                      <td>
                            <?php if ($customer_history['completed'] == 1): ?>
                                <span style="color: green;">Completed</span>
                            <?php else: ?>
                                <span style="color: red;">Cancelled</span>
                            <?php endif; ?>  
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
</div>
    
<?php
    include "customerProfileFooter.php";
?>