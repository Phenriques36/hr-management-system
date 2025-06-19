document.addEventListener('DOMContentLoaded', function () {
  const wideCard = document.querySelector('.kpi-card.wide');
  const expandIcon = wideCard.querySelector('.expand-icon');

  expandIcon.addEventListener('click', function () {
    wideCard.classList.toggle('expanded');
    // Optionally swap icon between expand/collapse
    if (wideCard.classList.contains('expanded')) {
      expandIcon.textContent = 'close_fullscreen';
    } else {
      expandIcon.textContent = 'open_in_full';
    }
  });

  // Estado de pedidos de férias
  document.querySelectorAll('.recent-list .btn-estado').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const li = btn.closest('li');
      const id = li.getAttribute('data-id');
      const select = li.querySelector('.estado-select');
      const estado = select.value;
      fetch('scripts/atualizar_estado_ferias.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id=${encodeURIComponent(id)}&estado=${encodeURIComponent(estado)}`
      })
      .then(response => response.text())
      .then(result => {
        if (result.trim() === 'ok') {
          // Atualiza o texto e a classe do status
          const statusSpan = li.querySelector('.status');
          statusSpan.textContent = estado;
          statusSpan.className = 'status ' + estado;
        } else {
          alert('Erro ao atualizar estado: ' + result);
        }
      });
    });
  });
});