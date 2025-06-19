document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('loginForm');
  const emailInput = form.querySelector('input[name="email"]');
  const passwordInput = form.querySelector('input[name="password"]');


  function validarCampos() {
    let valid = true;

    if (!emailInput.value.trim()) {
      emailInput.style.border = '2px solid #f5604c';
      valid = false;
    } else {
      emailInput.style.border = '';
    }

    if (!passwordInput.value.trim()) {
      passwordInput.style.border = '2px solid #f5604c';
      valid = false;
    } else {
      passwordInput.style.border = '';
    }

    return valid;
  }

  // Valida quando o formulário for enviado
  form.addEventListener('submit', function (event) {
    if (!validarCampos()) {
      event.preventDefault();
    }
  });

  // Remove borda vermelha quando o utilizador começa a escrever e o campo fica válido
  emailInput.addEventListener('input', function () {
    if (emailInput.value.trim()) {
      emailInput.style.border = '';
    }
  });

  passwordInput.addEventListener('input', function () {
    if (passwordInput.value.trim()) {
      passwordInput.style.border = '';
    }
  });
});
