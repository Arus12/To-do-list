<?php
class writeLoginError
{
    private $session;

    public function __construct($session)
    {
        $this->session = new WorkSession;
    }

    /**
     * 0 = Registrace úspěšná
     * 1 = Registrace neúspěšná
     * 2 = Uživatel neexistuje v DB při loginu
     * 3 = Uživatel zadal špatné heslo při loginu
     *
     * @return string
     */
    public function writeLoginError()
    {
        if ($this->session->getLoginError() > -1) {
            for ($i = 0; $i < 4; $i++) {
                if ($this->session->getLoginError() == 0) {
                    return '<script>document.getElementById("error-container").innerHTML = "<div class='."'succes-message'".'></div>";showError("Registrace úspěšná! Můžete se přihlásit");</script>';
                } else if ($this->session->getLoginError() == 1) {
                    return '<script>document.getElementById("error-container").innerHTML = "<div class='."'error-message'".'> cv</div>";showError("Uživatel pod stejným emailem je již registrovaný");</script>';
                } else if ($this->session->getLoginError() == 2) {
                    return '<script>document.getElementById("error-container").innerHTML = "<div class='."'error-message'".'></div>";showError("Zadaný uživatel není registrovaný");</script>';
                } else if ($this->session->getLoginError() == 3) {
                    return '<script>document.getElementById("error-container").innerHTML = "<div class='."'error-message'".'> cv</div>";showError("Zadali jste špatné heslo");</script>';
                }
            }
        }
    }
}
