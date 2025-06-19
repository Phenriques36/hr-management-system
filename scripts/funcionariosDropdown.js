function loadFuncionariosDropdown() {
  fetch('scripts/lista_funcionarios.php')
    .then(response => response.text())
    .then(html => {
      const select = document.getElementById('modal-funcionario');
      if (!select) return;
      select.innerHTML = '';

      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const rows = doc.querySelectorAll('table tr');

      // Skip the header row
      for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].querySelectorAll('td');
        if (cells.length > 0) {
          const nome = cells[0].textContent.trim();
          const idInput = cells[4]?.querySelector('input[name="id"]');
          const id = idInput ? idInput.value : '';

          if (id && nome) {
            const opt = document.createElement('option');
            opt.value = id;
            opt.textContent = nome;
            select.appendChild(opt);
          }
        }
      }

      if (select.options.length === 0) {
        select.innerHTML = '<option value="">Nenhum funcionário encontrado</option>';
      }
    })
    .catch(() => {
      const select = document.getElementById('modal-funcionario');
      if (select) {
        select.innerHTML = '<option value="">Erro ao carregar funcionários</option>';
      }
    });
}

function openPermissaoModal(edit = false, id = '', funcionarioId = '', nivel = '') {
  document.getElementById('permissao-modal').style.display = 'flex';
  document.getElementById('modal-title').textContent = edit ? 'Editar Permissão' : 'Adicionar Permissão';
  document.getElementById('modal-id').value = id || '';
  document.getElementById('modal-msg').textContent = '';
  loadFuncionariosDropdown();

  // Set the selected option after loading
  if (edit && funcionarioId) {
    const select = document.getElementById('modal-funcionario');
    if (select) {
      select.value = funcionarioId;
    }
  }

  document.getElementById('modal-nivel').value = nivel || 'leitura';
}

function closePermissaoModal() {
  document.getElementById('permissao-modal').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
  loadFuncionariosDropdown();

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
    const url = id ? 'scripts/editar_permissao.php' : 'scripts/adicionar_permissoes.php';
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
});