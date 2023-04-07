<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="accountPageStyles.css">
    <link rel="stylesheet" href="../MainPageSTYLES.css">
</head>
<?php
    require_once('../php/classes.php');
    session_start();
?>
<body>
    <div class="headerDiv">
        <image src="../../images/gstore.png" class="headerDivLogo" id="ReturnToMainPage">
        <input type="text" placeholder="czego szukasz?" class="headerDivSearch">
        <select class="headerDivCategorySelect">
            <option>Wszystkie kategorie</option>
            <optgroup label="Kategorie">
                <option value="parrot">Elektronika</option>
                <option value="macaw">Moda</option>
                <option value="albatross">Motoryzacja</option>
            </optgroup>
        </select>
        <input type="button" class="headerDivSearchButton" value="SZUKAJ">
        <input type="button" id="coinIconID" class="headerDivIcons">
        <input type="button" id="starIconID" class="headerDivIcons">
        <input type="button" id="chatIconID" class="headerDivIcons">
        <input type="button" id="bellIconID" class="headerDivIcons">
        <input type="button" id="cartIconID" class="headerDivIcons" onclick="AccountPageGoToCartFunction()">
        <input type="button" id="accountIconID" class="headerDivIcons" onclick="AccountMenuOpen()">
    </div>



    <div class="accountSettingsContainer">

        <div class="userInfoMainDiv">
            <div>
                <?php
                    echo "<label class='mainTitleInUserInfoDiv'>"; 
                        echo "Cześć " . $_SESSION["user"]['name'] . "!"; 
                    echo "</label>";
                    echo "<p class='emailInUserInfoDiv'>"; 
                        echo $_SESSION["user"]['email']; 
                    echo "</p>";
                    echo "<label class='monetyTextInUserInfoDiv'>"; 
                        echo "Masz " . $_SESSION["user"]['monety'] . " Monet"; 
                    echo "</label>";
                    if($_SESSION['user']['isAdmin'] != 1) $permissions = "Użytkownik";
                    else $permissions = "Administrator";
                    echo "<label class='permissionsTextInUserInfoDiv'>"; 
                        echo $permissions; 
                    echo "</label>";
                ?>
            </div>
            <div class='separationDiv'></div>
            <div style="margin: auto; text-align: center">
                <?php
                    $date1 = new DateTime($_SESSION['user']['createDate']);
                    $date2 = new DateTime(date("Y-m-d"));
                    $interval = $date1->diff($date2);
                    $interval->d += 1;
                    echo "<label class='accountOldTimerText'>Jesteś z nami:</label><br>";
                    echo "<label class='accountOldTimer'>$interval->y rok, $interval->m miesięcy, $interval->d dni</label>";
                ?>
            </div>
        </div>



        <div class="mainUserSettingsDiv">
            <div class="">

            </div>


            <div>

            </div>
        </div>


    </div>


    <div class="loggedUserMenu" id="logg">
        <div class="loggedUserMenuArrow"></div>
        <form action="index.php" method="POST">
            <input type="submit" name="logOut" value="KONTO">
        </form>
        <form action="../php/logOutUser.php" method="POST">
            <input type="submit" name="logOut" value="WYLOGUJ">
        </form>
    </div>
</body>
<script src="../MainPageSCRIPT.js"></script>
<script>
    let ReturnToMainPage = document.getElementById("ReturnToMainPage");
    ReturnToMainPage.addEventListener('click', ReturnToMainPageFunction);

    function ReturnToMainPageFunction() {
        window.location="../index.php";
    }

    function AccountPageGoToCartFunction() {
        window.location="../cart/index.php";
    }

</script>
</html>