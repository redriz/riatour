<?php require 'app/views/layout/header.php'; ?>

<h1 class="fw-bold mb-4"><?= isset($boat['id']) ? 'Editar barco #' . $boat['id'] : 'Adicionar barco' ?></h1>

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
        <input type="text" id="name" name="name" maxlength="50" class="form-control"
               value="<?= htmlspecialchars($boat['name']) ?>" placeholder="Introduza o nome do barco...">
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="capacity" class="form-label">Capacidade</label>
            <div class="input-group">
                <input type="number" id="capacity" name="capacity" min="1" class="form-control"
                       value="<?= $boat['capacity'] ?>">
                <span class="input-group-text">passageiros</span>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label for="is_available" class="form-label">Disponibilidade</label>
            <select id="is_available" name="is_available" class="form-select">
                <option value="1">Disponível</option>
                <option value="0" <?= $boat['is_available'] == 0 ? 'selected' : '' ?>>Indisponível</option>
            </select>
        </div>
    </div>

    <hr>

    <div class="d-flex justify-content-end gap-2">
        <a href="index.php?page=boat" class="btn btn-outline-secondary">Cancelar</a>
        <button class="btn btn-success"><i class="bi bi-check-lg"></i> Guardar</button>
    </div>
</form>

<?php require 'app/views/layout/footer.php'; ?>
