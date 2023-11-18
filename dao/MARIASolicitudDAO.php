<?php

class MARIASolicitudDAO {

    public function registrarSolicitud($asunto, $numero_documento, $chk_numero_documento, $tipo_tramite, $notificacion, $nombreDocumentos, $nombreAnexos, $firma){

        try{

            $factoryConnection = FactoryConnection::create('mysql');
            $connection = $factoryConnection->getConnection();

            $idUsuario = $_SESSION['SIFO']['iId'];
            $flag_documento = 0;

            if($chk_numero_documento == 'on'){
                $flag_documento = 1;
            }

            $flg_notificacion = ($notificacion == 'true') ? 1 : 0;
            $anio = date('Y');
            $fechaExtensa = date('YmdHis');
            $expediente = 'EAG'.$anio.'-'.$fechaExtensa;

            $sql="INSERT INTO tramite (iIdUsuario, vTipoTramite, iNotificacion, vAsunto, bFlagNumeroDocumento, vNumeroDocumento, vNumeroExpediente, dFechaRegistro, iEstado) VALUES (?,?,?,?,?,?,?,now(),1);";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $idUsuario, PDO::PARAM_INT);
            $pr->bindParam(2, $tipo_tramite, PDO::PARAM_STR);
            $pr->bindParam(3, $flg_notificacion, PDO::PARAM_INT);
            $pr->bindParam(4, $asunto, PDO::PARAM_STR);
            $pr->bindParam(5, $flag_documento, PDO::PARAM_INT);
            $pr->bindParam(6, $numero_documento, PDO::PARAM_STR);
            $pr->bindParam(7, $expediente, PDO::PARAM_STR);

            $pr->execute();
            $ruta = "../resources/archivos/$expediente";

            if(!is_dir($ruta)){
                mkdir($ruta, 0777, true);
                mkdir($ruta.'/Anexos', 0777, true);
            }

            if($nombreDocumentos != ''){

                foreach ($nombreDocumentos as $documento) {

                    $nombre = $documento["nombreDocumento"];

                    $antiguaRuta = "../resources/archivos/$nombre";
                    $nuevaRuta = $ruta.'/'.$nombre;

                    rename($antiguaRuta, $nuevaRuta);
                }
            }

            if($nombreAnexos != ''){

                foreach ($nombreAnexos as $anexo) {

                    $nombreAnexo = $anexo["nombreAnexo"];

                    $antiguaRutaAnexo = "../resources/anexos/$nombreAnexo";
                    $nuevaRutaAnexo = $ruta.'/Anexos/'.$nombreAnexo;

                    rename($antiguaRutaAnexo, $nuevaRutaAnexo);
                }
            }

            $imageData = $firma;
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $decodedImage = base64_decode($imageData);

            $image = imagecreatefromstring($decodedImage);

            if ($image !== false) {
                $ancho = imagesx($image);
                $alto = imagesy($image);

                $nuevaImagen = imagecreatetruecolor($ancho, $alto);
                $colorBlanco = imagecolorallocate($nuevaImagen, 255, 255, 255);

                imagefill($nuevaImagen, 0, 0, $colorBlanco);

                imagecopy($nuevaImagen, $image, 0, 0, 0, 0, $ancho, $alto);

                $nombreArchivo = 'firma.png';
                $rutaArchivo = $ruta .'/' . $nombreArchivo;

                if (imagepng($nuevaImagen, $rutaArchivo)) {
                  imagedestroy($nuevaImagen);
                  imagedestroy($image);
                } else {
                  imagedestroy($nuevaImagen);
                  imagedestroy($image);
                }
            }

            $idSolicitud = $connection->lastInsertId();

            $sql = "SELECT u.iId from usuario u inner join area a on u.iIdArea = a.iId where a.vDescripcion = 'Mesa de partes' order by iOrden asc limit 1";
            $pr=$connection->prepare($sql);
            $pr->execute();
            $idUsuario = $pr->FetchAll(PDO::FETCH_ASSOC);

            $sql = "INSERT INTO detalletramite (IIdSolicitud, iIdUsuario, iEstado, dFechaIngreso) VALUES (?,?,1,NOW());";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $idSolicitud, PDO::PARAM_INT);
            $pr->bindParam(2, $idUsuario[0]['iId'], PDO::PARAM_INT);
            $pr->execute();

