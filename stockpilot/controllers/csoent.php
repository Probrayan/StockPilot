<?php
require_once __DIR__ . '/../models/msoent.php';
require_once __DIR__ . '/../models/mprod.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$msoent = new Msoent();
$msoent->setIdemp($_SESSION['idemp']); // empresa activa

$idsol = isset($_GET['idsol']) ? $_GET['idsol'] : null;
$ope   = isset($_POST['ope']) ? $_POST['ope'] : null;

// Guardar
if ($ope == "save") {
    $data = [
        ":idsol"   => $_POST['idsol'],
        ":idprod"  => $_POST['idprod'],
        ":cantdet" => $_POST['cantdet'],
        ":vundet"  => $_POST['vundet'],
        ":totdet"  => ($_POST['cantdet'] * $_POST['vundet']),
        ":idemp"   => $_SESSION['idemp']
    ];
    
    if ($msoent->save($data)) {
        $_SESSION['mensaje'] = "Producto agregado exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al agregar el producto";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    
    // Redireccionar para evitar resubmisión del formulario
    header("Location: dashboard.php?pg=2060&idsol=" . $idsol);
    exit();
}

// Eliminar detalle
if (isset($_GET['delete']) && $_GET['delete']) {
    $iddet = $_GET['delete'];
    if ($msoent->delete($iddet)) {
        $_SESSION['mensaje'] = "Producto eliminado exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el producto";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    
    header("Location: dashboard.php?pg=2060&idsol=" . $idsol);
    exit();
}

// Traer productos para el select
$mprod = new MProd();
$productos = $mprod->getAll();

// Debug - eliminar después
error_log("Total productos encontrados: " . count($productos));
if (empty($productos)) {
    error_log("No se encontraron productos");
} else {
    error_log("Primer producto: " . print_r($productos[0], true));
}

// Traer detalles de la solicitud actual
$detalles = [];
if ($idsol) {
    $detalles = $msoent->getAll($idsol);
}
?>