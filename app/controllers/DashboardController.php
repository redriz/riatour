<?php
require_once 'app/models/Dashboard.php';

class DashboardController
{
    private $dashboardModel;

    public function __construct()
    {
        $this->dashboardModel = new Dashboard();
    }

    public function index()
    {
        $reservasAtivas    = $this->dashboardModel->reservasAtivas();
        $totalPassageiros  = $this->dashboardModel->totalPassageiros();
        $barcosDisponiveis = $this->dashboardModel->barcosDisponiveis();

        require 'app/views/dashboard/index.php';
    }
}
