<?php 
class Mmov {
    // Atributos
    private $idmov;
    private $idemp;
    private $idkar;
    private $idprod;
    private $idubi;
    private $fecmov;
    private $tipmov;
    private $cantmov;
    private $valmov;
    private $costprom;
    private $docref;
    private $obs;
    private $idusu;
    private $fec_crea;
    private $fec_actu;

    // Getters
    function getIdmov()    { return $this->idmov; }
    function getIdemp()    { return $this->idemp; }
    function getIdkar()    { return $this->idkar; }
    function getIdprod()   { return $this->idprod; }
    function getIdubi()    { return $this->idubi; }
    function getFecmov()   { return $this->fecmov; }
    function getTipmov()   { return $this->tipmov; }
    function getCantmov()  { return $this->cantmov; }
    function getValmov()   { return $this->valmov; }
    function getCostprom() { return $this->costprom; }
    function getDocref()   { return $this->docref; }
    function getObs()      { return $this->obs; }
    function getIdusu()    { return $this->idusu; }
    function getFec_crea() { return $this->fec_crea; }
    function getFec_actu() { return $this->fec_actu; }

    // Setters
    function setIdmov($idmov)        { $this->idmov = $idmov; }
    function setIdemp($idemp)        { $this->idemp = $idemp; }
    function setIdkar($idkar)        { $this->idkar = $idkar; }
    function setIdprod($idprod)      { $this->idprod = $idprod; }
    function setIdubi($idubi)        { $this->idubi = $idubi; }
    function setFecmov($fecmov)      { $this->fecmov = $fecmov; }
    function setTipmov($tipmov)      { $this->tipmov = $tipmov; }
    function setCantmov($cantmov)    { $this->cantmov = $cantmov; }
    function setValmov($valmov)      { $this->valmov = $valmov; }
    function setCostprom($costprom)  { $this->costprom = $costprom; }
    function setDocref($docref)      { $this->docref = $docref; }
    function setObs($obs)            { $this->obs = $obs; }
    function setIdusu($idusu)        { $this->idusu = $idusu; }
    function setFec_crea($fec_crea)  { $this->fec_crea = $fec_crea; }
    function setFec_actu($fec_actu)  { $this->fec_actu = $fec_actu; }

    // CRUD
    public function getAll(){
        try {
            $sql = "SELECT idmov, idemp, idkar, idprod, idubi, fecmov, tipmov, 
                           cantmov, valmov, costprom, docref, obs, idusu, fec_crea, fec_actu 
                    FROM movim";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e){
            echo "Error en getAll: ".$e->getMessage()."<br><br>";
            return [];
        }
    }

    public function getOne(){
        try {
            $sql = "SELECT idmov, idemp, idkar, idprod, idubi, fecmov, tipmov, 
                           cantmov, valmov, costprom, docref, obs, idusu, fec_crea, fec_actu 
                    FROM movim 
                    WHERE idmov=:idmov";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idmov = $this->getIdmov();
            $result->bindParam(':idmov', $idmov);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch(Exception $e){
            echo "Error en getOne: ".$e->getMessage()."<br><br>";
            return null;
        }
    }

    public function save(){
        try {
            $sql = "INSERT INTO movim(idemp, idkar, idprod, idubi, fecmov, tipmov, 
                                      cantmov, valmov, costprom, docref, obs, idusu, fec_crea, fec_actu) 
                    VALUES(:idemp, :idkar, :idprod, :idubi, :fecmov, :tipmov, 
                           :cantmov, :valmov, :costprom, :docref, :obs, :idusu, NOW(), NOW())";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);

            $res->bindParam(":idemp", $this->idemp);
            $res->bindParam(":idkar", $this->idkar);
            $res->bindParam(":idprod", $this->idprod);
            $res->bindParam(":idubi", $this->idubi);
            $res->bindParam(":fecmov", $this->fecmov);
            $res->bindParam(":tipmov", $this->tipmov);
            $res->bindParam(":cantmov", $this->cantmov);
            $res->bindParam(":valmov", $this->valmov);
            $res->bindParam(":costprom", $this->costprom);
            $res->bindParam(":docref", $this->docref);
            $res->bindParam(":obs", $this->obs);
            $res->bindParam(":idusu", $this->idusu);
            
            return $res->execute();
        } catch(Exception $e){
            echo "Error en save: ".$e->getMessage()."<br><br>";
            return false;
        }
    }

    public function upd(){
        try {
            $sql = "UPDATE movim SET 
                        idemp=:idemp, idkar=:idkar, idprod=:idprod, idubi=:idubi, 
                        fecmov=:fecmov, tipmov=:tipmov, cantmov=:cantmov, valmov=:valmov, 
                        costprom=:costprom, docref=:docref, obs=:obs, idusu=:idusu, 
                        fec_actu=NOW() 
                    WHERE idmov=:idmov";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);

            $res->bindParam(":idmov", $this->idmov);
            $res->bindParam(":idemp", $this->idemp);
            $res->bindParam(":idkar", $this->idkar);
            $res->bindParam(":idprod", $this->idprod);
            $res->bindParam(":idubi", $this->idubi);
            $res->bindParam(":fecmov", $this->fecmov);
            $res->bindParam(":tipmov", $this->tipmov);
            $res->bindParam(":cantmov", $this->cantmov);
            $res->bindParam(":valmov", $this->valmov);
            $res->bindParam(":costprom", $this->costprom);
            $res->bindParam(":docref", $this->docref);
            $res->bindParam(":obs", $this->obs);
            $res->bindParam(":idusu", $this->idusu);

            return $res->execute();
        } catch(Exception $e){
            echo "Error en upd: ".$e->getMessage()."<br><br>";
            return false;
        }
    }

    public function del(){
        try {
            $sql = "DELETE FROM movim WHERE idmov=:idmov";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);
            $res->bindParam(":idmov", $this->idmov);
            return $res->execute();
        } catch(Exception $e){
            echo "Error en del: ".$e->getMessage()."<br><br>";
            return false;
        }
    }
}
?>
