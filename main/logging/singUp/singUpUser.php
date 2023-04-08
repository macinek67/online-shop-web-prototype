<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");


if(isset($_POST['singUpUser'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date = date('Y-m-d');
    $result = $connect->query("SELECT * FROM user WHERE email='$email' AND pass='$password' LIMIT 1");
    if($row = mysqli_fetch_assoc($result)) {
        header("Location: index.php");
        return;
    }
    $result = $connect->query("INSERT INTO user(email, pass, isAdmin) VALUES('$email','$password', 0)");
    $result = $connect->query("SELECT * FROM user WHERE email='$email' AND pass='$password' LIMIT 1");
    if($row = mysqli_fetch_assoc($result)) {
        $result = $connect->query("UPDATE user SET name='user$row[id]', createDate='$date' WHERE email='$email' AND pass='$password' LIMIT 1");
    }
    header("Location: ../singIn/index.php");
}

$connect->close();

?>