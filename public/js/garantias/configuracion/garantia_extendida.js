function validarPDF() {
  let input = document.getElementById('archivo-input');
  let archivo = input.files[0];
  let extension = archivo.name.split('.').pop().toLowerCase();

  if (extension !== 'pdf') {
      Swal.fire('Por favor, selecciona un formato PDF.');
      input.value = '';
      return false;
  }
}

function actualizarValorActivo() {
  var checkbox = document.getElementById('activo');
  var activoHidden = document.getElementById('activo_hidden');
  var labelEstatus = document.getElementById('labelEstatus');

  if (checkbox.checked) {
      activoHidden.value = '1';
      labelEstatus.textContent = 'Activo';
  } else {
      activoHidden.value = '0';
      labelEstatus.textContent = 'Inactivo';
  }
}
function formatearCantidad(input) {
  let valor = input.value.replace(/,/g, '');
  if (!isNaN(valor) && valor.trim() !== '') {
      const partes = valor.split('.');
      partes[0] = Number(partes[0]).toLocaleString('en-US');
      input.value = partes.join('.');
  }
} 

const inputMonto = document.getElementById('monto_g_extendida');
inputMonto.addEventListener('input', function() {
  formatearCantidad(this);
});

/**Modal */
