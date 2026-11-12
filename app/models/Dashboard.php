<?php
class Dashboard
{
    public static function stats(): array
    {
        $pdo = Database::connect();

        return [
            'activeBookings' => $pdo->query("SELECT COUNT(*) FROM booking WHERE status <> 'cancelada'")->fetchColumn(),
            'totalPassengers' => $pdo->query("SELECT COALESCE(SUM(passengers), 0) FROM booking WHERE status <> 'cancelada'")->fetchColumn(),
            'availableBoats'  => $pdo->query("SELECT COUNT(*) FROM boat WHERE is_available = 1")->fetchColumn(),
        ];
    }
}
