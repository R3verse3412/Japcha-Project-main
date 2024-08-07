<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['checkout'])){
        
        $cartid = $_POST['cart_id'];
        $pname = $_POST['p_name'];
        $sizename = $_POST['size_name'];
        $addons_name = $_POST['addons_name'];
        echo '<pre>';
        var_dump($cartid);
        echo '</pre>';
        echo '<br>';
        echo '<pre>';
        var_dump($pname);
        echo '</pre>';
        echo '<br>';
        echo '<pre>';
        var_dump($sizename);
        echo '</pre>';
        echo '<br>';
        echo '<pre>';
        var_dump($addons_name);
        echo '</pre>';
    }
}