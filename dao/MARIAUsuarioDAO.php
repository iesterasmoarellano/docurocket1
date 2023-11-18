<?php

class MARIAUsuarioDAO {
   
    public function isUser(dtoUsuario $objUsuario) {
        
        $sql = "SELECT COUNT(1) AS COUNT FROM usuario WHERE vDocumentoIdentidad=? and vClave = md5(?) and iEstado = 1 ";
        
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        
        $usr=$objUsuario->getDni();
        $pwd=$objUsuario->getClave();
        
        $pr = $connection->prepare($sql);
        $pr->bindParam(1, $usr, PDO::PARAM_INT);
        $pr->bindParam(2, $pwd, PDO::PARAM_STR);
        
        if ($pr->execute()) {
            return $pr->fetchAll(PDO::FETCH_ASSOC);
        } else {
           
          return array(array('COUNT' => 0));
        }
    }
    
    public function getDatos(dtoUsuario $objUsuario) {

        $sql = "SELECT u.*, case when u.iTipoPersona = 2 then u.vRazonSocial else u.vNombreCompleto end as UsuarioNombreCompleto, a.vDescripcion as area, t.vDescripcion as tipoUsuario, date(u.dFechaRegistro) as fecha FROM usuario u INNER JOIN tipousuario t ON t.iId = u.iTipoUsuario LEFT JOIN area a ON a.iId = u.iIdArea WHERE vDocumentoIdentidad=? and vClave = md5(?) and u.iEstado = 1 ";
        
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        
        $dni=$objUsuario->getDni();
        $pwd=$objUsuario->getClave();
        
        $pr = $connection->prepare($sql);
        $pr->bindParam(1, $dni);
        $pr->bindParam(2, $pwd, PDO::PARAM_STR);        
        
        if ($pr->execute()) {
            $obj = $pr->fetchAll(PDO::FETCH_ASSOC);
            return $obj;            
        } else {
            return null;
        }
    }

    public function changePassword(dtoUsuario $objUsuario){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $clave = $objUsuario->getClave();
        $id = $objUsuario->getIdUsuario();

        $sql="UPDATE usuario SET vClave = MD5(?) where iId = ?;";
        $pr=$connection->prepare($sql);
        $pr->bindParam(1, $clave);
        $pr->bindParam(2, $id);

        if($pr->execute()){
            return true;
        }else{
            return false;
        }
        
    }

