<?php require 'app/views/layout/header.php'; ?>

<h1 class="fw-bold mb-4">Barco <span class="text-secondary fst-italic">#<?= $boat['id'] ?></span></h1>

<div class="card mb-4">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">Nome</dt>
            <dd class="col-sm-9"><?= htmlspecialchars($boat['name']) ?></dd>

            <dt class="col-sm-3">Capacidade</dt>
            <dd class="col-sm-9"><?= $boat['capacity'] ?> passageiros</dd>

            <dt class="col-sm-3">Disponibilidade</dt>
            <dd class="col-sm-9"><?= $boat['is_available'] ? 'Disponível' : 'Indisponível' ?></dd>
        </dl>
    </div>
</div>

<a href="index.php?page=boat" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
<a href="index.php?page=boat&action=edit&id=<?= $boat['id'] ?>" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a>

<?php require 'app/views/layout/footer.php'; ?>