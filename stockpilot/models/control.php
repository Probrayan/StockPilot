<?php
require_once('conexion.php');

$usu = isset($_POST['usu']) ? $_POST['usu'] : NULL;
$pas = isset($_POST['pas']) ? $_POST['pas'] : NULL;

if ($usu && $pas) {
    validar($usu, $pas);
} else {
    echo '<script>window.location="../index.php";</script>';
}

function validar($usu, $pas) {
    $res = verdat($usu, $pas);
    $res = isset($res) ? $res : NULL;

    if ($res) {
        session_start();
        $_SESSION['idusu']  = $res[0]['idusu'];
        $_SESSION['nomusu'] = $res[0]['nomusu'];
        $_SESSION['apeusu'] = $res[0]['apeusu'];
        $_SESSION['idper']  = $res[0]['idper'];
        $_SESSION['nomper'] = $res[0]['nomper'];
        $_SESSION['emausu'] = $res[0]['emausu'];

        // bandera de sesión activa
        $_SESSION['aut'] = "askjhd654-+"; 

        // todos redirigen al home
        echo '<script>window.location="../home.php";</script>';
    } else {
        echo '<script>window.location="../index.php?err=ok";</script>';
    }
}

function verdat($usu, $con) {
    // generar hash SHA1/MD5 + sal
    $pas = sha1(md5($con . "/Pq5@-+")) . "kjahw9";

    $sql = "SELECT u.idusu, u.ndousu, u.nomusu, u.apeusu, u.emausu, 
                   u.idper, p.nomper
            FROM usuario AS u
            INNER JOIN perfil AS p ON u.idper = p.idper
            WHERE u.act = 1 AND u.ndousu = :ndousu 
              AND u.pasusu = :pasusu";
    
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(':ndousu', $usu);
    $result->bindParam(':pasusu', $pas);
    $result->execute();
    return $result->fetchAll(PDO::FETCH_ASSOC);
}
?>
