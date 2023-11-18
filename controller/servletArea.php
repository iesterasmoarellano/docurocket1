<?php

    class servletArea extends CommandController {
        
        public function doPost() {

            $dao=DAOFactory::getDAOArea('maria');

            if(isset($_POST['action'])){

                switch ($_POST['action']):

                    case  'crearArea' :
                        
                        if(!isset($_SESSION['SIFO'])){
                            echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                            exit();
                        }

                        $nombre = $_POST['nombre'];
                        $id = $_POST['id'];

                        if($id == 0){

                            if($dao->registrarArea($nombre)){
                                echo json_encode(array('rst'=>true,'msg'=>'Área agregado correctamente.'));
                            }else{
                                echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                            }

                        } else {

                            if($dao->editarArea($nombre, $id)){
                                echo json_encode(array('rst'=>true,'msg'=>'Área actualizado correctamente.'));
                            }else{
                                echo json_encode(array('rst'=>false,'msg'=>'Ocurrió un error, por favor intentarlo más tarde'));
                            }

                        }

                    break;

                    case  'eliminarOficina' :
                        
                        if(!isset($_SESSION['SIFO'])){
                            echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                            exit();
                        }

                        $id = $_POST['id'];

                        if($dao->eliminarOficina($id)){
                            echo json_encode(array('rst'=>true,'msg'=>'Oficina eliminado correctamente.'));
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

            $dao=DAOFactory::getDAOArea('maria');
            switch ($_GET['action']):

                case 'listArea':
                    $array = $dao->getListArea();
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;
                 
                default:
                    echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada'));

            endswitch;
         			 		    
          }
    }

?>
