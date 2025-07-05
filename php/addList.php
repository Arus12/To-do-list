<?php
class AddList
{
    public function __construct()
    {
        require_once("autoloader.php");
        $loader = new Loader;
        print("Title: " . $_POST["title"] . "<br>Content: " . $_POST["contents"] . "<br>Date: " . $_POST["formDate"]);
    }
}
$addList = new AddList();
