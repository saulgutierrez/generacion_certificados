// Obtenemos el id del usuario tomandolo desde la variable de sesion oculta en el MainHeader
var usu_id = $('#user_idx').val();

function init() {
    $("#cursos_form").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#cursos_form")[0]);
    $.ajax({
        url: "../../controller/curso.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            $('#cursos_data').DataTable().ajax.reload();
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
    $('#cat_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });
    
    $('#inst_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    combo_categoria();
    combo_instructor();

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
    $.post("../../controller/curso.php?op=mostrar", {cur_id: cur_id}, function (data) {
        data = JSON.parse(data);
        $('#cur_id').val(data.cur_id);
        $('#cat_id').val(data.cat_id).trigger('change');
        $('#cur_nom').val(data.cur_nom);
        $('#cur_descrip').val(data.cur_descrip);
        $('#cur_fech_ini').val(data.cur_fech_ini);
        $('#cur_fech_fin').val(data.cur_fech_fin);
        $('#inst_id').val(data.inst_id).trigger('change');
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(cur_id) {
    Swal.fire({
        title: "Eliminar",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/curso.php?op=eliminar", {cur_id: cur_id}, function (data) {
                $('#cursos_data').DataTable().ajax.reload();
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
    $('#lbltitulo').html("Nuevo registro");
    $('#cursos_form')[0].reset();
    combo_categoria();
    combo_instructor();
    $('#modalmantenimiento').modal('show');
}

function combo_categoria() {
    // Retornamos un objeto html y lo incrustamos en el DOM
    $.post("../../controller/categoria.php?op=combo", function (data) {
        $('#cat_id').html(data);
    });
}

function combo_instructor() {
    $.post("../../controller/instructor.php?op=combo", function (data) {
        $('#inst_id').html(data);
    });
}

function imagen(cur_id) {
    $('#modalfile').modal('show');
}

init();