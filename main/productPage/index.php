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
    <title>Document</title>
    <link rel="stylesheet" href="productPageStyles.css">
    <link rel="stylesheet" href="../MainPageSTYLES.css">
</head>
<body>
    <div class="headerDiv" style="top: 0;">
        <img src="../../images/gstore.png" class="headerDivLogo" onclick='window.location="../index.php";'>
        <input type="text" id="searchBarId" placeholder="czego szukasz?" class="headerDivSearch">
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



    <div class="productMainContainer">
        <div class="arrowsContainer">
            <input type="button" class="galleryArrowLeft" value="🡠" id="leftArrowId" onclick="photoGalleryScrollLeft()">
            <input type="button" class="galleryArrowRight" value="🡢" id="rightArrowId" onclick="photoGalleryScrollRight()">
        </div>
        <div class="photosGallery" id="photosGalleryId">
            <img src="https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/35/3508342/Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg" class="galleryImg">
            <img src="https://duka.com/media/catalog/product/cache/88c2480cc32e03bb6d6f41df6024675d/1/2/1214343_16755108672_1.jpg" class="galleryImg">
            <img src="https://cdn.x-kom.pl/i/setup/images/prod/big/product-new-big,,2022/10/pr_2022_10_20_6_19_50_837_00.jpg" class="galleryImg">
        </div>
        <div class="rightGalleryProductInfo">
            <label class="titlelabel">Procesor AMD Ryzen 9 5900X, 3.7 GHz, 64 MB, BOX (100-100000061WOF)Procesor AMD Ryzen 9 5900X, 3.7 GHz, 64 MB, BOX (100-100000061WOF)Procesor AMD Ryzen 9 5900X, 3.7 GHz, 64 MB, BOX (100-100000061WOF)</label>
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
                        <form action="../account/index.php" method="POST">
                            <input type="submit" name="logOut" value="KONTO">
                        </form>
                        <form action="php/logOutUser.php" method="POST" style="margin-top: -30px;">
                            <input type="submit" name="logOut" value="WYLOGUJ">
                        </form>
                    </div>
                html;
            }
        }
    ?>

    <form action="index.php" id="searchBarFormId" method="POST">
        <input type="hidden" id="searchBarContextId" name="searchBarContext" value="">
        <input type="hidden" id="searchBarSelectedCategoryId" name="searchBarSelectedCategory" value="Wszystkie kategorie">
    </form>

</body>
    <script src="../MainPageSCRIPT.js"></script>
    <script>

        let photoGallery = document.getElementById("photosGalleryId");

        function photoGalleryScrollLeft() {
            document.getElementById("rightArrowId").style.visibility = "visible";
            if(photoGallery.scrollLeft <= 500) event.target.style.visibility = "hidden";
            photoGallery.scrollLeft -= 500;
        }

        function photoGalleryScrollRight() {
            document.getElementById("leftArrowId").style.visibility = "visible";
            if(photoGallery.scrollLeft+1000 == photoGallery.scrollWidth) event.target.style.visibility = "hidden";
            photoGallery.scrollLeft += 500;
        }

    </script>
</html>