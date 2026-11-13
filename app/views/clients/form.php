<?php require 'app/views/layout/header.php'; ?>

<h1 class="fw-bold mb-4"><?= isset($client['id']) ? 'Editar cliente #' . $client['id'] : 'Adicionar cliente' ?></h1>

<?php if (!empty($erros)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($erros as $erro): ?>
                <li><?= $erro ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" id="name" name="name" maxlength="100" class="form-control"
               value="<?= htmlspecialchars($client['name']) ?>" placeholder="Introduza o nome do cliente...">
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" maxlength="100" class="form-control"
                   value="<?= htmlspecialchars($client['email']) ?>" placeholder="Introduza o email do cliente...">
        </div>

        <div class="col-md-6 mb-3">
            <label for="phone" class="form-label">Telefone</label>
            <input type="tel" id="phone" name="phone" maxlength="20" class="form-control"
                   value="<?= htmlspecialchars($client['phone']) ?>" placeholder="Introduza o telefone do cliente...">
        </div>
    </div>

    <hr>

    <div class="d-flex justify-content-end gap-2">
        <a href="index.php?page=client" class="btn btn-outline-secondary">Cancelar</a>
        <button class="btn btn-success"><i class="bi bi-check-lg"></i> Guardar</button>
    </div>
</form>

<?php require 'app/views/layout/footer.php'; ?>