<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if(isset($_POST['categoryIdToDelete'])) {
    $categoryToDelete = $_POST['categoryIdToDelete'];
    $result = $connect->query("DELETE FROM category WHERE category_id='$categoryToDelete'");
    header("Location: ../../adminPage/index.php");
}

?>