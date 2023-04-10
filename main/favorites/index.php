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
    <title>Gstore - sklep internetowy</title>
    <link rel="stylesheet" href="../MainPageSTYLES.css">
    <link rel="stylesheet" href="favoritesPageStyles.css">
</head>
<body>
<div class="headerDiv" style="top: 0;">
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
        <input type="button" id="starIconID" class="headerDivIcons">
        <input type="button" id="cartIconID" class="headerDivIcons" onclick="FavoritesPageGoToCartFunction()">
        <input type="button" id="accountIconID" class="headerDivIcons" onclick="AccountMenuOpen()">
    </div>


    <?php
        echo "<div class='cartMainContainer'>";
            $userID = $_SESSION["user"]['user_id'];
            $result = $connect->query("SELECT * FROM product JOIN favoriteproduct USING(product_id) WHERE favoriteproduct.user_id=$userID ORDER BY id ASC");
            while($row = mysqli_fetch_assoc($result)) {
                $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price'], $row['product_img']);
                $CartPrdct = new FavoriteItem($row['product_id'], $prdct);
                $CartPrdct->createProduct();
            }
        echo "</div>";
    ?>


    <?php
        if(isset($_SESSION['loggedIn'])){
            if($_SESSION['loggedIn'] != true) {
                echo <<< html
                    <div class="logInMenu" id="logg">
                        <div class="logInMenuArrow"></div>
                        <p id="MainTitleLoginMenu">Witaj w gstore!</p>
                        <div id="LoginMenuParting"></div>
                        <p id="SmallTextLoginMenu">Zaloguj się i zobacz swoje zakupy, obserwowane oferty i powiadomienia.</p>
                        <a href="../logging/singIn/index.php"><input type="button" id="logInButton" value="ZALOGUJ SIĘ"></a>
                        <p id="SingUpTitleLoginMenu">Nie masz konta? <a href="../logging/singUp/index.php">Zarejestruj się</a></p>
                    </div>
                html;
            } else {
                echo <<< html
                    <div class="loggedUserMenu" id="logg">
                        <div class="loggedUserMenuArrow"></div>
                        <form action="../account/index.php" method="POST">
                            <input type="submit" name="logOut" value="KONTO">
                        </form>
                        <form action="../php/logOutUser.php" method="POST" style="margin-top: -30px;">
                            <input type="submit" name="logOut" value="WYLOGUJ">
                        </form>
                    </div>
                html;
            }
        }
    ?>

    <script src="../MainPageSCRIPT.js"></script>
    <script>
        let ReturnToMainPage = document.getElementById("ReturnToMainPage");
        ReturnToMainPage.addEventListener('click', ReturnToMainPageFunction);

        function ReturnToMainPageFunction() {
            window.location="../index.php";
        }

        function FavoritesPageGoToCartFunction() {
            window.location="../cart/index.php";
        }
    </script>
</body>
</html>