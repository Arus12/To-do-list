<?php
class Loader
{
    public static function load(string $className, string $dir = "php/")
    {
        if (!defined('APP_DIR')) {
            define("APP_DIR", $dir);
        }
        if (file_exists(APP_DIR . "$className.php")) {
            require APP_DIR . "$className.php";
        } else {
            die("Unable to load class $className.");
        }
    }
}
