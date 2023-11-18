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
		            <h1>Oficinas</h1>

		            <button type="button" class="btn btn-info btn-sm btnAgregarModal" data-toggle="modal" data-target="#modal-agregar-area" style="margin-top: 10px;"> <i class="fas fa-plus-square"></i> Nueva Oficina</button>
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
		                <table id="tblArea" class="table table-striped table-bordered nowrap" style="width:100%">
		                  <thead class="btn-info">
		                  <tr>
		                    <th style="width: 70px;">Código</th>
		                    <th>Nombre</th>
		                    <th style="width: 100px;">Acciones</th>
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

		    <div class="modal fade" id="modal-agregar-area">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">
			      <div class="modal-header bg-info">
			        <h4 class="modal-title txtTitulo"></h4>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="card-body">
			          <div class="container-fluid">
			          	<div class="row">
			          		<div class="col-lg-11">
			          			<div class="form-group">
									<label for="txtNombres">Nombre</label>
									<input type="text" name="txtNombre" class="form-control" id="txtNombre" placeholder="Ingrese nombre" required>
									<input type="hidden" name="txtIdArea" id="txtIdArea" value="0">
								</div>
			          		</div>
			          	</div>
			          </div>
			        </div>
			      </div>
			      <div class="modal-footer justify-content-between">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			        <button type="button" class="btn btn-info" id="btnGuardar"> <span id="lblNombreBoton"></span> </button>
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

    <script src="../js/DAO/areaDAO.js" type="text/javascript"></script>

    <script>
		$(function () {
			$(document).ready(function () {
				
				var tableArea = $('#tblArea').DataTable({
			    	"language": {
			            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			        },
			        ajax: {
			        	"url": "../controller/ControllerSIFO.php",
			        	"type": "GET",
			        	"data": {
			        		command : 'area',
	            			action : 'listArea'
			        	}
			        },
			        columns: [
			            { data: 'iId' },
			            { data: 'vDescripcion' },
			            {
							data: null,
							render: function(data, type, row) {
								return '<button class="btn btn-primary acciones-btn btn-sm btnEditar" data-toggle="modal" data-target="#modal-agregar-area"><i class="fas fa-pencil-alt"></i></button>' +
								       '<button class="btn btn-danger acciones-btn btn-sm btnEliminar"><i class="fas fa-trash"></i></button>';
							}
						}
			        ]
			    });

			    $('#btnGuardar').on('click', function(){
			    	var nombre = $('#txtNombre').val();

					if(nombre == ''){
						toastr.error('Favor de ingresar nombre');
						return false;
					}

					$.ajax({
				        url: '../controller/ControllerSIFO.php',
				        type: 'POST',
				        dataType: 'json',
				        data: {
				            command: 'area',
				            action : 'crearArea',
				            nombre: $('#txtNombre').val(),
				            id: $('#txtIdArea').val()
				        },  
				        beforeSend: function(){},
				        success: function(obj){
				            if(obj.rst){
				                
				                $('#txtNombre').val('');
				                $('#txtNombre').focus();

				                toastr.success(obj.msg);
				                $('#modal-agregar-area').modal('hide');
				                tableArea.ajax.reload(null,false);

				            }else{
				                toastr.error(obj.msg);
				            }
				        }                              
				        
				    });
			    });

			    $('.btnAgregarModal').on('click', function(){
					$('#txtIdArea').val(0);
					$('#txtNombre').val('');
					$('.txtTitulo').html('Registrar nueva oficina');
					$('#lblNombreBoton').html('Registrar');
				});

				$('#tblArea tbody').on('click', '.btnEditar', function(){
					var data = tableArea.row($(this).parents('tr')).data();
					$('#txtIdArea').val(data["iId"]);
					$('#txtNombre').val(data["vDescripcion"]);
					$('.txtTitulo').html('Editar oficina');
					$('#lblNombreBoton').html('Actualizar');
				});

				$('#tblArea tbody').on('click', '.btnEliminar', function(){
					
					var dato = tableArea.row($(this).parents('tr')).data();

					Swal.fire({
					  title: '¿Estás seguro de eliminar la oficina?',
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
					            command: 'area',
					            action : 'eliminarOficina',
					            id: dato["iId"]
					        },  
					        success: function(obj){
					            if(obj.rst){
					                toastr.success(obj.msg);
					                tableArea.ajax.reload(null,false);

					            }else{
					                toastr.error(obj.msg);
					            }
					        }                              
					        
					    });

					  }
					})
				})

			});
		});


	</script>

</body>
</html>