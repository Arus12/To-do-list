<?php
class LoginRegister


/**
 * Kontruktor kontroluje, zdali se uživatel regsitruje, nebo přihlašuje. Podle toho vybírá správnou funkci.
 * Hned první ale zavolá funkci pro vyčištění POST dat.
 * Zároveň vytváří instanci pro správu databáze.
 */
{
    public function __construct(object $loader, object $session, string $logOrReg, array $data)
    {
        $this->cleanPost();
        $loader->load("sqlLogin");
        $DB = new SqlLogin();
        $isAllOk = $this->registerOrLogin($DB, $session, $logOrReg, $data);
        if ($isAllOk) {
            $this->isAllOk($session, $data["email"]);
        } else {
        }
    }

    /**
     * Řídící funkce, která kontroluje, zdali se uživatel snaží přihlásit, nebo registrovat.
     * Podle toho, o co se uživatel snaží, poté funkce volá potřebné další funkce.
     *
     * @param object $DB
     * @param object $session
     * @param string $logOrReg
     * @param array $data
     * @return boolean
     */
    private function registerOrLogin(object $DB, object $session, string $logOrReg, array $data): bool
    {
        if ($logOrReg == "register") {
            if (!$this->checkIfExists($DB->openDB(), $data["emailReg"])) {
                $this->registerUser($DB->openDB(), $session, $data);
            } else {
                $session->setLoginError(1);
            }
        } else if ($logOrReg == "login") {
            if ($this->checkIfExists($DB->openDB(), $data["email"])) {
                return $this->loginUser($DB->openDB(), $session, $data);
            } else {
                $session->setLoginError(2);
            }
        }
        return false;
    }

    /**
     * Funkce, která se spojí s databází a zaregistruje nového uživatele
     *
     * @param object $conSQL
     * @param object $session
     * @param array $data
     * @return void
     */
    private function registerUser(object $conSQL, object $session, array $data): void
    {
        $sql = ("INSERT INTO `todolist`.`user` (`iduser`, `first_name`, `last_name`, `email`, `password`) VALUES (DEFAULT, '" . $data["firstName"] . "', '" . $data["lastName"] . "', '" . $data["emailReg"] . "', '" . $data["passwordReg"] . "')");
        if (mysqli_query($conSQL, $sql)) {
            $session->setLoginError(0);
        }
    }


    /**
     * Funkce, která kontroluje, zdali uživatel zadal pro přihlášení správný heslo.
     * Email kontrolovat není třeba, jelikož to už udělal kontroktor pomocí funkce checkIfExists
     * Pokud uživatel zadal heslo správně, rovnou funkce uloží do session jméno
     *
     * @param object $conSQL
     * @param object $session
     * @param array $data
     * @return boolean
     */
    private function loginUser(object $conSQL, object $session, array $data): bool
    {
        $sql = ("SELECT PASSWORD, first_name, last_name FROM `todolist`.`user` WHERE email = '" . $data["email"] . "'");
        if ($result = mysqli_query($conSQL, $sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row["PASSWORD"] === $data["password"]) {
                    $session->setUserName(array("firstname" => $row["first_name"], "lastname" => $row["last_name"]));
                    return true;
                } else {
                    $session->setLoginError(3);
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     *  Funkce, která vyčistí hodnoty v $_POST
     *
     * @return void
     */
    private function cleanPost(): void
    {
        foreach ($_POST as $key => $value) {
            unset($_POST[$key]);
        }
    }

    /**
     * Zkontroluje, zdali uživatel existuje pomocí emailu v databázi
     *
     * @param object $conSQL
     * @param string $email
     * @return boolean
     */
    private function checkIfExists(object $conSQL, string $email): bool
    {
        $sql = ("SELECT * FROM `todolist`.`user` WHERE email = " . "'" . $email . "'");
        if ($result = mysqli_query($conSQL, $sql)) {
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }


    /**
     * Funkce, která je závěrečná. Pokud vše dopadlo dobře, tak v class WorkSession nastaví hodnoty:
     * $_SESSION["isLogged"] na true
     * $_SESSION["user"] email, kterým se uživatel přihlásil
     * @param object $session
     * @param string $email
     * @return boolean
     */
    private function isAllOK(object $session, string $email): void
    {
        $session->setIsLogged(true);
        $session->setUser($email);
        header("Location: ../index.php");
    }
}
