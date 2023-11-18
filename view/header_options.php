<div class="preloader flex-column justify-content-center align-items-center" style="background: #DCDDDF url(https://cssdeck.com/uploads/media/items/7/7AF2Qzt.png);">
  <img class="animation__shake" src="../img/logoeag.png" alt="AdminLTELogo" height="60" width="60">
</div>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">Ver todas las solicitudes</a>
      </div>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-cog"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">Configuración</span>
        <div class="dropdown-divider"></div>

        <?php
          if($_SESSION['SIFO']['iTipoUsuario'] == '13'){
        ?>
            <a href="#" class="dropdown-item">
              <i class="far fa-user"></i> Mi Perfil
            </a>
        <?php 
          } else {
        ?>
            <a href="inicio.php" class="dropdown-item">
              <i class="far fa-user"></i> Mi Perfil
            </a>
        <?php
          }
        ?>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-cambiar-clave">
          <i class="fas fa-unlock-alt"></i> Cambiar Clave
        </a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-controlsidebar-slide="true" role="button" href="../close.php">
        <i class="fas fa-sign-out-alt" title="Cerrar Sesión"></i>
      </a>
    </li>
  </ul>
</nav>

<div class="modal fade" id="modal-cambiar-clave">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h4 class="modal-title">Cambiar clave</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="form-group">
            <label for="txtNuevaClave">Contraseña</label>
            <input type="password" name="txtNuevaClave" class="form-control" id="txtNuevaClave" placeholder="Ingresar Contraseña">
          </div>
          <div class="form-group">
            <label for="txtConfirmarClave">Confirmar Contraseña</label>
            <input type="password" name="txtConfirmarClave" class="form-control" id="txtConfirmarClave" placeholder="Confirmar Contraseña">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-info" onclick="changePassword()">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script src="../js/inicio.js" type="text/javascript"></script>
<script src="../js/DAO/indexDAO.js" type="text/javascript"></script>