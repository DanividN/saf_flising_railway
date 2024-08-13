$(document).ready(function() {
    $('#tabla').DataTable({
        "autoWidth": false,
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": 'Mostrar <select style="background:white">' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="50">50</option>' +
                '<option value="100">100</option>' +
                '</select> registros',
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmty": "",
            "infoFiltered": ""
        }
    });
});

$(document).ready(function() {
    $('#tabla_serv').DataTable({
        "autoWidth": false,
        ordering: false,
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": 'Mostrar <select style="background:white">' +
                '<option value="15">15</option>' +
                '<option value="30">30</option>' +
                '<option value="60">60</option>' +
                '<option value="100">100</option>' +
                '</select> registros',
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmty": "",
            "infoFiltered": ""
        },
        pageLength: 15
    });
});

$(document).ready(function() {
    $('#tabla_r').DataTable({
        "autoWidth": false,
        // "order": [[ 0, "DESC" ]],
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": 'Mostrar <select style="background:white">' +
                '<option value="25">25</option>' +
                '<option value="50">50</option>' +
                '<option value="75">75</option>' +
                '<option value="100">100</option>' +
                '</select> registros',
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmty": "",
            "infoFiltered": ""
        },
        pageLength: 25
    });
    $('#tabla_torres').DataTable({
        "autoWidth": false,
        "order": [[ 3, "DESC" ]],
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": 'Mostrar <select style="background:white">' +
                '<option value="25">25</option>' +
                '<option value="50">50</option>' +
                '<option value="75">75</option>' +
                '<option value="100">100</option>' +
                '</select> registros',
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmty": "",
            "infoFiltered": ""
        },
        pageLength: 25
    });

    $('#tabla_jimenez').DataTable({
        "autoWidth": false,
        "order": [[ 3, "DESC" ]],
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": 'Mostrar <select style="background:white">' +
                '<option value="25">25</option>' +
                '<option value="50">50</option>' +
                '<option value="75">75</option>' +
                '<option value="100">100</option>' +
                '</select> registros',
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmty": "",
            "infoFiltered": ""
        },
        pageLength: 25
    });
    $('#tabla_mateo').DataTable({
        "autoWidth": false,
        "order": [[ 3, "DESC" ]],
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": 'Mostrar <select style="background:white">' +
                '<option value="25">25</option>' +
                '<option value="50">50</option>' +
                '<option value="75">75</option>' +
                '<option value="100">100</option>' +
                '</select> registros',
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmty": "",
            "infoFiltered": ""
        },
        pageLength: 25
    });
    $('#tabla_calix').DataTable({
        "autoWidth": false,
        "order": [[ 3, "DESC" ]],
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": 'Mostrar <select style="background:white">' +
                '<option value="25">25</option>' +
                '<option value="50">50</option>' +
                '<option value="75">75</option>' +
                '<option value="100">100</option>' +
                '</select> registros',
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmty": "",
            "infoFiltered": ""
        },
        pageLength: 25
    });
});
