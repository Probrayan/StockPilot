<?php

class Mmen {

    // obtiene el menú según el perfil del usuario
    public function menu($idper) {
        $sql = "SELECT g.idpag, g.nompag, g.ruta, g.icono
                FROM pagina AS g
                INNER JOIN pxp AS f ON g.idpag = f.idpag
                WHERE g.act = 1 AND f.idper = :idper AND f.ver = 1
                ORDER BY g.orden ASC";
        
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $res = $conexion->prepare($sql);
        $res->bindParam(':idper', $idper);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    // valida si un perfil tiene acceso a una página
    public function valpg($idper, $idpag) {
        $sql = "SELECT g.idpag, g.nompag, g.ruta, g.icono, f.ver, f.crear, f.editar, f.eliminar
                FROM pagina AS g
                INNER JOIN pxp AS f ON g.idpag = f.idpag
                WHERE f.idper = :idper AND g.idpag = :idpag AND g.act = 1";
        
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $res = $conexion->prepare($sql);
        $res->bindParam(':idper', $idper);
        $res->bindParam(':idpag', $idpag);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
