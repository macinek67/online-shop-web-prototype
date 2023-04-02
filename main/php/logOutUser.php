<?php

if(isset($_POST['logOut'])) {
    session_start();
    $_SESSION["loggedIn"] = false;
    header("Location: ../index.php");
}

?>