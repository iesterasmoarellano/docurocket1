<?php

    class servletUsuario extends CommandController {
        public function doPost() {

            $dao=DAOFactory::getDAOUsuario('maria');

            if(isset($_POST['action'])){


                switch ($_POST['action']):
                   
                    case  'changePassword' :
                        
                        if(!isset($_SESSION['SIFO']) ){
                            echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                            exit();
                        }

                        $pwd = $_POST['pwd'];
                        $id = $_SESSION['SIFO']['iId'];

                        $objUsuario = new dtoUsuario();
                        $objUsuario->setClave($pwd);
                        $objUsuario->setIdUsuario($id);

                        if($dao->changePassword($objUsuario)){
                            echo json_encode(array('rst'=>true,'msg'=>'Se actualizó la contraseña correctamente'));
                        }else{
                            echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                        }
                    break;

                    case  'crearUsuario' :

                        $codigoUsuario = $_POST['codigoUsuario'];
                        $tipoPersona = $_POST['tipoPersona'];
                        $dni = $_POST['dni'];
                        $ruc = $_POST['ruc'];
                        $nombres = $_POST['nombres'];
                        $razonSocial = $_POST['razonSocial'];
                        $correo = $_POST['correo'];
                        $departamento = $_POST['departamento'];
                        $distrito = $_POST['distrito'];
                        $tipoUsuario = $_POST['tipoUsuario'];
                        $telefono = $_POST['telefono'];
                        $area = $_POST['area'];
                        $provincia = $_POST['provincia'];
                        $domicilio = $_POST['domicilio'];
                        $clave = $_POST['clave'];
                        $dniRepresentante = $_POST['dniRepresentante'];
                        $apellidoRepresentante = $_POST['apellidoRepresentante'];
                        $nombreRepresentante = $_POST['nombreRepresentante'];
                        $celular = $_POST['celular'];
                        $correoRepresentante = $_POST['correoRepresentante'];

                        if($codigoUsuario == 0){
                            
                            if($dao->registrarUsuario($tipoPersona, $dni, $ruc, $nombres, $razonSocial, $correo, $departamento, $distrito, $tipoUsuario, $telefono, $area, $provincia, $domicilio, $clave, $dniRepresentante, $apellidoRepresentante, $nombreRepresentante, $celular, $correoRepresentante)){
                                echo json_encode(array('rst'=>true,'msg'=>'Usuario agregado correctamente.'));
                            }else{
                                echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                            }

                        } else {
                            
                            if($dao->actualizarUsuario($codigoUsuario, $ruc, $correo, $departamento, $distrito, $tipoUsuario, $telefono, $area, $provincia, $domicilio, $dniRepresentante, $apellidoRepresentante, $nombreRepresentante, $celular, $correoRepresentante)){
                                echo json_encode(array('rst'=>true,'msg'=>'Usuario actualizado correctamente.'));
                            }else{
                                echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                            }

                        }

                        
                    break;

                    case  'crearTipoUsuario' :
                        
                        if(!isset($_SESSION['SIFO'])){
                            echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                            exit();
                        }

                        $nombre = $_POST['nombre'];
                        $id = $_POST['id'];

                        if($id == 0){
                            
                            if($dao->registrarTipoUsuario($nombre)){
                                echo json_encode(array('rst'=>true,'msg'=>'Tipo Usuario agregado correctamente.'));
                            }else{
                                echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                            }

                        } else {

                            if($dao->editarTipoUsuario($nombre, $id)){
                                echo json_encode(array('rst'=>true,'msg'=>'Tipo Usuario actualizado correctamente.'));
                            }else{
                                echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                            }

                        }

                    break;

                    case  'eliminarTipoUsuario' :
                        
                        if(!isset($_SESSION['SIFO'])){
                            echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                            exit();
                        }

                        $id = $_POST['id'];

                        if($dao->eliminarTipoUsuario($id)){
                            echo json_encode(array('rst'=>true,'msg'=>'Tipo Usuario eliminado correctamente.'));
                        }else{
                            echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                        }

                    break;

                    case  'eliminarUsuario' :
                        
                        if(!isset($_SESSION['SIFO'])){
                            echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                            exit();
                        }

                        $id = $_POST['id'];
                        $documento = $_POST['documento'];

                        if($_SESSION['SIFO']['iId'] == $id){
                            echo json_encode(array('rst'=>false,'msg'=>'No se puede eliminar el usuario con una sesión activa.'));
                        } else if($dao->eliminarUsuario($id, $documento)){
                            echo json_encode(array('rst'=>true,'msg'=>'Usuario eliminado correctamente.'));
                        }else{
                            echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                        }

                    break;

                    default:
                        echo json_encode(array('rst'=>false,'msg'=>'ACCIÓN NO ENCONTRADA'));

                endswitch;

            } 
            
        }
        public function doGet() {
            $dao=DAOFactory::getDAOUsuario('maria');
            switch ($_GET['action']):

                case 'getAreas':
                    $array = $dao->getAreas();
                    echo json_encode(array('rst'=>true,'areas'=>$array));
                break;

                case 'getTipoTramite':
                    $array = $dao->getTipoTramite();
                    echo json_encode(array('rst'=>true,'tipotramite'=>$array));
                break;

                case 'getTipoUsuario':
                    $array = $dao->getTipoUsuarios();
                    echo json_encode(array('rst'=>true,'tipoUsuarios'=>$array));
                break;

                case 'getDepartamento':
                    $array = $dao->getDepartamento();
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'listarProvincias':
                    $departamento = $_GET['idDepartamento'];
                    $array = $dao->getListarProvincias($departamento);
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'listarDistritos':
                    $provincia = $_GET['idProvincia'];
                    $array = $dao->getListarDistritos($provincia);
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'listUsuario':
                    $array = $dao->getListUsuarios();
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'listTipoUsuario':
                    $array = $dao->getListTipoUsuarios();
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'getTramiteDia':
                    $array = $dao->getTramiteDia();
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'getTramitePendientes':
                    $array = $dao->getTramitePendientes();
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'getTotalTramites':
                    $array = $dao->getTotalTramites();
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'getTramitePendientePorcentaje':
                    $array = $dao->getTramitePendientePorcentaje();
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;

                case 'getGraficoTramiteRegistrado':
                    $codigo = $_GET['estado'];
                    $array = $dao->getGraficoTramiteRegistrado($codigo);
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;
                 
                default:
                    echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada'));

            endswitch;
         			 		    
          }
    }

?>
