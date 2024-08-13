$(document).ready(function() {
    $('#table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json",
            "paginate": {
                "previous": "<",
                "next": ">"
            }
        },
        "dom": 'lBfrtip', // Incluir 'l' para activar el menú de longitud
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, "Todos"]], // Configurar opciones de longitud
        // "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, "Todos"]]

        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});



