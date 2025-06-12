document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn = document.getElementById('toggleInfoBtn');
  const projectInfo = document.getElementById('projectInfo');

  toggleBtn.addEventListener('click', () => {
    if (projectInfo.style.display === 'none' || projectInfo.style.display === '') {
      projectInfo.style.display = 'block';
      toggleBtn.textContent = 'Ocultar Info do Projeto';
    } else {
      projectInfo.style.display = 'none';
      toggleBtn.textContent = 'Mostrar Info do Projeto';
    }
  });
});