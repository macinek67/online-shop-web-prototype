<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gstore - sklep internetowy</title>
    <link rel="stylesheet" href="MainPageSTYLES.css">
    <link rel="stylesheet" href="php/product/productStyles.css">
</head>
<?php
    session_start();
    require_once('php/classes.php');
    if($_SESSION["loggedIn"] == null)
        $_SESSION["loggedIn"] = false;
?>
<body>
    <div class="headerDiv">
        <img src="../images/gstore.png" class="headerDivLogo" onclick='window.location="index.php";'>
        <input type="text" id="searchBarId" placeholder="czego szukasz?" class="headerDivSearch">
        <select class="headerDivCategorySelect" id="headerDivCategorySelectId">
            <option>Wszystkie kategorie</option>
            <optgroup label="Kategorie">
                <?php showCategories(); ?>
            </optgroup>
        </select>
        <input type="button" id="SearchButtonSubmit" class="headerDivSearchButton" value="SZUKAJ">
        <input type="button" id="starIconID" class="headerDivIcons" onclick="MainPageGoToFavoritesFunction()">
        <input type="button" id="cartIconID" class="headerDivIcons" onclick="MainPageGoToCartFunction()">
        <input type="button" id="accountIconID" class="headerDivIcons" onclick="AccountMenuOpen()">
    </div>





    <div>
        <div class="SuggestionsBaner" id="SuggestionsBanerID">
            <input type="button" id="Suggestion1" class="SelectSugeestionButtons" value="Darmowa dostawa" onclick="ChangedSuggestionBanner(1)">
            <input type="button" id="Suggestion2" class="SelectSugeestionButtons" value="Zbieraj monety" onclick="ChangedSuggestionBanner(2)">
            <input type="button" id="Suggestion3" class="SelectSugeestionButtons" value="Okazje" onclick="ChangedSuggestionBanner(3)">
            <input type="button" id="Suggestion4" class="SelectSugeestionButtons" value="Newsletter" onclick="ChangedSuggestionBanner(4)">
        </div>

        <div class="newsletterDiv" id="newsletterDivID">
            <div>
                <div class="dotHeader"></div>
                <h2 class="categoryHeaderText">Zapis do newslettera</h2>
                <div class="blueLineHeader"></div>
            </div>
        </div>

        <div class="bestSellersDiv" id="bestSellersDivID">
            <div>
                <div class="dotHeader"></div>
                <h2 class="categoryHeaderText">Najczęściej kupowane</h2>
                <div class="blueLineHeader"></div>
            </div>
            <div class="theNewestProductsDivProductContainer" id="bestSellersProductsDivProductContainer">
                <?php
                    $result = $connect->query("SELECT * FROM product ORDER BY product_boughtCount DESC LIMIT 20");
                    while($row = mysqli_fetch_assoc($result)) {
                        $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price'], $row['product_img']);
                        $prdct->createProduct();
                    }
                ?>
            </div>
        </div>

        <div class="lastWatchedProductsDiv" id="lastWatchedProductsDivID">
            <div>
                <div class="dotHeader"></div>
                <h2 class="categoryHeaderText">Ostatnio przeglądane</h2>
                <div class="blueLineHeader"></div>
            </div>
                <?php
                    if(isset($_SESSION['loggedIn'])){
                        if($_SESSION['loggedIn'] != true) {
                            echo <<< html
                                <p id="lastWatchedProductsDivTitle">ZAWARTOŚĆ NIEDOSTĘPNA DLA NIEZALOGOWANYCH</p>
                                <a href="logging/singIn/index.php"><input type="button" id="lastWatchedProductsDivButton" value="ZALOGUJ SIĘ"></a>
                            html;
                        } else {
                            echo '<div class="theNewestProductsDivProductContainer" id="lastWatchedProductsProductContainer">';
                            $userID = $_SESSION["user"]['user_id'];
                            $result = $connect->query("SELECT * FROM product JOIN lastwatchedproducts USING(product_id) WHERE lastwatchedproducts.user_id=$userID ORDER BY id DESC LIMIT 20");
                            while($row = mysqli_fetch_assoc($result)) {
                                $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price'], $row['product_img']);
                                $prdct->createProduct();
                            }
                            echo '</div>';
                        }
                        
                    }
                ?>
        </div>

        <div class="theNewestProductsDiv" id="theNewestProductsDivID">
            <div>
                <div class="dotHeader"></div>
                <h2 class="categoryHeaderText">Najnowsze produkty</h2>
                <div class="blueLineHeader"></div>
            </div>
	        <div class="theNewestProductsDivProductContainer" id="theNewestProductsDivProductContainer">
                <?php
                    $result = $connect->query("SELECT * FROM product ORDER BY product_id DESC LIMIT 20");
                    while($row = mysqli_fetch_assoc($result)) {
                        $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price'], $row['product_img']);
                        $prdct->createProduct();
                    }
                ?>
            </div>
        </div>

        <div class="ContactUsDiv" id="ContactUsDivID">
            <div>
                <h1 class="contactUsTitle">SKONTAKTUJ SIE</h1>
                <div>
                    <form id="msform">
                        <fieldset>
                            <h2 class="fs-title">Wyślij zapytanie</h2>
                            <h3 class="fs-subtitle"></h3>
                            <input type="number" name="email" placeholder="Numer klienta:" min="0"/>
                            <input type="text" name="pass" placeholder="Email:"/>
                            <input type="text" name="cpass" placeholder="Treść:"/>
                            <input type="button" name="next" class="next action-button" value="WYŚLIJ" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        
    </div>



    <?php
        if(isset($_SESSION['loggedIn'])){
            if($_SESSION['loggedIn'] != true) {
                echo <<< html
                    <div class="logInMenu" id="logg">
                        <div class="logInMenuArrow"></div>
                        <p id="MainTitleLoginMenu">Witaj w gstore!</p>
                        <div id="LoginMenuParting"></div>
                        <p id="SmallTextLoginMenu">Zaloguj się i zobacz swoje zakupy, obserwowane oferty i powiadomienia.</p>
                        <a href="logging/singIn/index.php"><input type="button" id="logInButton" value="ZALOGUJ SIĘ"></a>
                        <p id="SingUpTitleLoginMenu">Nie masz konta? <a href="logging/singUp/index.php">Zarejestruj się</a></p>
                    </div>
                html;
            } else {
                echo <<< html
                    <div class="loggedUserMenu" id="logg">
                        <div class="loggedUserMenuArrow"></div>
                        <form action="account/index.php" method="POST">
                            <input type="submit" name="logOut" value="KONTO">
                        </form>
                        <form action="php/logOutUser.php" method="POST">
                            <input type="submit" name="logOut" value="WYLOGUJ">
                        </form>
                    </div>
                html;
            }
        }
    ?>

    <form action="search/index.php" id="searchBarFormId" method="POST">
        <input type="hidden" id="searchBarContextId" name="searchBarContext" value="">
        <input type="hidden" id="searchBarSelectedCategoryId" name="searchBarSelectedCategory" value="Wszystkie kategorie">
    </form>

    <script src="MainPageSCRIPT.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</body>
</html>