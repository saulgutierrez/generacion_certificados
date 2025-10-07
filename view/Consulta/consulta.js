function init() {

}

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
            console.log(data);
            if (data.length > 0) {

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