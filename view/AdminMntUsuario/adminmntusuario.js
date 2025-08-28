// Obtenemos el id del usuario tomandolo desde la variable de sesion oculta en el MainHeader
var usu_id = $('#user_idx').val();

function init() {
    $("#usuario_form").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            $('#usuario_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');

            Swal.fire({
                title: 'Correcto',
                text: 'Se registro correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function () {
    // Indicar al select que se encuentra dentro de un modal
    $('#usu_sex').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    $('#rol_id').select2({
        dropdownParent: $('#modalmantenimiento')
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

function editar(usu_id) {
    $.post("../../controller/usuario.php?op=mostrar", {usu_id: usu_id}, function (data) {
        console.log(data);
        data = JSON.parse(data);
        console.log(data);
        $('#usu_id').val(data.usu_id);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_apep').val(data.usu_apep);
        $('#usu_apem').val(data.usu_apem);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_pass').val(data.usu_pass);
        $('#usu_sex').val(data.usu_sex).trigger('change');
        $('#usu_telf').val(data.usu_telf);
        $('#rol_id').val(data.rol_id).trigger('change');
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

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

function nuevo() {
    $('#usu_id').val('');
    $('#usu_sex').val('').trigger('change');
    $('#rol_id').val('').trigger('change');
    $('#lbltitulo').html("Nuevo registro");
    $('#usuario_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}

init();