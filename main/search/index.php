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
    <link rel="stylesheet" href="searchPageStyles.css">
    <link rel="stylesheet" href="../MainPageSTYLES.css">
</head>
<body>
    <div class="headerDiv" style="top: 0;">
        <img src="../../images/gstore.png" class="headerDivLogo" onclick='window.location="../index.php";'>
        <input type="text" id="searchBarId" placeholder="czego szukasz?" class="headerDivSearch" value="<?php echo $_POST['searchBarContext'] ?>" style="height: 37px;">
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


    <div class="searcheditemsMainContainer">
        <label class="whatSearchingTitle">szukasz „<?php echo $_POST['searchBarContext'] ?>”</label>
        <form action="" method="POST" class="searchFiltersForm" id="searchFiltersFormId">
            <?php
                if(isset($_POST['searchingSelectedFilter'])) $sortBy = $_POST['searchingSelectedFilter'];
                else $sortBy = "popularność: największa"
            ?>
            <label class="FiltersFormOfertsTitle">Oferty</label>
            <select name="searchingSelectedFilter" class="searchFormFilters" onchange="document.getElementById('searchFiltersFormId').submit()">
                <option <?=$sortBy == 'popularność: największa' ? ' selected="selected"' : '';?>>popularność: największa</option>
                <option <?=$sortBy == 'cena: od najniższej' ? ' selected="selected"' : '';?>>cena: od najniższej</option>
                <option <?=$sortBy == 'cena: od najwyższej' ? ' selected="selected"' : '';?>>cena: od najwyższej</option>
            </select>
            <div class="FiltersFormCurrentPageSelectTopDiv">
                <?php
                    if(isset($_POST['searchingCurrentPage'])) $currentPage = $_POST['searchingCurrentPage'];
                    else $currentPage = 1;
                    $productsPerPage = 25;
                    $title = strtolower($_POST['searchBarContext']);
                    $category = $_POST['searchBarSelectedCategory'];
                    if($category != "Wszystkie kategorie")
                        $result = $connect->query("SELECT * FROM product JOIN category USING(category_id) WHERE LOWER(product_title) LIKE('%$title%') AND category.name='$category' ORDER BY product_boughtCount DESC");
                    else
                        $result = $connect->query("SELECT * FROM product JOIN category USING(category_id) WHERE LOWER(product_title) LIKE('%$title%') ORDER BY product_boughtCount DESC");
                    $searchedProductsCount = 0;
                    while($row = mysqli_fetch_assoc($result)) {
                        $searchedProductsCount++;
                    }
                    $howManyPages = ceil($searchedProductsCount/$productsPerPage);
                    if($currentPage<=0) $currentPage = 1;
                    if($currentPage>$howManyPages) $currentPage = $howManyPages;
                ?>
                <input type="number" name="searchingCurrentPage" id="formChangePageNumerId" onchange="document.getElementById('searchFiltersFormId').submit()" class="searchFiltersFormCurrentPage" value="<?php echo $currentPage ?>">
                <input type="hidden" name="searchBarContext" value="<?php echo $title ?>">
                <input type="hidden" name="searchBarSelectedCategory" value="<?php echo $category ?>">
                <label>z</label>
                <label><?php echo $howManyPages ?></label>
            </div>
        </form>
        <?php
            if($category != "Wszystkie kategorie") {
                if($sortBy == "popularność: największa")
                    $result = $connect->query("SELECT * FROM product JOIN category USING(category_id) WHERE LOWER(product_title) LIKE('%$title%') AND category.name='$category' ORDER BY product_boughtCount DESC");
                else if($sortBy == "cena: od najniższej")
                    $result = $connect->query("SELECT * FROM product JOIN category USING(category_id) WHERE LOWER(product_title) LIKE('%$title%') AND category.name='$category' ORDER BY cast(product_price as DECIMAL(10,2)) ASC");
                else if($sortBy = "cena: od najwyższej")
                    $result = $connect->query("SELECT * FROM product JOIN category USING(category_id) WHERE LOWER(product_title) LIKE('%$title%') AND category.name='$category' ORDER BY cast(product_price as DECIMAL(10,2)) DESC");
            }
            else {
                if($sortBy == "popularność: największa")
                    $result = $connect->query("SELECT * FROM product JOIN category USING(category_id) WHERE LOWER(product_title) LIKE('%$title%') ORDER BY product_boughtCount DESC");
                else if($sortBy == "cena: od najniższej")
                    $result = $connect->query("SELECT * FROM product JOIN category USING(category_id) WHERE LOWER(product_title) LIKE('%$title%') ORDER BY cast(product_price as DECIMAL(10,2)) ASC");
                else if($sortBy = "cena: od najwyższej")
                    $result = $connect->query("SELECT * FROM product JOIN category USING(category_id) WHERE LOWER(product_title) LIKE('%$title%') ORDER BY cast(product_price as DECIMAL(10,2)) DESC");
            }
            $countProducts = 0;
            while($row = mysqli_fetch_assoc($result)) {
                if($countProducts >= $productsPerPage*($currentPage-1) && $countProducts < $productsPerPage*$currentPage) {
                    $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price'], $row['product_img']);
                    $searchedProduct = new SearchedItem($prdct);
                    $searchedProduct->createProduct();
                }
                $countProducts++;
            }
        ?>
        <div class="bottomChangePageDiv">
            <?php
                if($currentPage<4) {
                    for($i=1; $i<=5; $i++) {
                        if($i<=$howManyPages)
                            echo "<input class='bottomChangePageDivSubmitButton' type='submit' value='$i' onclick='submitChangePageForm($i)'>";
                    }
                } else {
                    echo "<input class='bottomChangePageDivSubmitButton' type='submit' value='1' onclick='submitChangePageForm(1)'>";
                    echo "<label> ... </label>";
                    for($i=$currentPage-2; $i<=$howManyPages; $i++) {
                        if($i<=$currentPage+2)
                            echo "<input class='bottomChangePageDivSubmitButton' type='submit' value='$i' onclick='submitChangePageForm($i)'>";
                    }
                }
                echo "<label> z $howManyPages</label>";
            ?>
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

    <form action="index.php" id="searchBarFormId" method="POST">
        <input type="hidden" id="searchBarContextId" name="searchBarContext" value="">
        <input type="hidden" id="searchBarSelectedCategoryId" name="searchBarSelectedCategory" value="Wszystkie kategorie">
    </form>


    <script src="../MainPageSCRIPT.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        function submitChangePageForm(id) {
            document.getElementById("formChangePageNumerId").value = id;
            document.getElementById('searchFiltersFormId').submit();
        }

        function goToProductPage(productId) {
            document.getElementById("goToProductId").value = productId;
            document.getElementById("goToProductPageForm").submit();
        }
    </script>
</body>
</html>