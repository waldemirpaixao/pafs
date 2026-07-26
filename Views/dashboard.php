<?php
// Define os nomes dos meses
$meses = array(
    1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
    5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
    9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
);
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #f8f9fa;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    }

    .dashboard-container {
        padding: 30px;
        background: #f8f9fa;
        min-height: 100vh;
    }

    /* HEADER */
    .dashboard-header {
        margin-bottom: 30px;
    }

    .dashboard-header h1 {
        font-size: 28px;
        color: #1a1a1a;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .dashboard-header p {
        font-size: 14px;
        color: #999;
    }

    /* KPI CARDS */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .kpi-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        border-left: 4px solid #667eea;
        transition: box-shadow 0.3s ease;
    }

    .kpi-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .kpi-card.success {
        border-left-color: #10b981;
    }

    .kpi-card.warning {
        border-left-color: #f59e0b;
    }

    .kpi-card.danger {
        border-left-color: #ef4444;
    }

    .kpi-label {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .kpi-value {
        font-size: 32px;
        color: #1a1a1a;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .kpi-subtitle {
        font-size: 13px;
        color: #666;
    }

    /* SECTION */
    .section {
        background: white;
        border-radius: 8px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::before {
        content: '';
        width: 4px;
        height: 20px;
        background: #667eea;
        border-radius: 2px;
    }

    /* GRID DE 2 COLUNAS PARA DADOS FINANCEIROS */
    .data-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }

    .data-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 6px;
        border-left: 3px solid #e0e0e0;
    }

    .data-item.success {
        border-left-color: #10b981;
    }

    .data-item.warning {
        border-left-color: #f59e0b;
    }

    .data-item.danger {
        border-left-color: #ef4444;
    }

    .data-label {
        font-size: 13px;
        color: #666;
        font-weight: 500;
    }

    .data-value {
        font-size: 18px;
        color: #1a1a1a;
        font-weight: 700;
    }

    /* GRID DE 3 COLUNAS PARA CONTRATOS */
    .contract-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    /* RESPONSIVO */
    @media (max-width: 1024px) {
        .kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .data-grid {
            grid-template-columns: 1fr;
        }

        .contract-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .kpi-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-header h1 {
            font-size: 22px;
        }

        .kpi-value {
            font-size: 24px;
        }

        .contract-grid {
            grid-template-columns: 1fr;
        }
    }

    .text-success {
        color: #10b981;
    }

    .text-warning {
        color: #f59e0b;
    }

    .text-danger {
        color: #ef4444;
    }
</style>

<div class="dashboard-container">
    <!-- HEADER -->
    <div class="dashboard-header">
        <h1>📊 Dashboard Financeiro</h1>
        <p>Última atualização: <?php echo date('d/m/Y H:i'); ?></p>
    </div>

    <!-- KPI CARDS -->
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-label">Total de Clientes</div>
            <div class="kpi-value"><?php echo isset($totalClientes) ? number_format($totalClientes, 0, ',', '.') : '0'; ?></div>
            <div class="kpi-subtitle">👥 Ativos: <?php echo isset($clientesAtivos) ? $clientesAtivos : '0'; ?></div>
        </div>

        <div class="kpi-card success">
            <div class="kpi-label">Dependentes</div>
            <div class="kpi-value"><?php echo isset($totalDependentes) ? number_format($totalDependentes, 0, ',', '.') : '0'; ?></div>
            <div class="kpi-subtitle">Beneficiários ativos</div>
        </div>

        <div class="kpi-card warning">
            <div class="kpi-label">Planos Ativos</div>
            <div class="kpi-value"><?php echo isset($planosAtivos) ? number_format($planosAtivos, 0, ',', '.') : '0'; ?></div>
            <div class="kpi-subtitle">📊 Inativos: <?php echo isset($planosInativos) ? $planosInativos : '0'; ?></div>
        </div>

        <div class="kpi-card danger">
            <div class="kpi-label">Inadimplentes</div>
            <div class="kpi-value"><?php echo isset($inadimplentes) ? number_format($inadimplentes, 0, ',', '.') : '0'; ?></div>
            <div class="kpi-subtitle">⚠️ Com atraso</div>
        </div>
    </div>

    <!-- FATURAMENTO -->
    <div class="section">
        <div class="section-title">💰 Faturamento</div>
        <div class="data-grid">
            <div class="data-item success">
                <div class="data-label">Este Mês</div>
                <div class="data-value">
                    R$ <?php echo isset($faturamentoMes) ? number_format($faturamentoMes, 2, ',', '.') : '0,00'; ?>
                </div>
            </div>
            <div class="data-item success">
                <div class="data-label">Este Ano</div>
                <div class="data-value">
                    R$ <?php echo isset($faturamentoAno) ? number_format($faturamentoAno, 2, ',', '.') : '0,00'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- VENDAS -->
    <div class="section">
        <div class="section-title">📈 Vendas</div>
        <div class="data-grid">
            <div class="data-item">
                <div class="data-label">Este Mês</div>
                <div class="data-value">
                    <?php echo isset($vendasMes) ? number_format($vendasMes, 0, ',', '.') : '0'; ?>
                </div>
            </div>
            <div class="data-item">
                <div class="data-label">Este Ano</div>
                <div class="data-value">
                    <?php echo isset($vendasAno) ? number_format($vendasAno, 0, ',', '.') : '0'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- PAGAMENTOS -->
    <div class="section">
        <div class="section-title">💳 Pagamentos</div>
        <div class="data-grid">
            <div class="data-item success">
                <div class="data-label">Recebidos Este Mês</div>
                <div class="data-value">
                    R$ <?php echo isset($pagamentosRecebidos) ? number_format($pagamentosRecebidos, 2, ',', '.') : '0,00'; ?>
                </div>
            </div>
            <div class="data-item warning">
                <div class="data-label">A Receber</div>
                <div class="data-value">
                    R$ <?php echo isset($pagamentosAReceber) ? number_format($pagamentosAReceber, 2, ',', '.') : '0,00'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTRATOS E DESPESAS -->
    <div class="section">
        <div class="section-title">📋 Contratos & Despesas</div>
        <div class="contract-grid">
            <div class="data-item success">
                <div class="data-label">Contratos Ativos</div>
                <div class="data-value">
                    <?php echo isset($contratosAtivos) ? number_format($contratosAtivos, 0, ',', '.') : '0'; ?>
                </div>
            </div>
            <div class="data-item danger">
                <div class="data-label">Cancelados</div>
                <div class="data-value">
                    <?php echo isset($contratosCancelados) ? number_format($contratosCancelados, 0, ',', '.') : '0'; ?>
                </div>
            </div>
            <div class="data-item danger">
                <div class="data-label">Despesas Este Mês</div>
                <div class="data-value">
                    R$ <?php echo isset($despesasMes) ? number_format($despesasMes, 2, ',', '.') : '0,00'; ?>
                </div>
            </div>
        </div>
    </div>
</div>