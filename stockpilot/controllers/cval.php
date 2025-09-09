<?php
require_once('models/mval.php');

$mval = new MVal();

$idval = isset($_REQUEST['idval']) ? $_REQUEST['idval']:NULL;
$nomval = isset($_POST['nomval']) ? $_POST['nomval']:NULL;
$iddom = isset($_POST['iddom']) ? $_POST['iddom']:NULL;
$codval = isset($_POST['codval']) ? $_POST['codval']:NULL;
$desval = isset($_POST['desval']) ? $_POST['desval']:NULL;
$fec_crea = isset($_POST['fec_crea']) ? $_POST['fec_crea']:NULL;
$fec_actu = isset($_POST['fec_actu']) ? $_POST['fec_actu']:NULL;
$act = isset($_POST['act']) ? $_POST['act']:NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$mval->setIdval($idval);
if($ope == "save"){
    $mval->setNomval($nomval);
    $mval->setIddom($iddom);
    $mval->setCodval($codval);
    $mval->setDesval($desval);
    $mval->setFec_crea($fec_crea);
    $mval->setFec_actu($fec_actu);
    $mval->setAct($act);
    if(!$idval) $mval->save(); else $mval->edit();
}

if($ope =="eli" && $idval) $mval->del();
if($ope =="edi" && $idval) $datOne = $mval->getOne();

$datAll = $mval->getAll();
?>