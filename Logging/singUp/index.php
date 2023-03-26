<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gstore - rejestracja</title>
    <link rel="stylesheet" href="singUpPageStyle.css">
</head>
<body>
    <div class="headerDiv">
        <a href="../../index.php"><img src="../../gstore.png" class="headerDivLogo"></a>
    </div>
    <form action="singUpUser.php" method="POST">
        <div class="container">
            <h1>Zarejestruj się</h1>
            <div class="text-field">
                <input type="text" name="email" id="email" class="input" required>
                <label class="label1">e-mail</label>
                <p id="emailErrorText">Podaj login lub e-mail</p>
            </div>
            <div class="text-field">
                <input type="password" name="password" id="password" class="input" required>
                <label class="label2">hasło</label>
                <p id="passwordErrorText">Podaj hasło</p>
            </div><br>
            <div class="howOldContainer">
                <label id="under18"><a>Mam mniej niż 18 lat</a></label>
                <label id="18orOver"><a>Mam 18 lat lub więcej</a></label>
            </div>
            <a>Dzięki tej informacji możemy pokazać oferty odpowiednie dla Ciebie</a><br><br>
            <input type="submit" name="singUpUser" value="ZAREJESTRUJ SIĘ" class="singUpButton">
            <br><br><hr>
            <label class="orLabel">lub jeśli masz już konto</label>
            <a href="../singIn/index.php"><input type="button" value="ZALOGUJ SIĘ" class="logInButton"></a>
        </div>
    </form>
</body>
<script>
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const emailErrorText = document.getElementById("emailErrorText");
    const passwordErrorText = document.getElementById("passwordErrorText");
    const under18 = document.getElementById('under18');
    const OverThan18 = document.getElementById('18orOver');

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

    function under18Clicked() {
        if(under18.style.borderColor != "#68d5f7") {
            under18.style.borderColor = "#68d5f7";
            OverThan18.style.borderColor = "#999";
        }
    }

    function over18Clicked() {
        if(OverThan18.style.borderColor != "#68d5f7") {
            OverThan18.style.borderColor = "#68d5f7";
            under18.style.borderColor = "#999";
        }
    }

    email.addEventListener('keyup', emailError);
    password.addEventListener('keyup', passwordError);
    under18.addEventListener('click', under18Clicked);
    OverThan18.addEventListener('click', over18Clicked);
</script>
</html>