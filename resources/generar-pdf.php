<?php
session_start();
if (!isset($_SESSION['SIFO'])) {
    header('Location:../index.php');
} else if (!$_SESSION['SIFO']['activo']) {
    header('Location:../index.php');
}

require_once '../includes/tcpdf/tcpdf.php';
require_once '../conexion/config.php';
require_once '../conexion/MYSQLConnectionMYSQLI.php';
require_once '../conexion/MYSQLConnectionPDO.php';
require_once '../conexion/SQLITEConnectionPDO.php';
require_once '../conexion/PGSQLConnectionPDO.php';
require_once '../factory/DAOFactory.php';
require_once '../factory/FactoryConnection.php';

$expediente = $_REQUEST['expediente'];

$factoryConnection = FactoryConnection::create('mysql');
$connection = $factoryConnection->getConnection();

$sql = "SELECT case when iTipoPersona = 1 then vNombreCompleto else vRazonSocial end as nombresolicitante, s.vNumeroDocumento, s.dFechaRegistro, s.vTipoTramite, s.vAsunto, case when s.iNotificacion = 1 then 'CORREO ELECTRONICO' else 'SIN NOTIFICAR' end as Notificacion from tramite s inner join usuario u on s.iIdUsuario = u.iId where vNumeroExpediente = ?;";
$pr=$connection->prepare($sql);
$pr->bindParam(1, $expediente, PDO::PARAM_STR);
$pr->execute();
$data = $pr->FetchAll(PDO::FETCH_ASSOC);

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistema Gestion Documentaria');
$pdf->SetTitle('Constancia de registro');
$pdf->SetSubject('Constancia');
$pdf->SetKeywords('Constancia, registro, EAG');

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setFontSubsetting(true);

$pdf->AddPage();

$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Constancia de registro</title>

    <style>
		table {
		  font-family: arial, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		}

		td, th {
		  border: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;
		}

		p{
			font-size: 11px;
		}
	</style>
</head>
<body>
	<div class="align-items-center" style="text-align: center">
		<img src="../img/logoeag.png" class="rounded-4" style="width: 55px;" alt="" />
	</div>
    <h1>Constancia de recepción</h1>
    <p style="text-align: justify;">Estimado(a) ciudadano(a) '.$data[0]['nombresolicitante'].'</p>
    <p style="text-align: justify;">Le comunicamos que su expediente N° '.$expediente.' ha sido registrado satisfactoriamente con los siguientes datos:</p>
    <br>
	<table>
	  <tr>
	    <th colspan=2 style="text-align: center; background-color: #dddddd;"><p><b>DATOS DEL SOLICITANTE</b></p></th>
	  </tr>
	  <tr>
	    <td style="width: 200px"><p>Nombres y Apellidos</p></td>
	    <td><p>'.$data[0]['nombresolicitante'].'</p></td>
	  </tr>
	  <tr>
	    <td><p>Número de Documento</p></td>
	    <td><p>'.$data[0]['vNumeroDocumento'].'</p></td>
	  </tr>
	</table>
	<br>
	<br>
	<table>
	  <tr>
	    <th colspan=2 style="text-align: center; background-color: #dddddd;"><p><b>DATOS DEL EXPEDIENTE</b></p></th>
	  </tr>
	  <tr>
	    <td style="width: 200px"><p>N° Expediente</p></td>
	    <td><p>'.$expediente.'</p></td>
	  </tr>
	  <tr>
	    <td><p>Fecha y hora de registro</p></td>
	    <td><p>'.$data[0]['dFechaRegistro'].'</p></td>
	  </tr>
	  <tr>
	    <td><p>Documento</p></td>
	    <td><p>'.strtoupper($data[0]['vTipoTramite']).'</p></td>
	  </tr>
	  <tr>
	    <td><p>Entidad</p></td>
	    <td><p>IESTP. ERASMO ARELLANO GUILLEN</p></td>
	  </tr>
	  <tr>
	    <td><p>Oficina que recibe</p></td>
	    <td><p>MESA DE PARTES</p></td>
	  </tr>
	  <tr>
	    <td><p>Asunto</p></td>
	    <td><p>'.strtoupper($data[0]['vAsunto']).'</p></td>
	  </tr>
	  <tr>
	    <td><p>Medio de notificación</p></td>
	    <td><p>'.$data[0]['Notificacion'].'</p></td>
	  </tr>
	</table>
</body>
<footer>
	<p style="text-align: justify;"> <b>NOTA IMPORTANTE: </b> </p>
	<p style="text-align: justify;"> 1.- La EAG estará habilitada las veinticuatro (24) horas del día y los siete (07) días de la semana para la presentación de documentos. </p>
	<p style="text-align: justify;"> 2.- El expediente presentado se sujeta a la verificación y eventual observación de los requisitos procedimentales, conforme a lo establecido en
		los artículos 124 y 136 del Texto Único Ordenado de la Ley N° 27444, Ley del Procedimiento Administrativo General </p>
	<p style="text-align: justify;"> Atentamente, </p>
	<p style="text-align: justify;"> IESTP. ERASMO ARELLANO GUILLEN </p>
	<br>
	<br>
	<div style="text-align: center;">
		<img src="archivos/'.$expediente.'/firma.png" class="rounded-4" style="width: 150px;" alt="" />
		<p>_____________________________</p>
		<p>Firma del solicitante</p>
	</div>	 
</footer>
</html>';


$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('Constancia de registro.pdf', 'D');
?>