<?php

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function view(string $name, array $data = []): void
{
    extract($data);
    require __DIR__ . '/views/layout/header.php';
    require __DIR__ . '/views/$name.php';
    require __DIR__ . '/views/layout/footer.php';
}

function redirect(string $url): void
{
    header("Location: $url");
    exit;
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}
