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

    <style>
        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            min-width: 220px;
            flex: 1;
            max-width: 280px;
            transition: transform .2s ease;
        }
        .card:hover {
            transform: translateY(-4px);
        }
        .card h3 {
            margin: 0 0 10px 0;
            font-size: 18px;
        }
        .card .valor {
            font-size: 22px;
            font-weight: bold;
        }
        .grafico-box {
            margin-top: 40px;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
    </style>
    <?php
        $saldo_atual = 0;
        if (!empty($contas)):
            $total_saldo = 0;
            foreach ($contas as $conta) {
                $total_saldo += $conta['saldo'];
            }
            $saldo_atual = $total_saldo;
        endif;
        
    ?>


    <div>
        <h2>Visão Geral das Finanças</h2>
        <div class="cards">
            <div class="card" style="background-color: #0dfd7f7d;">
                <h3>Saldo Atual</h3>
                <div class="valor">
                    R$ <?= number_format($saldo_atual ?? 0, 2, ',', '.')?>
                </div>
            </div>
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3 class="m-0">Total de Ganhos</h3>
                    <small class="text-muted">Últimos 30 dias</small>
                </div>
                <div class="valor" style="color: #2ecc71;">
                    R$ <?= number_format($ganhos ?? 0, 2, ',', '.') ?>
                </div>
            </div>
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3 class="m-0">Total de Prejuízos</h3>
                    <small class="text-muted">Últimos 30 dias</small>
                </div>
                <div class="valor" style="color: #e74c3c;">
                    R$ <?= number_format($prejuizos ?? 0, 2, ',', '.') ?>
                </div>
            </div>
        </div>
        <?php if (!empty($contas)): ?>
            <br>
            <h5>Saldo em contas:</h5>
            <div class="cards">
                <?php foreach ($contas as $conta): ?>
                    <div class="card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3><?= htmlspecialchars($conta['nome']) ?></h3>
                            <?php if ($conta['status'] == 0): ?>
                                <span class="badge bg-secondary">Inativa</span>
                            <?php endif; ?>
                        </div>
                        <div class="valor">
                            R$ <?= number_format($conta['saldo'], 2, ',', '.') ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Você ainda não adicionou nenhuma conta. <a href="<?= base_url('accounts/create') ?>">Adicionar Conta</a></p>
        <?php endif; ?>

        <div class="grafico-box">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3>Ganhos x Prejuízos</h3>
                <small class="text-muted">Últimos 30 dias</small>
            </div>
            <canvas id="graficoFinanceiro" height="120"></canvas>
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoFinanceiro').getContext('2d');

    const grafico = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Ganhos', 'Prejuízos'],
            datasets: [{
                label: 'R$',
                data: [
                    <?= $ganhos ?? 0 ?>,
                    <?= $prejuizos ?? 0 ?>
                ],
                backgroundColor: ['#2ecc71', '#e74c3c'],
                borderRadius: 8,
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

    </div>
</body>
</html>
