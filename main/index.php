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
    error_reporting(E_ERROR | E_PARSE);
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
                        $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price']);
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
                                $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price']);
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
                        $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price']);
                        $prdct->createProduct();
                    }
                ?>
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
                    <div class="accountButtonsDiv" onclick='window.location="account/index.php";'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        <label>KONTO</label>
                    </div>
                    <div class="accountButtonsDiv" style="margin-top: 0;" onclick='window.location="php/logOutUser.php";'>
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

    <form action="search/index.php" id="searchBarFormId" method="POST">
        <input type="hidden" id="searchBarContextId" name="searchBarContext" value="">
        <input type="hidden" id="searchBarSelectedCategoryId" name="searchBarSelectedCategory" value="Wszystkie kategorie">
    </form>

    <script src="MainPageSCRIPT.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</body>
</html>