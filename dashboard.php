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
        <li><a href="permissoes.php">Gestão de permissões</a></li>
        <li><a href="relatorios.html">Relatórios</a></li>
      </ul>
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
          <h3>Pedidos de Férias</h3>
          <ul class="recent-list">
            <?php
            $db = new SQLite3('database/dados.db');
            $results = $db->query(
              "SELECT p.id, f.nome, p.estado 
               FROM pedidos_ferias p
               JOIN funcionarios f ON p.id_funcionario = f.id
               ORDER BY p.id DESC
               LIMIT 5"
            );
            while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
              $id = intval($row['id']);
              $nome = htmlspecialchars($row['nome']);
              $estado = htmlspecialchars($row['estado']);
              $classe = '';
              if ($estado === 'pendente') $classe = 'pendente';
              elseif ($estado === 'aprovado') $classe = 'aprovado';
              elseif ($estado === 'rejeitado') $classe = 'rejeitado';
              echo "<li data-id=\"{$id}\">{$nome} 
                <span class=\"status {$classe}\">{$estado}</span>
                <select class=\"estado-select\">
                  <option value=\"pendente\"".($estado=='pendente'?' selected':'').">pendente</option>
                  <option value=\"aprovado\"".($estado=='aprovado'?' selected':'').">aprovado</option>
                  <option value=\"rejeitado\"".($estado=='rejeitado'?' selected':'').">rejeitado</option>
                </select>
                <button class=\"btn-estado\">Salvar</button>
              </li>";
            }
            ?>
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
  <script src="scripts/dashboard.js"></script>        
</body>
</html>