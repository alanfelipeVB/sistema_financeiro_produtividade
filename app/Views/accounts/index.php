<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas - Sistema de Gestão Financeira e Produtividade</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Minhas Contas</h1>
        <p><a href="/dashboard">Voltar para o Dashboard</a></p>
        <p><a href="/accounts/create">Adicionar Nova Conta</a></p>

        <?php if (empty($accounts)): ?>
            <p>Nenhuma conta encontrada.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Saldo</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accounts as $account): ?>
                        <tr>
                            <td><?= htmlspecialchars($account["nome"]) ?></td>
                            <td><?= htmlspecialchars($account["saldo"]) ?></td>
                            <td><?= htmlspecialchars($account["tipo"]) ?></td>
                            <td>
                                <a href="/accounts/edit/<?= $account["id"] ?>">Editar</a>
                                <a href="/accounts/delete/<?= $account["id"] ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>

