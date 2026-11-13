<?php
require_once 'config/Database.php';

class Dashboard
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function reservasAtivas()
    {
        return $this->conn->query("SELECT COUNT(*) FROM booking WHERE status <> 'cancelada'")->fetchColumn();
    }

    public function totalPassageiros()
    {
        return $this->conn->query("SELECT SUM(passengers) FROM booking WHERE status <> 'cancelada'")->fetchColumn();
    }

    public function barcosDisponiveis()
    {
        return $this->conn->query("SELECT COUNT(*) FROM boat WHERE is_available = 1")->fetchColumn();
    }
}