            $sql = "UPDATE usuario set iOrden = iOrden + 1 where iid = ".$idUsuario[0]['iId'];
            $pr=$connection->prepare($sql);
            $pr->execute();
            
            return $expediente;

        } catch(Exception $e){
            return false;
        }
        
    }

    public function getListSolicitudes($expediente){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT iId, vNumeroExpediente, dFechaRegistro, vAsunto, case when iEstado = 1 then 'Pendiente' when iEstado = 2 then 'En proceso' when iEstado = 3 then 'Atendido' when iEstado = 4 then 'Observado' when iEstado = 5 then 'Cancelado' end as EstadoTramite FROM tramite where vNumeroExpediente = '$expediente' ORDER BY dFechaRegistro DESC ";
        $pr= $connection->prepare($sql);

        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getListTipoTramite(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT iId, vDescripcion FROM tipotramite WHERE iEstado = 1 ORDER BY vDescripcion DESC;";
        $pr= $connection->prepare($sql);

        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getBacklog($estado){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $idUsuario = $_SESSION['SIFO']['iId'];
        $area = $_SESSION['SIFO']['area'];
        $query = '';

        if($area != 'Mesa de partes'){
            $query = 'AND iIdUsuario = '.$idUsuario;
        }

        $sql="SELECT iId, vNumeroExpediente, vAsunto, motivo FROM tramite WHERE iEstado = $estado $query ORDER BY dFechaRegistro DESC LIMIT 3;";
        $pr= $connection->prepare($sql);
        
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function registrarTipoTramite($nombre){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="INSERT INTO tipotramite (vDescripcion, iEstado) VALUES (?,1);";
        $pr=$connection->prepare($sql);
        $pr->bindParam(1, $nombre, PDO::PARAM_STR);

        if($pr->execute()){
            return true;
        }else{
            return false;
        }
        
    }

    public function editarTipoTramite($nombre, $id){

        try{

            $factoryConnection = FactoryConnection::create('mysql');
            $connection = $factoryConnection->getConnection();

            $sql="UPDATE tipotramite SET vDescripcion = ? WHERE iId = ?;";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $nombre, PDO::PARAM_STR);
            $pr->bindParam(2, $id, PDO::PARAM_INT);

            $pr->execute();

            return true;

        } catch(Exception $ex){
            return false;
        }
    }

    public function eliminarTipoTramite($id){

        try{

            $factoryConnection = FactoryConnection::create('mysql');
            $connection = $factoryConnection->getConnection();

            $sql="DELETE FROM tipotramite WHERE iId = ?;";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $id, PDO::PARAM_INT);

            $pr->execute();

            return true;

        } catch(Exception $ex){
            return false;
        }
    }

    public function verDetalleSolicitud($codigo){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT date(s.dfechaRegistro) as fechaRegistro, time(s.dFechaRegistro) as horaRegistro, vNumeroExpediente, vTipoTramite, vNumeroDocumento, case when u.iTipoPersona = 1 then vNombreCompleto else vRazonSocial end as Remitente, vAsunto, case when s.iEstado = 1 then 'Pendiente' when s.iEstado = 2 then 'En proceso' when s.iEstado = 3 then 'Atendido' when s.iEstado = 4 then 'Observado' when s.iEstado = 5 then 'Cancelado' end as EstadoTramite, s.motivo from tramite s inner join usuario u on s.iIdUsuario = u.iId where s.iId = $codigo;";
        $pr= $connection->prepare($sql);
        
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }
    }

    public function listDetalleSolicitud($codigo){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT a.vDescripcion as area, u.vNombreCompleto as usuario, case when ds.iEstado = 1 then 'Pendiente' when ds.iEstado = 2 then 'En proceso' when ds.iEstado = 3 then 'Atendido' when ds.iEstado = 4 then 'Observado' when ds.iEstado = 5 then 'Cancelado' end as EstadoTramite, ds.dFechaIngreso, ds.dFechaSalida from detalletramite ds inner join tramite s on ds.IIdSolicitud = s.iId inner join usuario u on ds.iIdUsuario = u.iId inner join area a on u.iIdArea = a.iId where ds.IIdSolicitud = $codigo;";
        $pr= $connection->prepare($sql);
        
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }
    }

    public function verTramitesAsignados(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $idUsuario = $_SESSION['SIFO']['iId'];

        $sql="SELECT ds.iId as codigoDetalleSolicitud, s.iId, s.vNumeroExpediente, case when u.iTipoPersona = 1 then u.vNombreCompleto else u.vRazonSocial end as Remitente, s.vTipoTramite, s.vAsunto, date(ds.dFechaIngreso) as FechaRegistro from detalletramite ds inner join tramite s on ds.IIdSolicitud = s.iId inner join usuario u on s.iIdUsuario = u.iId where ds.iIdUsuario = $idUsuario and iAtendido = 0";
        $pr= $connection->prepare($sql);
        
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }
    }

    public function registrarDerivacionTramite($estado, $motivo, $oficinaAsignar, $codigoSolicitud, $codigoDetalleSolicitud, $archivosAtendidos, $firmaOficina){

        try{

            $factoryConnection = FactoryConnection::create('mysql');
            $connection = $factoryConnection->getConnection();

            $sql = "SELECT vNumeroExpediente from tramite WHERE iID = ?";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $codigoSolicitud, PDO::PARAM_INT);
            $pr->execute();
            $data = $pr->FetchAll(PDO::FETCH_ASSOC);
            $expediente = $data[0]['vNumeroExpediente'];

            $ruta = "../resources/archivos/$expediente";

            if($archivosAtendidos != ''){

                foreach ($archivosAtendidos as $archivo) {

                    $nombreArchivo = $archivo["nombreArchivo"];

                    $antiguaRutaAnexo = "../resources/anexos/$nombreArchivo";
                    $nuevaRutaAnexo = $ruta.'/'.$nombreArchivo;

                    rename($antiguaRutaAnexo, $nuevaRutaAnexo);
                }
            }

            if($firmaOficina != "0"){
                $imageData = $firmaOficina;
                $imageData = str_replace('data:image/png;base64,', '', $imageData);
                $imageData = str_replace(' ', '+', $imageData);
                $decodedImage = base64_decode($imageData);

                $image = imagecreatefromstring($decodedImage);

                if ($image !== false) {
                    $ancho = imagesx($image);
                    $alto = imagesy($image);

                    $nuevaImagen = imagecreatetruecolor($ancho, $alto);
                    $colorBlanco = imagecolorallocate($nuevaImagen, 255, 255, 255);

                    imagefill($nuevaImagen, 0, 0, $colorBlanco);

                    imagecopy($nuevaImagen, $image, 0, 0, 0, 0, $ancho, $alto);

                    $nombreArchivo = 'firma-responsable-oficina.png';
                    $rutaArchivo = $ruta .'/' . $nombreArchivo;

                    if (imagepng($nuevaImagen, $rutaArchivo)) {
                      imagedestroy($nuevaImagen);
                      imagedestroy($image);
                    } else {
                      imagedestroy($nuevaImagen);
                      imagedestroy($image);
                    }
                }
            }

            $sql="UPDATE tramite SET iEstado = ?, motivo = ? WHERE iID = ?";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $estado, PDO::PARAM_INT);
            $pr->bindParam(2, $motivo, PDO::PARAM_STR);
            $pr->bindParam(3, $codigoSolicitud, PDO::PARAM_INT);
            $pr->execute();

            $sql = "UPDATE detalletramite SET iAtendido = 1, dFechaSalida = now() WHERE iId = ?";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $codigoDetalleSolicitud, PDO::PARAM_INT);
            $pr->execute();

            if($estado == 3 || $estado == 5 || $estado == 4){

                $sql = "SELECT iIdUsuario from detalletramite WHERE iId = ?";
                $pr=$connection->prepare($sql);
                $pr->bindParam(1, $codigoDetalleSolicitud, PDO::PARAM_INT);
                $pr->execute();
                $idUsuario = $pr->FetchAll(PDO::FETCH_ASSOC);

                $sql = "INSERT INTO detalletramite (IIdSolicitud, iIdUsuario, iEstado, iAtendido, dFechaIngreso, dFechaSalida) VALUES(?, ?, ?, 1, now(), now());";
                $pr=$connection->prepare($sql);
                $pr->bindParam(1, $codigoSolicitud, PDO::PARAM_INT);
                $pr->bindParam(2, $idUsuario[0]['iIdUsuario'], PDO::PARAM_INT);
                $pr->bindParam(3, $estado, PDO::PARAM_INT);
                $pr->execute();

                
            } else {

                $sql = "SELECT iId from usuario WHERE iTipoPersona = 1 AND iIdArea = ? ORDER BY iOrden ASC LIMIT 1;";
                $pr=$connection->prepare($sql);
                $pr->bindParam(1, $oficinaAsignar, PDO::PARAM_INT);
                $pr->execute();
                $idUsuario = $pr->FetchAll(PDO::FETCH_ASSOC);
                

                $sql = "INSERT INTO detalletramite (IIdSolicitud, iIdUsuario, iEstado, iAtendido, dFechaIngreso) VALUES(?, ?, ?, 0, now());";
                $pr=$connection->prepare($sql);
                $pr->bindParam(1, $codigoSolicitud, PDO::PARAM_INT);
                $pr->bindParam(2, $idUsuario[0]['iId'], PDO::PARAM_INT);
                $pr->bindParam(3, $estado, PDO::PARAM_INT);
                $pr->execute();

            }

            return true;

        } catch(Exception $ex){

        }
    }

    public function registrarExpedienteObservado($nombreArchivosObservados, $expediente){

        try{

            $factoryConnection = FactoryConnection::create('mysql');
            $connection = $factoryConnection->getConnection();

            $ruta = "../resources/archivos/$expediente";

            if($nombreArchivosObservados != ''){

                foreach ($nombreArchivosObservados as $archivo) {

                    $nombreArchivo = $archivo["nombreArchivo"];

                    $antiguaRutaAnexo = "../resources/anexos/$nombreArchivo";
                    $nuevaRutaAnexo = $ruta.'/Anexos/'.$nombreArchivo;

                    rename($antiguaRutaAnexo, $nuevaRutaAnexo);
                }
            }

            $sql = "UPDATE tramite SET iEstado = 2 WHERE vNumeroExpediente = ?";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $expediente, PDO::PARAM_STR);
            $pr->execute();

            $sql = "SELECT ds.IIdSolicitud, ds.iIdUsuario FROM detalletramite ds INNER JOIN tramite s ON s.iId = ds.IIdSolicitud WHERE s.vNumeroExpediente = ? ORDER BY ds.iId DESC LIMIT 1;";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $expediente, PDO::PARAM_STR);
            $pr->execute();
            $data = $pr->FetchAll(PDO::FETCH_ASSOC);

            $sql = "INSERT INTO detalletramite (IIdSolicitud, iIdUsuario, iEstado, iAtendido, dFechaIngreso) VALUES (?, ?, 2, 0, now())";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $data[0]['IIdSolicitud'], PDO::PARAM_INT);
            $pr->bindParam(2, $data[0]['iIdUsuario'], PDO::PARAM_INT);
            $pr->execute();

            return true;

        } catch(Exception $e){
            return false;
        }
        
    }
    
}