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


    <form class="orderForm" action="orderFinished.php" method="POST" id="orderFormid">
        <div class="shippingAdresDiv">
            <label class="boldlabel">Dane odbiorcy przesyłki</label>
            <hr>
            <div id="shippingAdresDivFormId">
                <label class="TypeAdresButton">imię</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. Jan" id="orderNameId" name="orderName"><br><br>
                <label class="TypeAdresButton">nazwisko</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. Kowalski" id="orderSurmaneId" name="orderSurname"><br><br>
                <label class="TypeAdresButton">telefon komórkowy</label><br>
                <input type="number" class="shippingAdresButton" placeholder="np. 000000000" id="orderTelephoneNumberId" name="orderTelephone"><br><br>
                <label class="TypeAdresButton">ulica i numer</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. Przemysłowa 10/10" id="orderStreetAdressId" name="orderAdress"><br><br>
                <label class="TypeAdresButton">kod pocztowy</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. 00-000" id="orderPostCodeId" name="orderPostcode"><br><br>
                <label class="TypeAdresButton">miejscowość</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. Warszawa" id="orderCityId" name="orderCity"><br>
            </div>
        </div>


        <div class="shippingMethodDiv">
            <label class="boldlabel">Metody dostawy</label>
            <hr>
            <input type="radio" name="shippingType" value="14.99" checked="checked">
            <label class="shippingMethodLabelText">Kurier</label><label class="shippingCostlabel">14.99 zł</label><br>
            <input type="radio" name="shippingType" value="19.99">
            <label class="shippingMethodLabelText">Kurier za pobraniem</label><label class="shippingCostlabel">19.99 zł</label><br>
            <?php
                $productsInOrder = $_POST['cartProducts'];
                $cartSumPrice = $_POST['sumPriceProducts'];
                if($cartSumPrice < 399) echo '<input type="radio" name="shippingType" value="9.99" id="paczkomatRadio">';
                else echo '<input type="radio" name="shippingType" value="0.00" id="paczkomatRadio">';
            ?>
            <label class="shippingMethodLabelText">Paczkomat inPost</label>
            <?php
                if($cartSumPrice < 399) echo "<label class='shippingCostlabel'>9.99 zł</label>";
                else {
                    echo "<label class='shippingCostlabel' style='text-decoration: line-through;'>9.99 zł</label>";
                    echo "<label class='shippingCostlabel'>0.00 zł</label>";
                }
            ?>
            <div id="slide">
                <label class="TypeAdresButton">kod paczkomatu</label><br>
                <input type="text" class="shippingAdresButton" placeholder="np. LIM02M" id="orderPaczkomatCode" name="orderPaczkomatCodePost"><br>
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


        <div class="summaryOrderDiv">
            <label class="boldlabel">Podsumowanie</label>
            <hr>
            <div>
                <label class="summaryDivLeftLabels">Produkty </label>
                <label class="summaryDivRightLabels">zł</label><label class="summaryDivRightLabels" id="cartProductsSumPriceId"><?php echo $cartSumPrice; ?></label><br>
                <label class="summaryDivLeftLabels">Dostawa</label>
                <label class="summaryDivRightLabels">zł</label><label class="summaryDivRightLabels" id="shipCostSummaryId">14.99</label>
                <hr>
                <label class="summaryDivLeftLabels">Razem</label>
                <label class="summaryDivRightLabels">zł</label><label class="summaryDivRightLabels" id="orderFinalPriceId"><?php echo $cartSumPrice+14.99; ?></label><br>
                <input type="button" id="orderFormSubmitButtonId" class="orderFormSubmitButton" value="KUPUJE I PŁACE" onclick="checkOrderValid()">
                <input type="hidden" name="shipCostPost" value="14.99" id="shipCostPostId">
                <input type="hidden" name="finalPricePost" value='<?php echo $cartSumPrice+14.99; ?>' id="finalPricePostid">
                <input type="hidden" name="paymentTypePost" value="blik" id="paymentTypePostId">
                <input type="hidden" name="orderedProducts" value='<?php echo $productsInOrder ?>'>
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
            document.getElementById("shipCostSummaryId").innerText = this.value;
            let finalPrice = document.getElementById("orderFinalPriceId");
            let cartProductsPrice = document.getElementById("cartProductsSumPriceId");
            document.getElementById("shipCostPostId").value = this.value;
            finalPrice.innerHTML = parseFloat(cartProductsPrice.innerHTML)+parseFloat(this.value);
            document.getElementById("finalPricePostid").value = parseFloat(cartProductsPrice.innerHTML)+parseFloat(this.value);
            if(this.value == "9.99" || this.value == "0.00")
                $('#slide').animate({height: 'show'}, 200,);
            else
                $('#slide').animate({height: 'hide'}, 200,);
        });

        $('#slide').animate({
            height: 'hide'
        }, 0, function() {
        });

        document.getElementById("blikContainer").style.borderWidth = "2px";
        function blikPaymentMethodSelected() {
            document.getElementById("blikContainer").style.borderWidth = "2px";
            document.getElementById("googlepayContainer").style.borderWidth = "1px";
            document.getElementById("paymentTypePostId").value = "blik";
        }

        function GooglepayPaymentMethodSelected() {
            document.getElementById("blikContainer").style.borderWidth = "1px";
            document.getElementById("googlepayContainer").style.borderWidth = "2px";
            document.getElementById("paymentTypePostId").value = "googlepay";
        }

        function isEmpty(str) {
            return !str.trim().length;
        }

        function checkOrderValid() {
            let name = document.getElementById("orderNameId");
            let surname = document.getElementById("orderSurmaneId");
            let telephoneNumber = document.getElementById("orderTelephoneNumberId");
            let streetAdress = document.getElementById("orderStreetAdressId");
            let postCode = document.getElementById("orderPostCodeId");
            let city = document.getElementById("orderCityId");
            let isValid = true;

            if(isEmpty(name.value)) { name.style.borderColor = "red"; isValid = false}
            else name.style.borderColor = "black";
            if(isEmpty(surname.value)) { surname.style.borderColor = "red"; isValid = false}
            else surname.style.borderColor = "black";
            if(isEmpty(telephoneNumber.value)) { telephoneNumber.style.borderColor = "red"; isValid = false}
            else telephoneNumber.style.borderColor = "black";
            if(isEmpty(streetAdress.value)) { streetAdress.style.borderColor = "red"; isValid = false}
            else streetAdress.style.borderColor = "black";
            if(isEmpty(postCode.value)) { postCode.style.borderColor = "red"; isValid = false}
            else postCode.style.borderColor = "black";
            if(isEmpty(city.value)) { city.style.borderColor = "red"; isValid = false}
            else city.style.borderColor = "black";
            if(telephoneNumber.value.length!=9) { telephoneNumber.style.borderColor = "red"; isValid = false}
            else telephoneNumber.style.borderColor = "black";
            if(postCode.value.length!=6) { postCode.style.borderColor = "red"; isValid = false}
            else postCode.style.borderColor = "black";
            if(document.getElementById("paczkomatRadio").checked) {
                let paczkomatCode = document.getElementById("orderPaczkomatCode");
                if(isEmpty(paczkomatCode.value)) { paczkomatCode.style.borderColor = "red"; isValid = false}
            else paczkomatCode.style.borderColor = "black";
            }

            if(isValid == true) {
                document.getElementById("orderFormid").submit();
            }
        }

    </script>
</body>
</html>