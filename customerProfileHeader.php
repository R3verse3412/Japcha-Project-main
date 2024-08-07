<?php
    include "c_header.php";
    // include_once "config/databaseConnection.php";
    require_once "classes/StatisticsModel.php";
    $stat_model = new StatisticsModel();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JapCha Profile</title>

</head>
<body>
    

<div class="profileContainer">
    <div class="profile">
        <div class="profileHeader">
            <div class="profilePic">
                <img src="image/sample1.png" alt="">
            </div>
            <div class="username">
                <div class="profile_name">
                    <?= $customer_date["username"] . ' ' . $customer_date["last_name"] ?>
                </div>
            </div>
        </div>
        <div class="manageProfile">
            <div class="myprofile">
                <h2><a href="myProfile.php">My Profile</a></h2>
            </div>
            <div class="editAccount">
                <ul class="m-2">
                    <li><a href="customerManageAccount.php">Manage Account</a></li>
                    <!-- <li><a href="addressBook.php">Address Book</a></li> -->
                </ul>
            </div>
        </div>
        <div class="manageOrder">
            <div class="orderManagement">
                <h2>Order Management</h2>
            </div>
            <div class="orderLinks">
                <ul class="m-2">
                    <li><a href="orderHistory.php">Order History</a></li>
                    <li><a href="myReviews.php">My Reviews</a></li>
                </ul>
            </div>
        </div>
    </div>
 