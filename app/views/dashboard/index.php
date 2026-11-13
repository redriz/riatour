<?php require 'app/views/layout/header.php'; ?>

<h1 class="fw-bold mb-4">Dashboard</h1>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card stat-card border-0 h-100">
            <div class="card-body">
                <h5 class="fw-bold">Reservas ativas</h5>
                <div class="value"><?= $reservasAtivas ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card border-0 h-100">
            <div class="card-body">
                <h5 class="fw-bold">Total de passageiros</h5>
                <div class="value"><?= $totalPassageiros ?? 0 ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card border-0 h-100">
            <div class="card-body">
                <h5 class="fw-bold">Barcos disponíveis</h5>
                <div class="value"><?= $barcosDisponiveis ?></div>
            </div>
        </div>
    </div>
</div>

<?php require 'app/views/layout/footer.php'; ?>
