<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <title>Adicionar Transação - Sistema de Gestão Financeira e Produtividade</title>
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
        <h1>Editar Transação: <?= htmlspecialchars($transaction["descricao"]) ?></h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="<?= base_url("transactions/update") ?>" method="POST">
            <input type="hidden" name="id" value="<?= $transaction["id"] ?>">
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" value="<?= htmlspecialchars($transaction["descricao"]) ?>" required>
            <br>
            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" step="0.01" value="<?= htmlspecialchars($transaction["valor"]) ?>" required>
            <br>
            <label for="data_transacao">Data da transação:</label>
            <input type="date" id="data_transacao" name="data_transacao" value="<?= htmlspecialchars($transaction["data_transacao"]) ?>" required>
            <br>
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo">
                <option value="receita" <?= $transaction["tipo"] === "receita" ? "selected" : "" ?>>Receita</option>
                <option value="despesa" <?= $transaction["tipo"] === "despesa" ? "selected" : "" ?>>Despesa</option>
            </select>
            <br>
            <label for="conta_id">Conta:</label>
            <select id="conta_id" name="conta_id" required>
                <?php foreach ($accounts as $account): ?>
                    <option value="<?= $account["id"] ?>" <?= $transaction["conta_id"] == $account["id"] ? "selected" : "" ?>><?= htmlspecialchars($account["nome"]) ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="categoria_id">Categoria:</label>
            <select id="categoria_id" name="categoria_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category["id"] ?>" <?= $transaction["categoria_id"] == $category["id"] ? "selected" : "" ?>><?= htmlspecialchars($category["nome"]) ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="pago_recebido">
                <input type="checkbox" id="pago_recebido" name="pago_recebido" value="1" <?= $transaction["pago_recebido"] ? "checked" : "" ?>>
                Pago/Recebido
            </label>
            <br>
            <button type="submit">Salvar Transação</button>
        </form>
    </div>
</body>
</html>

