<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="MainPageSTYLES.css">
</head>
<?php

?>
<body>
    <div class="headerDiv">
        <img src="gstore.png" class="headerDivLogo">
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
        <input type="button" id="cartIconID" class="headerDivIcons">
        <input type="button" id="accountIconID" class="headerDivIcons" onclick="AccountMenuOpen()">
    </div>





    <div>
        <div class="SuggestionsBaner" id="SuggestionsBanerID">
            <input type="button" id="Suggestion1" class="SelectSugeestionButtons" value="Darmowa dostawa" onclick="ChangedSuggestionBanner(1)">
            <input type="button" id="Suggestion2" class="SelectSugeestionButtons" value="Zbieraj monety" onclick="ChangedSuggestionBanner(2)">
            <input type="button" id="Suggestion3" class="SelectSugeestionButtons" value="Okazje" onclick="ChangedSuggestionBanner(3)">
            <input type="button" id="Suggestion4" class="SelectSugeestionButtons" value="Nowości" onclick="ChangedSuggestionBanner(4)">
        </div>

        <div class="newsletterDiv" id="newsletterDivID">
            <div>
                <div class="dotHeader"></div>
                <h2 class="categoryHeaderText">Zapisz się na newsletter</h2>
                <div class="blueLineHeader"></div>
            </div>
        </div>

        <div class="bestSellersDiv" id="bestSellersDivID">
            <div>
                <div class="dotHeader"></div>
                <h2 class="categoryHeaderText">Najczęściej kupowane</h2>
                <div class="blueLineHeader"></div>
            </div>
        </div>

        <div class="lastWatchedProductsDiv" id="lastWatchedProductsDivID">
            <div>
                <div class="dotHeader"></div>
                <h2 class="categoryHeaderText">Ostatnio przeglądane</h2>
                <div class="blueLineHeader"></div>
            </div>
        </div>

        <div class="theNewestProductsDiv" id="theNewestProductsDivID">
            <div>
                <div class="dotHeader"></div>
                <h2 class="categoryHeaderText">Najnowsze produkty</h2>
                <div class="blueLineHeader"></div>
            </div>
        </div>

        <div class="ContactUsDiv" id="ContactUsDivID">
            <div>
                <h1 class="contactUsTitle">SKONTAKTUJ SIE</h1>
            </div>
        </div>
    </div>





    <div class="logInMenu" id="logg">
        <div class="logInMenuArrow"></div>
        <p id="MainTitleLoginMenu">Witaj w gstore!</p>
        <div id="LoginMenuParting"></div>
        <p id="SmallTextLoginMenu">Zaloguj się i zobacz swoje zakupy, obserwowane oferty i powiadomienia.</p>
        <input type="button" id="logInButton" value="ZALOGUJ SIĘ">
        <p id="SingUpTitleLoginMenu">Nie masz konta? <a href="">Zarejestruj się</a></p>
    </div>

    <script src="MainPageSCRIPT.js"></script>
</body>
</html>