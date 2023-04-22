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
    <title>Gstore - dziękujemy za zakupy!</title>
    <link rel="stylesheet" href="../MainPageSTYLES.css">
    <style>
        .orderFinishedMainContainer {
            position: relative;
            margin: auto;
            margin-top: 125px;
            width: 1280px;
            background-color: white;
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.2);
            padding-bottom: 25px;
        }

        .imgAndMainlabelContainer {
            display: flex;
            flex-direction: row;
        }

        .imgAndMainlabelContainer img {
            padding-left: 20px;
            width: 300px;
        }

        .boldlabel {
            font-weight: 600;
            font-size: 22px;
            padding-top: 25px;
        }

        .labelText {
            position: relative;
            margin-top: -230px;
            margin-left: 320px;
            display: inline-block;
        }

        .continueshoppingLabel {
            position: relative;
            margin-top: 25px;
            display: block;
            text-align: center;
            color: #00a790;
            cursor: pointer;
        }

        @media screen and (max-width: 1279px) {
            .orderFinishedMainContainer {
                width: 98%;
            }
        }

        @media screen and (max-width: 495px) {
            .imgAndMainlabelContainer img {
                width: 200px;
                padding-left: 5px;
            }

            .labelText {
                margin-top: -130px;
                margin-left: 205px;
                font-size: 14px;
            }
        }

        @media screen and (max-width: 389px) {
            .imgAndMainlabelContainer img {
                position: absolute;
                visibility: hidden;
            }

            .boldlabel {
                margin-left: 10px;
            }

            .labelText {
                margin-top: 20px;
                margin-left: 10px;
                font-size: 14px;
            }
        }

    </style>
</head>
<body>
    <div class="headerDiv" style="top: 0;">
        <img src="../../images/gstore.png" class="headerDivLogo" onclick='window.location="../index.php";'>
        <input type="text" id="searchBarId" placeholder="czego szukasz?" class="headerDivSearch" value="">
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




    <div class="orderFinishedMainContainer">
        <div class="imgAndMainlabelContainer">
            <img src="../../images/orderFinishedImage.png">
            <label class="boldlabel">Drogi Kliencie,</label><br>
        </div>
        <label class="labelText">Chcielibyśmy potwierdzić, że Twoje zamówienie zostało przyjęte i aktualnie jest przetwarzane przez nasz zespół. Będziemy pracować, aby Twoje produkty zostały przygotowane do wysyłki jak najszybciej.
            <br><br><br>Jeśli masz jakiekolwiek pytania lub uwagi dotyczące Twojego zamówienia, prosimy o kontakt z naszym zespołem obsługi klienta. Z przyjemnością odpowiemy na Twoje pytania i udzielimy wszelkiej potrzebnej pomocy.
            <br><br><br>Raz jeszcze dziękujemy za Twoje zaufanie i za wybór naszej firmy. Mamy nadzieję, że będziesz zadowolony z Twoich produktów i z naszej obsługi. Pozdrawiamy, Zespół Obsługi Klienta.
        </label>
        <label class="continueshoppingLabel" onclick='window.location="../index.php";'>KONTYNUUJ ZAKUPY</label>
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
</body>
    <script src="../MainPageSCRIPT.js"></script>
</html>