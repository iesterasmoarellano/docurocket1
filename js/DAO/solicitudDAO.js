var solicitudDAO={
    url:'../controller/ControllerSIFO.php',
    idLayerMessage : 'layerMessage',

    getAreas : function(){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getAreas'
            },
            beforeSend : function(){},
            success: function(obj){
                if(obj.rst){
                    var opciones;
                    var area_asignar;

                    for(i=0;i<obj.areas.length;i++){
                        opciones+='<option value="'+obj.areas[i].iId+'">';
                        opciones+=obj.areas[i].vDescripcion;
                        opciones+='</option>';
                    }
                    $('#cboOficina').append(opciones);

                    for(i=0;i<obj.areas.length;i++){
                        if(obj.areas[i].vDescripcion != 'Mesa de partes'){
                            area_asignar+='<option value="'+obj.areas[i].iId+'">';
                            area_asignar+=obj.areas[i].vDescripcion;
                            area_asignar+='</option>';
                        }
                    }
                    $('#dboAreaAsignar').append(area_asignar);
                }
            }
        });
    },

    getTipoTramite : function(){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getTipoTramite'
            },
            beforeSend : function(){},
            success: function(obj){
                if(obj.rst){
                    var opciones;
                    for(i=0;i<obj.tipotramite.length;i++){
                        opciones+='<option value="'+obj.tipotramite[i].vDescripcion+'">';
                        opciones+=obj.tipotramite[i].vDescripcion;
                        opciones+='</option>';
                    }
                    $('#cboTipoTramite').append(opciones);
                }
            }
        });
    },

    getBacklog : function(){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'getBacklog',
                estado : 1
            },
            success: function(obj){

                var html = '';
                $('.kanBacklog').html('');

                if(obj.data.length > 0){
                    
                    for(i=0;i<obj.data.length;i++){
                        html+='<div class="card card-light card-outline">';
                        html+='  <div class="card-header">';
                        html+='    <h5 class="card-title">'+obj.data[i].vNumeroExpediente+'</h5>';
                        html+='    <div class="card-tools">';
                        html+='      <a href="#" class="btn btn-tool">';
                        html+='        <i class="fa fa-search-plus" onclick="verDetalleTramite('+obj.data[i].iId+')"></i>';
                        html+='      </a>';
                        html+='    </div>';
                        html+='  </div>';
                        html+='  <div class="card-body">';
                        html+='    <p> <b>Asunto:</b> '+obj.data[i].vAsunto+' </p>';
                        html+='  </div>';
                        html+='</div>';
                    }

                } else {
                    html+='<div class="card card-light card-outline">';
                    html+='  <div class="card-body">';
                    html+='    <p> Sin datos </p>';
                    html+='  </div>';
                    html+='</div>';
                }

                $('.kanBacklog').html(html);
            }
        });
    },

    getEnProceso : function(){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'getBacklog',
                estado : 2
            },
            success: function(obj){
                
                var html = '';
                $('.kanProceso').html('');

                if(obj.data.length > 0){

                    for(i=0;i<obj.data.length;i++){
                        html+='<div class="card card-light card-outline">';
                        html+='  <div class="card-header">';
                        html+='    <h5 class="card-title">'+obj.data[i].vNumeroExpediente+'</h5>';
                        html+='    <div class="card-tools">';
                        html+='      <a href="#" class="btn btn-tool">';
                        html+='        <i class="fa fa-search-plus" onclick="verDetalleTramite('+obj.data[i].iId+')"></i>';
                        html+='      </a>';
                        html+='    </div>';
                        html+='  </div>';
                        html+='  <div class="card-body">';
                        html+='    <p> <b>Asunto:</b> '+obj.data[i].vAsunto+' </p>';
                        html+='  </div>';
                        html+='</div>';
                    }

                } else {
                    html+='<div class="card card-light card-outline">';
                    html+='  <div class="card-body">';
                    html+='    <p> Sin datos </p>';
                    html+='  </div>';
                    html+='</div>';
                }

                $('.kanProceso').html(html);
            }
        });
    },

    getHecho : function(){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'getBacklog',
                estado : 3
            },
            success: function(obj){
                
                var html = '';
                $('.kanHecho').html('');

                if(obj.data.length > 0){

                    for(i=0;i<obj.data.length;i++){

                        html+='<div class="card card-light card-outline">';
                        html+='  <div class="card-header">';
                        html+='    <h5 class="card-title">'+obj.data[i].vNumeroExpediente+'</h5>';
                        html+='    <div class="card-tools">';
                        html+='      <a href="#" class="btn btn-tool">';
                        html+='        <i class="fa fa-search-plus" onclick="verDetalleTramite('+obj.data[i].iId+')"></i>';
                        html+='      </a>';
                        html+='    </div>';
                        html+='  </div>';
                        html+='  <div class="card-body">';
                        html+='    <p> <b>Asunto:</b> '+obj.data[i].vAsunto+' </p>';
                        html+='  </div>';
                        html+='</div>';
                    }

                } else {
                    html+='<div class="card card-light card-outline">';
                    html+='  <div class="card-body">';
                    html+='    <p> Sin datos </p>';
                    html+='  </div>';
                    html+='</div>';
                }

                $('.kanHecho').html(html);

            }
        });
    },

    getObservado : function(){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'getBacklog',
                estado : 4
            },
            success: function(obj){
                
                var html = '';
                $('.kanObservado').html('');

                if(obj.data.length > 0){

                    for(i=0;i<obj.data.length;i++){

                        html+='<div class="card card-light card-outline">';
                        html+='  <div class="card-header">';
                        html+='    <h5 class="card-title">'+obj.data[i].vNumeroExpediente+'</h5>';
                        html+='    <div class="card-tools">';
                        html+='      <a href="#" class="btn btn-tool">';
                        html+='        <i class="fa fa-search-plus" onclick="verDetalleTramite('+obj.data[i].iId+')"></i>';
                        html+='      </a>';
                        html+='    </div>';
                        html+='  </div>';
                        html+='  <div class="card-body">';
                        html+='    <p> <b>Asunto:</b> '+obj.data[i].vAsunto+' </p>';
                        html+='    <p> <b>Motivo:</b> '+obj.data[i].motivo+' </p>';
                        html+='  </div>';
                        html+='</div>';
                    }

                } else {
                    html+='<div class="card card-light card-outline">';
                    html+='  <div class="card-body">';
                    html+='    <p> Sin datos </p>';
                    html+='  </div>';
                    html+='</div>';
                }

                $('.kanObservado').html(html);

            }
        });
    },

    getCancelado : function(){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'getBacklog',
                estado : 5
            },
            success: function(obj){
                
                var html = '';
                $('.kanCancelado').html('');

                if(obj.data.length > 0){

                    for(i=0;i<obj.data.length;i++){

                        html+='<div class="card card-light card-outline">';
                        html+='  <div class="card-header">';
                        html+='    <h5 class="card-title">'+obj.data[i].vNumeroExpediente+'</h5>';
                        html+='    <div class="card-tools">';
                        html+='      <a href="#" class="btn btn-tool">';
                        html+='        <i class="fa fa-search-plus" onclick="verDetalleTramite('+obj.data[i].iId+')"></i>';
                        html+='      </a>';
                        html+='    </div>';
                        html+='  </div>';
                        html+='  <div class="card-body">';
                        html+='    <p> <b>Asunto:</b> '+obj.data[i].vAsunto+' </p>';
                        html+='    <p> <b>Motivo:</b> '+obj.data[i].motivo+' </p>';
                        html+='  </div>';
                        html+='</div>';
                    }

                } else {
                    html+='<div class="card card-light card-outline">';
                    html+='  <div class="card-body">';
                    html+='    <p> Sin datos </p>';
                    html+='  </div>';
                    html+='</div>';
                }

                $('.kanCancelado').html(html);

            }
        });
    },

    verDetalleSolicitud : function(codigo){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'verDetalleSolicitud',
                codigo : codigo
            },
            success: function(obj){
                if(obj.rst){
                    $('#lblFechaIngreso').html(obj.data[0].fechaRegistro);
                    $('#lblHoraIngreso').html(obj.data[0].horaRegistro);
                    $('#lblExpediente').html(obj.data[0].vNumeroExpediente);
                    $('#lblNumeroDocumento').html(obj.data[0].vNumeroDocumento);
                    $('#lblRemitente').html(obj.data[0].Remitente);
                    $('#lblAsunto').html(obj.data[0].vAsunto);
                    $('#lblTipoTramite').html(obj.data[0].vTipoTramite);
                    $('#lblEstadoDocumento').html(obj.data[0].EstadoTramite);

                    $('#lblMotivoObservado').html(obj.data[0].motivo);

                    $('.btnObservacion').css('display', 'none');
                    $('.dvArchivosDescargarAtendido').css('display', 'none');

                    if(obj.data[0].EstadoTramite == 'Observado'){
                       $('.btnObservacion').css('display', 'block');
                    }

                    if(obj.data[0].EstadoTramite == 'Atendido'){
                       $('.dvArchivosDescargarAtendido').css('display', 'block');
                       solicitudDAO.verArchivosAtendidos(obj.data[0].vNumeroExpediente);
                       solicitudDAO.verAnexosAtendidos(obj.data[0].vNumeroExpediente);
                    }
                }
            }
        });
    },

    registrarSolicitud : function(nombreArchivos, nombreAnexos, firma){
        $.ajax({
            url: this.url,
            type: 'POST',
            dataType: 'json',
            data: {
                command: 'solicitud',
                action : 'crearSolicitud',
                asunto : $('#txtAsunto').val(),
                numero_documento : $('#txtNumeroDocumento').val(),
                chk_numero_documento : $('input[name="chkValidaNumeroDocumento"]:checked').val(),
                tipo_tramite : $('#cboTipoTramite').val(),
                notificacion : document.getElementById("chkNotificacion").checked,
                nombreArchivos: nombreArchivos,
                anexos: nombreAnexos,
                firma: firma
            },  
            beforeSend: function(){},
            success: function(obj){
                if(!obj.rst){

                    toastr.error(obj.msg);

                }else{

                    $('#txtAsunto').val('');
                    $('#txtNumeroDocumento').val('');
                    $('#cboTipoTramite').val(0).trigger('change');

                    var notificacion = document.getElementById("chkNotificacion");
                    var terminos = document.getElementById("chkTerminos");
                    var jurada = document.getElementById("chkJurada");
                    var valida = document.getElementById("chkValidaNumeroDocumento");
                    var anexos = document.getElementById("chkValidaAnexos");

                    notificacion.checked = false;
                    terminos.checked = false;
                    jurada.checked = false;
                    valida.checked = false;
                    anexos.checked = false;

                    $('#txtNumeroDocumento').attr('disabled', 'disabled');
                    $('#btnRegistrarSolicitud').attr('disabled', 'disabled');
                    $('.dv-anexos').css('display', 'none');

                    document.querySelector("#actions .cancel").onclick();
                    document.querySelector("#actions2 .cancel2").onclick();

                    $('#modal-agregar-solicitud').modal('hide');

                    Swal.fire({
                      title: 'Estimado ciudadano',
                      html: 'Le comunicamos que su expediente <br> <b>' + obj.rst + '</b> <br> ha sido creado exitosamente',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Descargar constancia'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = '../resources/generar-pdf.php?expediente=' +  obj.rst;
                      }
                    });

                    solicitudDAO.getBacklog();
                    solicitudDAO.getEnProceso();
                    solicitudDAO.getHecho();
                    solicitudDAO.getCancelado();
                    solicitudDAO.getObservado();
                    
                }
            }                              
            
        });
    },

    buscarSolicitud : function(tableSolicitudes){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'listSolicitud',
                expediente : $('#txtExpediente').val()
            },
            beforeSend : function(){},
            success: function(obj){
                console.log(obj);

                tableSolicitudes.clear().draw();

                if(obj.data.length > 0){

                    for(i=0;i<obj.data.length;i++){

                        var datos = [
                            obj.data[i].vNumeroExpediente,
                            obj.data[i].vAsunto,
                            obj.data[i].EstadoTramite,
                            obj.data[i].dFechaRegistro,
                            '<button class="btn btn-primary acciones-btn btn-sm" onclick="verDetalleTramite('+obj.data[i].iId+')"><i class="fas fa-search-plus"></i></button>'
                        ];

                        tableSolicitudes.row.add(datos);
                    }

                    tableSolicitudes.draw();
                }
            }
        });
    },

    listDetalleSolicitud : function(codigo, tableDetalleSolicitud){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'listDetalleSolicitud',
                codigo : codigo
            },
            success: function(obj){

                tableDetalleSolicitud.clear().draw();

                if(obj.data.length > 0){

                    for(i=0;i<obj.data.length;i++){

                        var datos = [
                            obj.data[i].area,
                            obj.data[i].usuario,
                            obj.data[i].EstadoTramite,
                            obj.data[i].dFechaIngreso,
                            obj.data[i].dFechaSalida
                        ];

                        tableDetalleSolicitud.row.add(datos);
                    }

                    tableDetalleSolicitud.draw();
                }
            }
        });
    },

    getInformacionTramite : function(codigo, codigoDetalleSolicitud){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'verDetalleSolicitud',
                codigo : codigo
            },
            success: function(obj){
                if(obj.rst){
                    $('#idTramiteAsignacion').val(codigo);
                    $('#idDetalleSolicitud').val(codigoDetalleSolicitud);
                    $('#lblFechaIngresoAsignar').html(obj.data[0].fechaRegistro);
                    $('#lblHoraIngresoAsignar').html(obj.data[0].horaRegistro);
                    $('#lblExpedienteAsignar').html(obj.data[0].vNumeroExpediente);
                    $('#lblNumeroDocumentoAsignar').html(obj.data[0].vNumeroDocumento);
                    $('#lblRemitenteAsignar').html(obj.data[0].Remitente);
                    $('#lblAsuntoAsignar').html(obj.data[0].vAsunto);
                    $('#lblTipoTramiteAsignar').html(obj.data[0].vTipoTramite);
                }
            }
        });
    },

    verArchivos : function(expediente){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'verArchivos',
                expediente : expediente
            },
            success: function(obj){
                var html = '<ul class="list-group">';

                obj.forEach(function(archivo) {
                    if(archivo != 'Anexos' && archivo != 'firma-responsable-oficina.png' && archivo != 'firma.png'){

                        var extension = archivo.substring(archivo.lastIndexOf('.') + 1).toLowerCase();
                        var icono = '';

                        switch (extension) {
                            case 'pdf':
                                icono = 'pdf.png';
                                break;
                            case 'xls':
                            case 'xlsx':
                                icono = 'excel.png';
                                break;
                            case 'doc':
                            case 'docx':
                                icono = 'word.png';
                                break;
                            case 'ppt':
                            case 'pptx':
                                icono = 'powerpoint.png';
                                break;
                            default:
                                icono = 'archivo.png';
                                break;
                        }

                        html += '<li class="list-group-item"> <img src="../img/'+icono+'" width="15px" alt="Icono"> <a href="../resources/archivos/'+expediente+'/'+archivo+'" download>'+archivo+'</a></li>';
                    }
                });

                html += '</ul>';
                
                $('#listaArchivos').html(html)
            }
        });
    },

    verAnexos : function(expediente){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'verAnexos',
                expediente : expediente
            },
            success: function(obj){
                var html = '<ul class="list-group">';

                obj.forEach(function(archivo) {

                    var extension = archivo.substring(archivo.lastIndexOf('.') + 1).toLowerCase();
                    var icono = '';

                    switch (extension) {
                        case 'pdf':
                            icono = 'pdf.png';
                            break;
                        case 'xls':
                        case 'xlsx':
                            icono = 'excel.png';
                            break;
                        case 'doc':
                        case 'docx':
                            icono = 'word.png';
                            break;
                        case 'ppt':
                        case 'pptx':
                            icono = 'powerpoint.png';
                            break;
                        default:
                            icono = 'archivo.png';
                            break;
                    }

                    html += '<li class="list-group-item"> <img src="../img/'+icono+'" width="15px" alt="Icono"> <a href="../resources/archivos/'+expediente+'/Anexos/'+archivo+'" download>'+archivo+'</a></li>';
                });

                html += '</ul>';
                
                $('#listaAnexos').html(html)
            }
        });
    },

    registrarDerivacionTramite : function(tableTramiteAsignado, archivosAtendidos, firmaOficina){
        $.ajax({
            url: this.url,
            type: 'POST',
            dataType: 'json',
            data: {
                command: 'solicitud',
                action : 'registrarDerivacionTramite',
                estado : $('#cboNuevoEstadoTramite').val(),
                motivo : $('#txtMotivo').val(),
                oficinaAsignar : $('#dboAreaAsignar').val(),
                codigoSolicitud: $('#idTramiteAsignacion').val(),
                codigoDetalleSolicitud: $('#idDetalleSolicitud').val(),
                archivosAtendidos: archivosAtendidos,
                firmaOficina: firmaOficina
            },  
            beforeSend: function(){},
            success: function(obj){
                if(!obj.rst){

                    toastr.error(obj.msg);

                }else{

                    var estado = $('#cboNuevoEstadoTramite').val();
                    var expediente = $('#lblExpedienteAsignar').html();

                    toastr.success(obj.msg);

                    $('#cboNuevoEstadoTramite').val(0).trigger('change');
                    $('#txtMotivo').val('');
                    $('#dboAreaAsignar').val(0).trigger('change');

                    $('.dvOficina').css('display', 'block');
                    $('.dvMotivo').css('display', 'none');

                    $('#modal-detalle-tramite-asignado').modal('hide');

                    solicitudDAO.getBacklog();
                    solicitudDAO.getEnProceso();
                    solicitudDAO.getHecho();
                    solicitudDAO.getCancelado();
                    solicitudDAO.getObservado();

                    tableTramiteAsignado.ajax.reload(null,false);

                    document.querySelector("#actions4 .cancel4").onclick();
                    
                }
            }                              
            
        });
    },

    registrarExpedienteObservado : function(nombreArchivosObservados, expediente){
        $.ajax({
            url: this.url,
            type: 'POST',
            dataType: 'json',
            data: {
                command: 'solicitud',
                action : 'registrarExpedienteObservado',
                nombreArchivosObservados: nombreArchivosObservados,
                expediente: expediente
            },  
            beforeSend: function(){},
            success: function(obj){
                if(!obj.rst){

                    toastr.error(obj.msg);

                }else{

                    toastr.success(obj.msg);

                    $('#cboPlantilla').val(0).trigger('change');
                    document.querySelector("#actions3 .cancel3").onclick();
                    $('#modal-levantar-observacion').modal('hide');

                    solicitudDAO.getBacklog();
                    solicitudDAO.getEnProceso();
                    solicitudDAO.getHecho();
                    solicitudDAO.getObservado();
                    solicitudDAO.getCancelado();
                    
                }
            }                              
            
        });
    },


    verArchivosAtendidos : function(expediente){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'verArchivos',
                expediente : expediente
            },
            success: function(obj){
                var html = '<ul class="list-group">';

                obj.forEach(function(archivo) {
                    if(archivo != 'Anexos' && archivo != 'firma-responsable-oficina.png' && archivo != 'firma.png'){

                        var extension = archivo.substring(archivo.lastIndexOf('.') + 1).toLowerCase();
                        var icono = '';

                        switch (extension) {
                            case 'pdf':
                                icono = 'pdf.png';
                                break;
                            case 'xls':
                            case 'xlsx':
                                icono = 'excel.png';
                                break;
                            case 'doc':
                            case 'docx':
                                icono = 'word.png';
                                break;
                            case 'ppt':
                            case 'pptx':
                                icono = 'powerpoint.png';
                                break;
                            default:
                                icono = 'archivo.png';
                                break;
                        }

                        html += '<li class="list-group-item"> <img src="../img/'+icono+'" width="15px" alt="Icono"> <a href="../resources/archivos/'+expediente+'/'+archivo+'" download>'+archivo+'</a></li>';
                    }
                });

                html += '</ul>';
                
                $('#listaArchivosAtendidos').html(html)
            }
        });
    },

    verAnexosAtendidos : function(expediente){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'solicitud',
                action : 'verAnexos',
                expediente : expediente
            },
            success: function(obj){
                var html = '<ul class="list-group">';

                obj.forEach(function(archivo) {

                    var extension = archivo.substring(archivo.lastIndexOf('.') + 1).toLowerCase();
                    var icono = '';

                    switch (extension) {
                        case 'pdf':
                            icono = 'pdf.png';
                            break;
                        case 'xls':
                        case 'xlsx':
                            icono = 'excel.png';
                            break;
                        case 'doc':
                        case 'docx':
                            icono = 'word.png';
                            break;
                        case 'ppt':
                        case 'pptx':
                            icono = 'powerpoint.png';
                            break;
                        default:
                            icono = 'archivo.png';
                            break;
                    }

                    html += '<li class="list-group-item"> <img src="../img/'+icono+'" width="15px" alt="Icono"> <a href="../resources/archivos/'+expediente+'/Anexos/'+archivo+'" download>'+archivo+'</a></li>';
                });

                html += '</ul>';
                
                $('#listaAnexosAtendidos').html(html)
            }
        });
    },
    
};