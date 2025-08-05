<!-- ########## START: LEFT PANEL ########## -->
<div class="br-logo"><a href="../usuHome/"><span>[</span>Empresa<span>]</span></a></div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">Menu</label>
    <div class="br-sideleft-menu">

        <a href="../usuHome/" class="br-menu-link">
            <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Inicio</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

    <?php
        if ($_SESSION["rol_id"] == 1) {
            ?>
                <a href="../usuCurso/" class="br-menu-link">
                    <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
                    <span class="menu-item-label">Mis Cursos</span>
                    </div><!-- menu-item -->
                </a><!-- br-menu-link -->
            <?php
        } else {
            ?>
                <a href="../AdminMntUsuario/" class="br-menu-link">
                    <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
                    <span class="menu-item-label">Mnt. Usuario</span>
                    </div><!-- menu-item -->
                </a><!-- br-menu-link -->

                <a href="../AdminMntCursos/" class="br-menu-link">
                    <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
                    <span class="menu-item-label">Mnt. Cursos</span>
                    </div><!-- menu-item -->
                </a><!-- br-menu-link -->

                <a href="../AdminMntInstructor" class="br-menu-link">
                    <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
                    <span class="menu-item-label">Mnt. Instructor</span>
                    </div><!-- menu-item -->
                </a><!-- br-menu-link -->

                <a href="../AdminMntCategoria" class="br-menu-link">
                    <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
                    <span class="menu-item-label">Mnt. Categoria</span>
                    </div><!-- menu-item -->
                </a><!-- br-menu-link -->

                <a href="../AdminDetalleCertificados/" class="br-menu-link">
                    <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
                    <span class="menu-item-label">Detalle Certificado</span>
                    </div><!-- menu-item -->
                </a><!-- br-menu-link -->
            <?php
        }
    ?>
    
    <a href="../usuPerfil/" class="br-menu-link">
        <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-gear-outline tx-20"></i>
        <span class="menu-item-label">Perfil</span>
        </div><!-- menu-item -->
    </a><!-- br-menu-link -->
    
    <a href="../html/Logout.php" class="br-menu-link">
        <div class="br-menu-item">
        <i class="menu-item-icon icon ion-power tx-20"></i>
        <span class="menu-item-label">Cerrar Sesión</span>
        </div><!-- menu-item -->
    </a><!-- br-menu-link -->

    </div><!-- br-sideleft-menu -->
</div><!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->