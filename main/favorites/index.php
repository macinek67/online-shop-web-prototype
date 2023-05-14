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
        <img src="../../images/gstore.png" class="headerDivLogo" onclick='window.location="../index.php";'>
        <input type="text" id="searchBarId" placeholder="czego szukasz?" class="headerDivSearch" style="height: 37px;">
        <select class="headerDivCategorySelect" id="headerDivCategorySelectId">
            <option>Wszystkie kategorie</option>
            <optgroup label="Kategorie">
                <?php showCategories(); ?>
            </optgroup>
        </select>
        <input type="button" id="SearchButtonSubmit" class="headerDivSearchButton" value="SZUKAJ">
        <input type="button" id="starIconID" class="headerDivIcons" onclick='window.location="../favorites/index.php";'>
        <input type="button" id="cartIconID" class="headerDivIcons" onclick='window.location="../cart/index.php";'>
        <input type="button" id="accountIconID" class="headerDivIcons" onclick="AccountMenuOpen()">
    </div>


    <?php
        if(isset($_SESSION['loggedIn'])){
            if($_SESSION['loggedIn'] == true) {
                $userID = $_SESSION["user"]['user_id'];
                $result = $connect->query("SELECT * FROM product JOIN favoriteproduct USING(product_id) WHERE favoriteproduct.user_id=$userID ORDER BY id ASC");
                if($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='cartMainContainer'>";
                        $result = $connect->query("SELECT * FROM product JOIN favoriteproduct USING(product_id) WHERE favoriteproduct.user_id=$userID ORDER BY id ASC");
                        while($row = mysqli_fetch_assoc($result)) {
                            $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price'], $row['product_img']);
                            $CartPrdct = new FavoriteItem($row['product_id'], $prdct);
                            $CartPrdct->createProduct();
                        }
                    echo "</div>";
                } else {
                    echo <<< html
                        <div class='emptyFavoritesDiv'>
                            <label id='boldLabel'>Nie masz ulubionych przedmiotów</label><br>
                            <label>Dodaj jakiś klikając gwiazdkę na stronie produktu.</label><br>
                            <img src='../../images/emptyFavoritesImage.png'>
                        </div>
                    html;
                }
            }
        }
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
                        <div class="accountButtonsDiv" onclick='window.location="../account/index.php";'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                            <label>KONTO</label>
                        </div>
                        <div class="accountButtonsDiv" style="margin-top: 0;" onclick='window.location="../php/logOutUser.php";'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="white" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                            </svg>
                            <label>WYLOGUJ</label>
                        </div>
                    </div>
                html;
            }
        }
    ?>

    <form action="../search/index.php" id="searchBarFormId" method="POST">
        <input type="hidden" id="searchBarContextId" name="searchBarContext" value="">
        <input type="hidden" id="searchBarSelectedCategoryId" name="searchBarSelectedCategory" value="Wszystkie kategorie">
    </form>

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

        function goToProductPage(productId) {
            document.getElementById("goToProductId").value = productId;
            document.getElementById("goToProductPageForm").submit();
        }

    </script>
</body>
</html>