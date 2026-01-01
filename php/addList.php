<?php
class AddList
{
    public function __construct()
    {
        require_once("autoloader.php");
        $loader = new Loader;
        $loader->load("sqlLogin", "./");
        var_dump($sqlLogin = new SqlLogin());
        if ($this->checkdata()) {
            $data["title"] = $_POST["title"];
            $data["contents"] = $_POST["contents"];
            $data["deadline"] = $_POST["formDate"];
            $userID = $this->getUserID($loader, $sqlLogin);
            $sql = "INSERT INTO task (title, description, deadline, status, user_iduser) VALUES ('" . $data["title"] . "', '" . $data["contents"] . "', '" . $data["deadline"] . "', 'V prubehu', " . $userID . ")";
            $this->addItem($sql, $sqlLogin, $dir);
        } else {
            print("Chyba: Nejsou vyplněny všechny údaje.");
        }

        print("Title: " . $_POST["title"] . "<br>Content: " . $_POST["contents"] . "<br>Date: " . $_POST["formDate"]);
        print($sql);
    }
    private function checkdata()
    {
        if (isset($_POST["title"]) && isset($_POST["contents"]) && isset($_POST["formDate"])) {
            return true;
        }
        return false;
    }
    private function getUserID($loader, $sqlLogin)
    {
        $loader->load("WorkSession", "./");
        $session = new WorkSession($loader);
        $userEmail = $session->getUser();
        $sql = "SELECT iduser FROM user WHERE email = '$userEmail'";
        $result = mysqli_query($sqlLogin->openDB(), $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row["iduser"];
        }
        return null;
    }
    private function addItem($sql, $sqlLogin, $dir)
    {
        if (mysqli_query($sqlLogin->openDB(), $sql)) {
            header("Location: " . $dir . "../index.php");
        } else {
            die("Error: " . $sql . "<br>" . mysqli_error($sqlLogin->openDB()));
        }
    }
}
$addList = new AddList();
