<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if(isset($_POST['deleteSubmit'])) {
    $id = $_POST['id'];
    $result = $connect->query("DELETE FROM cartproduct WHERE product_id='$id'");
    header("Location: ../../cart/index.php");
}

?>