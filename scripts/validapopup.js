document.addEventListener('DOMContentLoaded', function () {
  const popup = document.getElementById("popup");
  const form = document.getElementById("formPopup");


  const campos = form.querySelectorAll('input[name="nome"], input[name="telemovel"], input[name="email"], input[name="morada"]');
  const addBtn = document.getElementById("addBtn");
  const cancelBtn = document.getElementById("cancelBtn");

  addBtn.addEventListener("click", function () {
    popup.style.display = "flex";
  });

  cancelBtn.addEventListener("click", function () {
    popup.style.display = "none";
    form.reset();
  
    campos.forEach(campo => {
      campo.style.border = "";
    });
  });

  function validarPopup() {
    let valido = true;

    campos.forEach(campo => {
      if (!campo.value.trim()) {
        campo.style.border = "2px solid #f5604c";
        valido = false;
      } else {
        campo.style.border = "";
      }
    });

    return valido;
  }

  form.addEventListener("submit", function (e) {
    if (!validarPopup()) {
      e.preventDefault();
    }
  });

 
  campos.forEach(campo => {
    campo.addEventListener("input", function () {
      if (campo.value.trim()) {
        campo.style.border = "";
      }
    });
  });
});
