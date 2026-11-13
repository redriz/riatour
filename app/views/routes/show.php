<?php require 'app/views/layout/header.php'; ?>

<h1 class="fw-bold mb-4">Rota <span class="text-secondary fst-italic">#<?= $route['id'] ?></span></h1>

<div class="card mb-4">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">Nome</dt>
            <dd class="col-sm-9"><?= htmlspecialchars($route['name']) ?></dd>

            <dt class="col-sm-3">Descrição</dt>                                                  <!-- ← -->
            <dd class="col-sm-9"><?= htmlspecialchars($route['desc']) ?></dd>

            <dt class="col-sm-3">Duração</dt>                                                    <!-- ← -->
            <dd class="col-sm-9"><?= $route['duration_min'] ?> minutos</dd>

            <dt class="col-sm-3">Preço por passageiro</dt>                                       <!-- ← -->
            <dd class="col-sm-9"><?= $route['price'] ?> €</dd>
        </dl>
    </div>
</div>

<a href="index.php?page=route" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
<a href="index.php?page=route&action=edit&id=<?= $route['id'] ?>" class="btn btn-warning"><i class="bi bi-pencil"></i> Editar</a>

<?php require 'app/views/layout/footer.php'; ?>