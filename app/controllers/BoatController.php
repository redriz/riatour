<?php
require_once __DIR__ . '/../models/Boat.php';

class BoatController
{
    public function index(): void
    {
        $search = trim($_GET['search'] ?? '');
        $status = $_GET['status'] ?? '';

        view('boats/index', [
            'boats' => Boat::all($search, $status),
            'search' => $search,
            'status' => $status,
        ]);
    }
}
