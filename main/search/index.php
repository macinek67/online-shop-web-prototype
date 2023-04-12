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
        <input type="text" id="searchBarId" placeholder="czego szukasz?" class="headerDivSearch" value="<?php echo $_POST['searchBarContext'] ?>">
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
        <?php
            $title = strtolower($_POST['searchBarContext']);
            $category = $_POST['searchBarSelectedCategory'];
            if($category != "Wszystkie kategorie") 
                $result = $connect->query("SELECT * FROM product JOIN category USING(category_id) WHERE LOWER(product_title) LIKE('%$title%') AND category.name='$category' ORDER BY product_id ASC");
            else 
                $result = $connect->query("SELECT * FROM product JOIN category USING(category_id) WHERE LOWER(product_title) LIKE('%$title%') ORDER BY product_id ASC");
            while($row = mysqli_fetch_assoc($result)) {
                $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price'], $row['product_img']);
                $searchedProduct = new SearchedItem($prdct);
                $searchedProduct->createProduct();
            }
            // $array = array('kot' => "e", 'pies' => "litte", 'swinia' => "array", 2);
            // $serialized_array = serialize($array); 
            // print_r($serialized_array);
            // echo "          " . $serialized_array[1];
            // $serialized_array = unserialize($serialized_array); 
            // print_r($serialized_array);
        ?>
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


    <script src="../MainPageSCRIPT.js"></script>
</body>
</html>