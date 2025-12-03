<?php

class MInv{
    private $idinv;
    private $idprod;
    private $idubi;
    private $cant;
    private $fec_crea;
    private $fec_actu;

    function getIdinv(){
        return $this->idinv;
    }
    function getIdprod(){
        return $this->idprod;
    }
    function getIdubi(){
        return $this->idubi;
    }
    function getCant(){
        return $this->cant;
    }
    function getFec_crea(){
        return $this->fec_crea;
    }
    function getFec_actu(){
        return $this->fec_actu;
    }
    function setIdinv($idinv){
        $this->idinv = $idinv;
    }
    function setIdprod($idprod){
        $this->idprod = $idprod;
    }
    function setIdubi($idubi){
        $this->idubi = $idubi;
    }
    function setCant($cant){
        $this->cant = $cant;
    }
    function setFec_crea($fec_crea){
        $this->fec_crea = $fec_crea;
    }
    function setFec_actu($fec_actu){
        $this->fec_actu = $fec_actu;
    }

    public function getAll(){
    try{
        $sql = "SELECT i.idinv, i.idprod, p.nomprod,  i.idubi, u.nomubi,  c.idcat, c.nomcat,  i.cant, i.fec_crea, i.fec_actu FROM inventario i INNER JOIN producto p ON i.idprod = p.idprod INNER JOIN categoria c ON p.idcat = c.idcat INNER JOIN ubicacion u ON i.idubi = u.idubi";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }catch(Exception $e){
        echo "Error: ".$e->getMessage()."<br><br>";
    }
}

    public function getOne(){
        try{
            $sql = "SELECT idinv, idprod, idubi, cant, fec_crea, fec_actu FROM inventario WHERE idinv=:idinv";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idinv = $this->getIdinv();
            $result->bindParam(':idinv', $idinv);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function save(){
        try{
            $sql = "INSERT INTO inventario(idprod, idubi, cant, fec_crea, fec_actu) VALUES (:idprod, :idubi, :cant, :fec_crea, :fec_actu) ";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprod = $this->getIdprod();
            $result->bindParam(':idprod', $idprod);
            $idubi = $this->getIdubi();
            $result->bindParam(':idubi', $idubi);
            $cant = $this->getCant();
            $result->bindParam(':cant', $cant);
            $fec_crea = $this->getFec_crea();
            $result->bindParam(':fec_crea', $fec_crea);
            $fec_actu = $this->getFec_actu();
            $result->bindParam(':fec_actu', $fec_actu);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function upd(){
        try{
            $sql = "UPDATE inventario SET idprod=:idprod, idubi=:idubi, cant=:cant, fec_crea=:fec_crea, fec_actu=:fec_actu WHERE idinv=:idinv";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idinv = $this->getIdinv();
            $result->bindParam(':idinv', $idinv);
            $idprod = $this->getIdprod();
            $result->bindParam(':idprod', $idprod);
            $idubi = $this->getIdubi();
            $result->bindParam(':idubi', $idubi);
            $cant = $this->getCant();
            $result->bindParam(':cant', $cant);
            $fec_crea = $this->getFec_crea();
            $result->bindParam(':fec_crea', $fec_crea);
            $fec_actu = $this->getFec_actu();
            $result->bindParam(':fec_actu', $fec_actu);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function del(){
        try{
            $sql = "DELETE FROM inventario WHERE idinv=:idinv";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idinv = $this->getIdinv();
            $result->bindParam(':idinv', $idinv);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }


     public function gettablas(){
        try{
            $sql = "SELECT i.idinv,p.idprod FROM inventario i INNER JOIN productos p ON i.idprod = p.idprod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

}
?>
