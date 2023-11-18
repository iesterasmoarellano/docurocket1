var indexDAO={
    url:'controller/ControllerSIFO.php',
    idLayerMessage : 'layerMessage',

    checkUser:function( ){
        $.ajax({
            url: this.url,
            type: 'post',
            dataType:'json',
            data: {
                    command: 'login',
                    action: 'check',
                    usr: $('#txtUsuario').val(),
                    pwd: $('#txtClave').val()
                },
                beforeSend: function () {
                    $('.progress').css('display','inline-block');
                },
                complete: function () {
                    $('.progress').css('display','none');
                },
                success : function(obj){
                    if (obj.rst){
                        toastr.success('Bienvenido');
                        console.log(obj)
                        if(obj.tipoUsuario == "13"){
                            window.location.href='view/tramite.php';
                        } else {
                            window.location.href='view/inicio.php';
                        }
                    } else {
                        toastr.error('Usuario Incorrecto');
                    }
                }
        });  
    },

    changePassword :function(){
        $.ajax({
            url: '../controller/ControllerSIFO.php',
            type: 'POST',
            dataType : 'json',
            data : {
                command : 'usuario',
                action : 'changePassword',
                pwd : $('#txtNuevaClave').val()
            },
            beforeSend : function(){

            },
            success : function(obj){
                if(obj.rst){
                    toastr.success(obj.msg);
                    $('#txtNuevaClave').focus();
                    $('#txtConfirmarClave').val('');
                    
                    $('#modal-cambiar-clave').modal('hide');                    
                }else{
                    toastr.error(obj.msg);
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

    getTramiteDia : function(){
        $.ajax({
            url : '../controller/ControllerSIFO.php',
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getTramiteDia'
            },
            beforeSend : function(){},
            success: function(obj){
                $('#lblTramiteDia').html(obj.data[0].contador);
            }
        });
    },

    getTramitePendientes : function(){
        $.ajax({
            url : '../controller/ControllerSIFO.php',
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getTramitePendientes'
            },
            beforeSend : function(){},
            success: function(obj){
                $('#lblTramitePendiente').html(obj.data[0].contador);
            }
        });
    },

    getTotalTramites : function(){
        $.ajax({
            url : '../controller/ControllerSIFO.php',
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getTotalTramites'
            },
            beforeSend : function(){},
            success: function(obj){
                $('#lblTotalTramite').html(obj.data[0].contador);
                getTramitesPendientes();
            }
        });
    },

    getTramitePendientePorcentaje : function(){
        $.ajax({
            url : '../controller/ControllerSIFO.php',
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getTramitePendientePorcentaje'
            },
            beforeSend : function(){},
            success: function(obj){
                var total = $('#lblTotalTramite').html();
                var tramitesPendientes = 0;

                if(total > 0){
                    tramitesPendientes = Math.round((obj.data[0].contador / total) * 100,2);
                }

                $('#lblTramiteAtendido').html(tramitesPendientes + '%');
            }
        });
    },

    getGraficoTramiteRegistrado : function(){
        $.ajax({
            url : '../controller/ControllerSIFO.php',
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getGraficoTramiteRegistrado',
                estado: 1
            },
            beforeSend : function(){},
            success: function(obj){

                var fechas = [];
                var contador = [];

                for(i=0;i<obj.data.length;i++){
                    fechas.push(obj.data[i].fecha);
                    contador.push(obj.data[i].contador);
                }

                var ctx = document.getElementById('cnvTramiteRegistrado').getContext('2d');

                var lineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: fechas,
                        datasets: [{
                            label: 'Valores',
                            data: contador,
                            backgroundColor: 'transparent',
                            borderColor: '#007bff',
                            pointBorderColor: '#007bff',
                            pointBackgroundColor: '#007bff',
                            fill: false
                        }]
                    },
                    options: {
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    },

    getGraficoTramiteFinalizado : function(){
        $.ajax({
            url : '../controller/ControllerSIFO.php',
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getGraficoTramiteRegistrado',
                estado: 3
            },
            beforeSend : function(){},
            success: function(obj){

                var fechas = [];
                var contador = [];

                for(i=0;i<obj.data.length;i++){
                    fechas.push(obj.data[i].fecha);
                    contador.push(obj.data[i].contador);
                }

                var ctx = document.getElementById('cnvTramiteFinalizado').getContext('2d');

                var lineChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: fechas,
                        datasets: [{
                            label: 'Valores',
                            data: contador,
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            pointBorderColor: '#007bff',
                            pointBackgroundColor: '#007bff',
                            fill: false
                        }]
                    },
                    options: {
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    },

    getGraficoTramiteProceso : function(){
        $.ajax({
            url : '../controller/ControllerSIFO.php',
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getGraficoTramiteRegistrado',
                estado: 2
            },
            beforeSend : function(){},
            success: function(obj){

                var fechas = [];
                var contador = [];

                for(i=0;i<obj.data.length;i++){
                    fechas.push(obj.data[i].fecha);
                    contador.push(obj.data[i].contador);
                }

                var ctx = document.getElementById('cnvTramiteProceso').getContext('2d');

                var lineChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: fechas,
                        datasets: [{
                            label: 'Valores',
                            data: contador,
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            pointBorderColor: '#007bff',
                            pointBackgroundColor: '#007bff',
                            fill: false
                        }]
                    },
                    options: {
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    },

    getGraficoTramiteLocalizado : function(){
        $.ajax({
            url : '../controller/ControllerSIFO.php',
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'usuario',
                action : 'getGraficoTramiteRegistrado',
                estado: '1,2,3,4,5'
            },
            beforeSend : function(){},
            success: function(obj){

                var fechas = [];
                var contador = [];

                for(i=0;i<obj.data.length;i++){
                    fechas.push(obj.data[i].fecha);
                    contador.push(obj.data[i].contador);
                }

                var ctx = document.getElementById('cnvTramitesLocalizados').getContext('2d');

                var lineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: fechas,
                        datasets: [{
                            label: 'Valores',
                            data: contador,
                            backgroundColor: 'transparent',
                            borderColor: '#007bff',
                            pointBorderColor: '#007bff',
                            pointBackgroundColor: '#007bff',
                            fill: false
                        }]
                    },
                    options: {
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    },

    
};

