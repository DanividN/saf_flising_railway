document.getElementById('estado').addEventListener('change', function() {
    var id_estado = this.value;
    fetch('/configuracion/gps/municipios/' + id_estado)
        .then(response => response.json())
        .then(data => {
            var municipiosSelect = document.getElementById('municipio');
            municipiosSelect.innerHTML = '';
            data.forEach(municipio => {
                var option = document.createElement('option');
                option.value = municipio.id_municipio;
                option.textContent = municipio.nombre_municipio;
                municipiosSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
});
