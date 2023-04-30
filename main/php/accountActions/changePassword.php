<?php
session_start();
$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if(isset($_POST['changePasswordSubmited'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $newPasswordConfirm = $_POST['newPasswordConfirm'];
    if($oldPassword == $_SESSION["user"]['pass'] && $newPassword == $newPasswordConfirm) {
        $userId = $_SESSION["user"]['user_id'];
        $result = $connect->query("UPDATE user SET pass='$newPassword' WHERE user_id=$userId LIMIT 1");
        header("Location: ../../account/index.php");
    } else header("Location: ../../account/index.php");
}

?>