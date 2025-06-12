<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestão de RH - Dashboard</title>
  <link rel="stylesheet" href="styles/dashboard.css" />
</head>
<body>
  <div class="dashboard-layout">
    <!-- Sidebar -->
    <nav class="sidebar">
      <h2>Menu</h2>
      <ul>
        <li><a href="#" class="active">Dashboard</a></li>
        <li><a href="ferias.html">Pedido de férias</a></li>
        <li><a href="funcionarios.php">Gestão de funcionários</a></li>
        <li><a href="permissoes.html">Gestão de permissões</a></li>
        <li><a href="relatorios.html">Relatórios</a></li>
      </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Header (matches top bar in image) -->
      <header class="header-bar">
        <span>Bem-vindo, [Nome do Usuário]</span>
      </header>

      <div class="dashboard-widgets">
        <!-- Left: Main KPIs/statistics -->
        <section class="kpi-card destaque">
        <h3>Funcionários Ativos</h3>
        <div class="kpi-value">
          <?php include 'scripts/funcionariosAtivos.php'; ?>
        </div>
</section>

        <section class="kpi-card">
          <h3>Pedidos de Férias Pendentes</h3>
          <div class="kpi-value">7</div>
        </section>
        <section class="kpi-card wide">
          <h3>Últimos Pedidos de Férias</h3>
          <ul class="recent-list">
            <li>Maria Silva — 12-16 Jun 2025 <span class="status pendente">Pendente</span></li>
            <li>João Costa — 20-27 Jun 2025 <span class="status aprovado">Aprovado</span></li>
            <li>Ana Lima — 1-5 Jul 2025 <span class="status pendente">Pendente</span></li>
          </ul>
        </section>
      </div>

      <!-- Large block for chart or report -->
      <section class="dashboard-report">
        <h3>Resumo Mensal</h3>
        <p>
          <strong>Contratações:</strong> 3<br>
          <strong>Saídas:</strong> 1<br>
          <strong>Total de pedidos de férias:</strong> 14
        </p>
        <!-- You can insert a chart or visual summary here -->
      </section>
    </main>
  </div>
</body>
</html>