<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <title>Adicionar Categoria - Sistema de Gestão Financeira e Produtividade</title>
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
        <h1>Editar Categoria</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="<?= base_url("categories/edit") ?>" method="POST">
            <input type="hidden" name="id" value="<?= $category["id"] ?>">
            <label for="nome">Nome da Categoria:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($category["nome"]) ?>" required>
            <br>
            <button type="submit">Salvar Categoria</button>
        </form>
    </div>
</body>
</html>

