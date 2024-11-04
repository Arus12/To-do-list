<?php
/**
 * Třída, která zařizuje odhlášení uživatele
 */
class singOut
{

    public function __construct()
    {
        require_once("./autoloader.php");
        $loader = new Loader();
        $loader->load("WorkSession", "./");
        $session = new WorkSession($loader);
        if ($this->unsetUserName($session)) {
            if ($this->unsetUser($session)) {
                if ($this->unsetLoginError($session)) {
                    if ($this->unsetIsLogged($session)) {
                        header("Location: ../pages/loginPage.php");
                    }
                }
            }
        }
        header("Location: ../index.php");
    }

    /**
     * Funkce, která při odhlášení uživatele smaže údaje o jeho jméně.
     *
     * @param object $session
     * @return boolean
     */
    private function unsetUserName(object $session):bool
    {
        if ($session->setUsername(array("firstname" => null, "lastname" => null))) {
        }
        return true;
    }

    /**
     * Funkce, která při odhlášení uživatele smaže údaje o jeho emailu.
     *
     * @param object $session
     * @return boolean
     */
    private function unsetUser(object $session):bool
    {
        if ($session->unSetUser()) {
        }
        return true;
    }

    /**
     * Funkce, která při odhlášení uživatele resetuje čísla errorů.
     *
     * @param object $session
     * @return boolean
     */
    private function unsetLoginError(object $session):bool
    {
        if ($session->setLoginError(-1)) {
        }
        return true;
    }

    /**
     * Funkce, která při odhlášení uživatele nastaví IsLogged na false, tedy, že uživatel není přihlášený.
     *
     * @param object $session
     * @return boolean
     */
    private function unsetIsLogged(object $session):bool
    {
        if ($session->setIsLogged(false)) {
        }
        return true;
    }
}

$obj = new singOut();
