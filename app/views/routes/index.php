<?php require 'app/views/layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold m-0">Listagem de rotas</h1>
    <a href="index.php?page=route&action=create" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Adicionar rota
    </a>
</div>

<form method="post" action="index.php?page=route" class="row g-2 mb-3">
    <div class="col-md-9">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Pesquisar por nome...">
    </div>
    <div class="col-md-3 d-flex gap-2">
        <button class="btn btn-primary"><i class="bi bi-search"></i> Pesquisar</button>
        <a href="index.php?page=route" class="btn btn-outline-secondary">Limpar</a>
    </div>
</form>

<table class="table table-bordered bg-white align-middle table-ria">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>                                                                   <!-- ← -->
            <th>Duração</th>                                                                     <!-- ← -->
            <th>Preço</th>                                                                       <!-- ← -->
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!$routes): ?>
            <tr>
                <td colspan="6" class="text-center text-muted py-4">Nenhuma rota encontrada.</td>   <!-- ← colspan 6 -->
            </tr>
        <?php endif; ?>

        <?php foreach ($routes as $route): ?>
            <tr>
                <td class="text-center"><?= $route['id'] ?></td>
                <td><?= htmlspecialchars($route['name']) ?></td>
                <td class="text-truncate" style="max-width: 250px;"><?= htmlspecialchars($route['desc']) ?></td> <!-- ← -->
                <td><?= $route['duration_min'] ?> minutos</td>                                    <!-- ← -->
                <td><?= $route['price'] ?> €</td>                                                 <!-- ← -->
                <td class="text-center text-nowrap">
                    <a href="index.php?page=route&action=show&id=<?= $route['id'] ?>" class="btn btn-sm btn-outline-primary" title="Ver">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="index.php?page=route&action=edit&id=<?= $route['id'] ?>" class="btn btn-sm btn-outline-warning" title="Editar">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form method="post" action="index.php?page=route&action=delete" class="d-inline"
                        onsubmit="return confirm('Tem a certeza que pretende eliminar esta rota?')">
                        <input type="hidden" name="id" value="<?= $route['id'] ?>">
                        <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require 'app/views/layout/footer.php'; ?>