<?php
require_once("../php/autoloader.php");
$loader = new Loader();
$loader->load("WorkSession", "../php/");
$loader->load("isLogged", "../php/");
$session = new WorkSession($loader);
$isLogged = new IsLogged($session, "");
?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <title>To-Do List - Add list</title>
    <link href="../css/style.css" rel="stylesheet" />
    <link rel="icon" href="../img/logo/logo.png">
    <meta name="description" content="To-Do List">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Jan Černý" />
    <script src="https://kit.fontawesome.com/afcc9b0842.js" crossorigin="anonymous"></script>
    <script src="../javascript/script.js"></script>
</head>

<body>
    <header>
        <img src="../img/logo/logo.png" alt="Logo"></img>
        <a class="back" href="../index.php"><i class="fa-duotone fa-solid fa-circle-arrow-left"></i></a>
        <h1>To-Do list</h1>
        <span id="date"></span>
        <?php
        print($isLogged->printName($session));
        ?>
        <a class="logOut" href="../php/singOut.php">Odhlásit se</a>
        <script>
            clockTime();
        </script>
    </header>
    <main style="justify-content: center;height:100%;padding:7%;">
        <form action="../php/addList.php" method="post">
            <div class="container-addList" style="height: 55vh ;width: 35vw; border: solid;">
                <div class="container-header" style="height: 10% ;width: 100%; border-bottom: solid;">
                    <textarea name="title" placeholder="Nadpis" style="height:100%;width:100%; text-align: center; resize:none; word-break:break-word;overflow:auto; font-weight:bold;align-content: center"></textarea>
                </div>
                <div class="container-body" style="height: 80% ;width: 100%;">
                    <textarea name="contents" placeholder="Obsah" style="height:100%;width:100%;resize:none;text-align:center;word-break:break-word;overflow:auto;padding:4% 4% 4% 4%; align-content: center"></textarea>
                </div>
                <div class="container-footer" style="display:flex; height: 10% ;width: 100%; border-top: solid; font-weight:bold;">
                    <p style="padding-left:5px;">Deadline:</p>
                    <input type="date" id="formDate" name="formDate" placeholder="dd-mm-yyyy" style="all: unset; height:100%;width:100%;padding: 0 40% 0 30%;">
                </div>
                <button type="submit">Přidat úkol</button>
            </div>
        </form>
        <script>
            printTodayDate();
        </script>
    </main>
    <footer>
    </footer>
</body>

</html>