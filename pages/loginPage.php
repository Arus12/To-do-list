<?php
/*
* Kontroluje, zdali nejsme již přihlášeni
*
*/
require_once("../php/autoloader.php");
$loader = new Loader;
$loader->load("workSession", "../php/");
$session = new WorkSession;
if ($session->getIsLogged() == true) {
    header("Location: ../index.php");
}

/*
* Po registraci, či přihlášení vše zpracuje. Hesla zaheshuje a posílá to na zpracovaní loginRegister.php
*
*/
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $_POST["password"] = hash("sha256", $_POST["password"]);
    $loader->load("LoginRegister");
    $logOrREg = new LoginRegister($loader, $session, "login", $_POST);
} else if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["emailReg"]) && isset($_POST["passwordReg"])) {
    $_POST["passwordReg"] = hash("sha256", $_POST["passwordReg"]);
    $loader->load("LoginRegister");
    $logOrREg = new LoginRegister($loader, $session, "register", $_POST);
} else {
}
?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <title>To-Do List Login</title>
    <link href="../css/style.css" rel="stylesheet" />
    <link rel="icon" href="../img/logo/logo.png">
    <meta name="description" content="To-Do List Login Page">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Jan Černý" />
    <script src="https://kit.fontawesome.com/afcc9b0842.js" crossorigin="anonymous"></script>
    <script src="../javascript/script.js"></script>
</head>

<body style= "display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f7f7f7;">
    <div id="error-container"></div>

    <div class="container">
        <div class="form-container">
            <!-- Login Form -->
            <div class="login-form form">
                <img src="../img/logo/logo.png" alt="Logo" style="height: 16em; display: block; margin-left:auto; margin-right: auto;"></img>
                <h2>Přihlášení</h2>
                <form action="./loginPage.php" method="post">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" autocomplete="on" value="@" required>
                    <label for="password">Heslo</label>
                    <input type="password" id="password" name="password" autocomplete="on" placeholder="***********" required>
                    <button type="submit">Přihlásit se</button>
                    <p>Nemáš ještě účet? <a href="#" id="goToRegister">Zaregistruj se</a></p>
                </form>
            </div>

            <!-- Registration Form -->
            <div class="register-form form">
                <img src="../img/logo/logo.png" alt="Logo" style="height: 8em; display: block; margin-left:auto; margin-right: auto;"></img>
                <h2>Registrace</h2>
                <form action="./loginPage.php" method="post">
                    <label for="firstName">Jméno</label>
                    <input type="text" id="firstName" name="firstName" autocomplete="on" placeholder="John" required>
                    <label for="lastName">Příjmení</label>
                    <input type="text" id="lastName" name="lastName" autocomplete="on" placeholder="Black" required>
                    <label for="emailReg">Email</label>
                    <input type="email" id="emailReg" name="emailReg" autocomplete="on" value="@" required>
                    <label for="passwordReg">Heslo</label>
                    <input type="password" id="passwordReg" name="passwordReg" autocomplete="on" placeholder="***********" required>
                    <button type="submit">Registrovat se</button>
                    <p>Již máš účet? <a href="#" id="goToLogin">Přihlásit se</a></p>
                </form>
            </div>
        </div>
    </div>
    <script>
        rotate();
    </script>
    <?php
    require_once("../php/writeLoginError.php");
    $error = new writeLoginError($session);
    print($error->writeLoginError());

    ?>

</body>

</html>