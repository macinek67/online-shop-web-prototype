<?php
session_start();
$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if(isset($_POST['changeEmailSubmited'])) {
    $password = $_POST['password'];
    $email = $_POST['email'];
    if($password == $_SESSION["user"]['pass']) {
        $userId = $_SESSION["user"]['user_id'];
        $result = $connect->query("UPDATE user SET email='$email' WHERE user_id=$userId LIMIT 1");
        header("Location: ../../account/index.php");
    }
}

?>