<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if(isset($_POST['addNewCategorySubmited'])) {
    $method = $_POST['method'];
    $categoryName = $_POST['categoryName'];
    if($method == "addCategory") {
        $result = $connect->query("SELECT * FROM category WHERE name='$categoryName' LIMIT 1");
        if(!($row = mysqli_fetch_assoc($result))) {
            $result = $connect->query("INSERT INTO category(name) VALUES('$categoryName')");
        }
    } else if($method == "editCategory") {
        $oldName = $_POST['oldName'];
        $result = $connect->query("UPDATE category SET name='$categoryName' WHERE name='$oldName'");
    }
    header("Location: index.php");
}

?>