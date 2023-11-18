<?php

$tipoAdjunto = $_GET['flag'];
$targetDir = "archivos/";

if($tipoAdjunto == 'anexo'){
	$targetDir = "anexos/";
}

$targetFile = $targetDir . basename($_FILES["file"]["name"]);

if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
  $response = array("status" => "success", "message" => "Archivo subido correctamente");
} else {
  $response = array("status" => "error", "message" => "Error al subir el archivo");
}

echo json_encode($response);
?>