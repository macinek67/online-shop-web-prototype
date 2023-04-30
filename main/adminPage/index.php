<?php
    session_start();
    if($_SESSION['loggedIn'] != true || $_SESSION["user"]['isAdmin'] != 1) header("Location: ../index.php");
    require_once('../php/classes.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gstore - panel administratora</title>
    <link rel="stylesheet" href="../MainPageSTYLES.css">
    <link rel="stylesheet" href="adminPageStyles.css">
</head>
<body>
    <div class="headerDiv" style="top: 0;">
        <img src="../../images/gstore.png" class="headerDivLogo" onclick='window.location="../index.php";'>
        <input type="button" id="accountIconID" class="headerDivIcons" onclick="AccountMenuOpen()">
    </div>


    <div class="adminPageMainContainer">
        <label class="mainlabelBold">Panel administratora Gstore</label>
        <div class="addnewProductDiv" onclick='window.location="addNewProductPage.php";'>
            <label>DODAJ PRODUKT</label>
        </div>
        <div class="addnewCategoryDiv" onclick='window.location="addNewCategoryPage.php";'>
            <label>DODAJ KATEGORIE</label>
        </div>
        <label class="editCategoryLabel">Edytuj kategorie</label>
        <?php
            $searchedCategoryText = "";
            if(isset($_POST['searchedCategoryText'])) $searchedCategoryText = $_POST['searchedCategoryText'];
            $searchedProductText = "";
            if(isset($_POST['searchedProductText'])) $searchedProductText = $_POST['searchedProductText'];
        ?>
        <form class="searchProductDiv" action="index.php" method="POST" id="searchCategoryFormId">
            <input type="text" placeholder="szukaj" name="searchedCategoryText" value='<?php echo $searchedCategoryText ?>' class="searchProductFilter">
            <input type="button" value="" onclick="searchCategory()" class="searchConfirm">
        </form>
        <div class="searchedCategoriesDiv">
            <?php
                $result = $connect->query("SELECT * FROM category WHERE name LIKE('%$searchedCategoryText%')");
                while($row = mysqli_fetch_assoc($result)) {
                    $category = new searchedCategory($row['category_id']);
                    $category->createView();
                }
            ?>
        </div>
        <label class="editCategoryLabel">Edytuj produkt</label>
        <form class="searchProductDiv" action="index.php" method="POST" id="searchProductFormId">
            <input type="text" placeholder="szukaj" name="searchedProductText" value='<?php echo $searchedProductText ?>' class="searchProductFilter">
            <input type="button" value="" onclick="searchProduct()" class="searchConfirm">
        </form>
        <div class="searchedCategoriesDiv">
            <?php
                $result = $connect->query("SELECT * FROM product WHERE product_title LIKE('%$searchedProductText%')");
                while($row = mysqli_fetch_assoc($result)) {
                    $prdct = new Product($row['product_id'], $row['product_title'], $row['product_price'], $row['product_img']);
                    $searchedProduct = new AdminPageProduct($prdct);
                    $searchedProduct->createProduct();
                }
            ?>
        </div>
    </div>

    <form action="../php/searchedCategory/deleteCategory.php" method="POST" style="position: absolute; visibility: hidden;" id="categoryDeleteFormId">
        <input type="hidden" name="categoryIdToDelete" value="" id="categoryToDeleteButtonId">
    </form>

    <form action="addNewCategoryPage.php" method="POST" style="position: absolute; visibility: hidden;" id="categoryEditFormId">
        <input type="hidden" name="category" value="" id="categoryToEditButtonId">
    </form>

    <form action="../php/adminPageSearchedProduct/deleteProduct.php" method="POST" style="position: absolute; visibility: hidden;" id="productDeleteFormId">
        <input type="hidden" name="productIdToDelete" value="" id="productToDeleteButtonId">
    </form>

    <form action="../php/adminPageSearchedProduct/restoreProduct.php" method="POST" style="position: absolute; visibility: hidden;" id="productRestoreFormId">
        <input type="hidden" name="productIdToRestore" value="" id="productRestoreButtonId">
    </form>

    <form action="addNewProductPage.php" method="POST" style="position: absolute; visibility: hidden;" id="productEditFormId">
        <input type="hidden" name="productId" value="" id="productEditButtonId">
    </form>

    <?php
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
    ?>
    
</body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="../MainPageSCRIPT.js"></script>
    <script>
        function searchCategory() {
            document.getElementById("searchCategoryFormId").submit();
        }

        function deleteCategoryRequest(id) {
            alert("e");
            document.getElementById("categoryToDeleteButtonId").value = id;
            document.getElementById("categoryDeleteFormId").submit();
        }

        function editCategoryRequest(id) {
            document.getElementById("categoryToEditButtonId").value = id;
            document.getElementById("categoryEditFormId").submit();
        }

        function searchProduct() {
            document.getElementById("searchProductFormId").submit();
        }

        function goToProductPage(productId) {
            document.getElementById("goToProductId").value = productId;
            document.getElementById("goToProductPageForm").submit();
        }

        function deleteCategoryRequest(id) {
            document.getElementById("productToDeleteButtonId").value = id;
            document.getElementById("productDeleteFormId").submit();
        }

        function restoreCategoryRequest(id) {
            document.getElementById("productRestoreButtonId").value = id;
            document.getElementById("productRestoreFormId").submit();
        }

        function editProductRequest(id) {
            document.getElementById("productEditButtonId").value = id;
            document.getElementById("productEditFormId").submit();
        }

    </script>
</html>