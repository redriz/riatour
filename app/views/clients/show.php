<?php require 'app/views/layout/header.php'; ?>

<h1 class="fw-bold mb-4">Cliente <span class="text-secondary fst-italic">#<?= $client['id'] ?></span></h1>

<div class="card mb-4">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">Nome</dt>
            <dd class="col-sm-9"><?= htmlspecialchars($client['name']) ?></dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9"><?= htmlspecialchars($client['email']) ?></dd>

            <dt class="col-sm-3">Telefone</dt>
            <dd class="col-sm-9"><?= htmlspecialchars($client['phone']) ?></dd>
        </dl>
    </div>
</div>

<a href="index.php?page=client" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
<a href="index.php?page=client&action=edit&id=<?= $client['id'] ?>" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a>

<?php require 'app/views/layout/footer.php'; ?>
