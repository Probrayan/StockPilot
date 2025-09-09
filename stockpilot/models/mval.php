<?php

class MVal{
    private $idval;
    private $nomval;
    private $iddom;
    private $codval;
    private $desval;
    private $fec_crea;
    private $fec_actu;
    private $act;

    function getIdval(){
        return $this->idval;
    }
    function getNomval(){
        return $this->nomval;
    }
    function getIddom(){
        return $this->iddom;
    }
    function getCodval(){
        return $this->codval;
    }
    function getDesval(){
        return $this->desval;
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
    function setIdval($idval){
        $this->idval = $idval;
    }
    function setNomval($nomval){
        $this->nomval = $nomval;
    }
    function setIddom($iddom){
        $this->iddom = $iddom;
    }
    function setCodval($codval){
        $this->codval = $codval;
    }
    function setDesval($desval){
        $this->desval = $desval;
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
            $sql = "SELECT idval, nomval, iddom, codval, desval, fec_crea, fec_actu, act FROM valor";
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
            $sql = "SELECT idval, nomval, iddom, codval, desval, fec_crea, fec_actu, act FROM valor WHERE idval=:idval";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idval = $this->getIdval();
            $result->bindParam(':idval', $idval);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function save(){
        try{
            $sql = "INSERT INTO valor(nomval, iddom, codval, desval, fec_crea, fec_actu, act) VALUES (:nomval, :iddom, :codval, :desval, :fec_crea, :fec_actu, :act) ";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomval = $this->getNomval();
            $result->bindParam(':nomval', $nomval);
            $iddom = $this->getIddom();
            $result->bindParam(':iddom', $iddom);
            $codval = $this->getCodval();
            $result->bindParam(':codval', $codval);
            $desval = $this->getDesval();
            $result->bindParam(':desval', $desval);
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
            $sql = "UPDATE valor SET nomval=:nomval, iddom=:iddom, codval=:codval, desval=:desval, fec_crea=:fec_crea, fec_actu=:fec_actu, act=:act WHERE idval=:idval";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idval = $this->getIdval();
            $result->bindParam(':idval', $idval);
            $nomval = $this->getNomval();
            $result->bindParam(':nomval', $nomval);
            $iddom = $this->getIddom();
            $result->bindParam(':iddom', $iddom);
            $codval = $this->getCodval();
            $result->bindParam(':codval', $codval);
            $desval = $this->getDesval();
            $result->bindParam(':desval', $desval);
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
            $sql = "DELETE FROM valor WHERE idval=:idval";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idval = $this->getIdval();
            $result->bindParam(':idval', $idval);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }
}
?>