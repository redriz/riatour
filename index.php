<?php
session_start();

$controllerName = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

switch ($controllerName) {
    case 'client':
        require_once 'app/controllers/ClientController.php';
        $controller = new ClientController();
        break;
    case 'boat':
        require_once 'app/controllers/BoatController.php';
        $controller = new BoatController();
        break;
    case 'dashboard':
    default:
        require_once 'app/controllers/DashboardController.php';
        $controller = new DashboardController();
        break;
}

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo 'Ação não encontrada!';
}