    public function getAreas(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT iId, vDescripcion FROM area where iEstado = 1 order by vDescripcion asc";
        $pr= $connection->prepare($sql);
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getTipoTramite(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT iId, vDescripcion FROM tipotramite where iEstado = 1 order by vDescripcion asc";
        $pr= $connection->prepare($sql);
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getTipoUsuarios(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT iId, vDescripcion FROM tipousuario where iEstado = 1 order by vDescripcion asc";
        $pr= $connection->prepare($sql);
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getDepartamento(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT idDepa, departamento FROM ubdepartamento ORDER BY departamento ASC";
        $pr= $connection->prepare($sql);
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getListarProvincias($departamento){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT idProv, provincia FROM ubprovincia WHERE idDepa = $departamento ORDER BY provincia ASC";
        $pr= $connection->prepare($sql);
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getListarDistritos($provincia){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT idDist, distrito FROM ubdistrito WHERE idProv = $provincia ORDER BY distrito ASC";
        $pr= $connection->prepare($sql);
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function registrarUsuario($tipoPersona, $dni, $ruc, $nombres, $razonSocial, $correo, $departamento, $distrito, $tipoUsuario, $telefono, $area, $provincia, $domicilio, $clave, $dniRepresentante, $apellidoRepresentante, $nombreRepresentante, $celular, $correoRepresentante){

        $documento = $ruc;

        if($tipoPersona == 1){
            $documento = $dni;
        }

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="INSERT INTO usuario (iTipoPersona, iIdArea, iTipoUsuario, iDepartamento, iProvincia, iDistrito, vDocumentoIdentidad, vNombreCompleto, vTelefono, vCorreoElectronico, vDomicilio, vClave, vRazonSocial, dFechaRegistro, iEstado) VALUES (?,?,?,?,?,?,?,?,?,?,?,MD5(?),?,now(),1);";

        $pr=$connection->prepare($sql);
        $pr->bindParam(1, $tipoPersona, PDO::PARAM_INT);
        $pr->bindParam(2, $area, PDO::PARAM_INT);
        $pr->bindParam(3, $tipoUsuario, PDO::PARAM_INT);
        $pr->bindParam(4, $departamento, PDO::PARAM_INT);
        $pr->bindParam(5, $provincia, PDO::PARAM_INT);
        $pr->bindParam(6, $distrito, PDO::PARAM_INT);
        $pr->bindParam(7, $documento, PDO::PARAM_STR);
        $pr->bindParam(8, $nombres, PDO::PARAM_STR);
        $pr->bindParam(9, $telefono, PDO::PARAM_STR);
        $pr->bindParam(10, $correo, PDO::PARAM_STR);
        $pr->bindParam(11, $domicilio, PDO::PARAM_STR);
        $pr->bindParam(12, $clave, PDO::PARAM_STR);
        $pr->bindParam(13, $razonSocial, PDO::PARAM_STR);

        $pr->execute();

        if($tipoPersona == 2){

            $codigoCreado = $connection->lastInsertId();

            $sql = "INSERT INTO representante (iIdUsuario, vDocumentoIdentidadRepresentante, vNombresRepresentante, vApellidosRepresentante, vNumeroRepresentante, vCorreoElectronicoRepresentante, dFechaRegistro) VALUES (?,?,?,?,?,?,now())";

            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $codigoCreado, PDO::PARAM_INT);
            $pr->bindParam(2, $dniRepresentante, PDO::PARAM_STR);
            $pr->bindParam(3, $nombreRepresentante, PDO::PARAM_STR);
            $pr->bindParam(4, $apellidoRepresentante, PDO::PARAM_STR);
            $pr->bindParam(5, $celular, PDO::PARAM_STR);
            $pr->bindParam(6, $correoRepresentante, PDO::PARAM_STR);

            if($pr->execute()){
                return true;
            }else{
                return false;
            }
        }

        return true;        
        
    }

    public function actualizarUsuario($codigoUsuario, $ruc, $correo, $departamento, $distrito, $tipoUsuario, $telefono, $area, $provincia, $domicilio, $dniRepresentante, $apellidoRepresentante, $nombreRepresentante, $celular, $correoRepresentante){

        try{

            $factoryConnection = FactoryConnection::create('mysql');
            $connection = $factoryConnection->getConnection();

            $sql="UPDATE usuario SET iIdArea = ?, iTipoUsuario = ?, iDepartamento = ?, iProvincia = ?, iDistrito = ?, vTelefono = ?, vCorreoElectronico = ?, vDomicilio = ?, dFechaModificacion = now() WHERE iId = ?;";

            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $area, PDO::PARAM_INT);
            $pr->bindParam(2, $tipoUsuario, PDO::PARAM_INT);
            $pr->bindParam(3, $departamento, PDO::PARAM_INT);
            $pr->bindParam(4, $provincia, PDO::PARAM_INT);
            $pr->bindParam(5, $distrito, PDO::PARAM_INT);
            $pr->bindParam(6, $telefono, PDO::PARAM_STR);
            $pr->bindParam(7, $correo, PDO::PARAM_STR);
            $pr->bindParam(8, $domicilio, PDO::PARAM_STR);
            $pr->bindParam(9, $codigoUsuario, PDO::PARAM_INT);

            $pr->execute();

            if(strlen($ruc) > 0){

                $sql = "UPDATE representante SET vDocumentoIdentidadRepresentante = ?, vNombresRepresentante = ?, vApellidosRepresentante = ?, vNumeroRepresentante = ?, vCorreoElectronicoRepresentante = ?, dFechaModificacion = now() WHERE iIdUsuario = ?;";

                $pr=$connection->prepare($sql);
                $pr->bindParam(1, $dniRepresentante, PDO::PARAM_STR);
                $pr->bindParam(2, $nombreRepresentante, PDO::PARAM_STR);
                $pr->bindParam(3, $apellidoRepresentante, PDO::PARAM_STR);
                $pr->bindParam(4, $celular, PDO::PARAM_STR);
                $pr->bindParam(5, $correoRepresentante, PDO::PARAM_STR);
                $pr->bindParam(6, $codigoUsuario, PDO::PARAM_INT);

                $pr->execute();
            }

            return true;

        } catch(Exception $e){
            return false;
        }
        
    }


    public function registrarTipoUsuario($nombre){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="INSERT INTO tipousuario (vDescripcion, iEstado) VALUES (?,1);";
        $pr=$connection->prepare($sql);
        $pr->bindParam(1, $nombre, PDO::PARAM_STR);

        if($pr->execute()){
            return true;
        }else{
            return false;
        }
        
    }

    public function editarTipoUsuario($nombre, $id){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="UPDATE tipousuario SET vDescripcion = ? WHERE iId = ?;";
        $pr=$connection->prepare($sql);
        $pr->bindParam(1, $nombre, PDO::PARAM_STR);
        $pr->bindParam(2, $id, PDO::PARAM_INT);

        if($pr->execute()){
            return true;
        }else{
            return false;
        }
        
    }

    public function eliminarTipoUsuario($id){

        try{

            $factoryConnection = FactoryConnection::create('mysql');
            $connection = $factoryConnection->getConnection();

            $sql="DELETE FROM tipousuario WHERE iId = ?;";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $id, PDO::PARAM_INT);

            $pr->execute();

            return true;

        } catch(Exception $ex){
            return false;
        }
        
    }

    public function eliminarUsuario($id, $documento){

        try{

            $factoryConnection = FactoryConnection::create('mysql');
            $connection = $factoryConnection->getConnection();

            if(strlen($documento) == 11){
                $sql="DELETE FROM representante WHERE iIdUsuario = ?;";
                $pr=$connection->prepare($sql);
                $pr->bindParam(1, $id, PDO::PARAM_INT);
                $pr->execute();
            }

            $sql="DELETE FROM usuario WHERE iId = ?;";
            $pr=$connection->prepare($sql);
            $pr->bindParam(1, $id, PDO::PARAM_INT);

            $pr->execute();

            return true;

        } catch(Exception $ex){
            return false;
        }
        
    }

    public function getListUsuarios(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT u.*, r.*, CASE WHEN u.iTipoPersona = 1 THEN u.vNombreCompleto ELSE u.vRazonSocial END AS 'nombreUsuario' , u.iId as codigoUnicoUsuario, u.vDocumentoIdentidad, u.vCorreoElectronico, tu.vDescripcion, u.dFechaRegistro FROM usuario u inner join tipousuario tu on tu.iId = u.iTipoUsuario left join representante r on u.iId = r.iIdUsuario where tu.iEstado = 1 and u.iEstado = 1 order by nombreUsuario desc;";

        $pr= $connection->prepare($sql);
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getListTipoUsuarios(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT iId, vDescripcion FROM tipousuario WHERE iEstado = 1 ORDER BY vDescripcion DESC;";
        $pr= $connection->prepare($sql);
        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    } 

    public function getTramiteDia(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $idUsuario = $_SESSION['SIFO']['iId'];
        $area = $_SESSION['SIFO']['area'];
        $query = '';

        if($area != 'Mesa de partes'){
            $query = 'AND iIdUsuario = '.$idUsuario;
        }

        $sql="SELECT count(1) AS contador FROM tramite WHERE date(dFechaRegistro) = date(now()) $query";
        $pr= $connection->prepare($sql);

        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getTramitePendientes(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $idUsuario = $_SESSION['SIFO']['iId'];
        $area = $_SESSION['SIFO']['area'];
        $query = '';

        if($area != 'Mesa de partes'){
            $query = 'AND iIdUsuario = '.$idUsuario;
        }

        $sql="SELECT count(1) AS contador FROM tramite WHERE iEstado IN (1, 2) $query";
        $pr= $connection->prepare($sql);

        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getTotalTramites(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $idUsuario = $_SESSION['SIFO']['iId'];
        $area = $_SESSION['SIFO']['area'];
        $query = '';

        if($area != 'Mesa de partes'){
            $query = 'WHERE iIdUsuario = '.$idUsuario;
        }

        $sql="SELECT count(1) AS contador FROM tramite $query";
        $pr= $connection->prepare($sql);

        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getTramitePendientePorcentaje(){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $idUsuario = $_SESSION['SIFO']['iId'];
        $area = $_SESSION['SIFO']['area'];
        $query = '';

        if($area != 'Mesa de partes'){
            $query = 'AND iIdUsuario = '.$idUsuario;
        }

        $sql="SELECT count(1) AS contador FROM tramite WHERE iEstado = 3 $query";
        $pr= $connection->prepare($sql);

        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }

    public function getGraficoTramiteRegistrado($estado){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $idUsuario = $_SESSION['SIFO']['iId'];
        $area = $_SESSION['SIFO']['area'];
        $query = '';

        if($area != 'Mesa de partes'){
            $query = 'AND iIdUsuario = '.$idUsuario;
        }

        $hoy = date('Y-m-d');
        $fechaAnterior = date("Y-m-d",strtotime($hoy."- 7 days"));

        $sql="SELECT date(dFechaRegistro) AS fecha, count(1) AS contador FROM tramite WHERE iEstado in ($estado) AND dFechaRegistro >= '$fechaAnterior 00:00:00' AND dFechaRegistro <= '$hoy 23:59:59' $query GROUP BY date(dFechaRegistro)";

        $pr= $connection->prepare($sql);

        if($pr->execute()){
            return $pr->FetchAll(PDO::FETCH_ASSOC);
        }else{
            return null;
        }

    }    
    
}