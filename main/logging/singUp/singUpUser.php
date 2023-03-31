<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");


if(isset($_POST['singUpUser'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = $connect->query("INSERT INTO user(email, pass, isAdmin) VALUES('$email','$password', 0)");
    header("Location: ../singIn/index.php");
}

$connect->close();

?>