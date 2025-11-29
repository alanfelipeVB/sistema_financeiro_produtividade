<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <title>Registro - Sistema de Gestão Financeira e Produtividade</title>
</head>
<body>
    <div class="container">
        <h1>Registro</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        <form action="<?= base_url("register") ?>" method="POST">
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
        <p>Já tem uma conta? <a href="<?= base_url("login") ?>">Faça login</a></p>
    </div>
</body>
</html>

