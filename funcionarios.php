<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Gestão de Funcionários</title>
  <link rel="stylesheet" href="styles/funcionarios.css">
</head>
<body>
  <div class="main-content">
    <h1>Gestão de Funcionários</h1>

    <button id="addBtn">Adicionar Funcionário</button>

    <!-- Tabela de Funcionários -->
    <div class="tabela-funcionarios">
      <?php include 'scripts/lista_funcionarios.php'; ?>
    </div>
  </div>

  <!-- Formulário popup -->
  <div id="popup" class="popup">
    <form class="form" action="scripts/adicionarfuncionario.php" method="POST">
      <h2>Adicionar Funcionário</h2>
      <input type="text" name="nome" placeholder="Nome" required>
      <input type="text" name="telemovel" placeholder="Telemóvel">
      <input type="email" name="email" placeholder="Email">
      <input type="text" name="morada" placeholder="Morada">
      <div class="botoes">
        <button type="submit">Guardar</button>
        <button type="button" onclick="fecharPopup()">Cancelar</button>
      </div>
    </form>
  </div>

  <script>
    document.getElementById("addBtn").onclick = function () {
      document.getElementById("popup").style.display = "flex";
    };

    function fecharPopup() {
      document.getElementById("popup").style.display = "none";
    }
  </script>
</body>
</html>