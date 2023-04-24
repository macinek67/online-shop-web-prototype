<?php

session_start();
$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if($_POST['action'] == 'addFavoriteItem') {
    $userId = $_SESSION["user"]['user_id'];
    $productId = $_POST['product'];
    $result = $connect->query("SELECT * FROM favoriteproduct WHERE user_id='$userId' AND product_id='$productId' LIMIT 1");
    if(!($row = mysqli_fetch_assoc($result))) {
        $result = $connect->query("INSERT INTO favoriteproduct(user_id, product_id) VALUES('$userId', '$productId')");
    }
}

?>