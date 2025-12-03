<?php
require_once('models/mprod.php');
require_once('models/mcat.php');

$mprod = new Mprod();
$mcat = new Mcat();

$idprod = isset($_REQUEST['idprod']) ? $_REQUEST['idprod'] : NULL;
$codprod = isset($_POST['codprod']) ? $_POST['codprod'] : NULL;
$nomprod = isset($_POST['nomprod']) ? $_POST['nomprod'] : NULL;
$desprod = isset($_POST['desprod']) ? $_POST['desprod'] : NULL;
$idcat = isset($_POST['idcat']) ? $_POST['idcat'] : NULL;
$unimed = isset($_POST['unimed']) ? $_POST['unimed'] : NULL;
$stkmin = isset($_POST['stkmin']) ? $_POST['stkmin'] : NULL;
$stkmax = isset($_POST['stkmax']) ? $_POST['stkmax'] : NULL;
$imgprod = isset($_FILES['imgprod']) ? $_FILES['imgprod'] : NULL;
$tipo_inventario = isset($_POST['tipo_inventario']) ? $_POST['tipo_inventario'] : NULL;
$act = isset($_POST['act']) ? $_POST['act'] : 1;
$costouni = isset($_POST['costouni']) ? $_POST['costouni'] : NULL;
$precioven = isset($_POST['precioven']) ? $_POST['precioven'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mprod->setIdprod($idprod);

if ($ope == "save") {
    $mprod->setCodprod($codprod);
    $mprod->setNomprod($nomprod);
    $mprod->setDesprod($desprod);
    $mprod->setIdcat($idcat);

    $idemp_a_usar = isset($_SESSION['idemp']) ? $_SESSION['idemp'] : 1;
    $mprod->setIdemp($idemp_a_usar);

    $mprod->setUnimed($unimed);
    $mprod->setStkmin($stkmin);
    $mprod->setStkmax($stkmax);

    $nombre_imagen = NULL;
    if ($imgprod && isset($imgprod['error']) && $imgprod['error'] === 0) {
        $upload_dir = 'uploads/productos/';
        $nombre_imagen = time() . '_' . basename($imgprod['name']);
        if (move_uploaded_file($imgprod['tmp_name'], $upload_dir . $nombre_imagen)) {
            $mprod->setImgprod($nombre_imagen);
        } else {
            $mprod->setImgprod(NULL);
        }
    } else {
        $mprod->setImgprod(NULL);
    }

    $mprod->setTipo_inventario($tipo_inventario);
    $mprod->setAct($act);
    $mprod->setCostouni($costouni);
    $mprod->setPrecioven($precioven);

    $fec_actu = date("Y-m-d H:i:s");

    // Guardar o actualizar
    if (!$idprod) {
        $mprod->setFec_crea($fec_actu);
        $mprod->setFec_actu($fec_actu);
        $mprod->save();
        echo "<script>window.location.href = 'home.php?pg=$pg&msg=saved';</script>";
        exit;
    } else {
        $mprod->setFec_actu($fec_actu);
        $mprod->edit();
        echo "<script>window.location.href = 'home.php?pg=$pg&msg=updated';</script>";
        exit;
    }
}

if ($ope == "eli" && $idprod) {
    $mprod->del();
    echo "<script>window.location.href = 'home.php?pg=$pg&msg=deleted';</script>";
    exit;
}

if ($ope == "edi" && $idprod) {
    $idemp_usuario = isset($_SESSION['idemp']) ? $_SESSION['idemp'] : null;
    $idper_usuario = isset($_SESSION['idper']) ? $_SESSION['idper'] : null;
    $datOne = $mprod->getOne($idemp_usuario, $idper_usuario);
}


// Obtener datos según perfil y empresa
$idemp_usuario = isset($_SESSION['idemp']) ? $_SESSION['idemp'] : null;
$idper_usuario = isset($_SESSION['idper']) ? $_SESSION['idper'] : null;

// Llamada a getAll() pasando idemp y idper
$datAll = $mprod->getAll($idemp_usuario, $idper_usuario);

// Categorías igual
$datCat = $mcat->getAll();

?>
