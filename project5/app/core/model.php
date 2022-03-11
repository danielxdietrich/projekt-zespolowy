<?php

class Model
{
    private $db;

    protected const TABLE_USER = 'Uzytkownik';
    protected const TABLE_PRODUCT = 'Produkt';
    protected const TABLE_ORDER = 'Zamówienie';

    public function __construct()
    {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = '';

        $this->db = new Database($dbhost, $dbuser, $dbpass, $dbname);
    }

    public function getDatabase()
    {
        return $this->db;
    }

    public function logout()
    {
        session_destroy();
        unset($this->getActiveEmail());

        header('Location: ' . ROOT_PATH . 'homepage');
    }

    public function getUserInfo($info)
    {
        $query = "SELECT " . $info . " FROM " . $this->TABLE_USER . " WHERE email = \"" . $this->getActiveEmail() . "\"";
        return $this->getDatabase()->runQuery($query);
    }

    public function isLoggedIn()
    {
        return isset($this->getActiveEmail());
    }

    private function getActiveEmail()
    {
        return $_SESSION['email'];
    }
}
