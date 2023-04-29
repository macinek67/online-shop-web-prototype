<script>
    var productImageUrls = [];

    // function adjustAllImageWidth(imgArray) {
    //     if ($(window).width() <= 780)window.location.reload();
    // }

    function adjustImageWidth(imgUrl) {
        productImageUrls.push(imgUrl);
        let imagesGalleryWidth = document.getElementById("photosGalleryId").offsetWidth;
        let imagesGalleryHeight = document.getElementById("photosGalleryId").offsetHeight;
        let img = document.getElementById(imgUrl);
        if(img.width==0) window.location.reload();
        if(img.width<imagesGalleryWidth) {
            img.style.marginLeft = (((imagesGalleryWidth-img.width)/2)/imagesGalleryWidth)*100 + "%";
            img.style.marginRight = (((imagesGalleryWidth-img.width)/2)/imagesGalleryWidth)*100 + "%";
        }
        if(img.width>imagesGalleryWidth) {
            let j = 100-(imagesGalleryWidth/img.naturalWidth*100);
            img.style.marginTop = j/8 + "%";
            img.style.width = imagesGalleryWidth;
        }
    }

    //addEventListener('resize', (event) => { adjustAllImageWidth(productImageUrls); });
</script>
<?php
    session_start();
    require_once('../php/classes.php');
    $productId = $_POST['id'];
    $result = $connect->query("SELECT * FROM product WHERE product_id='$productId' LIMIT 1");
    if($row = mysqli_fetch_assoc($result)) {
        $currentProduct = $row;
    }
    //$arr = serialize(['Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg', 'Smartfon-SAMSUNG-Galaxy-S22-Czarny-2.jpg', 'Smartfon-SAMSUNG-Galaxy-S22-Czarny-3.jpg']);
    //$result = $connect->query("UPDATE product SET product_img='$arr' WHERE product_id='$productId' LIMIT 1");
    $userId = $_SESSION["user"]['user_id'];
    $result = $connect->query("SELECT * FROM lastwatchedproducts WHERE user_id='$userId' AND product_id='$productId'");
    if(($row = mysqli_fetch_assoc($result))) $result = $connect->query("DELETE FROM lastwatchedproducts WHERE user_id='$userId' AND product_id='$productId'");
    $result = $connect->query("INSERT INTO lastwatchedproducts(user_id, product_id) VALUES('$userId', '$productId')");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gstore - <?php echo $currentProduct['product_title']; ?></title>
    <link rel="stylesheet" href="productPageStyles.css">
    <link rel="stylesheet" href="../MainPageSTYLES.css">
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



    <div class="productMainContainer">
        <div class="arrowsContainer">
            <input type="button" class="galleryArrowLeft" value="🡠" id="leftArrowId" onclick="photoGalleryScrollLeft()">
            <?php
                $productImages = unserialize($currentProduct['product_img']);
                if(count($productImages)==1) echo "<input type='button' class='galleryArrowRight' value='🡢' id='rightArrowId' onclick='photoGalleryScrollRight()' style='visibility: hidden;'>";
                else echo "<input type='button' class='galleryArrowRight' value='🡢' id='rightArrowId' onclick='photoGalleryScrollRight()'>";
            ?>
        </div>
        <div class="photosGallery" id="photosGalleryId">
            <?php
                $i = 0;
                foreach ($productImages as &$productImage) {
                    echo "<img src='../../uploadedProductImages/$productImage' id='productPhoto$i'>";
                    echo "<script>adjustImageWidth('productPhoto$i');</script>";
                    $i++;
                }
            ?>
        </div>
        <div class="rightGalleryProductInfo">
            <label class="titlelabel"><?php echo $currentProduct['product_title']; ?></label>
            <?php
                if($currentProduct['product_price']<$currentProduct['product_regularPrice']) {
                    $discount = "-" . intval(100-round(($currentProduct['product_price']/$currentProduct['product_regularPrice'])*100)) . "%";
                    echo "<label class='productDiscountPriceLabel'>$currentProduct[product_price] zł</label>
                    <label> w tym VAT</label><br>
                    <label class='regularPriceLabel'>Cena początkowa: </label>
                    <label class='regularPriceValueLabel'>$currentProduct[product_regularPrice] zł</label>
                    <label class='discountPercentLabel'> $discount</label><br>";
                } else {
                    echo "<label class='productRegularPriceLabel'>$currentProduct[product_price] zł</label>
                    <label> w tym VAT</label><br>";
                }
                echo "<label class='inMaganizeTextLabel'>W magazynie: </label>";
                if($currentProduct['product_magazinePieces']==0) echo "<label class='outofStockLabel'> $currentProduct[product_magazinePieces]</label>";
                else echo "<label class='howManyProductsLabel'> $currentProduct[product_magazinePieces]</label>";
                echo "<label> sztuk</label><br>
                <label class='howManySoldLabel'>● sprzedano: $currentProduct[product_boughtCount] sztuk</label><br>
                <div class='buttonsContainer'>
                    <div class='favoriteButtonContainer'><input type='button' class='addToFavoritesButton' onclick='addToFavorites()'></div>";
                    if($currentProduct['product_magazinePieces']>0) echo "<input type='button' class='addToCartButton' value='Dodaj do koszyka' onclick='addToCart()'>";
                    else echo "<input type='button' class='addToCartOutOfStockButton' value='BRAK TOWARU' onclick='addToCart()' disabled='true'>";
                    echo "
                </div>";
            ?>
        </div>
    </div>

    <div class="productProperiesContainer">
        <label class="properiesBoldLabel">Szczegóły</label>
        <?php
            $result = $connect->query("SELECT * FROM category WHERE category_id='$currentProduct[category_id]' LIMIT 1");
            if($row = mysqli_fetch_assoc($result)) {
                $currentProductCategory = $row['name'];
            }
            // $prop = serialize([0 => ["Kategoria", $currentProductCategory],
            //     1 => ["Producent", "SAMSUNG"],
            //     2 => ["Kolor", "czarny"],
            //     3 => ["Pamięć RAM", "8GB"],
            //     4 => ["Pamięć", "128GB"],
            //     5 => ["Kod produktu", "SM-S901"]
            // ]);
            //$result = $connect->query("UPDATE product SET product_properties='$prop' WHERE product_id='$productId' LIMIT 1");
            $productProperties = unserialize($currentProduct['product_properties']);
            $i = 0;
            foreach ($productProperties as &$productProperty) {
                if($i++%2==0) echo "<div class='propertyContainer'>";
                else echo "<div class='propertyContainerOdd'>";
                    echo "<label class='propertyNameLabel'>$productProperty[0]:</label> 
                    <label class='propertyValueLabel'>$productProperty[1]</label>
                </div>";
            }
        ?>
    </div>

    <div class="productDescriptionContainer">
        <label class="descriptionBoldLabel">Opis</label><br>
        <div class="descriptionValueLabel"><?php echo $currentProduct['product_description'] ?></div>
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

