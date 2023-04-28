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
    <title>Document</title>
    <link rel="stylesheet" href="../MainPageSTYLES.css">
    <style>
        .addNewCategoryMainContainer {
            width: 98%;
            max-width: 900px;
            height: 125px;
            margin: auto;
            margin-top: 125px;
            background-color: white;
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.2);
        }

        .mainLabel {
            margin-left: 20px;
            margin-top: 20px;
            display: inline-block;
            font-weight: 600;
        }

        .newCategoryForm {
            margin-left: 20px;
            margin-top: 20px;
        }

        .newCategoryForm input[type = "text"] {
            height: 2rem;
            width: 10rem;
        }

        .newCategoryForm input[type = "submit"] {
            height: 2rem;
            width: 5rem;
            background-color: #7e2df7;
            color: white;
            border-style: solid;
            border-width: 1px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
        }

        .goBackLabel {
            float: right;
            margin-right: 20px;
            margin-top: 20px;
            cursor: pointer;
            color: #00a790;
        }
    </style>

</head>
<body>
    <div class="headerDiv" style="top: 0;">
        <img src="../../images/gstore.png" class="headerDivLogo" onclick='window.location="../index.php";'>
        <input type="button" id="accountIconID" class="headerDivIcons" onclick="AccountMenuOpen()">
    </div>

    <div class="addNewCategoryMainContainer">
        <?php
            $categoryToEdit = $_POST['category'];
            if($categoryToEdit == "") echo "<label class='mainLabel'>Dodaj nową kategorie</label>";
            else echo "<label class='mainLabel'>Edytuj kategorie</label>";
        ?>
        <label class="goBackLabel" onclick='window.location="index.php";'>WRÓĆ</label>
        <form class="newCategoryForm" action="addNewCategoryAction.php" method="POST">
            <input type="text" name="categoryName" value='<?php echo $categoryToEdit ?>'>
            <?php
                if($categoryToEdit == "") echo "<input type='hidden' name='method' value='addCategory'>";
                else { 
                    echo "<input type='hidden' name='method' value='editCategory'>";
                    echo "<input type='hidden' name='oldName' value='$categoryToEdit'>";
                }
            ?>
            <input type="submit" name="addNewCategorySubmited" value="ZAPISZ">
        </form>
    </div>

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
</html>