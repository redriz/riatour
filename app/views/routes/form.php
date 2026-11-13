<?php require 'app/views/layout/header.php'; ?>

<h1 class="fw-bold mb-4"><?= isset($route['id']) ? 'Editar rota #' . $route['id'] : 'Adicionar rota' ?></h1>

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
               value="<?= htmlspecialchars($route['name']) ?>" placeholder="Introduza o nome da rota...">
    </div>

    <div class="mb-3">                                                                            <!-- ← a partir daqui -->
        <label for="desc" class="form-label">Descrição</label>
        <textarea id="desc" name="desc" rows="3" maxlength="255" class="form-control"
                  placeholder="Introduza a descrição para a rota..."><?= htmlspecialchars($route['desc']) ?></textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="duration_min" class="form-label">Duração</label>
            <div class="input-group">
                <input type="number" id="duration_min" name="duration_min" min="1" class="form-control"
                       value="<?= $route['duration_min'] ?>">
                <span class="input-group-text">minutos</span>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label for="price" class="form-label">Preço</label>
            <div class="input-group">
                <input type="number" id="price" name="price" min="0.01" step="0.01" class="form-control"
                       value="<?= $route['price'] ?>" placeholder="Introduza o preço da rota...">
                <span class="input-group-text">€</span>
            </div>
        </div>
    </div>                                                                                        <!-- ← até aqui -->

    <hr>

    <div class="d-flex justify-content-end gap-2">
        <a href="index.php?page=route" class="btn btn-outline-secondary">Cancelar</a>
        <button class="btn btn-success"><i class="bi bi-check-lg"></i> Guardar</button>
    </div>
</form>

<?php require 'app/views/layout/footer.php'; ?>