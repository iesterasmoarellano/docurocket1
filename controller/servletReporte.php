<?php

    class servletReporte extends CommandController {

        public function doGet() {
            $dao=DAOFactory::getDAOReporte('maria');
            switch ($_GET['action']):

                case 'buscarTramite':

                    if(!isset($_SESSION['SIFO']) ){
                        echo json_encode(array('rst'=>false,'msg'=>'Sesión expirada, por favor volver a ingresar'));
                        exit();
                    }
                    
                    $estado = $_GET['estado'];
                    $fechaInicio = $_GET['fechaInicio'];
                    $fechaFin = $_GET['fechaFin'];

                    $array = $dao->buscarTramite($estado, $fechaInicio, $fechaFin);
                    echo json_encode(array('rst'=>true,'data'=>$array));
                break;
                 
                default:
                    echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada'));

            endswitch;
         			 		    
          }
    }

?>
