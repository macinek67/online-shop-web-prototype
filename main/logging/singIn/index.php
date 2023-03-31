<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gstore - logowanie</title>
    <link rel="stylesheet" href="singInPageStyle.css">
</head>
<body>
    <div class="headerDiv">
        <a href="../../index.php"><img src="../../../images/gstore.png" class="headerDivLogo"></a>
    </div>
    <form action="singInUser.php" method="POST">
        <div class="container">
            <h1>Zaloguj się</h1>
            <div class="text-field">
                <input type="text" name="email" id="email" class="input" required>
                <label class="label1">e-mail</label>
                <p id="emailErrorText">Podaj login lub e-mail</p>
            </div>
            <div class="text-field">
                <input type="password" name="password" id="password" class="input" required>
                <label class="label2">hasło</label>
                <p id="passwordErrorText">Podaj hasło</p>
            </div>
            <a href="../singUp/index.php" id="resetPassword">Nie pamiętam hasła</a>
            <input type="submit" name="singInUser" value="ZALOGUJ SIĘ" class="logInButton">
            <br><br><br><br><hr>
            <label class="orLabel">lub</label>
            <a href="../singUp/index.php"><input type="button" value="ZAREJESTRUJ SIĘ" class="singUpButton"></a>
        </div>
    </form>
</body>
<script>
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const emailErrorText = document.getElementById("emailErrorText");
    const passwordErrorText = document.getElementById("passwordErrorText");

    function emailError() {
        if(email.value.length<=0) {
            emailErrorText.style.visibility = "visible";
        } else emailErrorText.style.visibility = "hidden";
    }

    function passwordError() {
        if(password.value.length<=0) {
            passwordErrorText.style.visibility = "visible";
        } else passwordErrorText.style.visibility = "hidden";
    }


    email.addEventListener('keyup', emailError);
    password.addEventListener('keyup', passwordError);
</script>
</html>