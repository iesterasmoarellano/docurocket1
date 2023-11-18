<?php include('header.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include('header_options.php'); ?>
        <?php include('menu.php'); ?>
        <div class="content-wrapper kanban">

		    <section class="content-header">
		      <div class="container-fluid">
		        <div class="row">
		          <div class="col-sm-6">
		            <h1>Trámites</h1>
		            <?php
		            	if($_SESSION['SIFO']['area'] != 'Mesa de partes'){
		            ?>
		            		<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-agregar-solicitud"> <i class="fas fa-plus-square"></i> Nuevo Trámite</button>
		            <?php
		            	}
		            ?>

		            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-listar-solicitud"> <i class="fa fa-search-plus"></i> Seguimiento de trámite</button>

		            <?php
		            	if($_SESSION['SIFO']['iTipoPersona'] == 1 && $_SESSION['SIFO']['iTipoUsuario'] != 13){
		            ?>
		            		<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-ver-asignados"> <i class="fas fa-tasks"></i> Ver trámites asignados</button>
		            <?php
		            	}
		            ?>
		          </div>

		        </div>
		      </div>
		    </section>

		    <?php
		    	if($_SESSION['SIFO']['iTipoUsuario'] != 13){
		    ?>

			    <div class="scroll">
			    	<section class="content pb-3">
				      <div class="container-fluid h-100">
				        <div class="card card-row card-secondary">
				          <div class="card-header">
				            <h3 class="card-title">
				              Pendiente
				            </h3>
				          </div>
				          <div class="card-body">
				          	<div class="kanBacklog">

				            </div>
				          </div>
				        </div>

				        <div class="card card-row card-default">
				          <div class="card-header bg-info">
				            <h3 class="card-title">
				              En proceso
				            </h3>
				          </div>
				          <div class="card-body">
				          	<div class="kanProceso">

				            </div>
				          </div>
				        </div>

				        <div class="card card-row card-warning">
				          <div class="card-header">
				            <h3 class="card-title">
				              Observados
				            </h3>
				          </div>
				          <div class="card-body">
				          	<div class="kanObservado">

				            </div>
				          </div>
				        </div>

				        <div class="card card-row card-danger">
				          <div class="card-header">
				            <h3 class="card-title">
				              Cancelados
				            </h3>
				          </div>
				          <div class="card-body">
				          	<div class="kanCancelado">

				            </div>
				          </div>
				        </div>

				        <div class="card card-row card-success">
				          <div class="card-header">
				            <h3 class="card-title">
				              Finalizados
				            </h3>
				          </div>
				          <div class="card-body">
				          	<div class="kanHecho">

				            </div>
				          </div>
				        </div>
				      </div>
				    </section>
			    </div>
			<?php
				} else {
			?>
				<br>
				<br>
				<br>
				<br>
				<div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6" style="padding-top: 30px; padding-left: 55px;">
                            <img src="../img/masculino.jpg" class="img-circle elevation-2" alt="User Image" style="width: 200px;">
                        </div>

                        <div class="col-lg-9 col-6" style="padding-top: 15px;">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="inner" style="text-align: center;">
                                    <h4>Información Personal</h4>
                                </div>
                                <div class="container-fluid">
                                    <div class="row" style="padding-left: 25px; padding-right: 25px;">
                                        <div class="col-lg-6 col-6">
                                            <label for="txtNombre">Nombres Completos</label>
                                            <input type="text" name="txtNombre" class="form-control" id="txtNombre" disabled="true" value="<?php echo $_SESSION['SIFO']['UsuarioNombreCompleto'];?>">
                                            <br>
                                            <label for="txtDni">Documento Identidad</label>
                                            <input type="text" name="txtDni" class="form-control" id="txtDni" disabled="true" value="<?php echo $_SESSION['SIFO']['vDocumentoIdentidad'];?>">
                                        </div>

                                        <div class="col-lg-6 col-6">
                                            <label for="txtFechaRegistro">Fecha Registro</label>
                                            <input type="text" name="txtFechaRegistro" class="form-control" id="txtFechaRegistro" disabled="true" value="<?php echo $_SESSION['SIFO']['fecha'];?>">
                                            <br>
                                            <label for="txtTipoUsuario">Tipo Usuario</label>
                                            <input type="text" name="txtTipoUsuario" class="form-control" id="txtTipoUsuario" disabled="true" value="<?php echo $_SESSION['SIFO']['tipoUsuario'];?>">
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>

                    </div>
                </div>

			<?php
				}
			?>

		    <div class="modal fade" id="modal-agregar-solicitud">
			  <div class="modal-dialog modal-lg" style="max-width: 1000px;">
			    <div class="modal-content">
			      <div class="modal-header bg-info">
			        <h4 class="modal-title">Registrar trámite</h4>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="card-body">
			        	<div class="bs-stepper">
		                  <div class="bs-stepper-header" role="tablist">
		                    <!-- your steps here -->
		                    <div class="step" data-target="#formulario-part">
		                      <button type="button" class="step-trigger" role="tab" aria-controls="formulario-part" id="formulario-part-trigger">
		                        <span class="bs-stepper-circle">1</span>
		                        <span class="bs-stepper-label">Formulario</span>
		                      </button>
		                    </div>
		                    <div class="line"></div>
		                    <div class="step" data-target="#firmar-part">
		                      <button type="button" class="step-trigger" role="tab" aria-controls="firmar-part" id="firmar-part-trigger">
		                        <span class="bs-stepper-circle">2</span>
		                        <span class="bs-stepper-label">Firmar</span>
		                      </button>
		                    </div>
		                  </div>
		                  <div class="bs-stepper-content">
		                    <!-- your steps content here -->
		                    <div id="formulario-part" class="content" role="tabpanel" aria-labelledby="formulario-part-trigger">
		                    	<div class="col-12 col-sm-12">
					            <div class="card card-primary card-outline card-outline-tabs">
					              <div class="card-header p-0 border-bottom-0">
					                <ul class="nav nav-tabs" id="panel-datos-tab" role="tablist">
					                  <li class="nav-item">
					                    <a class="nav-link active" id="panel-datos-solicitud-tab" data-toggle="pill" href="#panel-datos-solicitud" role="tab" aria-controls="panel-datos-solicitud" aria-selected="true">Datos</a>
					                  </li>
					                  <li class="nav-item">
					                    <a class="nav-link" id="panel-datos-documentos-tab" data-toggle="pill" href="#panel-datos-documentos" role="tab" aria-controls="panel-datos-documentos" aria-selected="false">Documentos</a>
					                  </li>
					                  <li class="nav-item">
					                    <a class="nav-link" id="panel-datos-anexos-tab" data-toggle="pill" href="#panel-datos-anexos" role="tab" aria-controls="panel-datos-anexos" aria-selected="false">Anexos</a>
					                  </li>
					                </ul>
					              </div>
					              <div class="card-body">
					                <div class="tab-content" id="panel-datos-tabContent">
					                  <div class="tab-pane fade show active" id="panel-datos-solicitud" role="tabpanel" aria-labelledby="panel-datos-solicitud-tab">
					                  	<div class="row">
					                  		<div class="col-lg-6">

					                  			<div class="form-group">
													<label for="txtAsunto">Asunto</label>
													<input type="text" name="txtAsunto" class="form-control" id="txtAsunto" placeholder="Ingresar asunto" required>
												</div>

												<div class="form-group">
								                  <label for="cboTipoTramite">Tipo trámite</label>
								                  <select class="form-control select2" id="cboTipoTramite" required>
								                  	<option value="0">--Seleccione--</option>
								                  </select>
								                </div>

							          		</div>

							          		<div class="col-lg-5">

							          			<div class="form-group">
													<label for="txtNumeroDocumento">Número documento</label>
													<input type="text" name="txtNumeroDocumento" class="form-control" id="txtNumeroDocumento" placeholder="Ingresar número documento" disabled required>
												</div>
							          		</div>

							          		<div class="col-lg-1">
							          			<div class="form-group">
													<div class="custom-control custom-switch" style="padding-top: 40px;">
														<input type="checkbox" class="custom-control-input" id="chkValidaNumeroDocumento" name="chkValidaNumeroDocumento" onclick="validarNumeroDocumento()">
														<label class="custom-control-label" for="chkValidaNumeroDocumento"></label>
													</div>
												</div>
							          		</div>
					                  	</div>
					                  </div>
					                  <div class="tab-pane fade" id="panel-datos-documentos" role="tabpanel" aria-labelledby="panel-datos-documentos-tab">
					                     <div class="row">
								          <div class="col-md-12">
								            <div class="card card-default">
								              <div class="card-body">
								                <div id="actions" class="row">
								                  <div class="col-lg-6">
								                    <div class="btn-group w-100">
								                      <span class="btn btn-success col fileinput-button">
								                        <i class="fas fa-plus"></i>
								                        <span>Agregar</span>
								                      </span>
								                      <button type="submit" class="btn btn-primary col start" style="margin-left: 5px; margin-right: 5px;">
								                        <i class="fas fa-upload"></i>
								                        <span>Subir</span>
								                      </button>
								                      <button type="reset" class="btn btn-warning col cancel">
								                        <i class="fas fa-times-circle"></i>
								                        <span>Cancelar</span>
								                      </button>
								                    </div>
								                  </div>
								                  <div class="col-lg-6 d-flex align-items-center" style="opacity: 0;">
								                    <div class="fileupload-process w-100">
								                      <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
								                        <div class="progress-bar progress-bar-success" style="width:0%; display: none;" data-dz-uploadprogress></div>
								                      </div>
								                    </div>
								                  </div>
								                </div>
								                <div class="table table-striped files" id="previews">
								                  <div id="template" class="row mt-2">
								                    <div class="col-auto">
								                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
								                    </div>
								                    <div class="col d-flex align-items-center">
								                        <p class="mb-0">
								                          <span class="lead" data-dz-name></span>
								                          (<span data-dz-size></span>)
								                        </p>
								                        <strong class="error text-danger" data-dz-errormessage></strong>
								                    </div>
								                    <div class="col-4 d-flex align-items-center">
								                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
								                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
								                        </div>
								                    </div>
								                    <div class="col-auto d-flex align-items-center">
								                      <div class="btn-group">
								                        <button class="btn btn-primary start">
								                          <i class="fas fa-upload"></i>
								                        </button>
								                        <button data-dz-remove class="btn btn-warning cancel" style="margin-left: 5px; margin-right: 5px;">
								                          <i class="fas fa-times-circle"></i>
								                        </button>
								                        <button data-dz-remove class="btn btn-danger delete">
								                          <i class="fas fa-trash"></i>
								                        </button>
								                      </div>
								                    </div>
								                  </div>
								                </div>
								              </div>
								              <!-- /.card-body -->
								            </div>
								            <!-- /.card -->
								          </div>
								        </div>
					                  </div>
					                  <div class="tab-pane fade" id="panel-datos-anexos" role="tabpanel" aria-labelledby="panel-datos-anexos-tab">
					                  	<div class="row">
											<div class="form-group">
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="chkValidaAnexos" name="chkValidaAnexos" onclick="validarAnexos()">
													<label class="custom-control-label" for="chkValidaAnexos">Adjuntar Anexos</label>
												</div>
											</div>
										</div>

										<div class="row dv-anexos" style="display: none;">
								          <div class="col-md-12">
								            <div class="card card-default">
								              <div class="card-body">
								                <div id="actions2" class="row">
								                  <div class="col-lg-6">
								                    <div class="btn-group w-100">
								                      <span class="btn btn-success col fileinput-button2">
								                        <i class="fas fa-plus"></i>
								                        <span>Agregar</span>
								                      </span>
								                      <button type="submit" class="btn btn-primary col start2" style="margin-left: 5px; margin-right: 5px;">
								                        <i class="fas fa-upload"></i>
								                        <span>Subir</span>
								                      </button>
								                      <button type="reset" class="btn btn-warning col cancel2">
								                        <i class="fas fa-times-circle"></i>
								                        <span>Cancelar</span>
								                      </button>
								                    </div>
								                  </div>
								                  <div class="col-lg-6 d-flex align-items-center" style="opacity: 0;">
								                    <div class="fileupload-process w-100">
								                      <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
								                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
								                      </div>
								                    </div>
								                  </div>
								                </div>
								                <div class="table table-striped files" id="previews2">
								                  <div id="template2" class="row mt-2">
								                    <div class="col-auto">
								                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
								                    </div>
								                    <div class="col d-flex align-items-center">
								                        <p class="mb-0">
								                          <span class="lead" data-dz-name></span>
								                          (<span data-dz-size></span>)
								                        </p>
								                        <strong class="error text-danger" data-dz-errormessage></strong>
								                    </div>
								                    <div class="col-4 d-flex align-items-center">
								                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
								                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
								                        </div>
								                    </div>
								                    <div class="col-auto d-flex align-items-center">
								                      <div class="btn-group">
								                        <button class="btn btn-primary start2">
								                          <i class="fas fa-upload"></i>
								                        </button>
								                        <button data-dz-remove class="btn btn-warning cancel2" style="margin-left: 5px; margin-right: 5px;">
								                          <i class="fas fa-times-circle"></i>
								                        </button>
								                        <button data-dz-remove class="btn btn-danger delete2">
								                          <i class="fas fa-trash"></i>
								                        </button>
								                      </div>
								                    </div>
								                  </div>
								                </div>
								              </div>
								              <!-- /.card-body -->
								            </div>
								            <!-- /.card -->
								          </div>
								        </div>
					                  </div>
					                </div>
					              </div>
					              <!-- /.card -->
					            </div>
					          </div>
		                      <button class="btn btn-info" onclick="stepper.next()">Siguiente</button>
		                    </div>
		                    <div id="firmar-part" class="content" role="tabpanel" aria-labelledby="firmar-part-trigger">
		                      <div class="form-group" style="text-align: center;">
		                        <canvas id="canvas" width="600" height="250" style="border: 1px solid #000;"></canvas>
		                      </div>
		                      <div class="form-group">
		                      	<div class="form-check">
		                          <input class="form-check-input" type="checkbox" id="chkNotificacion">
		                          <label class="form-check-label">Autorización de notificación</label>
		                        </div>

		                        <div class="form-check">
		                          <input class="form-check-input" type="checkbox" id="chkTerminos" onclick="validarRegistroSolicitud()">
		                          <label class="form-check-label">He leído los términos y condiciones para el registro y uso de la Mesa de Partes Virtual</label>
		                        </div>

		                        <div class="form-check">
		                          <input class="form-check-input" type="checkbox" id="chkJurada" onclick="validarRegistroSolicitud()">
		                          <label class="form-check-label">Los datos ingresados en el presente formulario tienen carácter de Declaración Jurada.</label>
		                        </div>
		                      </div>
		                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		                      <button class="btn btn-info" onclick="stepper.previous()">Anterior</button>
		                      <button type="button" class="btn btn-info" onclick="registrarSolicitud()" id="btnRegistrarSolicitud" disabled>Registrar</button>
		                    </div>
		                  </div>
		                </div>
			        </div>
			      </div>
			    </div>
			    <!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>

			<div class="modal fade" id="modal-listar-solicitud">
			  <div class="modal-dialog modal-lg" style="max-width: 1000px;">
			    <div class="modal-content">
			      <div class="modal-header bg-info">
			        <h4 class="modal-title">Listar trámites</h4>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="card-body">
			          <div class="container-fluid">
			          	<div class="row">
			          		<div class="col-lg-5">
			          			<div class="form-group">
									<label for="txtExpediente">N°. Expediente</label>
									<input type="text" name="txtExpediente" class="form-control" id="txtExpediente" placeholder="Ingresar N°. Expediente" autocomplete="off" required>
								</div>
			          		</div>
			          		<div class="col-lg-2">
			          			<div class="form-group" style="margin-top: 8px;">
			          				<br>
									<button type="button" class="btn btn-success" onclick="buscarSolicitudes()">Buscar</button>
								</div>
			          		</div>
			          	</div>

		          		<div class="row">
				          <div class="col-12">
				            <div class="card">
				              <div class="card-body">
				                <table id="tblSolicitudes" class="table table-bordered table-striped" style="width: 100%;">
									<thead>
										<tr>
											<th>N° Expediente</th>
											<th>Asunto</th>
											<th>Estado</th>
											<th>Fecha Registro</th>
											<th style="text-align: center;">Ver Detalle</th>
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

			          </div>
			        </div>
			      </div>
			      <div class="modal-footer justify-content-between">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			      </div>
			    </div>
			    <!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>


			<div class="modal fade" id="modal-ver-asignados">
			  <div class="modal-dialog modal-lg" style="max-width: 1000px;">
			    <div class="modal-content">
			      <div class="modal-header bg-info">
			        <h4 class="modal-title">Ver trámites asignados</h4>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="card-body">
			          <div class="container-fluid">
		          		<div class="row">
				          <div class="col-12">
				            <div class="card">
				              <div class="card-body">
				                <table id="tblTramitesAsignados" class="table table-bordered table-striped" style="width: 100%;">
									<thead>
										<tr>
											<th>N° Expediente</th>
											<th>Remitente</th>
											<th>Tipo trámite</th>
											<th>Asunto</th>
											<th>Fecha Registro</th>
											<th style="text-align: center;">Ver Detalle</th>
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

			          </div>
			        </div>
			      </div>
			      <div class="modal-footer justify-content-between">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			      </div>
			    </div>
			    <!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>


			<div class="modal fade" id="modal-detalle-tramite">
			  <div class="modal-dialog modal-lg" style="max-width: 1000px;">
			    <div class="modal-content">
			      <div class="modal-header bg-info">
			        <h4 class="modal-title">Ver detalle del trámite</h4>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body scroll">
			        <div class="card-body">
			          <div class="container-fluid">
			          	<div class="row">
			          		<div class="col-lg-6">
			          			<div class="form-group">
									<label for="lblFechaIngreso">Fecha de Ingreso:</label>
									<span id="lblFechaIngreso"></span>
								</div>
								<div class="form-group">
									<label for="lblHoraIngreso">Hora de Ingreso:</label>
									<span id="lblHoraIngreso"></span>
								</div>
								<div class="form-group">
									<label for="lblExpediente">Expediente:</label>
									<span id="lblExpediente"></span>
								</div>
								<div class="form-group">
									<label for="lblNumeroDocumento">Número Documento:</label>
									<span id="lblNumeroDocumento"></span>
								</div>
			          		</div>

			          		<div class="col-lg-6">
			          			<div class="form-group">
									<label for="lblRemitente">Remitente:</label>
									<span id="lblRemitente"></span>
								</div>
								<div class="form-group">
									<label for="lblAsunto">Asunto:</label>
									<span id="lblAsunto"></span>
								</div>
								<div class="form-group">
									<label for="lblTipoTramite">Tipo de Trámite:</label>
									<span id="lblTipoTramite"></span>
								</div>
								<div class="form-group">
									<label for="lblEstadoDocumento">Estado del Documento:</label>
									<span id="lblEstadoDocumento"></span>
								</div>
			          		</div>
			          	</div>
			          	<div class="row">
				          <div class="col-12">
				            <div class="card">
				              <!-- /.card-header -->
				              <div class="card-body">
				                <table id="tblDetalleSolicitud" class="table table-bordered table-striped" style="width:100%">
				                  <thead class="btn-info">
				                  <tr>
				                    <th>Oficina</th>
				                    <th>Usuario Atencion</th>
				                    <th>Estado</th>
				                    <th>Fecha Ingreso</th>
				                    <th>Fecha Salida</th>
				                  </tr>
				                  </thead>
				                  <tbody id="bodyDetalleSolicitud">
				                  </tbody>
				                </table>
				              </div>
				              <!-- /.card-body -->
				            </div>
				            <!-- /.card -->
				          </div>
				          <!-- /.col -->
				        </div>

				        <div class="row dvArchivosDescargarAtendido" style="display: none;">
				        	<hr>
			          		<h3 class="card-title">
			                  <i class="fas fa-book"></i>
			                  Archivos
			                </h3>
				          	<br>
				          	<div id="listaArchivosAtendidos"></div>
				          	<hr>
				          	<h3 class="card-title">
			                  <i class="fas fa-tag"></i>
			                  Anexos
			                </h3>
			                <br>
				          	<div id="listaAnexosAtendidos"></div>
				          	<hr>
				        </div>

				        <div class="row">
				        	<div class="col-4"></div>
				        	<div class="col-4 btnObservacion" style="text-align: center;">
				        		<button type="button" class="btn btn-danger" onclick="levantarObservacionTramite()">Levantar Observación</button>
				        	</div>
				        	<div class="col-4"></div>
				        </div>
			          </div>
			        </div>
			      </div>
			      <div class="modal-footer justify-content-between">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			      </div>
			    </div>
			    <!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>

			<div class="modal fade" id="modal-levantar-observacion">
			  <div class="modal-dialog modal-lg" style="max-width: 1000px;">
			    <div class="modal-content">
			      <div class="modal-header bg-info">
			        <h4 class="modal-title">Levantar observación - N°. Expediente: <label id="lblExpedienteTitulo"></label> </h4>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="card-body">
			          <div class="container-fluid">
			          	<div class="row">
			          		<div class="col-lg-6">

			          			<div class="form-group">
									<label for="lblMotivoObservado">Motivo:</label>
									<span id="lblMotivoObservado"></span>
								</div>

			          			<div class="form-group">
									<label for="cboPlantilla" required>Plantillas:</label>
									<select class="form-control select2" name="cboPlantilla" id="cboPlantilla">
										<option value="0">--Seleccione--</option>
										<option value="informe">Informe</option>
										<option value="constancia">Constancia prácticas</option>
										<option value="certificado">Certificado</option>
									</select>
								</div>
			          		</div>

			          		<div class="col-lg-2">
			          			<div class="form-group" style="padding-top: 79px;">
			          				<a href="#" class="btn btn-danger" id="downloadLink">Descargar</a>
								</div>
			          		</div>
			          	</div>
			          	<hr>
			          	<h4>Subir archivos</h4>

			          	<div class="row">
				          <div class="col-md-12">
				            <div class="card card-default">
				              <div class="card-body">
				                <div id="actions3" class="row">
				                  <div class="col-lg-6">
				                    <div class="btn-group w-100">
				                      <span class="btn btn-success col fileinput-button3">
				                        <i class="fas fa-plus"></i>
				                        <span>Agregar</span>
				                      </span>
				                      <button type="submit" class="btn btn-primary col start3" style="margin-left: 5px; margin-right: 5px;">
				                        <i class="fas fa-upload"></i>
				                        <span>Subir</span>
				                      </button>
				                      <button type="reset" class="btn btn-warning col cancel3">
				                        <i class="fas fa-times-circle"></i>
				                        <span>Cancelar</span>
				                      </button>
				                    </div>
				                  </div>
				                  <div class="col-lg-6 d-flex align-items-center" style="opacity: 0;">
				                    <div class="fileupload-process w-100">
				                      <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
				                        <div class="progress-bar progress-bar-success" style="width:0%; display: none;" data-dz-uploadprogress></div>
				                      </div>
				                    </div>
				                  </div>
				                </div>
				                <div class="table table-striped files" id="previews3">
				                  <div id="template3" class="row mt-2">
				                    <div class="col-auto">
				                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
				                    </div>
				                    <div class="col d-flex align-items-center">
				                        <p class="mb-0">
				                          <span class="lead" data-dz-name></span>
				                          (<span data-dz-size></span>)
				                        </p>
				                        <strong class="error text-danger" data-dz-errormessage></strong>
				                    </div>
				                    <div class="col-4 d-flex align-items-center">
				                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
				                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
				                        </div>
				                    </div>
				                    <div class="col-auto d-flex align-items-center">
				                      <div class="btn-group">
				                        <button class="btn btn-primary start3">
				                          <i class="fas fa-upload"></i>
				                        </button>
				                        <button data-dz-remove class="btn btn-warning cancel3" style="margin-left: 5px; margin-right: 5px;">
				                          <i class="fas fa-times-circle"></i>
				                        </button>
				                        <button data-dz-remove class="btn btn-danger delete3">
				                          <i class="fas fa-trash"></i>
				                        </button>
				                      </div>
				                    </div>
				                  </div>
				                </div>
				              </div>
				              <!-- /.card-body -->
				            </div>
				            <!-- /.card -->
				          </div>
				        </div>
			          </div>
			        </div>
			      </div>
			      <div class="modal-footer justify-content-between">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			        <button type="button" class="btn btn-info" onclick="registrarExpedienteObservado()">Registrar</button>
			      </div>
			    </div>
			    <!-- /.modal-content -->
			  </div>
			  <!-- /.modal-dialog -->
			</div>

			<div class="modal fade" id="modal-detalle-tramite-asignado">
			  <div class="modal-dialog modal-lg" style="max-width: 1000px;">
			    <div class="modal-content">
			      <div class="modal-header bg-info">
			        <h4 class="modal-title">Trámite</h4>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body scroll">
			        <div class="card-body">
			          <div class="container-fluid">
			          	<div class="row">
			          		<div class="col-lg-6">
			          			<div class="form-group">
									<label for="lblFechaIngresoAsignar">Fecha de Ingreso:</label>
									<span id="lblFechaIngresoAsignar"></span>
								</div>
								<div class="form-group">
									<label for="lblHoraIngresoAsignar">Hora de Ingreso:</label>
									<span id="lblHoraIngresoAsignar"></span>
								</div>
								<div class="form-group">
									<label for="lblExpedienteAsignar">Expediente:</label>
									<span id="lblExpedienteAsignar"></span>
								</div>
								<div class="form-group">
									<label for="lblNumeroDocumentoAsignar">Número Documento:</label>
									<span id="lblNumeroDocumentoAsignar"></span>
								</div>
			          		</div>

			          		<div class="col-lg-6">
			          			<div class="form-group">
									<label for="lblRemitenteAsignar">Remitente:</label>
									<span id="lblRemitenteAsignar"></span>
								</div>
								<div class="form-group">
									<label for="lblAsuntoAsignar">Asunto:</label>
									<span id="lblAsuntoAsignar"></span>
								</div>
								<div class="form-group">
									<label for="lblTipoTramiteAsignar">Tipo de Trámite:</label>
									<span id="lblTipoTramiteAsignar"></span>
								</div>
			          		</div>
			          	</div>
			          	<hr>
		          		<h3 class="card-title">
		                  <i class="fas fa-book"></i>
		                  Archivos
		                </h3>
			          	<br>
			          	<div id="listaArchivos"></div>
			          	<hr>
			          	<h3 class="card-title">
		                  <i class="fas fa-tag"></i>
		                  Anexos
		                </h3>
		                <br>
			          	<div id="listaAnexos"></div>
			          	<hr>
			          	<div class="row">
			          		<div class="col-lg-6">
			          			<div class="form-group">
			          			  <input type="hidden" id="idTramiteAsignacion" name="idTramiteAsignacion">
			          			  <input type="hidden" id="idDetalleSolicitud" name="idDetalleSolicitud">
				                  <label for="cboNuevoEstadoTramite">Estado</label>
				                  <select class="form-control select2" id="cboNuevoEstadoTramite" onchange="validarEstadoTramite()" required>
				                  	<option value="0">--Seleccione--</option>
				                  	<option value="2">Derivar</option>
				                  	<option value="4">Observado</option>
				                  	<option value="5">Cancelado</option>
				                  	<option value="3">Atender</option>
				                  </select>
				                </div>

				                <div class="form-group dvMotivo" style="display: none;">
								    <label for="txtMotivo">Motivo</label>
								    <textarea class="form-control" id="txtMotivo" rows="3"></textarea>
								</div>
			          		</div>

			          		<div class="col-lg-6">
			          			<div class="form-group dvOficina">
				                  <label for="dboAreaAsignar">Oficina a asignar</label>
				                  <select class="form-control select2" id="dboAreaAsignar" required>
				                  	<option value="0">--Seleccione--</option>
				                  </select>
				                </div>

				                <div class="form-group dvAtender" style="display: none;">
				                  <label for="cboTipoDocumento">Tipo de documento</label>
				                  <select class="form-control select2" id="cboTipoDocumento" required>
				                  	<option value="0">--Seleccione--</option>
				                  	<option value="Acta">Acta</option>
				                  	<option value="Carta">Carta</option>
				                  	<option value="Informe">Informe</option>
				                  	<option value="Memorandum">Memorandum</option>
				                  	<option value="Memorandum Múltiple">Memorandum Múltiple</option>
				                  	<option value="Oficio">Oficio</option>
				                  	<option value="Oficio Múltiple">Oficio Múltiple</option>
				                  	<option value="Resolución">Resolución</option>
				                  	<option value="Proveído">Proveído</option>
				                  </select>
				                </div>
			          		</div>
			          	</div>

			          	<div class="row dvAtender" style="display: none">
			          		<h4>Subir archivos</h4>

				          	<div class="row">
					          <div class="col-md-12">
					            <div class="card card-default">
					              <div class="card-body">
					                <div id="actions4" class="row">
					                  <div class="col-lg-6">
					                    <div class="btn-group w-100">
					                      <span class="btn btn-success col fileinput-button4">
					                        <i class="fas fa-plus"></i>
					                        <span>Agregar</span>
					                      </span>
					                      <button type="submit" class="btn btn-primary col start4" style="margin-left: 5px; margin-right: 5px;">
					                        <i class="fas fa-upload"></i>
					                        <span>Subir</span>
					                      </button>
					                      <button type="reset" class="btn btn-warning col cancel4">
					                        <i class="fas fa-times-circle"></i>
					                        <span>Cancelar</span>
					                      </button>
					                    </div>
					                  </div>
					                  <div class="col-lg-6 d-flex align-items-center" style="opacity: 0;">
					                    <div class="fileupload-process w-100">
					                      <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
					                        <div class="progress-bar progress-bar-success" style="width:0%; display: none;" data-dz-uploadprogress></div>
					                      </div>
					                    </div>
					                  </div>
					                </div>
					                <div class="table table-striped files" id="previews4">
					                  <div id="template4" class="row mt-2">
					                    <div class="col-auto">
					                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
					                    </div>
					                    <div class="col d-flex align-items-center">
					                        <p class="mb-0">
					                          <span class="lead" data-dz-name></span>
					                          (<span data-dz-size></span>)
					                        </p>
					                        <strong class="error text-danger" data-dz-errormessage></strong>
					                    </div>
					                    <div class="col-4 d-flex align-items-center">
					                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
					                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
					                        </div>
					                    </div>
					                    <div class="col-auto d-flex align-items-center">
					                      <div class="btn-group">
					                        <button class="btn btn-primary start4">
					                          <i class="fas fa-upload"></i>
					                        </button>
					                        <button data-dz-remove class="btn btn-warning cancel4" style="margin-left: 5px; margin-right: 5px;">
					                          <i class="fas fa-times-circle"></i>
					                        </button>
					                        <button data-dz-remove class="btn btn-danger delete4">
					                          <i class="fas fa-trash"></i>
					                        </button>
					                      </div>
					                    </div>
					                  </div>
					                </div>
					              </div>
					              <!-- /.card-body -->
					            </div>
					            <!-- /.card -->
					          </div>
					        </div>
			          	</div>

			          	<div class="row dvAtender" style="display: none; text-align: center;">
			          		<h4>Firmar documento</h4>
			          		<canvas id="canvas2" width="600" height="250" style="border: 1px solid #000;"></canvas>
			          	</div>

			          </div>
			        </div>
			      </div>
			      <div class="modal-footer justify-content-between">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			        <button type="button" class="btn btn-info btnRegistrarCambioTramite">Registrar</button>
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

    <script src="../js/DAO/solicitudDAO.js" type="text/javascript"></script>

    <script>

    	var tableDetalleSolicitud;
    	var tableSolicitudes;
    	var nombreDocumentos = [];
		var nombreAnexos = [];
		var nombreArchivosObservados = [];
		var nombreArchivosAtendidos = [];

		/*---------------------------Firma documento usuario interno---------------------------*/

		var canvas2 = document.getElementById('canvas2');
	    var ctx2 = canvas2.getContext('2d');
	    var isDrawing2 = false;
	    var lastX2 = 0;
	    var lastY2 = 0;

	    canvas2.addEventListener('mousedown', (e) => {
	        isDrawing2 = true;
	        [lastX2, lastY2] = [e.offsetX, e.offsetY];
	    });

	    canvas2.addEventListener('mousemove', (e) => {
	        if (!isDrawing2) return;
	        ctx2.beginPath();
	        ctx2.moveTo(lastX2, lastY2);
	        ctx2.lineTo(e.offsetX, e.offsetY);
	        ctx2.stroke();
	        [lastX2, lastY2] = [e.offsetX, e.offsetY];
	    });

	    canvas2.addEventListener('mouseup', () => {
	        isDrawing2 = false;
	    });

	    /*---------------------------Fin firma documento usuario interno---------------------------*/

		$(function () {
			$(document).ready(function () {

			    tableSolicitudes = $('#tblSolicitudes').DataTable({
			    	"language": {
			            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			        },
			    });

			    tableDetalleSolicitud = $('#tblDetalleSolicitud').DataTable({
			    	"language": {
			            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			        }
			    });

			    var tableTramiteAsignado = $('#tblTramitesAsignados').DataTable({
			    	"language": {
			            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			        },
			        ajax: {
			        	"url": "../controller/ControllerSIFO.php",
			        	"type": "GET",
			        	"data": {
			        		command : 'solicitud',
	            			action : 'verTramitesAsignados'
			        	}
			        },
			        columns: [
			            { data: 'vNumeroExpediente' },
			            { data: 'Remitente' },
			            { data: 'vTipoTramite' },
			            { data: 'vAsunto' },
			            { data: 'FechaRegistro' },
			            {
							data: null,
							render: function(data, type, row) {
								return '<button class="btn btn-primary acciones-btn btn-sm btnDetalleTramiteAsignado" data-toggle="modal" data-target="#modal-detalle-tramite-asignado"><i class="fas fa-search-plus"></i></button>';
							}
						}
			        ]
			    });

			    $('#tblTramitesAsignados tbody').on('click', '.btnDetalleTramiteAsignado', function(){
			    	$('#modal-ver-asignados').modal('hide');
			    	var data = tableTramiteAsignado.row($(this).parents('tr')).data();
			    	solicitudDAO.getInformacionTramite(data["iId"], data["codigoDetalleSolicitud"]);
			    	solicitudDAO.verArchivos(data["vNumeroExpediente"]);
			    	solicitudDAO.verAnexos(data["vNumeroExpediente"]);
			    });

			    $('.btnRegistrarCambioTramite').on('click', function(){
			    	var estado = $('#cboNuevoEstadoTramite').val();
					var motivo = $('#txtMotivo').val();
					var oficinaAsignar = $('#dboAreaAsignar').val();
					var firmaOficina = canvas2.toDataURL('image/png');

					if(estado == 0){
						toastr.error('Favor de seleccionar un estado');
						return false;
					}

					if(oficinaAsignar == 0 && estado != 3 && estado != 4 && estado != 5){
						toastr.error('Favor de seleccionar una oficina a derivar el trámite');
						return false;
					}

					if(estado == 4 && estado == 5 && motivo == ''){
						toastr.error('Favor de escribir un motivo del porque se observa y/o cancela el trámite');
						return false;
					}

					solicitudDAO.registrarDerivacionTramite(tableTramiteAsignado, nombreArchivosAtendidos, firmaOficina);
					nombreArchivosAtendidos = [];
					ctx2.clearRect(0, 0, canvas2.width, canvas2.height);
			    });

			    $('.btnRegistrarExpedienteObservado').on('click', function(){


					solicitudDAO.registrarDerivacionTramite(tableTramiteAsignado, nombreArchivosAtendidos, 0);
					nombreArchivosAtendidos = [];
			    });			    

			    solicitudDAO.getAreas();
			    solicitudDAO.getTipoTramite();

			    solicitudDAO.getBacklog();
			    solicitudDAO.getEnProceso();
			    solicitudDAO.getHecho();
			    solicitudDAO.getObservado();
			    solicitudDAO.getCancelado();

			    const downloadLink = document.getElementById('downloadLink');
		
				downloadLink.addEventListener('click', () => {

				    var nombreArchivo;
				    var plantilla = $('#cboPlantilla').val();

				    if(plantilla == 0){
				    	toastr.error('Favor de elegir una plantilla');
						return false;
				    } else if(plantilla == 'informe'){
				    	nombreArchivo = 'PLANTILLA IESTP EAG INFORME.docx';
				    } else if (plantilla == 'constancia'){
				    	nombreArchivo = 'PLANTILLA CONSTANCIA PRACTICAS MODULARES.docx';
				    } else if (plantilla == 'certificado'){
				    	nombreArchivo = 'PLANTILLA CERTIFICADO MODULAR.docx';
				    }

				    var fileUrl = '../resources/plantillas/' + nombreArchivo;

				    const link = document.createElement('a');
				    link.href = fileUrl;
				    link.download = nombreArchivo;

				    link.click();
				    
				});    
			});
		});

		document.addEventListener('DOMContentLoaded', function () {
			window.stepper = new Stepper(document.querySelector('.bs-stepper'))
		});

		/*---------------------------Firma documento usuario externo---------------------------*/

		var canvas = document.getElementById('canvas');
	    var ctx = canvas.getContext('2d');
	    var isDrawing = false;
	    var lastX = 0;
	    var lastY = 0;

	    canvas.addEventListener('mousedown', (e) => {
	        isDrawing = true;
	        [lastX, lastY] = [e.offsetX, e.offsetY];
	    });

	    canvas.addEventListener('mousemove', (e) => {
	        if (!isDrawing) return;
	        ctx.beginPath();
	        ctx.moveTo(lastX, lastY);
	        ctx.lineTo(e.offsetX, e.offsetY);
	        ctx.stroke();
	        [lastX, lastY] = [e.offsetX, e.offsetY];
	    });

	    canvas.addEventListener('mouseup', () => {
	        isDrawing = false;
	    });

	    /*---------------------------Fin firma documento usuario externo---------------------------*/

		function validarNumeroDocumento(){
			var valor = $('input[name="chkValidaNumeroDocumento"]:checked').val();

			if(valor != 'on'){
				$('#txtNumeroDocumento').attr('disabled', 'disabled');
				$('#txtNumeroDocumento').val('');
			} else {
				$('#txtNumeroDocumento').removeAttr('disabled');
			}
		}

		function validarRegistroSolicitud(){
			var terminos = document.getElementById("chkTerminos");
			var declaracion_jurada = document.getElementById("chkJurada");

			if(terminos.checked && declaracion_jurada.checked){
				$('#btnRegistrarSolicitud').removeAttr('disabled');
			} else {
				$('#btnRegistrarSolicitud').attr('disabled', 'disabled');
			}
		}

		function validarAnexos(){
			var anexos = document.getElementById("chkValidaAnexos");

			if(anexos.checked){
				$('.dv-anexos').css('display', 'block');
			} else {
				$('.dv-anexos').css('display', 'none');
			}
		}

		function registrarSolicitud(){

			var asunto = $('#txtAsunto').val();
			var numero_documento = $('#txtNumeroDocumento').val();
			var chk_numero_documento = $('input[name="chkValidaNumeroDocumento"]:checked').val();
			var tipo_tramite = $('#cboTipoTramite').val();
			var notificacion = document.getElementById("chkNotificacion").checked;
			var firma = canvas.toDataURL('image/png');

			if(asunto == ''){
				toastr.error('Favor de ingresar asunto');
				return false;
			} else if (chk_numero_documento == 'on'){

				if(numero_documento == ''){
					toastr.error('Favor de ingresar número de documento');
					return false;
				}

			} else if (tipo_tramite == 0){
				toastr.error('Favor de elegir tipo de trámite');
				return false;
			}

			solicitudDAO.registrarSolicitud(nombreDocumentos, nombreAnexos, firma);
			nombreDocumentos = [];
			nombreAnexos = [];
			ctx.clearRect(0, 0, canvas.width, canvas.height);
		}

		function buscarSolicitudes(){

			var expediente = $('#txtExpediente').val();

			if(expediente == ''){
				toastr.error('Favor de ingresar N°. expediente');
				return false;
			}

			solicitudDAO.buscarSolicitud(tableSolicitudes);
		}

		function verDetalleTramite(codigo){
			$('#modal-listar-solicitud').modal('hide');
			$('#modal-detalle-tramite').modal('show');
			solicitudDAO.verDetalleSolicitud(codigo);
			solicitudDAO.listDetalleSolicitud(codigo, tableDetalleSolicitud);
		}

		function validarEstadoTramite(){
			var valor = $("#cboNuevoEstadoTramite").val();

			$('.dvOficina').css('display', 'block');
			$('.dvMotivo').css('display', 'none');
			$('.dvAtender').css('display', 'none');

			if(valor == 4 || valor == 5){
				$('.dvOficina').css('display', 'none');
				$('.dvMotivo').css('display', 'block');
				$('.dvAtender').css('display', 'none');
			} else if (valor == 3){
				$('.dvOficina').css('display', 'none');
				$('.dvMotivo').css('display', 'none');
				$('.dvAtender').css('display', 'block');
			}
		}

		function levantarObservacionTramite(){
			$('#modal-detalle-tramite').modal('hide');
			$('#modal-levantar-observacion').modal('show');

			var expediente = $('#lblExpediente').html();
			$('#lblExpedienteTitulo').html(expediente);
		}

		function registrarExpedienteObservado(){
			var expediente = $('#lblExpedienteTitulo').html();
			solicitudDAO.registrarExpedienteObservado(nombreArchivosObservados, expediente);
			nombreArchivosObservados = [];
		}

		/*-----------------Adjuntar Documentos-----------------*/

		Dropzone.autoDiscover = false

		var previewNode = document.querySelector("#template")
		  previewNode.id = ""
		  var previewTemplate = previewNode.parentNode.innerHTML
		  previewNode.parentNode.removeChild(previewNode)


		var myDropzone = new Dropzone(document.body, {
			url: "/gestionDocumentaria/resources/carga.php?flag=documento",
			thumbnailWidth: 80,
			thumbnailHeight: 80,
			parallelUploads: 20,
			previewTemplate: previewTemplate,
			autoQueue: false,
			previewsContainer: "#previews",
			clickable: ".fileinput-button"
		})

		myDropzone.on("addedfile", function(file) {
			file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
		})

		myDropzone.on("totaluploadprogress", function(progress) {
			document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
		})

		myDropzone.on("sending", function(file) {
			document.querySelector("#total-progress").style.opacity = "0";

			file.previewElement.querySelector(".cancel").style.display = 'none';
			file.previewElement.querySelector(".start").style.display = 'none';
			file.previewElement.querySelector(".delete").style.display = 'none';

			nombreDocumentos.push({nombreDocumento: file.name});
		})

		myDropzone.on("queuecomplete", function(progress) {
			document.querySelector("#total-progress").style.opacity = "0"
		})

		document.querySelector("#actions .start").onclick = function() {
			myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
		}
		document.querySelector("#actions .cancel").onclick = function() {
			myDropzone.removeAllFiles(true)
		}

		/*-----------------Fin Adjuntar Documentos-----------------*/


		/*-----------------Adjuntar Anexos-----------------*/

		var previewNode2 = document.querySelector("#template2")
		  previewNode2.id = ""
		  var previewTemplate2 = previewNode2.parentNode.innerHTML
		  previewNode2.parentNode.removeChild(previewNode2)


		var myDropzone2 = new Dropzone('#actions2', {
			url: "/gestionDocumentaria/resources/carga.php?flag=anexo",
			thumbnailWidth: 80,
			thumbnailHeight: 80,
			parallelUploads: 20,
			previewTemplate: previewTemplate2,
			autoQueue: false,
			previewsContainer: "#previews2",
			clickable: ".fileinput-button2"
		})

		myDropzone2.on("addedfile", function(file) {
			file.previewElement.querySelector(".start2").onclick = function() { myDropzone2.enqueueFile(file) }
		})

		myDropzone2.on("totaluploadprogress", function(progress) {
			document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
		})

		myDropzone2.on("sending", function(file) {
			document.querySelector("#total-progress").style.opacity = "0";

			file.previewElement.querySelector(".cancel2").style.display = 'none';
			file.previewElement.querySelector(".start2").style.display = 'none';
			file.previewElement.querySelector(".delete2").style.display = 'none';

			nombreAnexos.push({nombreAnexo: file.name});
		})

		myDropzone2.on("queuecomplete", function(progress) {
			document.querySelector("#total-progress").style.opacity = "0";
		})

		document.querySelector("#actions2 .start2").onclick = function() {
			myDropzone2.enqueueFiles(myDropzone2.getFilesWithStatus(Dropzone.ADDED))
		}
		document.querySelector("#actions2 .cancel2").onclick = function() {
			myDropzone2.removeAllFiles(true)
		}

		/*-----------------Fin Adjuntar Anexos-----------------*/


		/*-----------------Levantar observacion-----------------*/

		var previewNode3 = document.querySelector("#template3")
		  previewNode3.id = ""
		  var previewTemplate2 = previewNode3.parentNode.innerHTML
		  previewNode3.parentNode.removeChild(previewNode3)


		var myDropzone3 = new Dropzone('#actions3', {
			url: "/gestionDocumentaria/resources/carga.php?flag=anexo",
			thumbnailWidth: 80,
			thumbnailHeight: 80,
			parallelUploads: 20,
			previewTemplate: previewTemplate2,
			autoQueue: false,
			previewsContainer: "#previews3",
			clickable: ".fileinput-button3"
		})

		myDropzone3.on("addedfile", function(file) {
			file.previewElement.querySelector(".start3").onclick = function() { myDropzone3.enqueueFile(file) }
		})

		myDropzone3.on("totaluploadprogress", function(progress) {
			document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
		})

		myDropzone3.on("sending", function(file) {
			document.querySelector("#total-progress").style.opacity = "0";

			file.previewElement.querySelector(".cancel3").style.display = 'none';
			file.previewElement.querySelector(".start3").style.display = 'none';
			file.previewElement.querySelector(".delete3").style.display = 'none';

			nombreArchivosObservados.push({nombreArchivo: file.name});
		})

		myDropzone3.on("queuecomplete", function(progress) {
			document.querySelector("#total-progress").style.opacity = "0";
		})

		document.querySelector("#actions3 .start3").onclick = function() {
			myDropzone3.enqueueFiles(myDropzone3.getFilesWithStatus(Dropzone.ADDED))
		}
		document.querySelector("#actions3 .cancel3").onclick = function() {
			myDropzone3.removeAllFiles(true)
		}

		/*-----------------Fin Levantar observacion3-----------------*/

		/*-----------------Atender tramite-----------------*/

		var previewNode4 = document.querySelector("#template4")
		  previewNode4.id = ""
		  var previewTemplate4 = previewNode4.parentNode.innerHTML
		  previewNode4.parentNode.removeChild(previewNode4)


		var myDropzone4 = new Dropzone('#actions4', {
			url: "/gestionDocumentaria/resources/carga.php?flag=anexo",
			thumbnailWidth: 80,
			thumbnailHeight: 80,
			parallelUploads: 20,
			previewTemplate: previewTemplate4,
			autoQueue: false,
			previewsContainer: "#previews4",
			clickable: ".fileinput-button4"
		})

		myDropzone4.on("addedfile", function(file) {
			file.previewElement.querySelector(".start4").onclick = function() { myDropzone4.enqueueFile(file) }
		})

		myDropzone4.on("totaluploadprogress", function(progress) {
			document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
		})

		myDropzone4.on("sending", function(file) {
			document.querySelector("#total-progress").style.opacity = "0";

			file.previewElement.querySelector(".cancel4").style.display = 'none';
			file.previewElement.querySelector(".start4").style.display = 'none';
			file.previewElement.querySelector(".delete4").style.display = 'none';

			nombreArchivosAtendidos.push({nombreArchivo: file.name});
		})

		myDropzone4.on("queuecomplete", function(progress) {
			document.querySelector("#total-progress").style.opacity = "0";
		})

		document.querySelector("#actions4 .start4").onclick = function() {
			myDropzone4.enqueueFiles(myDropzone4.getFilesWithStatus(Dropzone.ADDED))
		}
		document.querySelector("#actions4 .cancel4").onclick = function() {
			myDropzone4.removeAllFiles(true)
		}

		/*-----------------Fin Atender tramite-----------------*/

	</script>

</body>
</html>