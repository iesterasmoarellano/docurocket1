<?php
session_start();
if (!isset($_SESSION['SIFO'])) {
    header('Location:../index.php');
} else if (!$_SESSION['SIFO']['activo']) {
    header('Location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="es"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="../img/logoeag.png" type="image/x-icon">

        <link rel="stylesheet" href="../includes/jquery-ui-1.11.3.custom/jquery-ui.css" type="text/css">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="../includes/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="../includes/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="../includes/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="../includes/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="../includes/plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="../includes/plugins/summernote/summernote-bs4.min.css">
        <link rel="stylesheet" href="../includes/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="../includes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../includes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../includes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="../includes/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="../includes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="../includes/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../includes/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="../includes/plugins/sweetalert2/sweetalert2.min.css" >
        <link rel="stylesheet" href="../includes/plugins/bs-stepper/css/bs-stepper.min.css">

        <title>Gestion Documentaria</title>
    </head>