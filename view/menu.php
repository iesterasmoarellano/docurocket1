<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->

  <?php
    if($_SESSION['SIFO']['iTipoUsuario'] == '13'){
  ?>
      <a href="#" class="brand-link">
        <img src="../img/logoeag.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Inicio</span>
      </a>
  <?php 
    } else {
  ?>
      <a href="inicio.php" class="brand-link">
        <img src="../img/logoeag.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Inicio</span>
      </a>
  <?php
    }
  ?>

  <!-- Sidebar -->
  <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              <img src="../img/masculino.jpg" class="img-circle elevation-2" alt="User Image" style="width: 2.5rem;">
          </div>
          <div class="info" style="padding: 12px 5px 10px 20px; white-space: initial;">
              <a href="#" class="d-block" style="margin-top: -8px;"><?php echo $_SESSION['SIFO']['UsuarioNombreCompleto']?></a>
          </div>
      </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="tramite.php" class="nav-link">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
              Trámite
            </p>
          </a>
        </li>
        <?php
          if($_SESSION['SIFO']['tipoUsuario'] == 'Root'){
          
        ?>
            <li class="nav-item">
              <a href="usuario.php" class="nav-link">
                <i class="nav-icon fas fa-user-alt"></i>
                <p>
                  Usuarios
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tipoUsuario.php" class="nav-link">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>
                  Tipo Usuarios
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="area.php" class="nav-link">
                <i class="nav-icon fas fa-laptop-house"></i>
                <p>
                  Oficinas
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tipoTramite.php" class="nav-link">
                <i class="nav-icon fas fa-sticky-note"></i>
                <p>
                  Tipo Trámite
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="reporte.php" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                  Reportes
                </p>
              </a>
            </li>
        <?php
          }
        ?>
      </ul>
    </nav>
  </div>
</aside>