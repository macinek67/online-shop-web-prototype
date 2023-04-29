<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if(isset($_POST['productIdToRestore'])) {
    $productToRestore = $_POST['productIdToRestore'];
    $result = $connect->query("UPDATE product set isSuspended='no' WHERE product_id='$productToRestore'");
    header("Location: ../../adminPage/index.php");
}

?>