<!DOCTYPE html>
<html lang="pt-BR">



<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PAFS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2c3e50;
            --success: #27ae60;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #3498db;
            --light: #ecf0f1;
        }

        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header-dashboard {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .header-dashboard h1 {
            color: var(--primary);
            margin-bottom: 5px;
            font-weight: 700;
        }

        .header-dashboard p {
            color: #7f8c8d;
            margin-bottom: 0;
        }

        .kpi-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 5px solid;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .kpi-card.success {
            border-left-color: var(--success);
        }

        .kpi-card.danger {
            border-left-color: var(--danger);
        }

        .kpi-card.warning {
            border-left-color: var(--warning);
        }

        .kpi-card.info {
            border-left-color: var(--info);
        }

        .kpi-card .kpi-icon {
            font-size: 32px;
            margin-bottom: 15px;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: white;
        }

        .kpi-card.success .kpi-icon {
            background: rgba(39, 174, 96, 0.15);
            color: var(--success);
        }

        .kpi-card.danger .kpi-icon {
            background: rgba(231, 76, 60, 0.15);
            color: var(--danger);
        }

        .kpi-card.warning .kpi-icon {
            background: rgba(243, 156, 18, 0.15);
            color: var(--warning);
        }

        .kpi-card.info .kpi-icon {
            background: rgba(52, 152, 219, 0.15);
            color: var(--info);
        }

        .kpi-label {
            color: #7f8c8d;
            font-size: 13px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .kpi-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .kpi-change {
            font-size: 12px;
            color: #95a5a6;
        }

        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .chart-title i {
            margin-right: 10px;
            color: var(--info);
        }

        .table-container {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .table {
            margin-bottom: 0;
            font-size: 14px;
        }

        .table thead th {
            border-top: none;
            background: #f8f9fa;
            color: var(--primary);
            font-weight: 600;
            border-bottom: 2px solid #ecf0f1;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #ecf0f1;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-ativo {
            background: rgba(39, 174, 96, 0.1);
            color: var(--success);
        }

        .status-inativo {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger);
        }

        .status-pendente {
            background: rgba(243, 156, 18, 0.1);
            color: var(--warning);
        }

        .text-currency {
            font-weight: 600;
            color: var(--success);
        }

        .badge-custom {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .kpi-value {
                font-size: 24px;
            }

            .header-dashboard {
                padding: 20px;
            }

            .chart-container,
            .table-container {
                padding: 15px;
            }
        }

        .container-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .financeiro-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .currency-value {
            color: var(--success);
            font-weight: 700;
            font-size: 20px;
        }

        .negative-value {
            color: var(--danger);
        }
    </style>
</head>

<body>

    
    <div class="dashboard-container">
        <!-- Header -->
        <div class="header-dashboard">
            <h1><i class="fas fa-chart-line"></i> Dashboard</h1>
            <p>Bem-vindo, <strong><?php echo htmlspecialchars($_SESSION['nomeColaboradores']); ?></strong> - <?php echo htmlspecialchars($_SESSION['nomeEmpresa']); ?></p>
        </div>

        <!-- KPIs Principais -->
        <div class="container-row">
            <div class="kpi-card success">
                <div class="kpi-icon"><i class="fas fa-users"></i></div>
                <div class="kpi-label">Clientes Ativos</div>
                <div class="kpi-value"><?php echo isset($clientesAtivos) ? number_format($clientesAtivos) : '0'; ?></div>
                <div class="kpi-change">Total: <?php echo isset($totalClientes) ? number_format($totalClientes) : '0'; ?> clientes</div>
            </div>

            <div class="kpi-card info">
                <div class="kpi-icon"><i class="fas fa-people-carry"></i></div>
                <div class="kpi-label">Dependentes</div>
                <div class="kpi-value"><?php echo isset($totalDependentes) ? number_format($totalDependentes) : '0'; ?></div>
                <div class="kpi-change">Registrados no sistema</div>
            </div>

            <div class="kpi-card success">
                <div class="kpi-icon"><i class="fas fa-heartbeat"></i></div>
                <div class="kpi-label">Planos Ativos</div>
                <div class="kpi-value"><?php echo isset($planosAtivos) ? number_format($planosAtivos) : '0'; ?></div>
                <div class="kpi-change"><?php echo isset($planosInativos) ? number_format($planosInativos) : '0'; ?> inativos</div>
            </div>

            <div class="kpi-card warning">
                <div class="kpi-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="kpi-label">Inadimplentes</div>
                <div class="kpi-value"><?php echo isset($inadimplentes) ? number_format($inadimplentes) : '0'; ?></div>
                <div class="kpi-change">Atenção necessária</div>
            </div>
        </div>

        <!-- Financeiro -->
        <div class="financeiro-row">
            <div class="kpi-card success">
                <div class="kpi-icon"><i class="fas fa-money-bill-wave"></i></div>
                <div class="kpi-label">Faturamento do Mês</div>
                <div class="kpi-value currency-value">R$ <?php echo isset($faturamentoMes) ? number_format($faturamentoMes, 2, ',', '.') : '0,00'; ?></div>
                <div class="kpi-change">Ano: R$ <?php echo isset($faturamentoAno) ? number_format($faturamentoAno, 2, ',', '.') : '0,00'; ?></div>
            </div>

            <div class="kpi-card success">
                <div class="kpi-icon"><i class="fas fa-check-circle"></i></div>
                <div class="kpi-label">Pagamentos Recebidos</div>
                <div class="kpi-value currency-value">R$ <?php echo isset($pagamentosRecebidos) ? number_format($pagamentosRecebidos, 2, ',', '.') : '0,00'; ?></div>
                <div class="kpi-change">Este mês</div>
            </div>

            <div class="kpi-card warning">
                <div class="kpi-icon"><i class="fas fa-hourglass-half"></i></div>
                <div class="kpi-label">A Receber</div>
                <div class="kpi-value currency-value">R$ <?php echo isset($pagamentosAReceber) ? number_format($pagamentosAReceber, 2, ',', '.') : '0,00'; ?></div>
                <div class="kpi-change">Pendente</div>
            </div>

            <div class="kpi-card danger">
                <div class="kpi-icon"><i class="fas fa-shopping-cart"></i></div>
                <div class="kpi-label">Vendas do Mês</div>
                <div class="kpi-value"><?php echo isset($vendasMes) ? number_format($vendasMes) : '0'; ?></div>
                <div class="kpi-change">Total anual: <?php echo isset($vendasAno) ? number_format($vendasAno) : '0'; ?></div>
            </div>
        </div>

        <!-- Gráficos -->
        <div class="row">
            <div class="col-lg-6">
                <div class="chart-container">
                    <div class="chart-title">
                        <i class="fas fa-chart-bar"></i> Faturamento por Mês
                    </div>
                    <canvas id="faturamentoChart"></canvas>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="chart-container">
                    <div class="chart-title">
                        <i class="fas fa-chart-pie"></i> Status de Pagamentos
                    </div>
                    <canvas id="statusPagamentosChart"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="chart-container">
                    <div class="chart-title">
                        <i class="fas fa-shopping-bag"></i> Vendas Mensais
                    </div>
                    <canvas id="vendasChart"></canvas>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="chart-container">
                    <div class="chart-title">
                        <i class="fas fa-doughnut"></i> Contratos
                    </div>
                    <canvas id="contratosChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabela de Inadimplentes -->
        <div class="table-container">
            <div class="chart-title">
                <i class="fas fa-list"></i> Resumo Financeiro
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><i class="fas fa-cube"></i> Métrica</th>
                        <th class="text-end"><i class="fas fa-coins"></i> Valor</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Despesas do Mês</td>
                        <td class="text-end text-danger">
                            <strong>R$ <?php echo isset($despesasMes) ? number_format($despesasMes, 2, ',', '.') : '0,00'; ?></strong>
                        </td>
                        <td class="text-center">
                            <span class="badge-custom status-inativo">Saída</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Contratos Ativos</td>
                        <td class="text-end text-success">
                            <strong><?php echo isset($contratosAtivos) ? number_format($contratosAtivos) : '0'; ?></strong>
                        </td>
                        <td class="text-center">
                            <span class="badge-custom status-ativo">Ativo</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Contratos Cancelados</td>
                        <td class="text-end text-danger">
                            <strong><?php echo isset($contratosCancelados) ? number_format($contratosCancelados) : '0'; ?></strong>
                        </td>
                        <td class="text-center">
                            <span class="badge-custom status-inativo">Inativo</span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Margem Líquida (Mês)</strong></td>
                        <td class="text-end">
                            <strong class="currency-value">R$ <?php echo isset($faturamentoMes, $despesasMes) ? number_format(($faturamentoMes - $despesasMes), 2, ',', '.') : '0,00'; ?></strong>
                        </td>
                        <td class="text-center">
                            <span class="badge-custom status-ativo">Resultado</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Dados para os gráficos (será preenchido pelo PHP)
        const vendasPorMes = <?php echo isset($vendasPorMes) ? json_encode($vendasPorMes) : '[]'; ?>;
        const faturamentoPorMes = <?php echo isset($faturamentoPorMes) ? json_encode($faturamentoPorMes) : '[]'; ?>;
        const statusPagamentos = <?php echo isset($statusPagamentos) ? json_encode($statusPagamentos) : '{}'; ?>;

        // Gráfico de Faturamento
        const faturamentoCtx = document.getElementById('faturamentoChart').getContext('2d');
        new Chart(faturamentoCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: 'Faturamento (R$)',
                    data: faturamentoPorMes && faturamentoPorMes.length > 0 ? faturamentoPorMes : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    backgroundColor: '#27ae60',
                    borderColor: '#229954',
                    borderWidth: 1,
                    borderRadius: 5,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'R$ ' + value.toLocaleString('pt-BR');
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Status de Pagamentos
        const statusCtx = document.getElementById('statusPagamentosChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Recebido', 'Pendente', 'Atrasado'],
                datasets: [{
                    data: statusPagamentos && Object.keys(statusPagamentos).length > 0 ?
                        [statusPagamentos.recebido || 0, statusPagamentos.pendente || 0, statusPagamentos.atrasado || 0] :
                        [0, 0, 0],
                    backgroundColor: ['#27ae60', '#f39c12', '#e74c3c'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Vendas
        const vendasCtx = document.getElementById('vendasChart').getContext('2d');
        new Chart(vendasCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: 'Vendas',
                    data: vendasPorMes && vendasPorMes.length > 0 ? vendasPorMes : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#3498db',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gráfico de Contratos
        const contratosCtx = document.getElementById('contratosChart').getContext('2d');
        new Chart(contratosCtx, {
            type: 'doughnut',
            data: {
                labels: ['Ativos', 'Cancelados'],
                datasets: [{
                    data: [<?php echo isset($contratosAtivos) ? $contratosAtivos : '0'; ?>, <?php echo isset($contratosCancelados) ? $contratosCancelados : '0'; ?>],
                    backgroundColor: ['#27ae60', '#e74c3c'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>