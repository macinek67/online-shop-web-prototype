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
                <label class='howManySoldLabel'>● sprzedano: $currentProduct[product_boughtCount] sztuki</label><br>
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