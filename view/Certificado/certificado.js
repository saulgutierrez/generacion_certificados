const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

// Inicializamos la imagen
const image = new Image();
// Ruta de la imagen
image.src = '../../public/certificado.png';
// Dimensionamos y seleccionamos imagen
ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
// Definimos el tamanio de la fuente
ctx.font = "45px Arial";

ctx.textAlign = "center";
ctx.textBaseline = 'middle';
var x = canvas.width / 2;
ctx.fillText("Nombre", x, 100);
ctx.fillText("Nombaare", x, 230);

$(document).ready(function () {
    var curd_id = getUrlParameter('curd_id');

    $.post("../../controller/usuario.php?op=mostrar_curso_detalle", { curd_id : curd_id }, function (data) {
        data = JSON.parse(data);
        console.log(data);
        $('#cur_descrip').html(data.cur_descrip);
    });


});

// Obtenemos el parametro que se paso a traves de la URL, el cual es el id del usuario
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[i] === undefined ? true : sParameterName[1];
        }
    }
};