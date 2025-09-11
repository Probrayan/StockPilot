<?php

class MAud{
    private $idaud;
    private $idusu;
    private $tabla;
    private $accion;
    private $idreg;
    private $datos_ant;
    private $datos_nue;
    private $fecha;
    private $ip;

    function getIdaud(){
        return $this->idaud;
    }
    function getIdusu(){
        return $this->idusu;
    }
    function getTabla(){
        return $this->tabla;
    }
    function getAccion(){
        return $this->accion;
    }
    function getIdreg(){
        return $this->idreg;
    }
    function getDatos_ant(){
        return $this->datos_ant;
    }
    function getDatos_nue(){
        return $this->datos_nue;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getIp(){
        return $this->ip;
    }
    function setIdaud($idaud){
        $this->idaud = $idaud;
    }
    function setIdusu($idusu){
        $this->idusu = $idusu;
    }
    function setTabla($tabla){
        $this->tabla = $tabla;
    }
    function setAccion($accion){
        $this->accion = $accion;
    }
    function setIdreg($idreg){
        $this->idreg = $idreg;
    }
    function setDatos_ant($datos_ant){
        $this->datos_ant = $datos_ant;
    }
    function setDatos_nue($datos_nue){
        $this->datos_nue = $datos_nue;
    }
    function setFecha($fecha){
        $this->fecha = $fecha;
    }
    function setIp($ip){
        $this->ip = $ip;
    }

    public function getAll(){
        try{
            $sql = "SELECT idaud, idusu, tabla, accion, idreg, datos_ant, datos_nue, fecha, ip FROM auditoria";
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
            $sql = "SELECT idaud, idusu, tabla, accion, idreg, datos_ant, datos_nue, fecha, ip FROM auditoria WHERE idaud=:idaud";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idaud = $this->getIdaud();
            $result->bindParam(':idaud', $idaud);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function save(){
        try{
            $sql = "INSERT INTO auditoria(idusu, tabla, accion, idreg, datos_ant, datos_nue, fecha, ip) VALUES (:idusu, :tabla, :accion, :idreg, :datos_ant, :datos_nue, :fecha, :ip) ";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idusu = $this->getIdusu();
            $result->bindParam(':idusu', $idusu);
            $tabla = $this->getTabla();
            $result->bindParam(':tabla', $tabla);
            $accion = $this->getAccion();
            $result->bindParam(':accion', $accion);
            $idreg = $this->getIdreg();
            $result->bindParam(':idreg', $idreg);
            $datos_ant = $this->getDatos_ant();
            $result->bindParam(':datos_ant', $datos_ant);
            $datos_nue = $this->getDatos_nue();
            $result->bindParam(':datos_nue', $datos_nue);
            $fecha = $this->getFecha();
            $result->bindParam(':fecha', $fecha);
            $ip = $this->getIp();
            $result->bindParam(':ip', $ip);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function edit(){
        try{
            $sql = "UPDATE auditoria SET idusu=:idusu, tabla=:tabla, accion=:accion, idreg=:idreg, datos_ant=:datos_ant, datos_nue=:datos_nue, fecha=:fecha, ip=:ip WHERE idaud=:idaud";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idaud = $this->getIdaud();
            $result->bindParam(':idaud', $idaud);
            $idusu = $this->getIdusu();
            $result->bindParam(':idusu', $idusu);
            $tabla = $this->getTabla();
            $result->bindParam(':tabla', $tabla);
            $accion = $this->getAccion();
            $result->bindParam(':accion', $accion);
            $idreg = $this->getIdreg();
            $result->bindParam(':idreg', $idreg);
            $datos_ant = $this->getDatos_ant();
            $result->bindParam(':datos_ant', $datos_ant);
            $datos_nue = $this->getDatos_nue();
            $result->bindParam(':datos_nue', $datos_nue);
            $fecha = $this->getFecha();
            $result->bindParam(':fecha', $fecha);
            $ip = $this->getIp();
            $result->bindParam(':ip', $ip);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function del(){
        try{
            $sql = "DELETE FROM auditoria WHERE idaud=:idaud";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idaud = $this->getIdaud();
            $result->bindParam(':idaud', $idaud);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }
}
?>