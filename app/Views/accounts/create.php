<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Conta - Sistema de Gestão Financeira e Produtividade</title>
    <link rel="stylesheet" href="<?= $env->baseUrl ?> /public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Nova Conta</h1>
        <p><a href="/accounts">Voltar para Contas</a></p>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="/accounts" method="POST">
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
                <option value="Crédito">Crédito</option>
            </select>
            <br>
            <button type="submit">Salvar Conta</button>
        </form>
    </div>
</body>
</html>

