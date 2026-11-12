<?php
session_start();

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/app/helpers.php';

$routes = [
    'dashboard' => 'DashboardController',
    'boats' => 'BoatController',
];

$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

if (!isset($routes[$page])) {
    http_response_code(404);
    exit('Página não encontrada.');
}

$controllerName = $routes[$page];
require_once __DIR__ . "/app/controllers/$controllerName.php";
$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    exit('Ação não encontrada');
}

$controller->$action();
