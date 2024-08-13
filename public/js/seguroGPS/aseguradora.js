document.getElementById('aseguradora').addEventListener('change', function() {
    var id_aseguradora = this.value;
    fetch('polizas/' + id_aseguradora)
        .then(response => response.json())
        .then(data => {
            var polizasSelect = document.getElementById('poliza');
            polizasSelect.innerHTML = '';
            data.forEach(poliza => {
                var option = document.createElement('option');
                option.value = poliza.id_poliza_seguro;
                option.textContent = poliza.nombre_poliza;
                polizasSelect.appendChild(option);
            })
        })
        .catch(error => console.error('Error:', error));
});
