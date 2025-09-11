<?php
require_once('models/maud.php');

$maud = new MAud();

$idaud = isset($_REQUEST['idaud']) ? $_REQUEST['idaud']:NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu']:NULL;
$tabla = isset($_POST['tabla']) ? $_POST['tabla']:NULL;
$accion = isset($_POST['accion']) ? $_POST['accion']:NULL;
$idreg = isset($_POST['idreg']) ? $_POST['idreg']:NULL;
$datos_ant = isset($_POST['datos_ant']) ? $_POST['datos_ant']:NULL;
$datos_nue = isset($_POST['datos_nue']) ? $_POST['datos_nue']:NULL;
$fecha = isset($_POST['fecha']) ? $_POST['fecha']:NULL;
$ip = isset($_POST['ip']) ? $_POST['ip']:NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$maud->setIdaud($idaud);
if($ope == "save"){
    $maud->setIdusu($idusu);
    $maud->setTabla($tabla);
    $maud->setAccion($accion);
    $maud->setIdreg($idreg);
    $maud->setDatos_ant($datos_ant);
    $maud->setDatos_nue($datos_nue);
    $maud->setFecha($fecha);
    $maud->setIp($ip);
    if(!$idaud) $maud->save(); else $maud->edit();
}

if($ope =="eli" && $idaud) $maud->del();
if($ope =="edi" && $idaud) $datOne = $maud->getOne();

$datAll = $maud->getAll();
?>