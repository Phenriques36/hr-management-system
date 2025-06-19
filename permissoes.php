<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestão de Permissões</title>
  <link rel="stylesheet" href="styles/permissoes.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
  <div class="container">
    <div class="sidebar">
      <h2>Menu</h2>
      <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="ferias.html">Pedido de férias</a></li>
        <li><a href="funcionarios.php">Gestão de funcionários</a></li>
        <li><a href="#" class="active">Gestão de permissões</a></li>
        <li><a href="relatorios.html">Relatórios</a></li>
      </ul>
    </div>
    <div class="main">
      <header class="header-bar">
        <span>Gestão de permissões</span>
      </header>

      <div class="acoes">
        <button class="botao">+ Adicionar permissão</button>
      </div>

      <table class="tabela">
        <thead>
          <tr>
            <th>Utilizador</th>
            <th>Permissão</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php include 'scripts/lista_permissoes.php'; ?>
        </tbody>
      </table>

      <div id="permissao-modal" class="modal" style="display:none;">
        <div class="modal-content">
          <span class="close-modal" style="float:right;cursor:pointer;font-size:1.5em;">&times;</span>
          <h2 id="modal-title">Adicionar Permissão</h2>
          <form id="permissao-form">
            <label for="modal-funcionario">Funcionário:</label>
            <select id="modal-funcionario" required></select>
            <label for="modal-nivel">Permissão:</label>
            <select id="modal-nivel" required>
              <option value="leitura">Leitura</option>
              <option value="edicao">Edição</option>
              <option value="admin">Admin</option>
            </select>
            <input type="hidden" id="modal-id" value="">
            <button type="submit" id="modal-save" style="margin-top:12px;">Guardar</button>
            <div id="modal-msg" style="margin-top:10px;color:#b00;"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="scripts/funcionariosDropdown.js"></script>
  <script>
function openPermissaoModal(edit = false, id = '', funcionarioId = '', nivel = '') {
  document.getElementById('permissao-modal').style.display = 'flex';
  document.getElementById('modal-title').textContent = edit ? 'Editar Permissão' : 'Adicionar Permissão';
  document.getElementById('modal-id').value = id || '';
  document.getElementById('modal-msg').textContent = '';
  loadFuncionariosDropdown();
  document.getElementById('modal-nivel').value = nivel || 'leitura';
}

function closePermissaoModal() {
  document.getElementById('permissao-modal').style.display = 'none';
}

document.querySelector('.botao').onclick = function() {
  openPermissaoModal(false);
};

document.querySelector('.close-modal').onclick = closePermissaoModal;
window.onclick = function(event) {
  if (event.target === document.getElementById('permissao-modal')) closePermissaoModal();
};

document.getElementById('permissao-form').onsubmit = function(e) {
  e.preventDefault();
  const id = document.getElementById('modal-id').value;
  const funcionario = document.getElementById('modal-funcionario').value;
  const nivel = document.getElementById('modal-nivel').value;
  const url = id ? 'scripts/editar_permissao.php' : 'scripts/adicionar_permissao.php';
  fetch(url, {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({ id, funcionario, nivel })
  })
  .then(r => r.json())
  .then(data => {
    const msgDiv = document.getElementById('modal-msg');
    if (data.success) {
      msgDiv.style.color = "#2a7a2a";
      msgDiv.textContent = data.message || "Permissão guardada com sucesso!";
      setTimeout(() => {
        closePermissaoModal();
        location.reload();
      }, 1000);
    } else {
      msgDiv.style.color = "#b00";
      msgDiv.textContent = data.error || 'Erro ao guardar permissão.';
    }
  });
};

document.querySelectorAll('.editar').forEach(btn => {
  btn.onclick = function() {
    const row = btn.closest('tr');
    const id = btn.dataset.id;
    const utilizadorNome = row.children[0].textContent.trim();
    const nivel = row.children[1].textContent.trim().toLowerCase();
    // Find utilizador id by name (could be improved)
    fetch('scripts/lista_funcionarios.php')
      .then(response => response.text())
      .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const rows = doc.querySelectorAll('table tr');
        let funcionarioId = '';
        for (let i = 1; i < rows.length; i++) {
          const cells = rows[i].querySelectorAll('td');
          if (cells.length > 0) {
            const idInput = cells[4]?.querySelector('input[name="id"]');
            const idVal = idInput ? idInput.value : '';
            const nome = cells[0].textContent.trim();
            if (nome === utilizadorNome) {
              funcionarioId = idVal;
              break;
            }
          }
        }
        openPermissaoModal(true, id, funcionarioId, nivel);
      });
  };
});
</script>
</body>
</html>
