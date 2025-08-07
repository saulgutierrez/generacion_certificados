// Obtenemos el id del usuario tomandolo desde la variable de sesion oculta en el MainHeader
var usu_id = $('#user_idx').val();

$(document).ready(function () {
    $('#cursos_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/curso.php?op=listar",
            type: "POST"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":          "Procesando...",
            "sLengthMenu":          "Mostrar _MENU_ registros",
            "sZeroRecords":         "No se encontraron resultados",
            "sEmptyTable":          "Ningun dato disponible en esta tabla",
            "sInfo":                "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":           "Mostrando registros del 0 al 0 de un total del 0 registros",
            "sInfoFiltered":        "(filtrado de un total de _MAX_registros)",
            "sInfoPostFix":         "",
            "sSearch":              "Buscar:",
            "sUrl":                 "",
            "sInfoThousands":       ",",
            "sLoadingRecords":       "Cargando...",
            "oPaginate": {
                "sFirst":       "Primero",
                "sLast":        "Ultimo",
                "sNext":        "Siguiente",
                "sPrevious":    "Anterior",
            },
            "oAria": {
                "sSortAscending":   ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending":  ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
});

function editar(cur_id) {

}

function eliminar(cur_id) {

}