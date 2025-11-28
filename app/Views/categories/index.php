<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <title>Categorias - Sistema de Gestão Financeira e Produtividade</title>
</head>
<body>
    <?php include __DIR__ . '/../common/menu.php'; ?>
    <div class="content">
        <a href="javascript:history.back()" class="btn btn-secondary text-decoration-none" >
            <i class="fa-solid fa-arrow-left"></i>
            Voltar
        </a>
        <br>
        <br>
        <div class="d-flex justify-content-between align-items-center mb-4 w-100">
            <h1 class="m-0">Minhas Categorias</h1>

            <a href="<?= base_url("categories/create") ?>" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Adicionar Categoria
            </a>
        </div>

        <?php if (empty($categories)): ?>
            <div class="alert alert-info" role="alert">
                Nenhuma categoria encontrada.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= htmlspecialchars($category["nome"]) ?></td>
                                <td class="text-end">
                                    <a href="<?= base_url("categories/edit?id=" . $category["id"]) ?>" class="btn btn-sm btn-warning me-1">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </a>
                                    <a href="<?= base_url("categories/delete?id=" . $category["id"]) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">
                                        <i class="fa-solid fa-trash"></i> Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>
</body>
</html>

