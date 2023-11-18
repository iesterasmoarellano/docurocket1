var usuarioDAO={
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
                    for(i=0;i<obj.areas.length;i++){
                        opciones+='<option value="'+obj.areas[i].iId+'">';
                        opciones+=obj.areas[i].vDescripcion;
                        opciones+='</option>';
                    }
                    $('#cboArea').append(opciones);
                }
            }
        });
    },

    getTipoUsuario : function(){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getTipoUsuario'
            },
            beforeSend : function(){},
            success: function(obj){
                if(obj.rst){
                    var opciones;
                    for(i=0;i<obj.tipoUsuarios.length;i++){
                        opciones+='<option value="'+obj.tipoUsuarios[i].iId+'">';
                        opciones+=obj.tipoUsuarios[i].vDescripcion;
                        opciones+='</option>';
                    }
                    $('#cboTipoUsuario').append(opciones);
                }
            }
        });
    },

    getDepartamento : function(){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getDepartamento'
            },
            beforeSend : function(){},
            success: function(obj){
                if(obj.rst){
                    var opciones;
                    for(i=0;i<obj.data.length;i++){
                        opciones+='<option value="'+obj.data[i].idDepa+'">';
                        opciones+=obj.data[i].departamento;
                        opciones+='</option>';
                    }
                    $('#cboDepartamento').append(opciones);
                }
            }
        });
    },

    listarProvincias : function(idDepartamento){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'listarProvincias',
                idDepartamento: idDepartamento
            },
            beforeSend : function(){},
            success: function(obj){
                if(obj.rst){
                    
                    var opciones = '<option value="0">--Seleccione--</option>';
                    $('#cboProvincia').html('');

                    for(i=0;i<obj.data.length;i++){
                        opciones+='<option value="'+obj.data[i].idProv+'">';
                        opciones+=obj.data[i].provincia;
                        opciones+='</option>';
                    }
                    $('#cboProvincia').append(opciones);
                }
            }
        });
    },

    listarDistritos : function(idProvincia){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'listarDistritos',
                idProvincia: idProvincia
            },
            beforeSend : function(){},
            success: function(obj){
                if(obj.rst){
                    
                    var opciones = '<option value="0">--Seleccione--</option>';
                    $('#cboDistrito').html('');
                    
                    for(i=0;i<obj.data.length;i++){
                        opciones+='<option value="'+obj.data[i].idDist+'">';
                        opciones+=obj.data[i].distrito;
                        opciones+='</option>';
                    }
                    $('#cboDistrito').append(opciones);
                }
            }
        });
    },
    
};

