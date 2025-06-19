<!DOCTYPE html>
<html lang="pt">
  
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestão de Funcionários</title>
  <link rel="stylesheet" href="styles/funcionarios.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=delete" />
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <h3>Menus</h3>
      <ul class="menu">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="ferias.html">Pedido de férias</a></li>
        <li><a href="funcionarios.php" class="active">Gestão de funcionários</a></li>
        <li><a href="permissoes.html">Gestão de permissões</a></li>
        <li><a href="relatorios.html">Relatórios</a></li>
      </ul>

    </div>

    <!-- Conteúdo principal -->
    <div class="main-content">
      <h1>Gestão de Funcionários</h1>

      <button id="addBtn">Adicionar Funcionário</button>

      <!-- Tabela de Funcionários -->
      <div class="tabela-funcionarios">
        <?php include 'scripts/lista_funcionarios.php'; ?>
      </div>

    
    </div>
  </div>

  <!-- Formulário popup -->
  <div id="popup" class="popup" style="display:none;">
    <form class="form" action="scripts/adicionarfuncionario.php" method="POST" id="formPopup">
      <h2>Adicionar Funcionário</h2>
      <input type="text" name="nome" placeholder="Nome" />
      <input type="text" name="telemovel" placeholder="Telemóvel" />
      <input type="email" name="email" placeholder="Email" />
      <input type="text" name="morada" placeholder="Morada" />
      <div class="botoes">
        <button type="submit">Guardar</button>
        <button type="button" id="cancelBtn">Cancelar</button>
      </div>
    </form>
  </div>

  <script src="scripts/validapopup.js"></script>
</body>
</html>
