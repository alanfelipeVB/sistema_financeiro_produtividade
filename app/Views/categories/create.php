<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Categoria - Sistema de Gestão Financeira e Produtividade</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Nova Categoria</h1>
        <p><a href="/categories">Voltar para Categorias</a></p>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="/categories" method="POST">
            <label for="nome">Nome da Categoria:</label>
            <input type="text" id="nome" name="nome" required>
            <br>
            <label for="tipo_transacao">Tipo de Transação:</label>
            <select id="tipo_transacao" name="tipo_transacao">
                <option value="receita">Receita</option>
                <option value="despesa">Despesa</option>
            </select>
            <br>
            <button type="submit">Salvar Categoria</button>
        </form>
    </div>
</body>
</html>

