<?php
require_once __DIR__ . '/config/Database.php';

$pdo = Database::connect();
$total = $pdo->query('SELECT COUNT(*) FROM boat')->fetchColumn();

echo "Ligação OK! Existem $total barcos.";
