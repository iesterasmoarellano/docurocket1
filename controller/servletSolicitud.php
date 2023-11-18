<?php

    class servletSolicitud extends CommandController {

        public function doPost() {

            $dao=DAOFactory::getDAOSolicitud('maria');

            if(isset($_POST['action'])){

                switch ($_POST['action']):

                    case  'crearSolicitud' :
                        
                        if(!isset($_SESSION['SIFO'])){
                            echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                            exit();
                        }

                        $asunto = $_POST['asunto'];
                        $numero_documento = $_POST['numero_documento'];
                        $tipo_tramite = $_POST['tipo_tramite'];
                        $notificacion = $_POST['notificacion'];
                        $nombreArchivos = '';
                        $nombreAnexos = '';
                        $chk_numero_documento = 'off';
                        $firma = $_POST['firma'];

                        if(isset($_POST['chk_numero_documento'])){
                            $chk_numero_documento = $_POST['chk_numero_documento'];
                        }

                        if (isset($_POST['nombreArchivos'])){
                            $nombreArchivos = $_POST['nombreArchivos'];
                        }

                        if (isset($_POST['anexos'])){
                            $nombreAnexos = $_POST['anexos'];
                        }

                        $result = $dao->registrarSolicitud($asunto, $numero_documento, $chk_numero_documento, $tipo_tramite, $notificacion, $nombreArchivos, $nombreAnexos, $firma);

                        if(!$result){
                            echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                        }else{
                            echo json_encode(array('rst'=>$result,'msg'=>'Solicitud agregada correctamente.'));
                        }
                    break;

                    case  'crearTipoTramite' :
                        
                        if(!isset($_SESSION['SIFO'])){
                            echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                            exit();
                        }

                        $nombre = $_POST['nombre'];
                        $id = $_POST['id'];

                        if($id == 0){

                            if($dao->registrarTipoTramite($nombre)){
                                echo json_encode(array('rst'=>true,'msg'=>'Tipo trámite agregado correctamente.'));
                            }else{
                                echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                            }

                        } else {

                            if($dao->editarTipoTramite($nombre, $id)){
                                echo json_encode(array('rst'=>true,'msg'=>'Tipo trámite actualizado correctamente.'));
                            }else{
                                echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                            }

                        }

                    break;

                    case  'eliminarTipoTramite' :
                        
                        if(!isset($_SESSION['SIFO'])){
                            echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                            exit();
                        }

                        $id = $_POST['id'];

                        if($dao->eliminarTipoTramite($id)){
                            echo json_encode(array('rst'=>true,'msg'=>'Tipo trámite eliminado correctamente.'));
                        }else{
                            echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                        }

                    break;

                    case  'registrarDerivacionTramite' :
                        
                        if(!isset($_SESSION['SIFO'])){
                            echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                            exit();
                        }

                        $estado = $_POST['estado'];
                        $motivo = $_POST['motivo'];
                        $oficinaAsignar = $_POST['oficinaAsignar'];
                        $codigoSolicitud = $_POST['codigoSolicitud'];
                        $codigoDetalleSolicitud = $_POST['codigoDetalleSolicitud'];
                        $firmaOficina = $_POST['firmaOficina'];

                        $archivosAtendidos = '';

                        if(isset($_POST['archivosAtendidos'])){
                            $archivosAtendidos = $_POST['archivosAtendidos'];
                        }

                        if($dao->registrarDerivacionTramite($estado, $motivo, $oficinaAsignar, $codigoSolicitud, $codigoDetalleSolicitud, $archivosAtendidos, $firmaOficina)){
                            echo json_encode(array('rst'=>true,'msg'=>'Estado del trámite actualizado correctamente.'));
                        }else{
                            echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                        }

                    break;

                    case  'registrarExpedienteObservado' :
                        
                        if(!isset($_SESSION['SIFO'])){
                            echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                            exit();
                        }

                        $nombreArchivosObservados = '';
                        $expediente = $_POST['expediente'];

                        if (isset($_POST['nombreArchivosObservados'])){
                            $nombreArchivosObservados = $_POST['nombreArchivosObservados'];
                        }

                        $result = $dao->registrarExpedienteObservado($nombreArchivosObservados, $expediente);

                        if(!$result){
                            echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                        }else{
                            echo json_encode(array('rst'=>$result,'msg'=>'Trámite registrado de manera correcta.'));
                        }
                    break;

                    default:
                        echo json_encode(array('rst'=>false,'msg'=>'ACCIÓN NO ENCONTRADA'));

                endswitch;

            } 
            
        }
        public function doGet() {
            $dao=DAOFactory::getDAOSolicitud('maria');
            switch ($_GET['action']):

                case 'listSolicitud':
                    $expediente = $_GET['expediente'];

                    $array = $dao->getListSolicitudes($expediente);
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'listTipoTramite':
                    $array = $dao->getListTipoTramite();
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'getBacklog':
                    $estado = $_GET['estado'];
                    $array = $dao->getBacklog($estado);
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'verDetalleSolicitud':
                    $codigo = $_GET['codigo'];
                    $array = $dao->verDetalleSolicitud($codigo);
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'listDetalleSolicitud':
                    $codigo = $_GET['codigo'];
                    $array = $dao->listDetalleSolicitud($codigo);
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'verTramitesAsignados':
                    $array = $dao->verTramitesAsignados();
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'verArchivos':

                    $expediente = $_GET['expediente'];

                    $directorio = "../resources/archivos/$expediente"; 
                    $archivos = scandir($directorio); 
                    $archivos = array_diff($archivos, array('.', '..'));
                    echo json_encode(array_values($archivos));

                break;

                case 'verAnexos':

                    $expediente = $_GET['expediente'];

                    $directorio = "../resources/archivos/$expediente/Anexos"; 
                    $archivos = scandir($directorio); 
                    $archivos = array_diff($archivos, array('.', '..'));
                    echo json_encode(array_values($archivos));
                    
                break;
                 
                default:
                    echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada'));

            endswitch;
         			 		    
          }
    }

?>
