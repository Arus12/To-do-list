<?php

class LoadTasks
{
    /**
     * Třída, která načítá úkoly z databáze a zobrazuje je na index.php
     *
     * @param object $session
     */
    public function __construct($session)
    {
        $this->loadTasks($session, $this->dbCon());
    }

    private function dbCon()
    {
        require_once("php/sqlLogin.php");
        $sqlLogin = new SqlLogin();
        return $sqlLogin->openDB();
    }

    private function loadTasks($session, $db)
    {
        $sql = "SELECT iduser FROM user WHERE email = '" . $session->getUser() . "'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row["iduser"];
            $sql = "SELECT * FROM task WHERE user_iduser = " . $userId;
            $result = $db->query($sql);
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="task-card" style="height:225px;width:225px;border:solid;margin:70px;">';
                echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
                echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
                echo '<p>Datum: ' . htmlspecialchars($row["deadline"]) . '</p>';
                echo '<p>Stav: ' . htmlspecialchars($row["status"]) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>Žádné úkoly nenalezeny.</p>';
        }
    }

}