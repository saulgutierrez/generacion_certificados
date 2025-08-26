// Obtenemos el id del usuario tomandolo desde la variable de sesion oculta en el MainHeader
var usu_id = $('#user_idx').val();

function init() {
    $("#instructor_form").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#instructor_form")[0]);
    $.ajax({
        url: "../../controller/instructor.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            $('#instructor_data').DataTable().ajax.reload();
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
    $('#inst_sex').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    $('#instructor_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/instructor.php?op=listar",
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

function editar(inst_id) {
    $.post("../../controller/instructor.php?op=mostrar", {inst_id: inst_id}, function (data) {
        data = JSON.parse(data);
        $('#inst_id').val(data.inst_id);
        $('#inst_nom').val(data.inst_nom);
        $('#inst_apep').val(data.inst_apep);
        $('#inst_apem').val(data.inst_apem);
        $('#inst_correo').val(data.inst_correo);
        $('#inst_sex').val(data.inst_sex).trigger('change');
        $('#inst_telef').val(data.inst_telef);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(inst_id) {
    Swal.fire({
        title: "Eliminar",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/instructor.php?op=eliminar", {inst_id: inst_id}, function (data) {
                console.log(data);
                $('#instructor_data').DataTable().ajax.reload();
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
    $('#inst_id').val('');
    $('#inst_sex').val('').trigger('change');
    $('#lbltitulo').html("Nuevo registro");
    $('#instructor_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}

init();