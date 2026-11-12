<h1 class="fw-bold mb-4">Dashboard</h1>

<?php
$cards = [
    'Reservas ativas'      => $stats['activeBookings'],
    'Total de passageiros' => $stats['totalPassengers'],
    'Barcos disponíveis'   => $stats['availableBoats'],
];
?>

<div class="row g-4">
    <?php foreach ($cards as $label => $value): ?>
        <div class="col-md-4">
            <div class="card stat-card border-0 h-100">
                <div class="card-body">
                    <h5 class="fw-bold"><?= $label ?></h5>
                    <div class="value"><?= $value ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>