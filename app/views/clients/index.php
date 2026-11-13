<?php require 'app/views/layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold m-0">Listagem de clientes</h1>
    <a href="index.php?page=client&action=create" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Adicionar cliente
    </a>
</div>

<form method="post" action="index.php?page=client" class="row g-2 mb-3">
    <div class="col-md-9">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Pesquisar por nome ou email...">
    </div>
    <div class="col-md-3 d-flex gap-2">
        <button class="btn btn-primary"><i class="bi bi-search"></i> Pesquisar</button>
        <a href="index.php?page=client" class="btn btn-outline-secondary">Limpar</a>
    </div>
</form>

<table class="table table-bordered bg-white align-middle table-ria">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!$clients): ?>
            <tr>
                <td colspan="5" class="text-center text-muted py-4">Nenhum cliente encontrado.</td>
            </tr>
        <?php endif; ?>

        <?php foreach ($clients as $client): ?>
            <tr>
                <td class="text-center"><?= $client['id'] ?></td>
                <td><?= htmlspecialchars($client['name']) ?></td>
                <td><?= htmlspecialchars($client['email']) ?></td>
                <td><?= htmlspecialchars($client['phone']) ?></td>
                <td class="text-center text-nowrap">
                    <a href="index.php?page=client&action=show&id=<?= $client['id'] ?>" class="btn btn-sm btn-outline-primary" title="Ver">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="index.php?page=client&action=edit&id=<?= $client['id'] ?>" class="btn btn-sm btn-outline-warning" title="Editar">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form method="post" action="index.php?page=client&action=delete" class="d-inline"
                        onsubmit="return confirm('Tem a certeza que pretende eliminar este cliente?')">
                        <input type="hidden" name="id" value="<?= $client['id'] ?>">
                        <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require 'app/views/layout/footer.php'; ?>
