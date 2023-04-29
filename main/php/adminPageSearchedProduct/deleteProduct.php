<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if(isset($_POST['productIdToDelete'])) {
    $productToDelete = $_POST['productIdToDelete'];
    $result = $connect->query("UPDATE product set isSuspended='yes' WHERE product_id='$productToDelete'");
    header("Location: ../../adminPage/index.php");
}

?>