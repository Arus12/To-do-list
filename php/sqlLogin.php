<?php
class SqlLogin
{

    private $conn;

    /**
     * Konstructor připojuje do databáze
     */
    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $this->conn = $conn;
        }
    }

    /**
     * Funkce, která otevírá databázi
     *
     * @return object
     */
    public function openDB()
    {
        return $this->conn;
    }

    /**
     * Funkce, která zavírá databázi
     *
     * @return void
     */
    public function closeDB()
    {
        mysqli_close($this->conn);
    }
}
