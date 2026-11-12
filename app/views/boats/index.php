<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold m-0">Listagem de barcos</h1>
    <a href="index.php?page=boats&action=create" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Adicionar barco
    </a>
</div>

<form method="post" action="index.php?page=boats" class="row g-2 mb-3">
    <div class="col-md-6">
        <input type="text" name="search" value="<?= e($search) ?>" class="form-control" placeholder="Pesquisar por nome...">
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">Todos os estados</option>
            <option value="1" <?= $status === '1' ? 'selected' : '' ?>>Disponível</option>
            <option value="0" <?= $status === '0' ? 'selected' : '' ?>>Indisponível</option>
        </select>
    </div>
    <div class="col-md-3 d-flex gap-2">
        <button class="btn btn-primary"><i class="bi bi-search"></i> Pesquisar</button>
        <a href="index.php?page=boats" class="btn btn-outline-secondary">Limpar</a>
    </div>
</form>

<table class="table table-bordered bg-white align-middle table-ria">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Capacidade</th>
            <th>Disponibilidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!$boats): ?>
            <tr>
                <td colspan="5" class="text-center text-muted py-4">Nenhum barco encontrado.</td>
            </tr>
        <?php endif; ?>

        <?php foreach ($boats as $boat): ?>
            <tr>
                <td class="text-center"><?= $boat['id'] ?></td>
                <td><?= e($boat['name']) ?></td>
                <td><?= $boat['capacity'] ?> passageiros</td>
                <td>
                    <?php if ($boat['is_available']): ?>
                        <span class="badge text-bg-success">Disponível</span>
                    <?php else: ?>
                        <span class="badge text-bg-secondary">Indisponível</span>
                    <?php endif; ?>
                </td>
                <td class="text-center text-nowrap">
                    <a href="index.php?page=boats&action=show&id=<?= $boat['id'] ?>" class="btn btn-sm btn-outline-primary" title="Ver">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="index.php?page=boats&action=edit&id=<?= $boat['id'] ?>" class="btn btn-sm btn-outline-warning" title="Editar">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form method="post" action="index.php?page=boats&action=delete&id=<?= $boat['id'] ?>" class="d-inline"
                        onsubmit="return confirm('Tem a certeza que pretende eliminar este barco?')">
                        <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>