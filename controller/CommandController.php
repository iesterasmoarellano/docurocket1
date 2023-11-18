<?php

abstract class CommandController {

    public function process ( ) {
        switch ($_SERVER['REQUEST_METHOD']):
            case 'POST':
                if(method_exists($this,'doPost')) {
                    $this->doPost();
                }
            break;
            case 'GET':
                if(method_exists($this,'doGet')) {
                    $this->doGet();
                }
           	break;
       	endswitch;
    }

    public function doPost ( ) {

    }
    public function doGet ( ) {

    }
   
    public static function getCommand ( ) {
        $classController= NULL;
        
        switch ( $_REQUEST['command'] ) :
            
            case 'login':
                $classController = new servletLogin() ;
            break;
            case 'usuario':            
                $classController = new servletUsuario() ;
            break;
            case 'area':            
                $classController = new servletArea() ;
            break;
            case 'solicitud':            
                $classController = new servletSolicitud() ;
            break;
            case 'reporte':            
                $classController = new servletReporte() ;
            break;
            
            default:
                echo json_encode(array('rst'=>false,'msg'=>'Controllador no encontrado'));
                exit();
			
        endswitch;
        
        
        return $classController;
    }

}


?>
