<?php
require_once __DIR__ . '/../models/Dashboard.php';

class DashboardController
{
    public function index(): void
    {
        view('dashboard/index', ['stats' => Dashboard::stats()]);
    }
}
