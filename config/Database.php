<?php
class Database
{
    private $host = 'localhost';
    private $db   = 'bdRiaTour_AdonaiRodriguez_C27';
    private $user = 'root';
    private $pass = '';

    public function connect()
    {
        $conn = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8mb4", $this->user, $this->pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $conn;
    }
}
