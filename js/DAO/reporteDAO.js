var reporteDAO={
    url:'../controller/ControllerSIFO.php',
    idLayerMessage : 'layerMessage',

    buscarTramites : function(table){
        $.ajax({
            url : this.url,
            type: 'GET',
            async: false,
            dataType: 'json',
            data: {
                command : 'reporte',
                action : 'buscarTramite',
                estado : $('#cboBusquedaEstado').val(),
                fechaInicio : $('#txtFechaInicio').val(),
                fechaFin : $('#txtFechaFin').val()
            },
            beforeSend : function(){},
            success: function(obj){

                table.clear().draw();

                if(obj.data.length > 0){

                    for(i=0;i<obj.data.length;i++){

                        var datos = [
                            obj.data[i].iid,
                            obj.data[i].remitente,
                            obj.data[i].vNumeroExpediente,
                            obj.data[i].vTipoTramite,
                            obj.data[i].vAsunto,
                            obj.data[i].vNumeroDocumento,
                            obj.data[i].dFechaRegistro,
                        ];

                        table.row.add(datos);
                    }

                    table.draw();
                } else {
                    toastr.warning('Sin datos');
                }
            }
        });
    },



    
};

