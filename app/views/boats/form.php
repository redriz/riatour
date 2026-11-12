<?php $isEdit = !empty($boat['id']); ?>

<h1 class="fw-bold mb-4">
    <?php if ($isEdit): ?>
        Editar barco <span class="text-secondary fst-italic">#<?= $boat['id'] ?></span>
    <?php else: ?>
        Adicionar barco
    <?php endif; ?>
</h1>

<form method="post" novalidate
      action="index.php?page=boats&action=<?= $isEdit ? 'update&id=' . $boat['id'] : 'store' ?>">

    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" id="name" name="name" maxlength="50"
               value="<?= e($boat['name']) ?>"
               class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
               placeholder="Introduza o nome do barco...">
        <div class="invalid-feedback"><?= e($errors['name'] ?? '') ?></div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="capacity" class="form-label">Capacidade</label>
            <div class="input-group has-validation">
                <input type="number" id="capacity" name="capacity" min="1"
                       value="<?= e($boat['capacity']) ?>"
                       class="form-control <?= isset($errors['capacity']) ? 'is-invalid' : '' ?>">
                <span class="input-group-text">passageiros</span>
                <div class="invalid-feedback"><?= e($errors['capacity'] ?? '') ?></div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label for="is_available" class="form-label">Disponibilidade</label>
            <select id="is_available" name="is_available" class="form-select">
                <option value="1" <?= $boat['is_available'] ? 'selected' : '' ?>>Disponível</option>
                <option value="0" <?= !$boat['is_available'] ? 'selected' : '' ?>>Indisponível</option>
            </select>
        </div>
    </div>

    <hr>

    <div class="d-flex justify-content-end gap-2">
        <a href="index.php?page=boats" class="btn btn-outline-secondary">Cancelar</a>
        <button class="btn btn-success">
            <?php if ($isEdit): ?>
                <i class="bi bi-check-lg"></i> Guardar alterações
            <?php else: ?>
                <i class="bi bi-plus-lg"></i> Adicionar barco
            <?php endif; ?>
        </button>
    </div>
</form>
