<?php
  // Llamamos al archivo de conexion
  require_once("../../config/conexion.php");
  if (isset($_SESSION["usu_id"])) {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../html/MainHead.php"); ?>
    <title>Empresa::Home</title>
  </head>
  <body>
  <?php require_once("../html/MainMenu.php"); ?>
  <?php require_once("../html/MainHeader.php"); ?>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Inicio</a>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Inicio</h4>
        <p class="mg-b-0">Dashboard</p>
      </div>
      <!-- Contenido del proyecto -->
      <div class="br-pagebody mg-t-5 pd-x-30">
        <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <div class="bg-teal rounded overflow-hidden">
              <div class="pd-25 d-flex align-items-center">
                <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total de cursos</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1" id="lbltotal"></p>
                </div>
              </div>
            </div>
          </div><!-- col-3 -->
        </div><!-- row -->
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
    <?php require_once("../html/MainJS.php"); ?>
    <script type="text/javascript" src="usuhome.js"></script>
  </body>
</html>
<?php
  } else {
    // Si no ha iniciado sesion, se redirecciona a la ventana principal
    header("Location: ".Conectar::ruta()."view/404");
  }
?>