<?php
session_start();
$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if($_POST['action'] == 'changeQuantity') {
    $quantity = $_POST['quantity'];
    $productId = $_POST['productId'];
    $userId = $_SESSION["user"]['user_id'];
    if($quantity > 9) $quantity = 9;
    $result = $connect->query("UPDATE cartproduct SET product_quantity='$quantity' WHERE user_id='$userId' AND product_id='$productId' LIMIT 1");
}

?>