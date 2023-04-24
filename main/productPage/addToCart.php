<?php

session_start();
$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if($_POST['action'] == 'addToCartItem') {
    $userId = $_SESSION["user"]['user_id'];
    $productId = $_POST['product'];
    $result = $connect->query("SELECT * FROM cartproduct WHERE user_id='$userId' AND product_id='$productId' LIMIT 1");
    if(!($row = mysqli_fetch_assoc($result))) {
        $result = $connect->query("INSERT INTO cartproduct(user_id, product_id, product_quantity) VALUES('$userId', '$productId', 1)");
    }
}

?>