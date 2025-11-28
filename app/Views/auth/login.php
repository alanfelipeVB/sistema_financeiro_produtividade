<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gestão Financeira e Produtividade</title>
    <link rel="stylesheet" href="http://localhost/sistema_financeiro_produtividade/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        <form action="/login" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="sistema_financeiro_produtividade/register">Registre-se</a></p>
    </div>
</body>
</html>

