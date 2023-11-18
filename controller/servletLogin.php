<?php

class servletLogin extends CommandController {
  
  public function doPost() {
    $dao=DAOFactory::getDAOUsuario('maria');

    switch ($_POST['action']):
      
      case 'check':

      if( !isset($_POST['usr']) ) {
        echo json_encode(array('rst'=>false,'msg'=>'Usuario no ingresado'));
        exit();
      }
      if( !isset($_POST['pwd']) ) {
        echo json_encode(array('rst'=>false,'msg'=>'Clave no ingresada'));
        exit();
      }

      $usuario = $_POST['usr'];
      $password = $_POST['pwd'];

      $objUsuario=new dtoUsuario() ;

      $objUsuario->setDni($usuario);
      $objUsuario->setClave($password);

      $count=$dao->isUser($objUsuario);

      if($count[0]['COUNT']>0){
        $datos=$dao->getDatos($objUsuario);
        $_SESSION['SIFO'] = $datos[0];
        $_SESSION['SIFO']['activo'] = 1;

        echo json_encode(array('rst'=>true, 'tipoUsuario' => $_SESSION['SIFO']['iTipoUsuario']));
      }  else {
       echo json_encode(array('rst'=>false, 'tipoUsuario' => 0));
     }

     break;
     default:
     echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada'));

   endswitch;

  }

  public function doGet() {

  }

}

?>
