<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sistema de Gestão Financeira e Produtividade</title>
    <link rel="stylesheet" href="http://localhost/sistema_financeiro_produtividade/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Registro</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        <form action="sistema_financeiro_produtividade/register" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <br>
            <label for="confirm_senha">Confirmar Senha:</label>
            <input type="password" id="confirm_senha" name="confirm_senha" required>
            <br>
            <button type="submit">Registrar</button>
        </form>
        <p>Já tem uma conta? <a href="sistema_financeiro_produtividade/login">Faça login</a></p>
    </div>
</body>
</html>

