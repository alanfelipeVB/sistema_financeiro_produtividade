<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Gestão Financeira e Produtividade</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, <?= $user_name ?>!</h1>
        <p>Este é o seu dashboard. Aqui você pode gerenciar suas finanças e produtividade.</p>
        <nav>
            <ul>
                <li><a href="/transactions">Transações</a></li>
                <li><a href="/accounts">Contas</a></li>
                <li><a href="/categories">Categorias</a></li>
                <li><a href="/budgets">Orçamentos</a></li>
                <li><a href="/tasks">Tarefas</a></li>
                <li><a href="/events">Eventos</a></li>
                <li><a href="/notes">Notas</a></li>
                <li><a href="/logout">Sair</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>

