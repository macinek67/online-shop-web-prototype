<?php

$connect = @new mysqli("localhost", "root", "", "sklepinternetowypai");
include("product/produkt.php");
include("cartProduct/cartItem.php");
include("favoriteProduct/favoriteItem.php");
include("showCategories.php");
include("searchedProduct/searchedItem.php");
include("accountOrders/userOrder.php");
include("searchedCategory/searchedCategory.php");
include("adminPageSearchedProduct/adminPageProduct.php");

?>