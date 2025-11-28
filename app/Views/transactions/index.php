<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transações - Sistema de Gestão Financeira e Produtividade</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Minhas Transações</h1>
        <p><a href="/dashboard">Voltar para o Dashboard</a></p>
        <p><a href="/transactions/create">Adicionar Nova Transação</a></p>

        <?php if (empty($transactions)): ?>
            <p>Nenhuma transação encontrada.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Conta</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?= htmlspecialchars($transaction["descricao"]) ?></td>
                            <td><?= htmlspecialchars($transaction["valor"]) ?></td>
                            <td><?= htmlspecialchars($transaction["data_transacao"]) ?></td>
                            <td><?= htmlspecialchars($transaction["tipo"]) ?></td>
                            <td><?= htmlspecialchars($transaction["conta_id"]) ?></td> <!-- Substituir por nome da conta -->
                            <td><?= htmlspecialchars($transaction["categoria_id"]) ?></td> <!-- Substituir por nome da categoria -->
                            <td><?= $transaction["pago_recebido"] ? "Pago/Recebido" : "Pendente" ?></td>
                            <td>
                                <a href="/transactions/edit/<?= $transaction["id"] ?>">Editar</a>
                                <a href="/transactions/delete/<?= $transaction["id"] ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>

