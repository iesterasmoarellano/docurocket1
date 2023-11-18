<?php

session_start();
$_SESSION['SIFO']['activo']=0;

session_unset();
session_destroy();
unset($_SESSION['SIFO']);

header('Location: index.php');

?>
