<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <title>Dashboard - Sistema Financeiro e Produtividade</title>
</head>
<body>
    <?php include __DIR__ . '/../common/menu.php'; ?>
    <div class="content">
        <header class="header">
            <h1 class="title">Olá, <span><?= $user_name ?></span> 👋</h1>
            <p class="subtitle">Gerencie suas finanças e sua produtividade com estilo.</p>
        </header>
        <main class="dashboard">
            <div>
                <h2>Visão Geral das Finanças</h2>
                <?php if (!empty($contas)): ?>
                    <ul>
                        <?php foreach ($contas as $conta): ?>
                            <li><?= htmlspecialchars($conta['nome']) ?>: R$ <?= number_format($conta['saldo'], 2, ',', '.') ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Você ainda não adicionou nenhuma conta. <a href="<?= base_url('accounts/create') ?>">Adicionar Conta</a></p>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
