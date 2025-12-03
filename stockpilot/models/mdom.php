<?php

class MDom{
    private $iddom;
    private $nomdom;
    private $desdom;
    private $fec_crea;
    private $fec_actu;
    private $act;

    function getIddom(){
        return $this->iddom;
    }
    function getNomdom(){
        return $this->nomdom;
    }
    function getDesdom(){
        return $this->desdom;
    }
    function getFec_crea(){
        return $this->fec_crea;
    }
    function getFec_actu(){
        return $this->fec_actu;
    }
    function getAct(){
        return $this->act;
    }
    function setIddom($iddom){
        $this->iddom = $iddom;
    }
    function setNomdom($nomdom){
        $this->nomdom = $nomdom;
    }
    function setDesdom($desdom){
        $this->desdom = $desdom;
    }
    function setFec_crea($fec_crea){
        $this->fec_crea = $fec_crea;
    }
    function setFec_actu($fec_actu){
        $this->fec_actu = $fec_actu;
    }
    function setAct($act){
        $this->act = $act;
    }

    public function getAll(){
        try{
            $sql = "SELECT iddom, nomdom, desdom, fec_crea, fec_actu, act FROM dominio";
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

    public function getOne(){
        try{
            $sql = "SELECT iddom, nomdom, desdom, fec_crea, fec_actu, act FROM dominio WHERE iddom=:iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $iddom = $this->getIddom();
            $result->bindParam(':iddom', $iddom);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function save(){
        try{
            $sql = "INSERT INTO dominio(nomdom, desdom, fec_crea, fec_actu, act) VALUES (:nomdom, :desdom, :fec_crea, :fec_actu, :act) ";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomdom = $this->getNomdom();
            $result->bindParam(':nomdom', $nomdom);
            $desdom = $this->getDesdom();
            $result->bindParam(':desdom', $desdom);
            $fec_crea = $this->getFec_crea();
            $result->bindParam(':fec_crea', $fec_crea);
            $fec_actu = $this->getFec_actu();
            $result->bindParam(':fec_actu', $fec_actu);
            $act = $this->getAct();
            $result->bindParam(':act', $act);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function edit(){
        try{
            $sql = "UPDATE dominio SET nomdom=:nomdom, desdom=:desdom, fec_crea=:fec_crea, fec_actu=:fec_actu, act=:act WHERE iddom=:iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $iddom = $this->getIddom();
            $result->bindParam(':iddom', $iddom);
            $nomdom = $this->getNomdom();
            $result->bindParam(':nomdom', $nomdom);
            $desdom = $this->getDesdom();
            $result->bindParam(':desdom', $desdom);
            $fec_crea = $this->getFec_crea();
            $result->bindParam(':fec_crea', $fec_crea);
            $fec_actu = $this->getFec_actu();
            $result->bindParam(':fec_actu', $fec_actu);
            $act = $this->getAct();
            $result->bindParam(':act', $act);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function del(){
        try{
            $sql = "DELETE FROM dominio WHERE iddom=:iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $iddom = $this->getIddom();
            $result->bindParam(':iddom', $iddom);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }
}
?>
