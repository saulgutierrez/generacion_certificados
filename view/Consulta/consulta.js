function init() {

}

$(document).ready(function () {
    $('#divpanel').hide();
});

$(document).on("click", "#btnconsultar", function () {
    var usu_dni = $("#usu_dni").val();
    if (usu_dni.length == 0) {
        Swal.fire({
                    title: 'Error!',
                    text: 'DNI vacio',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                })
    } else {
        $.post("../../controller/usuario.php?op=consulta_dni", {usu_dni: usu_dni}, function (data) {
            if (data.length > 0) {
                data = JSON.parse(data);
                console.log(data);
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
                        url: "../../controller/usuario.php?op=listar_cursos_top10",
                        type: "POST",
                        data: {
                            usu_id:data.usu_id
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
                $('#divpanel').show();
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'No existe usuario',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    }
});