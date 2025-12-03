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
    // Guardar o actualizar
    if ($iddom) {
        $mdom->edit();
        echo "<script>window.location.href = 'home.php?pg=$pg&msg=updated';</script>";
        exit;
    } else {
        $mdom->save();
        echo "<script>window.location.href = 'home.php?pg=$pg&msg=saved';</script>";
        exit;
    }
}

if ($ope == "eli" && $iddom) {
    $mdom->setIddom($iddom);
    $mdom->del();
    echo "<script>window.location.href = 'home.php?pg=$pg&msg=deleted';</script>";
    exit;
}

if($ope =="edi" && $iddom) $datOne = $mdom->getOne();

$datAll = $mdom->getAll();
?>
