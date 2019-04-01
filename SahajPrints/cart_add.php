<?php
    require 'connection.php';
    //require 'header.php';
    session_start();

    $item_id=$_GET['id'];
    $item_name=$_GET['item_name'];
    $cost_per_pc =(int) $_GET['cost_per_pc'];
    $quantity=(int)$_GET['qty'];

    $user_id=$_SESSION['id'];
    
    $add_to_cart_query="insert into users_items(user_id,item_id,item_name,quantity,cost_per_pc,total_cost,status) values ('$user_id','$item_id','$item_name','$quantity','$cost_per_pc','$cost_per_pc*$quantity','Added to cart')";
    
    $add_to_cart_result=mysqli_query($con,$add_to_cart_query) or die(mysqli_error($con));
    
    header('location: testing.php');
?>