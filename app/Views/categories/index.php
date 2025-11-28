<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Sistema de Gestão Financeira e Produtividade</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Minhas Categorias</h1>
        <p><a href="/dashboard">Voltar para o Dashboard</a></p>
        <p><a href="/categories/create">Adicionar Nova Categoria</a></p>

        <?php if (empty($categories)): ?>
            <p>Nenhuma categoria encontrada.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo de Transação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= htmlspecialchars($category["nome"]) ?></td>
                            <td><?= htmlspecialchars($category["tipo_transacao"]) ?></td>
                            <td>
                                <a href="/categories/edit/<?= $category["id"] ?>">Editar</a>
                                <a href="/categories/delete/<?= $category["id"] ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>

