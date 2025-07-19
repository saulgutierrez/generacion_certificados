// Obtenemos el id del usuario tomandolo desde la variable de sesion oculta en el MainHeader
var usu_id = $('#user_idx').val();

$(document).ready(function () {
    $.post("../../controller/usuario.php?op=total", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotal').html(data.total);
    });
});