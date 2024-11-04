<?php
class WorkSession
{
    /*
    Konstuktor, který spouští session, pokud není zapnutá
    */
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Získá value z Session["isLogged"]
     * Pokud hodnota není nastavená, automaticky jí nastavuje na false, tedy nejsi přihlášen.
     *
     * @return boolen
     */
    public function getIsLogged(): bool
    {
        if (!isset($_SESSION["isLogged"])) {
            $_SESSION["isLogged"] = false;
        }
        return $_SESSION["isLogged"];
    }

    /**
     * Nastaví value do Session["isLogged"]
     *
     * @param bool $isLogged
     * @return void
     */
    public function setIsLogged(bool $isLogged): void
    {
        $_SESSION["isLogged"] = $isLogged;
    }

    /**
     * Získá value z Session["user"]
     * Pomocí emailu zjistíme, o jakého uživatele se jedná.
     *
     * @return string
     */
    public function getUser(): string
    {
        return $_SESSION["user"];
    }

    /**
     * Nastaví value do Session["user"].
     * Nastavuje se email, abychom věděli, o jakého uživatele se jedná.
     *
     * @param string $email
     * @return void
     */
    public function setUser(string $email): void
    {
        $_SESSION["user"] = $email;
    }

    /**
     * Získá value z Session["loginError"]
     * Pomocí čísel víme, o jaký error při loginu, nebo registru nastal.
     * 0 = Registrace úspěšná
     * 1 = Registrace neúspěšná
     * 2 = Uživatel neexistuje v DB při loginu
     * 3 = Uživatel zadal špatné heslo při loginu
     *
     * @return int
     */
    public function getLoginError(): int
    {
        if (!isset($_SESSION["loginError"])) {
            $_SESSION["loginError"] = -1;
        }
        return $_SESSION["loginError"];
    }

    /**
     * Nastaví value do Session["loginError"].
     * Nastavuje číslo pomocí kterého víme, o jaký error při loginu, nebo registru nastal.
     *
     * @param int $error
     * @return void
     */
    public function setLoginError(string $error): void
    {
        $_SESSION["loginError"] = $error;
    }

    /**
     * Získá value z Session["userName"]
     * Získává jméno uživatele
     *
     * @return array
     */
    public function getUserName(): array
    {
        return $_SESSION["userName"];
    }

    /**
     * Nastaví value do Session["userName"].
     * Nastavuje se jméno přihlášeného uživatele
     *
     * @param array $name
     * @return void
     */
    public function setUserName(array $name): void
    {
        $_SESSION["userName"] = $name;
    }

    /**
     * Funkce, která při odhlášení nastaví SESSION USER, neboli email na null a vrací true
     *
     * @return boolen
     */
    public function unSetUser(): bool
    {
        $_SESSION["user"] = null;
        return true;
    }
}
