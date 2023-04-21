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
    session_start();
    require_once('../php/classes.php');
?>
<body>
    <div class="headerDiv">
        <image src="../../images/gstore.png" class="headerDivLogo" id="ReturnToMainPage">
        <input type="text" id="searchBarId" placeholder="czego szukasz?" class="headerDivSearch">
        <select class="headerDivCategorySelect" id="headerDivCategorySelectId">
            <option>Wszystkie kategorie</option>
            <optgroup label="Kategorie">
                <?php showCategories(); ?>
            </optgroup>
        </select>
        <input type="button" id="SearchButtonSubmit" class="headerDivSearchButton" value="SZUKAJ">
        <input type="button" id="starIconID" class="headerDivIcons" onclick="AccountPageGoToFavoritesFunction()">
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
            <div class="userSettings">
                <label class="namePropertyToChange">Ustawienia użytkownika</label><br>
                <label>Twoja nazwa</label>
                <input type="button" id="slide_button" class="slide_button" value="ZMIEŃ">
                <div id="slide">
                    <?php $userName = $_SESSION["user"]['name']; ?>
                    <form action="../php/accountActions/changeUserName.php" method="POST">
                        <br><input type="text" id="currentNameButton" class="userSettingsButton" value='<?php echo $userName; ?>'><br>
                        <input type="submit" name="changeNameSubmited" value="ZAPISZ" class="saveFormButton">
                    </form>
                </div><br>
                <label class="namePropertyToChange">Twój email</label>
                <input type="button" id="slide_button1" class="slide_button" value="ZMIEŃ">
                <div id="slide1">
                    <?php $userName = $_SESSION["user"]['email']; ?>
                    <form action="../php/accountActions/changeUserName.php" method="POST">
                        <br><input type="text" id="currentNameButton" class="userSettingsButton" value='<?php echo $userName; ?>'><br>
                        <input type="password" id="currentNameButton" class="userSettingsButton" placeholder="potwierdź hasło" value=''><br>
                        <input type="submit" name="changeNameSubmited" value="ZAPISZ" class="saveFormButton">
                    </form>
                </div><br>
                <label class="namePropertyToChange">Twoje hasło</label>
                <input type="button" id="slide_button2" class="slide_button" value="ZMIEŃ">
                <div id="slide2">
                    <form action="../php/accountActions/changeUserName.php" method="POST">
                        <br><input type="text" id="currentNameButton" class="userSettingsButton" value='' placeholder="stare hasło"><br>
                        <input type="password" id="currentNameButton" class="userSettingsButton" placeholder="nowe hasło" value=''><br>
                        <input type="password" id="currentNameButton" class="userSettingsButton" placeholder="potwierdź hasło" value=''><br>
                        <input type="submit" name="changeNameSubmited" value="ZAPISZ" class="saveFormButton">
                    </form>
                </div>
            </div>


            <div class="nie">
                e
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

    <form action="../search/index.php" id="searchBarFormId" method="POST">
        <input type="hidden" id="searchBarContextId" name="searchBarContext" value="">
        <input type="hidden" id="searchBarSelectedCategoryId" name="searchBarSelectedCategory" value="Wszystkie kategorie">
    </form>

</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
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

    function AccountPageGoToFavoritesFunction() {
        window.location="../favorites/index.php";
    }

    let changeNameSlider = 0;

    $('#slide_button').click(function() {
        if(changeNameSlider == 0) {
            $('#slide').animate({height: 'show'}, 200,);
            changeNameSlider = 1;
        } else {
            $('#slide').animate({height: 'hide'}, 200,);
            changeNameSlider = 0;
        }
    });

    let changeNameSlider1 = 0;

    $('#slide_button1').click(function() {
        if(changeNameSlider1 == 0) {
            $('#slide1').animate({height: 'show'}, 200,);
            changeNameSlider1 = 1;
        } else {
            $('#slide1').animate({height: 'hide'}, 200,);
            changeNameSlider1 = 0;
        }
    });

    let changeNameSlider2 = 0;

$('#slide_button2').click(function() {
    if(changeNameSlider2 == 0) {
        $('#slide2').animate({height: 'show'}, 200,);
        changeNameSlider2 = 1;
    } else {
        $('#slide2').animate({height: 'hide'}, 200,);
        changeNameSlider2 = 0;
    }
});

    $('#slide').animate({
        height: 'hide'
    }, 0, function() {
    });

    $('#slide1').animate({
        height: 'hide'
    }, 0, function() {
    });

    $('#slide2').animate({
        height: 'hide'
    }, 0, function() {
    });

</script>
</html>