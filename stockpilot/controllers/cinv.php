<?php
require_once('models/minv.php');

$minv = new MInv();

$idinv = isset($_REQUEST['idinv']) ? $_REQUEST['idinv']:NULL;
$idprod = isset($_POST['idprod']) ? $_POST['idprod']:NULL;
$idubi = isset($_POST['idubi']) ? $_POST['idubi']:NULL;
$cant = isset($_POST['cant']) ? $_POST['cant']:NULL;
$fec_crea = isset($_POST['fec_crea']) ? $_POST['fec_crea']:NULL;
$fec_actu = isset($_POST['fec_actu']) ? $_POST['fec_actu']:NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$minv->setIdinv($idinv);
if($ope == "save"){
    $minv->setIdprod($idprod);
    $minv->setIdubi($idubi);
    $minv->setCant($cant);
    $minv->setFec_crea($fec_crea);
    $minv->setFec_actu($fec_actu);
    if(!$idinv) $minv->save(); else $minv->edit();
}

if($ope =="eli" && $idinv) $minv->del();
if($ope =="edi" && $idinv) $datOne = $minv->getOne();

$datAll = $minv->getAll();
?>