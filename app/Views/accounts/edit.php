<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <title>Editar Conta - Sistema de Gestão Financeira e Produtividade</title>
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
        <h1>Editar Conta</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="<?= base_url("accounts/update") ?>" method="POST">
            <input type="hidden" name="id" value="<?= $account["id"] ?>">
            <label for="nome">Nome da Conta:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($account["nome"]) ?>" required>
            <br>
            <label for="tipo">Tipo de Conta:</label>
            <select id="tipo" name="tipo">
                <option value="Corrente" <?= $account["tipo"] === "Corrente" ? "selected" : "" ?>>Corrente</option>
                <option value="Poupança" <?= $account["tipo"] === "Poupança" ? "selected" : "" ?>>Poupança</option>
                <option value="Investimento" <?= $account["tipo"] === "Investimento" ? "selected" : "" ?>>Investimento</option>
                <option value="Dinheiro" <?= $account["tipo"] === "Dinheiro" ? "selected" : "" ?>>Dinheiro</option>
            </select>
            <br>
            <button type="submit">Salvar Conta</button>
        </form>
    </div>
</body>
</html>

