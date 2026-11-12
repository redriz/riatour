<?php
$current = $_GET['page'] ?? 'dashboard';

$menu = [
    'dashboard' => 'Dashboard',
    'bookings'  => 'Reservas',
    'clients'   => 'Clientes',
    'routes'    => 'Rotas',
    'boats'     => 'Barcos',
    'tours'     => 'Passeios',
];
?>

<!DOCTYPE html>
<html lang=pt>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RiaTour - Sistema de Gestão</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="d-flex min-vh-100">

        <aside class="sidebar d-flex flex-column p-4">
            <div class="logo mb-3">RIA<br>TOUR</div>
            <h4 class="fw-bold mb-4">Sistema de Gestão</h4>

            <nav class="nav flex-column gap-1">
                <?php foreach ($menu as $key => $label): ?>
                    <a class="nav-link <?= $current === $key ? 'active' : '' ?>"
                        href="index.php?page=<?= $key ?>"><?= $label ?></a>
                <?php endforeach; ?>
            </nav>

            <small class="mt-auto">&copy; <?= date('Y') ?> - Ria Tour</small>
        </aside>

        <main class="flex-grow-1 p-5">
            <?php if (!empty($_SESSION['flash'])): ?>
                <?php $flash = $_SESSION['flash'];
                unset($_SESSION['flash']); ?>
                <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show">
                    <?= e($flash['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>