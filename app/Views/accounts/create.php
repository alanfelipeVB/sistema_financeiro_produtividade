<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <title>Adicionar Conta - Sistema de Gestão Financeira e Produtividade</title>
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
        <h1>Adicionar Nova Conta</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="<?= base_url("accounts") ?>" method="POST">
            <label for="nome">Nome da Conta:</label>
            <input type="text" id="nome" name="nome" required>
            <br>
            <label for="saldo">Saldo Inicial:</label>
            <input type="number" id="saldo" name="saldo" step="0.01" value="0.00" required>
            <br>
            <label for="tipo">Tipo de Conta:</label>
            <select id="tipo" name="tipo">
                <option value="Corrente">Corrente</option>
                <option value="Poupança">Poupança</option>
                <option value="Investimento">Investimento</option>
                <option value="Dinheiro">Dinheiro</option>
            </select>
            <br>
            <button type="submit" class="w-100">Salvar Conta</button>
        </form>
    </div>
</body>
</html>

