<?php

session_start();
date_default_timezone_set('America/Lima');
//error_reporting(1);


require_once '../controller/CommandController.php';
require_once '../controller/servletLogin.php';
require_once '../controller/servletUsuario.php';
require_once '../controller/servletArea.php';
require_once '../controller/servletSolicitud.php';
require_once '../controller/servletReporte.php';


require_once '../conexion/config.php';
require_once '../conexion/MYSQLConnectionMYSQLI.php';
require_once '../conexion/MYSQLConnectionPDO.php';
require_once '../conexion/SQLITEConnectionPDO.php';
require_once '../conexion/PGSQLConnectionPDO.php';

require_once '../factory/DAOFactory.php';
require_once '../factory/FactoryConnection.php';

require_once '../dao/MARIAUsuarioDAO.php';
require_once '../dao/MARIAAreaDAO.php';
require_once '../dao/MARIASolicitudDAO.php';
require_once '../dao/MARIAReporteDAO.php';


require_once '../dto/dtoUsuario.php';


$cn = CommandController::getCommand();
	
$cn->process();

?>
