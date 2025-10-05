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
        $("#cur_id option:selected").each(function () {
            cur_id = $(this).val();

            /* Listado de datatable */
            $('#detalle_data').DataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                ],
                "ajax":{
                    type:"GET",
                    data: cur_id,
                    url:"../../controller/usuario.php?op=listar_cursos_usuario&data="+cur_id,
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

function eliminar(curd_id) {
    Swal.fire({
        title: "Eliminar",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/curso.php?op=eliminar_curso_usuario", {curd_id: curd_id}, function (data) {
                $('#detalle_data').DataTable().ajax.reload();
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

function certificado(curd_id) {
    window.open('../Certificado/index.php?curd_id='+ curd_id+' ', '_blank');
}

function nuevo() {
    if ($('#cur_id').val() == '') {
        Swal.fire({
            title: 'Error',
            text: 'Seleccione curso',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    } else {
        var cur_id = $('#cur_id').val();
        listar_usuario(cur_id);
        $('#modalmantenimiento').modal('show');
    }
}

function listar_usuario(cur_id) {
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
            url: "../../controller/usuario.php?op=listar_detalle_usuario",
            type: "POST",
            data: {cur_id: cur_id},
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
}

function registrardetalle() {
    var usu_id = [];
    table = $('#usuario_data').DataTable();
    // Recorremos cada celda de la tabla para verificar si esta marcada como checked
    table.rows().every(function (rowIdx, tableLoop, rowLoop) {
        cell1 = table.cell({ row: rowIdx, column: 0 }).node();
        if ($('input', cell1).prop("checked") == true) {
            // En caso de que este marcado como checked, almacenamos su id
            id = $('input', cell1).val();
            usu_id.push([id]);
        }
    });

    if (usu_id == 0) {
        Swal.fire({
            title: 'Error',
            text: 'Seleccionar usuarios',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    } else {
        const formData = new FormData($("#detalle_check")[0]);
        formData.append('cur_id', cur_id);
        formData.append('usu_id', usu_id);

        $.ajax({
            url:    "../../controller/curso.php?op=insert_curso_usuario",
            type:   "POST",
            data:   formData,
            contentType:    false,
            processData:    false,
            success:        function(data) {
                data = JSON.parse(data);
                data.forEach(e => {
                    e.forEach(i => {
                        i.forEach(j => {
                            console.log(j['curd_id']);
                            $.ajax({
                                type: "POST",
                                url: "../../controller/curso.php?op=generar_qr",
                                data: {curd_id : j["curd_id"]},
                                dataType: "json"
                            });
                        });
                    });
                });
            }
        });

        // Recargar DataTable de los cursos de los usuarios que tienen acceso al certificado
        $('#detalle_data').DataTable().ajax.reload();
        // Recargar DataTable de los cursos de los usuarios que NO tienen acceso al certificado.
        $('#usuario_data').DataTable().ajax.reload();
        // Ocultar modal
        $('#modalmantenimiento').modal('hide');
    }
}

init();