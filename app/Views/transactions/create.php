<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ . '/../../../helpers/url.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Transação - Sistema de Gestão Financeira e Produtividade</title>
    <link rel="stylesheet" href="<?= $env->baseUrl ?> /public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Nova Transação</h1>
        <p><a href="<?= base_url("transactions") ?>">Voltar para Transações</a></p>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="<?= base_url("transactions") ?>" method="POST">
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" required>
            <br>
            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" step="0.01" required>
            <br>
            <label for="data_transacao">Data:</label>
            <input type="date" id="data_transacao" name="data_transacao" value="<?= date("Y-m-d") ?>" required>
            <br>
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo">
                <option value="receita">Receita</option>
                <option value="despesa">Despesa</option>
            </select>
            <br>
            <label for="conta_id">Conta:</label>
            <select id="conta_id" name="conta_id" required>
                <?php foreach ($accounts as $account): ?>
                    <option value="<?= $account["id"] ?>"><?= htmlspecialchars($account["nome"]) ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="categoria_id">Categoria:</label>
            <select id="categoria_id" name="categoria_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category["id"] ?>"><?= htmlspecialchars($category["nome"]) ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="pago_recebido">
                <input type="checkbox" id="pago_recebido" name="pago_recebido" value="1">
                Pago/Recebido
            </label>
            <br>
            <button type="submit">Salvar Transação</button>
        </form>
    </div>
</body>
</html>

