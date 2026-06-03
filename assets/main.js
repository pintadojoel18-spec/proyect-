// Se ejecuta cuando el DOM está completamente cargado
$(document).ready(function() {

    // Inicializar DataTables en cualquier tabla con la clase 'datatable'
    $('.datatable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json' // Traducción al español
        }
    });

    // Inicializar Select2 en cualquier select con la clase 'select2'
    $('.select2').select2({
        theme: "bootstrap-5",
        width: '100%'
    });

});