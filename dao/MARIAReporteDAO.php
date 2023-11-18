<?php

class MARIAReporteDAO {

    public function buscarTramite($estado, $fechaInicio, $fechaFin){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT s.iid, CASE WHEN u.iTipoPersona = 1 THEN vNombreCompleto ELSE vRazonSocial END AS remitente, vNumeroExpediente, vTipoTramite, vAsunto, vNumeroDocumento, s.dFechaRegistro FROM tramite s INNER JOIN usuario u ON s.iIdUsuario = u.iId WHERE s.iEstado = $estado AND s.dFechaRegistro >= '$fechaInicio 00:00:00' and s.dFechaRegistro <= '$fechaFin 23:59:59';";
        $pr= $connection->prepare($sql);
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

}
