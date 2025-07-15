<?php
  // Llamamos al archivo de conexion
  require_once("../../config/conexion.php");
  if (isset($_SESSION["usu_id"])) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../html/MainHead.php"); ?>
    <title>Empresa::Curso</title>
  </head>
  <body>
  <?php require_once("../html/MainMenu.php"); ?>
  <?php require_once("../html/MainHeader.php"); ?>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Curso</a>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Curso</h4>
        <p class="mg-b-0">Pantalla Curso</p>
      </div>

      <div class="br-pagebody">
        <!-- start you own content here -->

      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
    <?php require_once("../html/MainJS.php"); ?>
  </body>
</html>
<?php
  } else {
    // Si no ha iniciado sesion, se redirecciona a la ventana principal
    header("Location: ".Conectar::ruta()."view/404");
  }
?>