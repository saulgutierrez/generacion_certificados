<!DOCTYPE html>
<html lang="es" class="pos-relative">
  <head>
    <?php require_once("../html/MainHead.php"); ?>
    <title>Certificado</title>
  </head>

  <body class="pos-relative">

    <div class="ht-100v d-flex align-items-center justify-content-center">
      <div class="wd-lg-70p wd-xl-50p tx-center pd-x-40">
        <h1 class="tx-100 tx-xs-140 tx-normal tx-inverse tx-roboto mg-b-0">
            <canvas id="canvas" height="400px" width="700px" class="img-fluid" alt="Responsive image"></canvas>
            <!-- <img src="../../public/certificado.png" class="img-fluid" alt="Responsive image"> -->
        </h1>
        <br>
        <p class="tx-16 mg-b-30 text-justify" id="cur_descrip">

        </p>

        <div class="form-layout-footer bd pd-20 bd-t-0">
            <button class="btn btn-outline-info" id="btnpng"> <i class="fa fa-send mg-r-10"></i> PNG</button>
            <button class="btn btn-outline-success" id="btnpdf"> <i class="fa fa-send mg-r-10"></i> PDF</button>
        </div><!-- form-group -->

      </div>
    </div><!-- ht-100v -->

    <?php require_once("../html/MainJS.php"); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/3.0.1/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="certificado.js"></script>
  </body>
</html>