</body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="../MainPageSCRIPT.js"></script>
    <script>

        let photoGallery = document.getElementById("photosGalleryId");

        function photoGalleryScrollLeft() {
            let imagesGalleryWidth = document.getElementById("photosGalleryId").offsetWidth;
            document.getElementById("rightArrowId").style.visibility = "visible";
            if(photoGallery.scrollLeft <= imagesGalleryWidth) event.target.style.visibility = "hidden";
            photoGallery.scrollLeft -= imagesGalleryWidth;
        }

        function photoGalleryScrollRight() {
            let imagesGalleryWidth = document.getElementById("photosGalleryId").offsetWidth;
            document.getElementById("leftArrowId").style.visibility = "visible";
            if((photoGallery.scrollLeft+imagesGalleryWidth*2)+20 >= photoGallery.scrollWidth) event.target.style.visibility = "hidden";
            photoGallery.scrollLeft += imagesGalleryWidth;
        }

        function addToFavorites() {
            const productId = "<?php echo $productId; ?>";
            $.ajax({
                type: "POST",
                url: 'addToFavorites.php',
                data:{action:'addFavoriteItem', product: productId},
            });
        }

        function addToCart() {
            const productId = "<?php echo $productId; ?>";
            $.ajax({
                type: "POST",
                url: 'addToCart.php',
                data:{action:'addToCartItem', product: productId, },
            });
        }
    </script>
</html>