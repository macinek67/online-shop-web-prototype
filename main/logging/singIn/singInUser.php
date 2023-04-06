<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");

if(isset($_POST['singInUser'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = $connect->query("SELECT * FROM user WHERE email='$email' AND pass='$password' LIMIT 1");
    if($row = mysqli_fetch_assoc($result)) {
        if($row['email']==$email && $row['pass']==$password) {
            session_start();
            $_SESSION["loggedIn"] = true;
            $_SESSION["user"] = $row;
            header("Location: ../../index.php");
        }
    }
    if($_SESSION["loggedIn"] != true){
        session_start();
        $_SESSION["loggedIn"] = false;
        header("Location: index.php");
        exit;
    }
}

$connect->close();

?>