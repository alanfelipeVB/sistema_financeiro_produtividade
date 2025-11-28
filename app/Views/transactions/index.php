<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <title>Transações - Sistema de Gestão Financeira e Produtividade</title>
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
            <h1 class="m-0">Minhas Transações</h1>

            <a href="<?= base_url("transactions/create") ?>" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Adicionar Transação
            </a>
        </div>


        <?php if (empty($transactions)): ?>
            <div class="alert alert-warning text-center">
                Nenhuma transação encontrada.
            </div>
        <?php else: ?>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Data</th>
                            <th>Tipo</th>
                            <th>Conta</th>
                            <th>Categoria</th>
                            <th>Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr>
                                <td><?= htmlspecialchars($transaction["descricao"]) ?></td>
                                <td>R$ <?= number_format($transaction["valor"], 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($transaction["data_transacao"]) ?></td>
                                <td>
                                    <?php if ($transaction["tipo"] === "receita"): ?>
                                        <span class="badge bg-success">Receita</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Despesa</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= htmlspecialchars($transaction["conta_nome"]) ?></td>
                                <td><?= htmlspecialchars($transaction["categoria_nome"]) ?></td>

                                <td>
                                    <?php if ($transaction["pago_recebido"]): ?>
                                        <span class="badge bg-primary">Pago/Recebido</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Pendente</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <a href="<?= base_url("transactions/edit?id=" . $transaction["id"]) ?>" 
                                    class="btn btn-sm btn-warning me-1">
                                    <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <a href="<?= base_url("transactions/delete?id=" . $transaction["id"]) ?>" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir?');">
                                    <i class="fa-solid fa-trash"></i>
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

