<?php include('header.php'); ?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include('header_options.php'); ?>
        <?php include('menu.php'); ?>
        <div class="content-wrapper">
        	<section class="content-header">
		      <div class="container-fluid">
		        <div class="row mb-2">
		          <div class="col-sm-6">
		            <h1>Usuarios</h1>

		            <button type="button" class="btn btn-info btn-sm btnAgregarModal" data-toggle="modal" data-target="#modal-agregar-usuario" style="margin-top: 10px;"> <i class="fas fa-plus-square"></i> Nuevo Usuario</button>
		          </div>

		        </div>
		      </div><!-- /.container-fluid -->
		    </section>

		    <!-- Main content -->
		    <section class="content">
		      <div class="container-fluid">
		        <div class="row">
		          <div class="col-12">
		            <div class="card">
		              <!-- /.card-header -->
		              <div class="card-body">
		                <table id="tblUsuarios" class="table table-bordered table-striped">
		                  <thead class="btn-info">
		                  <tr>
		                    <th>Nombre y/o Razón social</th>
		                    <th>DNI</th>
		                    <th>Correo Electrónico</th>
		                    <th>Tipo Usuario</th>
		                    <th>Fecha Registro</th>
		                    <th>Acciones</th>
		                  </tr>
		                  </thead>
		                  <tbody>
		                  </tbody>
		                </table>
		              </div>
		              <!-- /.card-body -->
		            </div>
		            <!-- /.card -->
		          </div>
		          <!-- /.col -->
		        </div>
		        <!-- /.row -->
		      </div>
		      <!-- /.container-fluid -->
		    </section>

		    <div class="modal fade" id="modal-agregar-usuario">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">
			      <div class="modal-header bg-info">
			        <h4 class="modal-title titulo"></h4>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="card-body">
			          <div class="container-fluid">
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
			          	<hr class="chkPersona">
			          	<div>
			          		<div class="row">
				          		<div class="col-lg-6 col-4 dv_persona_natural">
				          			<div class="form-group">
										<label for="txtDni">DNI</label>
										<input type="text" name="txtDni" class="form-control" id="txtDni" placeholder="Digitar DNI" autocomplete="off" onkeypress="ValidaSoloNumeros()" maxlength="8" minlength="8">
										<input type="hidden" name="txtIdUsuario" id="txtIdUsuario" value="0">
									</div>
				          		</div>

				          		<div class="col-lg-6 col-4 dv_persona_juridica">
				          			<div class="form-group">
										<label for="txtRuc">RUC</label>
										<input type="text" name="txtRuc" class="form-control" id="txtRuc" placeholder="Digitar RUC" autocomplete="off" onkeypress="ValidaSoloNumeros()" maxlength="11" minlength="11">
									</div>
				          		</div>

				          		<div class="col-lg-1 col-4 chkPersona">
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
					                  <label for="cboTipoUsuario">Tipo de Usuario</label>
					                  <select class="form-control select2" id="cboTipoUsuario" required>
					                  	<option value="0">--Seleccione--</option>
					                  </select>
					                </div>
				          		</div>
				          		<div class="col-lg-6">
									<div class="form-group">
										<label for="txtTelefono">Teléfono Contacto</label>
										<input type="text" name="txtTelefono" class="form-control" id="txtTelefono" placeholder="Ingrese teléfono contacto" autocomplete="off" required>
									</div>
									<div class="form-group">
					                  <label for="cboArea">Area</label>
					                  <select class="form-control select2" id="cboArea" required>
					                  	<option value="0">--Seleccione--</option>
					                  </select>
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
									<div class="form-group chkPersona">
										<label for="txtClave">Contraseña</label>
										<input type="password" name="txtClave" class="form-control" id="txtClave" placeholder="Ingrese contraseña" autocomplete="off" required>
									</div>
				          		</div>
				          	</div>
				          	<div class="dv_persona_juridica">
				          		<hr>
					          	<label>Información del representante</label>
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
										<div class="form-group">
											<label for="txtCorreoRepresentante">Correo electrónico</label>
											<input type="text" name="txtCorreoRepresentante" class="form-control" id="txtCorreoRepresentante" placeholder="Ingrese correo electrónico" autocomplete="off" required>
										</div>
					          		</div>
					          	</div>
				          	</div>
			          	</div>
			          	<hr>
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
			          </div>
			        </div>
			      </div>
			      <div class="modal-footer justify-content-between">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			        <button type="button" class="btn btn-info" id="btnRegistrar" disabled> <span id="lblRegistrar"></span> </button>
			      </div>
			    </div>
			    <!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>

        </div>
        <?php include('footer.php'); ?>
    </div>
    <?php include('scripts.php'); ?>

    <script src="../js/DAO/usuarioDAO.js" type="text/javascript"></script>
    <script>
		$(function () {
			$(document).ready(function () {

			    usuarioDAO.getAreas();
			    usuarioDAO.getTipoUsuario();
			    usuarioDAO.getDepartamento();

			    var tableUsuario = $('#tblUsuarios').DataTable({
			    	"language": {
			            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			        },
			        ajax: {
			        	"url": "../controller/ControllerSIFO.php",
			        	"type": "GET",
			        	"data": {
			        		command : 'usuario',
	            			action : 'listUsuario'
			        	}
			        },
			        columns: [
			            { data: 'nombreUsuario' },
			            { data: 'vDocumentoIdentidad' },
			            { data: 'vCorreoElectronico' },
			            { data: 'vDescripcion' },
			            { data: 'dFechaRegistro' },
			            {
							data: null,
							render: function(data, type, row) {
								return '<button class="btn btn-primary acciones-btn btn-sm btnEditar" data-toggle="modal" data-target="#modal-agregar-usuario"><i class="fas fa-pencil-alt"></i></button>' +
								       '<button class="btn btn-danger acciones-btn btn-sm btnEliminar"><i class="fas fa-trash"></i></button>';
							}
						}
			        ]
			    });

			    $('.btnAgregarModal').on('click', function(){
			    	$('.titulo').html('Registrar nuevo usuario');
			    	$('#lblRegistrar').html('Registrar');

			    	$('.chkPersona').css('display', 'block');

			    	$('#txtDni').removeAttr('disabled');
					$('#txtNombres').removeAttr('disabled');
					$('#txtRuc').removeAttr('disabled');
					$('#txtRazonSocial').removeAttr('disabled');

					$('#txtIdUsuario').val(0);
					$('#txtDni').val('');
                    $('#txtRuc').val('');
                    $('#txtNombres').val('');
                    $('#txtRazonSocial').val('');
                    $('#txtCorreo').val('');
                    $('#cboDepartamento').val(0).trigger('change');
                    $('#cboDistrito').val(0).trigger('change');
                    $('#cboTipoUsuario').val(0).trigger('change');
                    $('#txtTelefono').val('');
                    $('#cboArea').val(0).trigger('change');
                    $('#cboProvincia').val(0).trigger('change');
                    $('#txtDomicilio').val('');
                    $('#txtClave').val('');
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
			    });

			    $('#btnRegistrar').on('click', function(){

			    	var idUsuario = $('#txtIdUsuario').val();
			    	var tipoPersona = $('input[name="rdTipoPersona"]:checked').val();
					var dni = $('#txtDni').val();
					var ruc = $('#txtRuc').val();
					var nombres = $('#txtNombres').val();
					var razonSocial = $('#txtRazonSocial').val();
					var correo = $('#txtCorreo').val();
					var departamento = $('#cboDepartamento').val();
					var distrito = $('#cboDistrito').val();
					var tipoUsuario = $('#cboTipoUsuario').val();
					var telefono = $('#txtTelefono').val();
					var area = $('#cboArea').val();
					var provincia = $('#cboProvincia').val();
					var domicilio = $('#txtDomicilio').val();
					var clave = $('#txtClave').val();

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
					} else if (tipoUsuario == 0){
						toastr.error('Favor de elegir tipo usuario');
						return false;
					} else if (telefono == ''){
						toastr.error('Favor de digitar teléfono');
						return false;
					} else if (area == 0){
						toastr.error('Favor de elegir área');
						return false;
					} else if (provincia == 0){
						toastr.error('Favor de elegir provincia');
						return false;
					} else if (domicilio == ''){
						toastr.error('Favor de digitar domicilio');
						return false;
					} else if (clave == '' && idUsuario == 0){
						toastr.error('Favor de digitar clave');
						return false;
					}

					$.ajax({
			            url: '../controller/ControllerSIFO.php',
			            type: 'POST',
			            dataType: 'json',
			            data: {
			                command: 'usuario',
			                action : 'crearUsuario',
			                codigoUsuario : idUsuario,
			                tipoPersona : tipoPersona,
			                dni : dni,
			                ruc : ruc,
			                nombres : nombres,
			                razonSocial : razonSocial,
			                correo : correo,
			                departamento : departamento,
			                distrito : distrito,
			                tipoUsuario : tipoUsuario,
			                telefono : telefono,
			                area : area,
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
			                    $('#cboTipoUsuario').val(0).trigger('change');
			                    $('#txtTelefono').val('');
			                    $('#cboArea').val(0).trigger('change');
			                    $('#cboProvincia').val(0).trigger('change');
			                    $('#txtDomicilio').val('');
			                    $('#txtClave').val('');
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

			                    tableUsuario.ajax.reload(null,false);
			                    $('#modal-agregar-usuario').modal('hide');
			                    toastr.success(obj.msg);

			                }else{
			                    toastr.error(obj.msg);
			                }
			            }                              
			            
			        });

			    });

				$('#tblUsuarios tbody').on('click', '.btnEditar', function(){
					var data = tableUsuario.row($(this).parents('tr')).data();

					console.log(data);

					$('#lblRegistrar').html('Actualizar');

					$('.titulo').html('Editar usuario');
					$('.chkPersona').css('display', 'none');

					if(data["iTipoPersona"] == 1){

						$('.dv_persona_natural').css('display', 'block');
						$('.dv_persona_juridica').css('display', 'none');

						$('#txtDni').val(data["vDocumentoIdentidad"]);
						$('#txtNombres').val(data["vNombreCompleto"]);

						$('#txtDni').attr('disabled', 'disabled');
						$('#txtNombres').attr('disabled', 'disabled');

					} else {

						$('.dv_persona_natural').css('display', 'none');
						$('.dv_persona_juridica').css('display', 'block');

						$('#txtRuc').val(data["vDocumentoIdentidad"]);
	                	$('#txtRazonSocial').val(data["vRazonSocial"]);

	                	$('#txtRuc').attr('disabled', 'disabled');
						$('#txtRazonSocial').attr('disabled', 'disabled');

	                	$('#txtDniRepresentante').val(data["vDocumentoIdentidadRepresentante"]);
		                $('#txtApellidoRepresentante').val(data["vApellidosRepresentante"]);
		                $('#txtNombreRepresentante').val(data["vNombresRepresentante"]);
		                $('#txtCelular').val(data["vNumeroRepresentante"]);
		                $('#txtCorreoRepresentante').val(data["vCorreoElectronicoRepresentante"]);

					}
					
	                $('#txtIdUsuario').val(data["codigoUnicoUsuario"]);
	                $('#txtCorreo').val(data["vCorreoElectronico"]);
	                $('#cboTipoUsuario').val(data["iTipoUsuario"]).trigger('change');
	                $('#txtTelefono').val(data["vTelefono"]);
	                $('#cboArea').val(data["iIdArea"]).trigger('change');
	                $('#txtDomicilio').val(data["vDomicilio"]);

	                $('#cboDepartamento').val(data["iDepartamento"]).trigger('change');
	                $('#cboProvincia').val(data["iProvincia"]).trigger('change');
	                $('#cboDistrito').val(data["iDistrito"]);
				});

			    $('#tblUsuarios tbody').on('click', '.btnEliminar', function(){
					
					var dato = tableUsuario.row($(this).parents('tr')).data();
					
					Swal.fire({
					  title: '¿Estás seguro de eliminar el usuario?',
					  text: "Ya no se podrá recuperar el registro",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Eliminar'
					}).then((result) => {
					  if (result.isConfirmed) {

					  	$.ajax({
					        url: '../controller/ControllerSIFO.php',
					        type: 'POST',
					        dataType: 'json',
					        data: {
					            command: 'usuario',
					            action : 'eliminarUsuario',
					            id: dato["codigoUnicoUsuario"],
					            documento: dato["vDocumentoIdentidad"]
					        },  
					        success: function(obj){
					            if(obj.rst){
					                toastr.success(obj.msg);
					                tableUsuario.ajax.reload(null,false);

					            }else{
					                toastr.error(obj.msg);
					            }
					        }                              
					        
					    });

					  }
					});
				});
			});
		});

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

		function ValidaSoloNumeros() {
			if ((event.keyCode < 48) || (event.keyCode > 57)) 
				event.returnValue = false;
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

		function verProvincias(){

			var valor = $('#cboDepartamento').val();
			usuarioDAO.listarProvincias(valor);
		}

		function verDistritos(){
			var valor = $('#cboProvincia').val();
			usuarioDAO.listarDistritos(valor);
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

	</script>
</body>
</html>