<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestão de Funcionários</title>
  <link rel="stylesheet" href="styles/funcionarios.css" />
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <h3>Menus</h3>
      <ul class="menu">
        <li><a href="dashboard.html">Dashboard</a></li>
        <li><a href="ferias.html">Pedido de férias</a></li>
        <li><a href="funcionarios.php" class="active">Gestão de funcionários</a></li>
        <li><a href="permissoes.html">Gestão de permissões</a></li>
        <li><a href="relatorios.html">Relatórios</a></li>
      </ul>

      <!-- Botão para mostrar/ocultar a descrição do projeto -->
      <button id="toggleInfoBtn">Mostrar Info do Projeto</button>
    </div>

    <!-- Conteúdo principal -->
    <div class="main-content">
      <h1>Gestão de Funcionários</h1>

      <button id="addBtn">Adicionar Funcionário</button>

      <!-- Tabela de Funcionários -->
      <div class="tabela-funcionarios">
        <?php include 'scripts/lista_funcionarios.php'; ?>
      </div>

      <!-- Caixa com a descrição e identificação do grupo -->
      <div id="projectInfo" style="display: none;">
        <h3>Descrição do Projeto</h3>
        <p>Este projeto consiste numa aplicação para gestão de funcionários, incluindo funcionalidades de adicionar, listar e editar dados.</p>
        <h4>Elementos do Grupo:</h4>
        <ul>
          <li>João Silva</li>
          <li>Maria Fernandes</li>
          <li>Pedro Costa</li>
          <!-- Adicione os nomes do seu grupo aqui -->
        </ul>
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
  <script src="scripts/infoProjeto.js"></script>
</body>
</html>
