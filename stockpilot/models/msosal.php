<?php
require_once __DIR__ . '/conexion.php';

class Msosal {
    private $idemp;

    function setIdemp($idemp){ 
        $this->idemp = $idemp; 
    }
    
    function getIdemp(){ 
        return $this->idemp; 
    }

    // Obtener todos los detalles de salida
    public function getAll($idsol) {
        try {
            // Usamos LEFT JOIN y COALESCE
            $sql = "SELECT d.iddet, d.idsol, d.idprod, COALESCE(p.nomprod, 'Producto no encontrado') as nomprod, 
                           d.cantdet, d.vundet, (d.cantdet * d.vundet) as totdet
                    FROM detsalida d
                    LEFT JOIN producto p ON d.idprod = p.idprod
                    WHERE d.idsol = :idsol AND d.idemp = :idemp
                    ORDER BY d.iddet DESC";
            
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":idsol", $idsol, PDO::PARAM_INT);
            $stmt->bindParam(":idemp", $this->idemp, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Msosal::getAll() - " . $e->getMessage());
            return [];
        }
    }

    // Guardar detalle
    public function save($data) {
        try {
            $sql = "INSERT INTO detsalida (idsol, idprod, cantdet, vundet, idemp, fec_crea)
                    VALUES (:idsol, :idprod, :cantdet, :vundet, :idemp, NOW())";
            
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            
            if(isset($data[':totdet'])) unset($data[':totdet']);
            
            $result = $stmt->execute($data);
            
            if (!$result) {
                throw new Exception("Error al guardar el detalle");
            }
            
            return true;
        } catch (PDOException $e) {
            error_log("Error en Msosal::save() - " . $e->getMessage());
            return false;
        }
    }

    // Eliminar detalle
    public function delete($iddet) {
        try {
            $sql = "DELETE FROM detsalida WHERE iddet = :iddet AND idemp = :idemp";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":iddet", $iddet, PDO::PARAM_INT);
            $stmt->bindParam(":idemp", $this->idemp, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Msosal::delete() - " . $e->getMessage());
            return false;
        }
    }

    // Obtener total de la solicitud
    public function getTotal($idsol) {
        try {
            $sql = "SELECT SUM(cantdet * vundet) as total FROM detsalida 
                    WHERE idsol = :idsol AND idemp = :idemp";
            
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":idsol", $idsol, PDO::PARAM_INT);
            $stmt->bindParam(":idemp", $this->idemp, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            error_log("Error en Msosal::getTotal() - " . $e->getMessage());
            return 0;
        }
    }
    
    // Verificar stock disponible
    public function verificarStockDisponible($idprod, $cantidadSolicitada) {
        try {
            $sql = "SELECT COALESCE(SUM(CASE WHEN tipmov = 1 THEN cantmov ELSE -cantmov END), 0) as stock
                    FROM movim 
                    WHERE idprod = :idprod AND idemp = :idemp";
            
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":idprod", $idprod, PDO::PARAM_INT);
            $stmt->bindParam(":idemp", $this->idemp, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stockActual = $result['stock'] ?? 0;
            
            return $stockActual >= $cantidadSolicitada;
            
        } catch (PDOException $e) {
            error_log("Error en Msosal::verificarStockDisponible() - " . $e->getMessage());
            return false;
        }
    }

    // Aprobar solicitud y crear movimientos en Kardex
    public function aprobarSolicitud($idsol, $idkar, $idubi, $idusu) {
        try {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $conexion->beginTransaction();
            
            $detalles = $this->getAll($idsol);
            
            if (empty($detalles)) {
                throw new Exception("No hay detalles para aprobar");
            }
            
            foreach ($detalles as $detalle) {
                if (!$this->verificarStockDisponible($detalle['idprod'], $detalle['cantdet'])) {
                    throw new Exception("Stock insuficiente para el producto: " . $detalle['nomprod']);
                }
                
                $sqlMov = "INSERT INTO movim (idkar, idprod, idubi, idusu, idemp, tipmov, cantmov, valmov, fecmov, fec_crea)
                          VALUES (:idkar, :idprod, :idubi, :idusu, :idemp, 2, :cantmov, :valmov, NOW(), NOW())";
                
                $stmtMov = $conexion->prepare($sqlMov);
                $stmtMov->execute([
                    ':idkar' => $idkar,
                    ':idprod' => $detalle['idprod'],
                    ':idubi' => $idubi,
                    ':idusu' => $idusu,
                    ':idemp' => $this->idemp,
                    ':cantmov' => $detalle['cantdet'],
                    ':valmov' => $detalle['vundet']
                ]);
            }
            
            $conexion->commit();
            return true;
            
        } catch (Exception $e) {
            if (isset($conexion)) {
                $conexion->rollBack();
            }
            error_log("Error en Msosal::aprobarSolicitud() - " . $e->getMessage());
            return false;
        }
    }
}
?>