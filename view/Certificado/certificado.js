const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

$(document).ready(function () {
    var curd_id = getUrlParameter('curd_id');
    // Inicializamos la imagen
    const image = new Image();
    // Ruta de la imagen
    image.src = '../../public/certificado.png';

    $.post("../../controller/usuario.php?op=mostrar_curso_detalle", { curd_id : curd_id }, function (data) {
        data = JSON.parse(data);
        console.log(data);
        $('#cur_descrip').html(data.cur_descrip);

        // Dimensionamos y seleccionamos imagen
        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
        // Definimos el tamanio de la fuente
        ctx.font = "35px Arial";
        ctx.textAlign = "center";
        ctx.textBaseline = 'middle';
        var x = canvas.width / 2;
        ctx.fillText(data.usu_nom + ' ' + data.usu_apep + ' ' + data.usu_apem, x, 165);
        ctx.font = "25px Arial";
        ctx.fillText(data.cur_nom, x, 220);
        ctx.font = "20px Arial";
        ctx.fillText(data.inst_nombre + ' ' + data.inst_apep + ' ' + data.inst_apem, x, 300);
        ctx.font = "15px Arial";
        ctx.fillText("Instuctor", x, 260);
        ctx.font = "15px Arial";
        ctx.fillText("Fecha de inicio: " +data.cur_fech_ini + " / Fecha de finalización: "+data.cur_fech_fin, x, 330);
    });


});

$(document).on("click", "#btnpng", function () {
    let lblpng = document.createElement('a');
    lblpng.download = "Certificado.png";
    lblpng.href = canvas.toDataURL();
    lblpng.click();
});

$(document).on("click", "#btnpdf", function () {
    window.jsPDF = window.jspdf.jsPDF;
    var imgData = canvas.toDataURL('image/png');
    var doc = new jsPDF('l', 'mm');
    doc.addImage(imgData, 'PNG', 30, 15);
    doc.save('Certificado.pdf');
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