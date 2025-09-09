<?php
require_once('models/mdom.php');

$mdom = new MDom();

$iddom = isset($_REQUEST['iddom']) ? $_REQUEST['iddom']:NULL;
$nomdom = isset($_POST['nomdom']) ? $_POST['nomdom']:NULL;
$desdom = isset($_POST['desdom']) ? $_POST['desdom']:NULL;
$fec_crea = isset($_POST['fec_crea']) ? $_POST['fec_crea']:NULL;
$fec_actu = isset($_POST['fec_actu']) ? $_POST['fec_actu']:NULL;
$act = isset($_POST['act']) ? $_POST['act']:NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$mdom->setIddom($iddom);
if($ope == "save"){
    $mdom->setNomdom($nomdom);
    $mdom->setDesdom($desdom);
    $mdom->setFec_crea($fec_crea);
    $mdom->setFec_actu($fec_actu);
    $mdom->setAct($act);
    if(!$iddom) $mdom->save(); else $mdom->edit();
}

if($ope =="eli" && $iddom) $mdom->del();
if($ope =="edi" && $iddom) $datOne = $mdom->getOne();

$datAll = $mdom->getAll();
?>