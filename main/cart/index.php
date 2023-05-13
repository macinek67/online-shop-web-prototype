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
    <title>Zawartość koszyka</title>
    <link rel="stylesheet" href="../MainPageSTYLES.css">
    <link rel="stylesheet" href="cartPageStyles.css">
</head>
<body>
    <div class="headerDiv">
        <image src="../../images/gstore.png" class="headerDivLogo" id="ReturnToMainPage">
        <input type="text" id="searchBarId" placeholder="czego szukasz?" class="headerDivSearch" style="height: 37px;">
        <select class="headerDivCategorySelect" id="headerDivCategorySelectId">
            <option>Wszystkie kategorie</option>
            <optgroup label="Kategorie">
                <?php showCategories(); ?>
            </optgroup>
        </select>
        <input type="button" id="SearchButtonSubmit" class="headerDivSearchButton" value="SZUKAJ">
        <input type="button" id="starIconID" class="headerDivIcons" onclick="CartPageGoToFavoritesFunction()">
        <input type="button" id="cartIconID" class="headerDivIcons" onclick="AccountPageGoToCartFunction()">
        <input type="button" id="accountIconID" class="headerDivIcons" onclick="AccountMenuOpen()">
    </div>

    <?php
        if(isset($_SESSION['loggedIn'])){
            if($_SESSION['loggedIn'] == true) {
                echo <<< html
                    <div class="cartMainContainer">
                        <div class="cartItemsContainer">
                html;
                        $userID = $_SESSION["user"]['user_id'];
                        $result = $connect->query("SELECT * FROM product JOIN cartproduct USING(product_id) WHERE cartproduct.user_id=$userID ORDER BY id ASC");
                        $cartProcutsArray = [];
                        $productsCount = 0;
                        while($row = mysqli_fetch_assoc($result)) {
                            $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price'], $row['product_img']);
                            $CartPrdct = new CartItem($row['product_id'], $prdct);
                            $CartPrdct->createProduct();
                            $cartProcutsArray[$productsCount++] = ['product_id' => $row['product_id'], 'product_quantity' => $row['product_quantity']];
                        }
                        $serializedcartProcutsArray = serialize($cartProcutsArray);
                        echo <<< html
                        </div>
                        <div class="sideCartPanel">
                            <label class="cartItemsSumPriceText">Wartość produktów</label>
                            <label class="cartItemsSumPrice">
                        html;
                        $cartSumPrice = 0;
                        $result = $connect->query("SELECT * FROM product JOIN cartproduct USING(product_id) WHERE cartproduct.user_id=$userID ORDER BY id ASC");
                        while($row = mysqli_fetch_assoc($result)) {
                            $cartSumPrice += $row['product_price']*$row['product_quantity']; 
                        }
                        echo <<< html
                            $cartSumPrice zł
                            </label>
                            <label class="cartShipCostText">Dostawa od</label>
                            <label class="cartShipCost">
                        html;
                        if($cartSumPrice > 399) $shipCost = "0.00";
                        else $shipCost = "9.99";
                        echo <<< html
                            $shipCost zł
                            </label>
                            <hr>
                            <label class="cartFinalPriceText">Razem z dostawą</label>
                            <label class="cartFinalPrice">
                        html;
                        $finalPrice = $cartSumPrice + $shipCost;
                        echo <<< html
                            $finalPrice zł
                            </label>
                            <form action="shipAndPaymentPage.php" method="POST">
                                <input type="submit" name="cartShipAndPaymentSubmit" value="DOSTAWA I PŁATNOŚĆ" class="cartShipAndPaymentButton">
                                <input type="hidden" name="sumPriceProducts" value='$cartSumPrice'>
                                <input type="hidden" name="cartProducts" value='$serializedcartProcutsArray'>
                            </form>
                            <label class="continueShopping" id="continueShoppingID">KONTYNUUJ ZAKUPY</label>
                        </div>
                    </div>
                    <div class="bottomCartPanel">
                        <label class="cartFinalPriceText">Razem z dostawą</label>
                        <label class="cartFinalPrice">
                    html;
                    echo $finalPrice;
                    echo <<< html
                        zł</label>
                        <form action="shipAndPaymentPage.php" method="POST">
                            <input type="submit" name="cartShipAndPaymentSubmit" value="DOSTAWA I PŁATNOŚĆ" class="cartShipAndPaymentButton">
                            <input type="hidden" name="sumPriceProducts" value='$cartSumPrice'>
                            <input type="hidden" name="cartProducts" value='$serializedcartProcutsArray'>
                            <input type="button" value="KONTYNUUJ ZAKUPY" class="continueShopping" onclick="ReturnToMainPageFunction()">
                        </form>
                    </div>
                html;
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
    
</body>
<script src="../MainPageSCRIPT.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    let ReturnToMainPage = document.getElementById("ReturnToMainPage");
    ReturnToMainPage.addEventListener('click', ReturnToMainPageFunction);

    let continueShopping = document.getElementById("continueShoppingID");
    continueShopping.addEventListener('click', ReturnToMainPageFunction);

    function ReturnToMainPageFunction() {
        window.location="../index.php";
    }

    function changeQuantity() {
        let eventTarget = event.target;
        $.ajax({
            type: "POST",
            url: '../php/cartProduct/changeQuantityProduct.php',
            data:{action:'changeQuantity', quantity:event.target.value, productId:((eventTarget.parentElement.children[0]).id).value},
            success:function() {
                window.location.reload();
            }
        });
    }

    function CartPageGoToFavoritesFunction() {
        window.location="../favorites/index.php";
    }

    function goToProductPage(productId) {
            document.getElementById("goToProductId").value = productId;
            document.getElementById("goToProductPageForm").submit();
    }

</script>
</html>