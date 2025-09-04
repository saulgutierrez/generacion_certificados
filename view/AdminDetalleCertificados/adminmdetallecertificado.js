// Obtenemos el id del usuario tomandolo desde la variable de sesion oculta en el MainHeader
var usu_id = $('#user_idx').val();

function init() {

}

$(document).ready(function () {
    // Indicar al select que se encuentra dentro de un modal
    $('#cur_id').select2();
    combo_curso()

    // Obtener id de combocurso
    $('#cur_id').on("change", function () {
        $('#cur_id option:selected').each(function() {
            cur_id = $(this).val();

            // Listado de DataTable
            $('#detalle_data').DataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                ],
                "ajax": {
                    url: "../../controller/usuario.php?op=listar_cursos_usuario",
                    type: "POST",
                    data: {
                        cur_id:cur_id
                    },
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
    });


    $('#usuario_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/usuario.php?op=listar",
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

function eliminar(usu_id) {
    Swal.fire({
        title: "Eliminar",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/usuario.php?op=eliminar", {usu_id: usu_id}, function (data) {
                console.log(data);
                $('#usuario_data').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Correcto',
                    text: 'Se elimino correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            });
        }
    });
}

function combo_curso() {
    // Retornamos un objeto html y lo incrustamos en el DOM
    $.post("../../controller/curso.php?op=combo", function (data) {
        $('#cur_id').html(data);
    });
}

init();