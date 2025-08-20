// Obtenemos el id del usuario tomandolo desde la variable de sesion oculta en el MainHeader
var usu_id = $('#user_idx').val();

function init() {
    $("#categoria_form").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#categoria_form")[0]);
    $.ajax({
        url: "../../controller/categoria.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            $('#categoria_data').DataTable().ajax.reload();
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
    $('#categoria_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/categoria.php?op=listar",
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

function editar(cat_id) {
    $.post("../../controller/categoria.php?op=mostrar", {cat_id: cat_id}, function (data) {
        data = JSON.parse(data);
        $('#cat_id').val(data.cat_id);
        $('#cat_nom').val(data.cat_nom);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(cat_id) {
    Swal.fire({
        title: "Eliminar",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/categoria.php?op=eliminar", {cat_id: cat_id}, function (data) {
                console.log(data);
                $('#categoria_data').DataTable().ajax.reload();
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
    $('#cat_id').val('');
    $('#lbltitulo').html("Nuevo registro");
    $('#categoria_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}

init();