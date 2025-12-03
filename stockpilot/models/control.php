<?php
// ===============================================
// Archivo: controllers/CLogin.php (FINAL)
// Objetivo: Autenticación de usuario y creación de la sesión completa, 
//           incluyendo ID y Nombre de la Empresa.
// ===============================================

require_once('conexion.php');
require_once('../controllers/misfun.php'); // Asume que incluye generar_hash_contrasena()

$usu = isset($_POST['usu']) ? $_POST['usu'] : NULL; // Email o usuario
$pas = isset($_POST['pas']) ? $_POST['pas'] : NULL;

if ($usu && $pas) {
    validar($usu, $pas);
} else {
    echo '<script>window.location="../index.php";</script>';
}

function validar($usu, $pas) {
    // Llama a la función que trae los datos de usuario y empresa
    $res = verdat($usu, $pas);
    
    // Si la consulta devolvió resultados
    if ($res) {
        $usuario_data = $res[0];
        
        // Datos para auditoría
        $idemp = $usuario_data['idemp'] ?? 0;
        $idusu = $usuario_data['idusu'];
        $email = $usuario_data['emausu'];

        // 🎯 VALIDACIÓN DE ESTADO DE USUARIO
        if ($usuario_data['usu_act'] == 0) {
            registrar_login_auditoria($idemp, $idusu, $email, 0);
            echo '<script>window.location="../index.php?err=inactivo_usu";</script>';
            return;
        }

        // 🎯 VALIDACIÓN DE ESTADO DE EMPRESA
        if ($usuario_data['idper'] != 1 && $usuario_data['emp_act'] == 0) {
            registrar_login_auditoria($idemp, $idusu, $email, 0);
            echo '<script>window.location="../index.php?err=inactivo_emp";</script>';
            return;
        }

        session_start();
        
        // Crear variables de Sesión completas
        $_SESSION['idusu']      = $usuario_data['idusu'];
        $_SESSION['nomusu']     = $usuario_data['nomusu'];
        $_SESSION['apeusu']     = $usuario_data['apeusu'];
        $_SESSION['emausu']     = $usuario_data['emausu'];
        
        // Perfil
        $_SESSION['idper']      = $usuario_data['idper'];
        $_SESSION['nomper']     = $usuario_data['nomper'];
        
        // Empresa
        $_SESSION['idemp']      = $usuario_data['idemp'] ?? NULL; 
        $_SESSION['nomemp']     = $usuario_data['nomemp'] ?? NULL;
        
        // Bandera de autenticación
        $_SESSION['aut']        = "askjhd654-+"; 

        // ✅ Registrar login EXITOSO
        registrar_login_auditoria($idemp, $idusu, $email, 1);

        // Redirigir al home
        echo '<script>window.location="../home.php";</script>';
    } else {
        // ❌ Registrar login FALLIDO
        // Intentamos buscar el usuario por email para registrar el ID correcto si existe
        $datos_usu = obtener_datos_usuario($usu);
        $idusu_fail = $datos_usu ? $datos_usu['idusu'] : null;
        $idemp_fail = $datos_usu ? ($datos_usu['idemp'] ?? 0) : 0;
        
        registrar_login_auditoria($idemp_fail, $idusu_fail, $usu, 0);
        
        echo '<script>window.location="../index.php?err=ok";</script>';
    }
}

function verdat($usu, $con) {
    // Generar hash usando la función centralizada de misfun.php
    $pas = generar_hash_contrasena($con);

    // Consulta con LEFT JOIN para traer el ID y Nombre de la Empresa
    $sql = "SELECT u.idusu, u.nomusu, u.apeusu, u.emausu, u.pasusu, 
                   u.imgusu, u.idper, p.nomper, u.act AS usu_act,  -- 🔑 Agregado el estado del Usuario
                   e.idemp, e.nomemp, e.act AS emp_act             -- 🔑 Agregado el estado de la Empresa
             FROM usuario AS u
             INNER JOIN perfil AS p ON u.idper = p.idper
             LEFT JOIN usuario_empresa AS ue ON ue.idusu = u.idusu
             LEFT JOIN empresa AS e ON e.idemp = ue.idemp
             WHERE u.emausu = :emausu AND u.pasusu = :pasusu
             LIMIT 1";

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(':emausu', $usu);
    $result->bindParam(':pasusu', $pas);
    $result->execute();
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

// ===============================================
// NUEVAS FUNCIONES DE APOYO
// ===============================================

function registrar_login_auditoria($idemp, $idusu, $email, $exitoso) {
    require_once('maud.php');
    $maud = new MAud();
    
    $ip = $_SERVER['REMOTE_ADDR'];
    $navegador = $_SERVER['HTTP_USER_AGENT'];
    
    $maud->registrarLogin($idemp, $idusu, $email, $exitoso, $ip, $navegador);
}

function obtener_datos_usuario($email) {
    try {
        $sql = "SELECT u.idusu, ue.idemp 
                FROM usuario u 
                LEFT JOIN usuario_empresa ue ON u.idusu = ue.idusu 
                WHERE u.emausu = :email LIMIT 1";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return null;
    }
}
?>