<?php
class IsLogged
{

    /**
     * Classa, která kontroluje, zdali je již daný uživatel přihlášen.
     * Když ne, tak ho hodí do přihlašovací tabulky.
     *
     */
    public function __construct(object $session, string $dir)
    {
        $this->isLogged($session, $dir);
    }

    /**
     * Funkce, která v případě, že uživatel není přihlášen, nás hodí na přihlašovací stránky.
     *
     * @param object $session
     * @param string $dir
     * @return void
     */
    private function isLogged(object $session, string $dir): void
    {
        if (!$session->getIsLogged()) {
            header("Location: " . $dir . "loginPage.php");
        }
    }

    /**
     * Funkce, která ze session bere jméno
     * Input je v array, takže si jen z arraye bere firtname a lastname a poté to jméno jen seskládá
     * Nakonec vrací jeden string indexu.php
     *
     * @param object $session
     * @return string
     */
    public function printName(object $session): string
    {
        $name = $session->getUserName();
        $resultname = "<p>" . $name["firstname"] . " " . $name["lastname"] . "</p>";
        return $resultname;
    }
}
