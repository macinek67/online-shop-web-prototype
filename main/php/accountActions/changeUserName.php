<?php
session_start();
$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if(isset($_POST['changeNameSubmited'])) {
    $newName = $_POST['newNameValue'];
    if(strlen($newName) == 0 || strlen($newName) > 25)
        header("Location: ../../account/index.php");
    else {
        $userId = $_SESSION["user"]['user_id'];
        $result = $connect->query("UPDATE user SET name='$newName' WHERE user_id=$userId LIMIT 1");
        header("Location: ../../account/index.php");
    }
}

?>