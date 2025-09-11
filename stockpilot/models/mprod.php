<?php
require_once __DIR__ . '/conexion.php';

class MProd {
    private $idemp;

    function setIdemp($idemp){ 
        $this->idemp = $idemp; 
    }
    
    function getIdemp(){ 
        return $this->idemp; 
    }

    // Obtener todos los productos activos
    public function getAll() {
        try {
            $sql = "SELECT idprod, nomprod, precio, stock 
                    FROM producto 
                    WHERE activo = 1";
            
            // Si necesitas filtrar por empresa, descomenta la siguiente línea
            // $sql .= " AND idemp = :idemp";
            
            $sql .= " ORDER BY nomprod ASC";
            
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            
            // Si necesitas filtrar por empresa, descomenta la siguiente línea
            // $stmt->bindParam(":idemp", $this->idemp, PDO::PARAM_INT);
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en MProd::getAll: " . $e->getMessage());
            return [];
        }
    }

    // Obtener un producto específico
    public function getOne($idprod) {
        try {
            $sql = "SELECT idprod, nomprod, precio, stock 
                    FROM producto 
                    WHERE idprod = :idprod AND activo = 1";
            
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":idprod", $idprod, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en MProd::getOne: " . $e->getMessage());
            return false;
        }
    }

    // Buscar productos por nombre
    public function search($termino) {
        try {
            $sql = "SELECT idprod, nomprod, precio, stock 
                    FROM producto 
                    WHERE nomprod LIKE :termino AND activo = 1
                    ORDER BY nomprod ASC";
            
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            $termino = "%$termino%";
            $stmt->bindParam(":termino", $termino, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en MProd::search: " . $e->getMessage());
            return [];
        }
    }

    // Verificar stock disponible
    public function verificarStock($idprod, $cantidad) {
        try {
            $producto = $this->getOne($idprod);
            if ($producto && isset($producto['stock'])) {
                return $producto['stock'] >= $cantidad;
            }
            return false;
        } catch (Exception $e) {
            error_log("Error en MProd::verificarStock: " . $e->getMessage());
            return false;
        }
    }
}
?>