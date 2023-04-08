<?php
    session_start();
    require_once('../php/classes.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zawartość koszyka</title>
    <link rel="stylesheet" href="../MainPageSTYLES.css">
    <link rel="stylesheet" href="cartPageStyles.css">
</head>
<body>
    <div class="headerDiv">
        <image src="../../images/gstore.png" class="headerDivLogo" id="ReturnToMainPage">
        <input type="text" placeholder="czego szukasz?" class="headerDivSearch">
        <select class="headerDivCategorySelect">
            <option>Wszystkie kategorie</option>
            <optgroup label="Kategorie">
                <option value="parrot">Elektronika</option>
                <option value="macaw">Moda</option>
                <option value="albatross">Motoryzacja</option>
            </optgroup>
        </select>
        <input type="button" class="headerDivSearchButton" value="SZUKAJ">
        <input type="button" id="coinIconID" class="headerDivIcons">
        <input type="button" id="starIconID" class="headerDivIcons">
        <input type="button" id="chatIconID" class="headerDivIcons">
        <input type="button" id="bellIconID" class="headerDivIcons">
        <input type="button" id="cartIconID" class="headerDivIcons" onclick="AccountPageGoToCartFunction()">
        <input type="button" id="accountIconID" class="headerDivIcons" onclick="AccountMenuOpen()">
    </div>

    <div class="cartMainContainer">
        <div class="cartItemsContainer">
            <?php
                $xd = new CartItem($product1);
                $xd1 = new CartItem($product2);
                $xd2 = new CartItem($product3);
                $xd3 = new CartItem($product4);
                $xd4 = new CartItem($product5);
                $xd1->createProduct();
                $xd2->createProduct();
                $xd3->createProduct();
                $xd4->createProduct();
                $xd->createProduct();
                $xd->createProduct();
                $xd->createProduct();
                $xd->createProduct();
                $xd->createProduct();
                $xd->createProduct();
                $xd->createProduct();
            ?>
        </div>
        <div class="sideCartPanel">

        </div>
    </div>




    <div class="loggedUserMenu" id="logg">
        <div class="loggedUserMenuArrow"></div>
        <form action="../account/index.php" method="POST">
            <input type="submit" name="logOut" value="KONTO">
        </form>
        <form action="../php/logOutUser.php" method="POST" style="margin-top: -30px">
            <input type="submit" name="logOut" value="WYLOGUJ">
        </form>
    </div>
    
</body>
<script src="../MainPageSCRIPT.js"></script>
<script>
    let ReturnToMainPage = document.getElementById("ReturnToMainPage");
    ReturnToMainPage.addEventListener('click', ReturnToMainPageFunction);

    function ReturnToMainPageFunction() {
        window.location="../index.php";
    }
</script>
</html>