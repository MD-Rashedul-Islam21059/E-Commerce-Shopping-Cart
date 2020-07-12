<?php 
    include 'connection.php';

    try{
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $totalCartItemQuery = $conn->query("SELECT * FROM `cart_item` WHERE `user_ip` = '$user_ip'");
        $totalCartItem = $totalCartItemQuery->rowCount();
        echo $totalCartItem;
    }catch(EXCEPTION $e){
        echo $e->getMessage();
    }
    
?>