<?php   
session_start();
if( isset($_SESSION['SIFO']) && $_SESSION['SIFO']['activo']==1 ) {
    header('Location: view/inicio.php');
}    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="img/logoeag.png" type="image/x-icon">

    <link rel="stylesheet" href="includes/jquery-ui-1.11.3.custom/jquery-ui.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="includes/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="includes/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="includes/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="includes/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="includes/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="includes/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="includes/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="includes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="includes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="includes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="includes/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="includes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="includes/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="includes/plugins/sweetalert2/sweetalert2.min.css" >

    <link rel="stylesheet" href="css/mdb.min.css">

    <link rel="stylesheet" href="css/login.css">

  
    <style>
      .divider:after,
      .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
      }
      .h-custom {
        height: calc(100% - 73px);
      }
      @media (max-width: 450px) {
        .h-custom {
          height: 100%;
        }
      }

      .imagen-circular{
        border-radius: 22px 22px 22px 22px;
      }

      .carousel-container {
          width: 100%;
          margin: 0 auto;
          overflow: hidden;
          position: relative;
      }

      .carousel-slide {
          display: flex; /* Muestra las imágenes en una fila */
          transition: transform 0.4s ease-in-out; /* Agrega una transición suave */
      }

      .carousel-slide img {
          width: 100%;
          height: auto;
      }

    </style>

    <title>Gestión Documentaria</title>
