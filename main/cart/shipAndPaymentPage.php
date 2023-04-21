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
    <title>Gstore - składanie zamówienia</title>
    <link rel="stylesheet" href="../MainPageSTYLES.css">
    <link rel="stylesheet" href="shipAndPaymentPageStyles.css">
</head>
<body>
<div class="headerDiv" style="top: 0;">
        <image src="../../images/gstore.png" class="headerDivLogo" id="ReturnToMainPage" onclick='window.location="../index.php";'>
        <input type="button" id="accountIconID" class="headerDivIcons" onclick="">
    </div>


    <form class="orderForm">
        <div class="shippingAdresDiv">
            <label class="boldlabel">Dane odbiorcy przesyłki</label>
            <hr>
            <div id="shippingAdresDivFormId">
                <label class="TypeAdresButton">imię</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. Jan"><br><br>
                <label class="TypeAdresButton">nazwisko</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. Kowalski"><br><br>
                <label class="TypeAdresButton">telefon komórkowy</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. 000000000"><br><br>
                <label class="TypeAdresButton">ulica i numer</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. Przemysłowa 10/10"><br><br>
                <label class="TypeAdresButton">kod pocztowy</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. 00-000"><br><br>
                <label class="TypeAdresButton">miejscowość</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. Warszawa"><br>
            </div>
        </div>


        <div class="shippingMethodDiv">
            <label class="boldlabel">Metody dostawy</label>
            <hr>
            <input type="radio" name="shippingType" value="Kurier">
            <label class="shippingMethodLabelText">Kurier</label><label class="shippingCostlabel">14.99 zł</label><br>
            <input type="radio" name="shippingType" value="Kurier za pobraniem">
            <label class="shippingMethodLabelText">Kurier za pobraniem</label><label class="shippingCostlabel">19.99 zł</label><br>
            <input type="radio" name="shippingType" value="Paczkomat inPost" id="paczkomatRadio">
            <label class="shippingMethodLabelText">Paczkomat inPost</label>
            <?php
                $cartSumPrice = $_POST['sumPriceProducts'];
                if($cartSumPrice < 399) echo "<label class='shippingCostlabel'>9.99 zł</label>";
                else {
                    echo "<label class='shippingCostlabel' style='text-decoration: line-through;'>9.99 zł</label>";
                    echo "<label class='shippingCostlabel'>0.00 zł</label>";
                }
            ?>
            <div id="slide">
                <label class="TypeAdresButton">kod paczkomatu</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. LIM02M"><br>
            </div>
        </div>

        <div class="paymentMethodDiv">
            <label class="boldlabel">Metody płatności</label>
            <hr>
            <div class="paymentMethodContainer" id="blikContainer" onclick="blikPaymentMethodSelected()">
                <img src="../../images/blikImage.webp">
                <label>BLIK</label>
            </div>
            <div class="paymentMethodContainer" id="googlepayContainer" onclick="GooglepayPaymentMethodSelected()">
                <img src="../../images/googlePayImage.svg">
                <label>Google Pay</label>
            </div>
        </div>
    </form>



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

    <form action="../search/index.php" id="searchBarFormId" method="POST">
        <input type="hidden" id="searchBarContextId" name="searchBarContext" value="">
        <input type="hidden" id="searchBarSelectedCategoryId" name="searchBarSelectedCategory" value="Wszystkie kategorie">
    </form>
    <script src="../MainPageSCRIPT.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        let selectPaczkomatSlide = 0;

        $('input[name="shippingType"]').change(function() {
            if(this.value == "Paczkomat inPost")
                $('#slide').animate({height: 'show'}, 200,);
            else
                $('#slide').animate({height: 'hide'}, 200,);
        });

        $('#slide').animate({
            height: 'hide'
        }, 0, function() {
        });

        function blikPaymentMethodSelected() {
            document.getElementById("blikContainer").style.borderWidth = "2px";
            document.getElementById("googlepayContainer").style.borderWidth = "1px";
        }

        function GooglepayPaymentMethodSelected() {
            document.getElementById("blikContainer").style.borderWidth = "1px";
            document.getElementById("googlepayContainer").style.borderWidth = "2px";
        }
    </script>
</body>
</html>