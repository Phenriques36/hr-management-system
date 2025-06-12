function atualizarKPIFuncionarios() {
  fetch('funcionarriosAtivos.php')
    .then(response => response.json())
    .then(data => {
      if (data.total !== undefined) {
        document.getElementById('kpi-funcionarios').textContent = data.total;
      } else {
        document.getElementById('kpi-funcionarios').textContent = 'Erro';
      }
    })
    .catch(err => {
      document.getElementById('kpi-funcionarios').textContent = 'Erro';
    });
}

atualizarKPIFuncionarios();
