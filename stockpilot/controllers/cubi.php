<?php
require_once('models/mubi.php');

$mubi = new MUbi();

$idubi = isset($_REQUEST['idubi']) ? $_REQUEST['idubi']:NULL;
$nomubi = isset($_POST['nomubi']) ? $_POST['nomubi']:NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi']:NULL;
$dirubi = isset($_POST['dirubi']) ? $_POST['dirubi']:NULL;
$depubi = isset($_POST['depubi']) ? $_POST['depubi']:NULL;
$ciuubi = isset($_POST['ciuubi']) ? $_POST['ciuubi']:NULL;
$idemp = isset($_POST['idemp']) ? $_POST['idemp']:NULL;
$idresp = isset($_POST['idresp']) ? $_POST['idresp']:NULL;
$fec_crea = isset($_POST['fec_crea']) ? $_POST['fec_crea']:NULL;
$fec_actu = isset($_POST['fec_actu']) ? $_POST['fec_actu']:NULL;
$act = isset($_POST['act']) ? $_POST['act']:NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$mubi->setIdubi($idubi);
if($ope == "save"){
    $mubi->setNomubi($nomubi);
    $mubi->setCodubi($codubi);
    $mubi->setDirubi($dirubi);
    $mubi->setDepubi($depubi);
    $mubi->setCiuubi($ciuubi);
    $mubi->setIdemp($idemp);
    $mubi->setIdresp($idresp);
    $mubi->setFec_crea($fec_crea);
    $mubi->setFec_actu($fec_actu);
    $mubi->setAct($act);
    if(!$idubi) $mubi->save(); else $mubi->edit();
}

if($ope =="eli" && $idubi) $mubi->del();
if($ope =="edi" && $idubi) $datOne = $mubi->getOne();

$datAll = $mubi->getAll();
?>