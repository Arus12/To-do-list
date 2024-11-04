<?php
require_once("php/autoloader.php");
$loader = new Loader();
$loader->load("WorkSession");
$loader->load("isLogged");
$session = new WorkSession($loader);
$isLogged = new IsLogged($session, "pages/");
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <title>To-Do List</title>
    <link href="css/style.css" rel="stylesheet" />
    <link rel="icon" href="img/logo/logo.png">
    <meta name="description" content="To-Do List">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Jan Černý" />
    <script src="https://kit.fontawesome.com/afcc9b0842.js" crossorigin="anonymous"></script>
    <script src="javascript/script.js"></script>
</head>

<body>
    <header>
        <img src="img/logo/logo.png" alt="Logo"></img>
        <h1>To-Do list</h1>
        <span id="date"></span>
        <?php
        print($isLogged->printName($session));
        ?>
        <a href="php/singOut.php">Odhlásit se</a>
        <script>
            clockTime();
        </script>
    </header>
    <main>
        <div class="filter-container" id="filter-container" style="margin-top:45px">
            <p><b>Filtr</b></p>
            <form action="/php/filterList.php" method="POST">
                <label style="width:100%;text-align:center; margin:0 0 10px 0;">Průběh:</label>
                <label for="progress1" style="font-size:15px">Hotovo</label>
                <input name="progress1" type="checkbox" value="done" style="width: 10px; padding: 10px; margin:0 0 0 10px;">
                <label for="progress2" style="font-size:15px">V progresu</label>
                <input name="progress2" type="checkbox" value="inProgress" style="width: 10px; padding: 10px; margin:0 0 0 10px">
                <label for="formDate" style="width:100%;text-align:center;margin:20px 0 5px 0;">Datum:</label>
                <input type="date" id="formDate" name="formDate" placeholder="dd-mm-yyyy">
                <button type="submit">Filtrovat</button>
            </form>
            <script>
                printFormDate();
                onlyOneCheck();
            </script>
            <script>
                scrollFunction();
            </script>
        </div>
        <div class="list-container">
            <a href="pages/addListPage.php" div class="add">
                <p>+</p>
            </a>
            <div class="test" style="height:225px;width:225px;border:solid;margin:70px;"></div>
            <div class="test" style="height:225px;width:225px;border:solid;margin:70px;"></div>
            <div class="test" style="height:225px;width:225px;border:solid;margin:70px;"></div>
            <div class="test" style="height:225px;width:225px;border:solid;margin:70px;"></div>
            <div class="test" style="height:225px;width:225px;border:solid;margin:70px;"></div>
            <div class="test" style="height:225px;width:225px;border:solid;margin:70px;"></div>
            <div class="test" style="height:225px;width:225px;border:solid;margin:70px;"></div>
            <div class="test" style="height:225px;width:225px;border:solid;margin:70px;"></div>
            <div class="test" style="height:225px;width:225px;border:solid;margin:70px;"></div>
            <div class="test" style="height:225px;width:225px;border:solid;margin:70px;"></div>
            <div class="test" style="height:225px;width:225px;border:solid;margin:70px;"></div>
        </div>
        <?php
        ?>
    </main>
    <footer>
    </footer>
</body>

</html>