<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");
include("product/produkt.php");
include("cartProduct/cartItem.php");
include("favoriteProduct/favoriteItem.php");

?>