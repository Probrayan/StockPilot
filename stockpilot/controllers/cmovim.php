<?php 
include("models/mmovim.php");

$mmov = new Mmov();

$idmov    = isset($_REQUEST['idmov']) ? $_REQUEST['idmov'] : NULL;
$idemp    = isset($_POST['idemp']) ? $_POST['idemp'] : NULL;
$idkar    = isset($_POST['idkar']) ? $_POST['idkar'] : NULL;
$idprod   = isset($_POST['idprod']) ? $_POST['idprod'] : NULL;
$idubi    = isset($_POST['idubi']) ? $_POST['idubi'] : NULL;
$fecmov   = isset($_POST['fecmov']) ? $_POST['fecmov'] : NULL;
$tipmov   = isset($_POST['tipmov']) ? $_POST['tipmov'] : NULL;
$cantmov  = isset($_POST['cantmov']) ? $_POST['cantmov'] : NULL;
$valmov   = isset($_POST['valmov']) ? $_POST['valmov'] : NULL;
$costprom = isset($_POST['costprom']) ? $_POST['costprom'] : NULL;
$docref   = isset($_POST['docref']) ? $_POST['docref'] : NULL;
$obs      = isset($_POST['obs']) ? $_POST['obs'] : NULL;
$idusu    = isset($_POST['idusu']) ? $_POST['idusu'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$dtOne = NULL;

$mmov->setIdmov($idmov);

if($ope=="SaVe" && $idmov){
    $mmov->setIdemp($idemp);
    $mmov->setIdkar($idkar);
    $mmov->setIdprod($idprod);
    $mmov->setIdubi($idubi);
    $mmov->setFecmov($fecmov);
    $mmov->setTipmov($tipmov);
    $mmov->setCantmov($cantmov);
    $mmov->setValmov($valmov);
    $mmov->setCostprom($costprom);
    $mmov->setDocref($docref);
    $mmov->setObs($obs);
    $mmov->setIdusu($idusu);

    $dtE = $mmov->getOne();
    if($dtE) $mmov->upd();
    else $mmov->save();
}

if($ope=="eLi" && $idmov){
    $mmov->del();
}

if($ope=="eDi" && $idmov){
    $dtOne = $mmov->getOne();
    # var_dump($dtOne);
}

$dtAll = $mmov->getAll();
?>
