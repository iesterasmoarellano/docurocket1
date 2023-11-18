<?php
session_start();
if (!isset($_SESSION['SIFO'])) {
    header('Location:../index.php');
} else if (!$_SESSION['SIFO']['activo']) {
    header('Location:../index.php');
}

setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'esp', 'Spanish_Spain', 'Spanish');

require_once '../includes/tcpdf/tcpdf.php';
require_once '../conexion/config.php';
require_once '../conexion/MYSQLConnectionMYSQLI.php';
require_once '../conexion/MYSQLConnectionPDO.php';
require_once '../conexion/SQLITEConnectionPDO.php';
require_once '../conexion/PGSQLConnectionPDO.php';
require_once '../factory/DAOFactory.php';
require_once '../factory/FactoryConnection.php';

$expediente = $_REQUEST['expediente'];

$hoy = date('Y-m-d');
$hoy = strtotime($hoy);
$fecha_formateada = strftime("%e de %B de %Y", $hoy);
$anio = date('Y');

$factoryConnection = FactoryConnection::create('mysql');
$connection = $factoryConnection->getConnection();

$sql = "SELECT case when u.iTipoPersona = 1 then u.vNombreCompleto else u.vRazonSocial end as creador, t.vAsunto from tramite t inner join usuario u on t.iIdUsuario = u.iId where vNumeroExpediente = ?";
$pr=$connection->prepare($sql);
$pr->bindParam(1, $expediente, PDO::PARAM_STR);
$pr->execute();
$data = $pr->FetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT u.vNombreCompleto, a.vDescripcion as oficina_atencion, dt.dFechaIngreso, tu.vDescripcion as tipo_usuario from tramite t inner join detalletramite dt on t.iId = dt.IIdSolicitud inner join usuario u on dt.iIdUsuario = u.iId inner join area a on u.iIdArea = a.iId inner join tipousuario tu on u.iTipoUsuario = tu.iId where vNumeroExpediente = ? order by dFechaIngreso desc limit 1;";
$pr=$connection->prepare($sql);
$pr->bindParam(1, $expediente, PDO::PARAM_STR);
$pr->execute();
$info = $pr->FetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT correlativo FROM documento";
$pr=$connection->prepare($sql);
$pr->execute();
$codigo = $pr->FetchAll(PDO::FETCH_ASSOC);
$correlativo_formateado = sprintf('%04d', $codigo[0]['correlativo']);

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetPrintHeader(false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistema Gestion Documentaria');
$pdf->SetTitle('Informe de finalizacion de tramite');
$pdf->SetSubject('Constancia');
$pdf->SetKeywords('Constancia, registro, EAG');

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);

$pdf->AddPage();

$html = '<!DOCTYPE html>
<html>
<head>
    <title>Constancia de registro</title>

    <style>
		body, p, label{
			font-size: 12px;
			font-family: "Courier New", monospace;
		}
	</style>
</head>
<body>
	<div class="align-items-center" style="text-align: center; padding-top: 10px;">
		<img src="../img/cabecera-informe.png" class="rounded-4" style="width: 500px;" alt="" />
	</div>
    <h4><b>Informe N°:</b> '.$correlativo_formateado.'-'.$anio.'</h4>
    <hr>
    <pre>
		<b>DE</b>           : '.$info[0]['vNombreCompleto'].'
		               '.$info[0]['tipo_usuario'].'
		<b>A</b>            : '.$data[0]['creador'].'
		<b>ASUNTO</b>       : '.$data[0]['vAsunto'].'
		<b>REFERENCIA</b>   : '.$expediente.'
		<b>FECHA</b>        :	Pataz,'.$fecha_formateada.'
		<hr>
		Es grato dirigirme a usted y a la vez informarle que su trámite ha sido atendido de manera exitosa. Se adjunta los datos:

		Expediente                : '.$expediente.'
		Oficina de atención       : '.$info[0]['oficina_atencion'].'
		Fecha y hora atención     : '.$info[0]['dFechaIngreso'].'
	</pre>
	<br>
	<p style="text-align: justify;">Es todo cuanto se informa, para los fines que se estime conveniente.</p>
	<p style="text-align: justify;">Atentamente,</p>
</body>
<footer>
	<div style="text-align: center;">
		<img src="archivos/'.$expediente.'/firma-responsable-oficina.png" class="rounded-4" style="width: 150px;" alt="" />
		<p>_____________________________</p>
		<label>'.$info[0]['vNombreCompleto'].'</label>
		<br>
		<label>'.$info[0]['tipo_usuario'].'</label>
		<br>
		<label>I.E.S.T.P. "Erasmo Arellano Guillén"</label>
	</div>	 
</footer>
</html>';

$sql = "UPDATE documento SET correlativo = correlativo + 1";
$pr=$connection->prepare($sql);
$pr->execute();

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output(__DIR__.'/archivos/'.$expediente.'/Informe de tramite.pdf', 'F');
?>