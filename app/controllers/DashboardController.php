<?php
require_once 'config/Database.php';

class DashboardController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index()
    {
        $reservasAtivas    = $this->db->query("SELECT COUNT(*) FROM booking WHERE status <> 'cancelada'")->fetchColumn();
        $totalPassageiros  = $this->db->query("SELECT SUM(passengers) FROM booking WHERE status <> 'cancelada'")->fetchColumn();
        $barcosDisponiveis = $this->db->query("SELECT COUNT(*) FROM boat WHERE is_available = 1")->fetchColumn();

        require 'app/views/dashboard/index.php';
    }
}