</head>
<body>
    <section class="vh-100">
      <div class="container-fluid h-custom loginUsuario">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <div class="carousel-container">
                <div class="carousel-slide">
                    <img src="img/foto25.jpg" class="img-fluid imagen-circular" alt="Sample image">
                    <img src="img/foto26.jpg" class="img-fluid imagen-circular" alt="Sample image">
                    <img src="img/foto18.jpg" class="img-fluid imagen-circular" alt="Sample image">
                </div>
            </div>
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form id="frm_login" method="post">
              <div class="align-items-center" style="text-align: center">
                <img src="img/logoeag.png" class="rounded-4" style="width: 140px;" alt="" />
              </div>

              <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0">Login</p>
              </div>

              <div class="form-group">
                <label class="form-label" for="txtUsuario" style="float: left;">Usuario</label>
                <input type="text" id="txtUsuario" class="form-control" autocomplete="off" placeholder="Ingrese usuario" />
              </div>

              <div class="form-group">
                <label class="form-label" for="txtClave" style="float: left;">Clave</label>
                <input type="password" id="txtClave" class="form-control" autocomplete="off" placeholder="Ingrese clave" onkeyup="if(event.keyCode==13){iniciar()}" />
              </div>

              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="button" class="btn btn-primary btn-lg" onClick="iniciar()" style="padding-left: 2.5rem; padding-right: 2.5rem;">Ingresar</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">No tienes una cuenta? <a href="#" class="link-danger" onclick="verFichaRegistro()">Registrarte</a></p>
              </div>

            </form>
          </div>
        </div>
      </div>

      <div class="container-fluid registrarUsuario" style="display: none;">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <div class="row">
              <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0">Registrar Usuario</p>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-4"></div>
              <div class="col-lg-3 col-4">
                <div class="form-group chkPersona">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdTipoPersona" value="1" onclick="validarUsuario()" checked>
                    <label class="form-check-label">Persona Natural</label>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-4">
                <div class="form-group chkPersona">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdTipoPersona" onclick="validarUsuario()" value="2">
                    <label class="form-check-label">Persona Jurídica</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6 col-4 dv_persona_natural">
                <div class="form-group">
                  <label for="txtDni">DNI</label>
                  <input type="text" name="txtDni" class="form-control" id="txtDni" placeholder="Digitar DNI" autocomplete="off" onkeypress="ValidaSoloNumeros()" maxlength="8" minlength="8">
                </div>
              </div>
              <div class="col-lg-6 col-4 dv_persona_juridica">
                  <div class="form-group">
                    <label for="txtRuc">RUC</label>
                    <input type="text" name="txtRuc" class="form-control" id="txtRuc" placeholder="Digitar RUC" autocomplete="off" onkeypress="ValidaSoloNumeros()" maxlength="11" minlength="11">
                  </div>
              </div>
              <div class="col-lg-1 col-4">
                <div class="form-group">
                  <a onclick="buscarPersona()">
                    <i class="fas fa-search" style="padding-top: 40px; cursor: pointer;"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-1 col-4 valida-dato">
                <div class="form-group">
                  <i class="fas fa-spinner fa-spin" style="margin-top: 37px;"></i>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group dv_persona_natural">
                  <label for="txtNombres">Nombre Completo</label>
                  <input type="text" name="txtNombres" class="form-control" id="txtNombres" placeholder="Ingrese nombres" autocomplete="off" required>
                </div>
                <div class="form-group dv_persona_juridica">
                  <label for="txtRazonSocial">Razón Social</label>
                  <input type="text" name="txtRazonSocial" class="form-control" id="txtRazonSocial" placeholder="Ingrese Razón Social" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="txtCorreo">Correo Electrónico</label>
                  <input type="text" name="txtCorreo" class="form-control" id="txtCorreo" placeholder="Ingrese correo electrónico" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="cboProvincia">Provincia</label>
                  <select class="form-control select2" id="cboProvincia" onchange="verDistritos()" required>
                    <option value="0">--Seleccione--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="txtDomicilio">Domicilio Legal</label>
                  <input type="text" name="txtDomicilio" class="form-control" id="txtDomicilio" placeholder="Ingrese domicilio legal" autocomplete="off" required>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="txtTelefono">Teléfono Contacto</label>
                  <input type="text" name="txtTelefono" class="form-control" id="txtTelefono" placeholder="Ingrese teléfono contacto" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="cboDepartamento">Departamento</label>
                  <select class="form-control select2" id="cboDepartamento" onchange="verProvincias()" required>
                    <option value="0">--Seleccione--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="cboDistrito">Distrito</label>
                  <select class="form-control select2" id="cboDistrito" required>
                    <option value="0">--Seleccione--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="txtClaveUsuario">Contraseña</label>
                  <input type="password" name="txtClaveUsuario" class="form-control" id="txtClaveUsuario" placeholder="Ingrese contraseña" autocomplete="off" required>
                </div>
              </div>
            </div>

            <div class="dv_persona_juridica">
              <div class="row">
                <div class="divider d-flex align-items-center my-4">
                  <p class="text-center fw-bold mx-3 mb-0">Información del representante</p>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="txtDniRepresentante">DNI</label>
                    <input type="text" name="txtDniRepresentante" class="form-control" id="txtDniRepresentante" placeholder="Ingrese DNI" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="txtApellidoRepresentante">Apellidos Completos</label>
                    <input type="text" name="txtApellidoRepresentante" class="form-control" id="txtApellidoRepresentante" placeholder="Ingrese apellido" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="txtCorreoRepresentante">Correo electrónico</label>
                    <input type="text" name="txtCorreoRepresentante" class="form-control" id="txtCorreoRepresentante" placeholder="Ingrese correo electrónico" autocomplete="off" required>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="txtNombreRepresentante">Nombres Completos</label>
                    <input type="text" name="txtNombreRepresentante" class="form-control" id="txtNombreRepresentante" placeholder="Ingrese nombre" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="txtCelular">Número celular</label>
                    <input type="text" name="txtCelular" class="form-control" id="txtCelular" placeholder="Ingrese celular" autocomplete="off" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="chkTerminos" onclick="validarRegistroUsuario()">
                  <label class="form-check-label">He leído los términos y condiciones para el registro de usuario.</label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="chkJurada" onclick="validarRegistroUsuario()">
                  <label class="form-check-label">Los datos ingresados con el presente formulario tienen carácter de Declaración Jurada</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="button" class="btn btn-primary" id="btnRegistrar" disabled>Registrar</button>
                <button type="button" class="btn btn-secondary" onClick="verLoginRegistro()">Cancelar</button>
              </div>
            </div>

            <br>
            <br>

          </div>
        </div>
      </div>
      <div
        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
          Copyright © 2023. Todos los derechos reservados.
        </div>
        <!-- Copyright -->
      </div>
    </section>
    <!--scripts-->
    <script src="includes/jquery/jquery-1.11.1.js" type="text/javascript"></script>
    <script src="includes/plugins/toastr/toastr.min.js"></script>    
    <script src="js/DAO/indexDAO.js" type="text/javascript"></script>       
    <script src="js/inicio.js" type="text/javascript"></script>

    <script src="includes/plugins/jquery/jquery.min.js"></script>
    <script src="includes/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="includes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="includes/plugins/chart.js/Chart.min.js"></script>
    <script src="includes/plugins/sparklines/sparkline.js"></script>
    <script src="includes/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="includes/plugins/moment/moment.min.js"></script>
    <script src="includes/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="includes/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="includes/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="includes/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="includes/dist/js/adminlte.js"></script>
    <script src="includes/dist/js/pages/dashboard.js"></script>
    <script src="includes/plugins/toastr/toastr.min.js"></script>

    <script src="includes/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="includes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="includes/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="includes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="includes/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="includes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="includes/plugins/jszip/jszip.min.js"></script>
    <script src="includes/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="includes/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="includes/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="includes/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="includes/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="includes/plugins/select2/js/select2.full.min.js"></script>
    <script src="includes/plugins/dropzone/min/dropzone.min.js"></script>
    <script src="includes/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="includes/plugins/moment/moment.min.js"></script>

    <script>
      $(function () {
        $('.select2').select2();
      });
      
    </script>

    <script>
      $(function () {

        $(document).ready(function () {
        
          $('#txtFechaNacimiento').datetimepicker({
              format: 'yyyy/MM/DD',
              maxDate: null
          });

          const carouselSlide = document.querySelector('.carousel-slide');
          const images = document.querySelectorAll('.carousel-slide img');

          let counter = 0;
          const slideWidth = images[0].clientWidth;

          const prevButton = document.querySelector('#prev');
          const nextButton = document.querySelector('#next');

          const moveToPreviousSlide = () => {
              if (counter <= 0) return;
              counter--;
              carouselSlide.style.transform = `translateX(${-slideWidth * counter}px)`;
          };

          const moveToNextSlide = () => {
              if (counter >= images.length - 1) {
                  counter = 0;
              } else {
                  counter++;
              }
              carouselSlide.style.transform = `translateX(${-slideWidth * counter}px)`;
          };

          let autoSlideInterval = setInterval(moveToNextSlide, 5000);

          const stopAutoSlide = () => {
              clearInterval(autoSlideInterval);
          };

          const startAutoSlide = () => {
              autoSlideInterval = setInterval(moveToNextSlide, 5000);
          };

          carouselSlide.addEventListener('mouseenter', stopAutoSlide);
          carouselSlide.addEventListener('mouseleave', startAutoSlide);

          indexDAO.getDepartamento();
        });
      });

      function verProvincias(){

        var valor = $('#cboDepartamento').val();
        indexDAO.listarProvincias(valor);
      }

      function verDistritos(){
        var valor = $('#cboProvincia').val();
        indexDAO.listarDistritos(valor);
      }

      function validarRegistroUsuario(){
        var terminos = document.getElementById("chkTerminos");
        var declaracion_jurada = document.getElementById("chkJurada");

        if(terminos.checked && declaracion_jurada.checked){
          $('#btnRegistrar').removeAttr('disabled');
        } else {
          $('#btnRegistrar').attr('disabled', 'disabled');
        }
      }

      function ValidaSoloNumeros() {
        if ((event.keyCode < 48) || (event.keyCode > 57)) 
          event.returnValue = false;
      }

      function buscarPersona(){
        var dni = $("#txtDni").val();
        var ruc = $("#txtRuc").val();
        var tipo = $('input[name="rdTipoPersona"]:checked').val();
        var url;

        $('.valida-dato').show();

        if(tipo == 1){

          if(dni.length != 8){
            toastr.error('El DNI debe tener 8 dígitos');
            $('.valida-dato').hide();
            return false;
          }

          $("#txtNombres").val('');
          url = "https://apiperu.dev/api/dni/" + dni;

        } else {

          if(ruc.length != 11){
            toastr.error('El RUC debe tener 11 dígitos');
            $('.valida-dato').hide();
            return false;
          }

          $("#txtRazonSocial").val('');
          url = "https://apiperu.dev/api/ruc/" + ruc;

        }

        fetch(url+'?api_token=a76903c88537fefef309a7b49bfe7e9ab881f6ac3c9ad5f72a35d319a4b41d91')
          .then((res) => res.json())
            .then(data => {
              if(data.success){
                console.log(data);

                if(tipo == 1){
                  $("#txtNombres").val(data.data.nombre_completo);
                } else {
                  $("#txtRazonSocial").val(data.data.nombre_o_razon_social);
                }
                
              } else {
                toastr.error('No se encontraron registros');
              }

              $('.valida-dato').hide();
              
            });
      }

      function validarUsuario(){
        var tipo = $('input[name="rdTipoPersona"]:checked').val();

        if(tipo == 1){
          $('.dv_persona_natural').css('display', 'block');
          $('.dv_persona_juridica').css('display', 'none');
        } else {
          $('.dv_persona_natural').css('display', 'none');
          $('.dv_persona_juridica').css('display', 'block');
        }
      }

      $('#btnRegistrar').on('click', function(){

          var tipoPersona = $('input[name="rdTipoPersona"]:checked').val();
          var dni = $('#txtDni').val();
          var ruc = $('#txtRuc').val();
          var nombres = $('#txtNombres').val();
          var razonSocial = $('#txtRazonSocial').val();
          var correo = $('#txtCorreo').val();
          var departamento = $('#cboDepartamento').val();
          var distrito = $('#cboDistrito').val();
          var telefono = $('#txtTelefono').val();
          var provincia = $('#cboProvincia').val();
          var domicilio = $('#txtDomicilio').val();
          var clave = $('#txtClaveUsuario').val();

          var dniRepresentante = $('#txtDniRepresentante').val();
          var apellidoRepresentante = $('#txtApellidoRepresentante').val();
          var nombreRepresentante = $('#txtNombreRepresentante').val();
          var celular = $('#txtCelular').val();
          var correoRepresentante = $('#txtCorreoRepresentante').val();

          var exp_valida_correo_valido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

          if(tipoPersona == 1){
            
            if(dni == ''){
              toastr.error('Favor de digitar DNI');
              return false;
            } else if (nombres == ''){
              toastr.error('Favor de digitar nombres completos');
              return false;   
            }

          } else if (tipoPersona == 2){

            if(ruc == ''){
              toastr.error('Favor de digitar RUC');
              return false;
            } else if (razonSocial == ''){
              toastr.error('Favor de digitar razón social');
              return false;
            } else if(dniRepresentante == '') {
              toastr.error('Favor de digitar DNI del representante legal');
              return false;
            } else if (apellidoRepresentante == ''){
              toastr.error('Favor de digitar los apellidos del representante legal');
              return false;
            } else if (nombreRepresentante == ''){
              toastr.error('Favor de digitar los nombres del representante legal');
              return false;
            } else if (celular == ''){
              toastr.error('Favor de digitar el celular del representante legal');
              return false;
            } else if (correoRepresentante == ''){
              toastr.error('Favor de digitar el correo electrónico del representante legal');
              return false;
            } else if (!exp_valida_correo_valido.test(correoRepresentante)){
              toastr.error('Favor de digitar un correo electrónico válido');
              return false;
            }

          }
            
          if(correo == ''){
            toastr.error('Favor de digitar correo electrónico');
            return false;
          } else if (!exp_valida_correo_valido.test(correo)){
            toastr.error('Favor de digitar un correo electrónico válido');
            return false;
          } else if (departamento == 0){
            toastr.error('Favor de elegir departamento');
            return false;
          } else if (distrito == 0){
            toastr.error('Favor de elegir distrito');
            return false;
          } else if (telefono == ''){
            toastr.error('Favor de digitar teléfono');
            return false;
          } else if (provincia == 0){
            toastr.error('Favor de elegir provincia');
            return false;
          } else if (domicilio == ''){
            toastr.error('Favor de digitar domicilio');
            return false;
          } else if (clave == ''){
            toastr.error('Favor de digitar clave');
            return false;
          }

          $.ajax({
                  url: 'controller/ControllerSIFO.php',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                      command: 'usuario',
                      action : 'crearUsuario',
                      codigoUsuario : 0,
                      tipoPersona : tipoPersona,
                      dni : dni,
                      ruc : ruc,
                      nombres : nombres,
                      razonSocial : razonSocial,
                      correo : correo,
                      departamento : departamento,
                      distrito : distrito,
                      tipoUsuario : 13,
                      telefono : telefono,
                      area : 0,
                      provincia : provincia,
                      domicilio : domicilio,
                      clave : clave,
                      dniRepresentante : dniRepresentante,
                      apellidoRepresentante : apellidoRepresentante,
                      nombreRepresentante : nombreRepresentante,
                      celular : celular,
                      correoRepresentante : correoRepresentante
                  },
                  success: function(obj){
                      if(obj.rst){

                          $('#txtDni').val('');
                          $('#txtRuc').val('');
                          $('#txtNombres').val('');
                          $('#txtRazonSocial').val('');
                          $('#txtCorreo').val('');
                          $('#cboDepartamento').val(0).trigger('change');
                          $('#cboDistrito').val(0).trigger('change');
                          $('#txtTelefono').val('');
                          $('#cboProvincia').val(0).trigger('change');
                          $('#txtDomicilio').val('');
                          $('#txtClaveUsuario').val('');
                          $('#txtDniRepresentante').val('');
                          $('#txtApellidoRepresentante').val('');
                          $('#txtNombreRepresentante').val('');
                          $('#txtCelular').val('');
                          $('#txtCorreoRepresentante').val('');

                          var terminos = document.getElementById("chkTerminos");
                          var jurada = document.getElementById("chkJurada");

                          terminos.checked = false;
                          jurada.checked = false;

                          $('#btnRegistrar').attr('disabled', 'disabled');
                          toastr.success(obj.msg);

                          $('.loginUsuario').css('display', 'block');
                          $('.registrarUsuario').css('display', 'none');

                      }else{
                          toastr.error(obj.msg);
                      }
                  }                              
                  
              });

          });
      
    </script>


</body>
</html>