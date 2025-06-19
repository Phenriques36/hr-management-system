<!DOCTYPE html>
<html lang="pt">
  <?php
session_start();

if (!isset($_SESSION['user_nome'])) {
    header('Location: index.html');
    exit;
}

$nome = htmlspecialchars($_SESSION['user_nome']);
?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bem-vindo, <?= $nome ?></title>
  <link rel="stylesheet" href="styles/dashboard.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
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
      <button id="toggleInfoBtn">Mostrar Info do Projeto</button>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Header (matches top bar in image) -->
      <header class="header-bar">
        <span>Bem-vindo, <?= $nome ?></span>
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
          <h3>Pedidos Pendentes</h3>
          <div class="kpi-value">5</div>
        </section>
        <section class="kpi-card wide">
          <span class="material-symbols-outlined expand-icon" title="Expandir">open_in_full</span>      
          <h3>Relatório Resumido</h3>
          <ul class="recent-list">
            <li>João Silva <span class="status pendente">pendente</span></li>
            <li>Maria Costa <span class="status aprovado">aprovado</span></li>
            <li>Pedro Santos <span class="status rejeitado">rejeitado</span></li>
            <li>Ana Lopes <span class="status pendente">pendente</span></li>
            <li>Carla Moura <span class="status aprovado">aprovado</span></li>
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
      <div id="projectInfo" style="display: none;">
  <h3>Descrição do Projeto</h3>
  <p>Este projeto consiste numa aplicação para gestão de funcionários, incluindo funcionalidades de adicionar, listar e editar dados.</p>
  <h4>Elementos do Grupo:</h4>
  <ul>
    <li>Paulo Henriques</li>
    <li>Jorge Mêna</li>
  </ul>
</div>
    </main>
  </div>
  <script src="scripts/dashboard.js"></script>  
          <script src="scripts/infoprojeto.js"></script>
</body>
</html>