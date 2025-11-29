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
        <h1>Adicionar Nova Transação</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="<?= base_url("transactions") ?>" method="POST">
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="descricao">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" required>
                </div>
                <div class="col-md-4">
                    <label for="valor">Valor:</label>
                    <input type="number" id="valor" name="valor" step="0.01" required>
                </div>
                <div class="col-md-4">
                    <label for="data_transacao">Data:</label>
                    <input type="date" id="data_transacao" name="data_transacao" value="<?= date("Y-m-d") ?>" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="tipo">Tipo:</label>
                    <select id="tipo" name="tipo">
                        <option value="receita">Receita</option>
                        <option value="despesa">Despesa</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="conta_id">Conta:</label>
                    <select id="conta_id" name="conta_id" required>
                        <?php foreach ($accounts as $account): ?>
                            <option value="<?= $account["id"] ?>"><?= htmlspecialchars($account["nome"]) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="categoria_id">Categoria:</label>
                    <select id="categoria_id" name="categoria_id" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category["id"] ?>"><?= htmlspecialchars($category["nome"]) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <label for="pago_recebido">
                <input type="checkbox" id="pago_recebido" name="pago_recebido" value="1">
                Pago/Recebido
            </label>
            <br>
            <button type="submit" class="w-100">Salvar Transação</button>
        </form>
    </div>
</body>
</html>

