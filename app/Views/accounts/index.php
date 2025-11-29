<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <title>Contas - Sistema de Gestão Financeira e Produtividade</title>
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
            <h1 class="m-0">Minhas Contas</h1>

            <a href="<?= base_url("accounts/create") ?>" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Adicionar Conta
            </a>
        </div>

       <?php if (empty($accounts)): ?>
    <div class="alert alert-info" role="alert">
        Nenhuma conta encontrada.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Saldo</th>
                    <th>Tipo</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accounts as $account): ?>
                    <tr>
                        <td><?= htmlspecialchars($account["nome"]) ?></td>
                        <td>R$ <?= number_format($account["saldo"], 2, ',', '.') ?></td>
                        <td><?= ucfirst(htmlspecialchars($account["tipo"])) ?></td>
                        <td class="text-center">
                            <?php if ($account["status"]): ?>
                                <a href="<?= base_url("accounts/edit?id=" . $account["id"]) ?>" class="btn btn-sm btn-warning me-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a>
                                <a href="<?= base_url("accounts/delete?id=" . $account["id"]) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta conta?');">
                                    <i class="fa-solid fa-trash"></i> Excluir
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Inativa</span>
                            <?php endif; ?>
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

