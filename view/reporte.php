<?php include('header.php'); ?>

<title> Reporte estado de trámites</title>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include('header_options.php'); ?>
        <?php include('menu.php'); ?>
        <div class="content-wrapper">
        	<section class="content-header">
		      <div class="container-fluid">
		        <div class="row mb-2">
		          <div class="col-sm-6">
		            <h1>Reporte estado de trámites</h1>
		          </div>
		        </div>
		      </div><!-- /.container-fluid -->
		    </section>

		    <section class="content">
		      <div class="container-fluid">
		      	<div class="row">
		      		<div class="col-lg-2"></div>
		      		<div class="col-lg-2">
	          			<div class="form-group">
							<label for="cboBusquedaEstado">Estado de trámite</label>
							<select class="form-control select2" name="cboBusquedaEstado" id="cboBusquedaEstado">
								<option value="0">--Seleccione--</option>
								<option value="1">Pendiente</option>
								<option value="2">En proceso</option>
								<option value="4">Observado</option>
								<option value="5">Cancelado</option>
								<option value="3">Finalizado</option>
							</select>
						</div>
	          		</div>

	          		<div class="col-lg-2">
	          			<div class="form-group">
							<label for="txtFechaInicio">Fecha Inicio</label>
							<div class="input-group date" data-target-input="nearest">
		                        <input type="text" class="form-control datetimepicker-input" data-target="#txtFechaInicio" id="txtFechaInicio" name="txtFechaInicio" />
		                        <div class="input-group-append" data-target="#txtFechaInicio" data-toggle="datetimepicker">
		                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
		                        </div>
		                    </div>
						</div>
	          		</div>

	          		<div class="col-lg-2">
	          			<div class="form-group">
		                  	<label for="txtFechaFin">Fecha Fin:</label>
		                    <div class="input-group date" data-target-input="nearest">
		                        <input type="text" class="form-control datetimepicker-input" data-target="#txtFechaFin" id="txtFechaFin" name="txtFechaFin" />
		                        <div class="input-group-append" data-target="#txtFechaFin" data-toggle="datetimepicker">
		                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
		                        </div>
		                    </div>
		                </div>
	          		</div>

	          		<div class="col-lg-2">
	          			<div class="form-group" style="padding-top: 32px;">
							<button type="button" class="btn btn-info" id="btnBuscar" onclick="buscarTramites()">Buscar</button>
						</div>
	          		</div>

		      	</div>
		        <div class="row">
		          <div class="col-12">
		            <div class="card">
		              <!-- /.card-header -->
		              <div class="card-body">
		                <table id="tblReporte" class="table table-striped table-bordered nowrap" style="width:100%">
		                  <thead class="btn-info">
		                  <tr>
		                    <th style="width: 70px;">Código</th>
		                    <th>Usuario creación</th>
		                    <th>Expediente</th>
		                    <th>Tipo trámite</th>
		                    <th>Asunto</th>
		                    <th>N°. Documento</th>
		                    <th>Fecha registro</th>
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

        </div>
        <?php include('footer.php'); ?>
    </div>
    <?php include('scripts.php'); ?>

    <script src="../js/DAO/reporteDAO.js" type="text/javascript"></script>

    <script>

    	var tableReportes;

    	$(function () {
			$(document).ready(function () {

			    tableReportes = $('#tblReporte').DataTable({
			    	dom: 'Bfrtip',
			        buttons: [
			            'excel', 'pdf', 'print'
			        ],
			    	"language": {
			            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			        },
			    });    
			});
		});

    	$('#txtFechaFin, #txtFechaInicio').datetimepicker({
	        format: 'yyyy/MM/DD'
	    });

	    function buscarTramites(){

			var estado = $('#cboBusquedaEstado').val();
			var fechaInicio = $('#txtFechaInicio').val();
			var fechaFin = $('#txtFechaFin').val();

			if(estado == 0){
				toastr.error('Favor de seleccionar un estado');
				return false;
			}

			if(fechaInicio == ''){
				toastr.error('Favor de ingresar fecha de inicio');
				return false;
			}

			if(fechaFin == ''){
				toastr.error('Favor de ingresar fecha fin');
				return false;
			}

			reporteDAO.buscarTramites(tableReportes);
		}

    </script>
</body>
</html>