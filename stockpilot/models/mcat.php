<?php

    class Mcat{
        private $idcat;
        private $nomcat;
        private $descat;
        private $idemp;
        private $fec_crea;
        private $fec_actu;
        private $act;
        
        function getIdcat(){
            return $this->idcat;
        }
        function getNomcat(){
            return $this->nomcat;
        }
        function getDescat(){
            return $this->descat;
        }
        function getIdemp(){
            return $this->idemp;
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


        function setIdcat($idcat){
            $this->idcat = $idcat;
        }
        function setNomcat($nomcat){
            $this->nomcat = $nomcat;
        }
        function setDescat($descat){
            $this->descat = $descat;
        }
        function setIdemp($idemp){
            $this->idemp = $idemp;
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
                $sql = "SELECT idcat, nomcat, descat, idemp, fec_crea, fec_actu, act FROM categoria";
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
                $sql = "SELECT idcat, nomcat, descat, idemp, fec_crea, fec_actu, act FROM categoria WHERE idcat=:idcat";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idcat = $this->getIdcat();
                $result->bindParam(':idcat', $idcat);
                $result->execute();
                $res = $result->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }catch(Exception $e){
                echo "Error".$e."<br><br>";
            }
        }


        public function save(){
            try{
                $sql = "INSERT INTO categoria (nomcat, descat,fec_crea, fec_actu, act) VALUES (:nomcat,:descat,:fec_crea, :fec_actu, :act)";
                $modelo = new Conexion();
                $conexion = $modelo ->get_conexion();
                $result = $conexion->prepare($sql);
                $nomcat = $this->getNomcat();
                $result->bindParam(':nomcat', $nomcat);
                $descat = $this->getDescat();
                $result->bindParam(':descat', $descat);
                $fec_crea = $this->getFec_actu();
                $result->bindParam(':fec_crea', $fec_crea);
                $fec_actu = $this->getFec_actu();
                $result->bindParam(':fec_actu', $fec_actu);
                $act = $this->getAct();
                $result->bindParam(':act', $act);
                $result->execute();
            }catch(Exception $e){
                echo "Error".$e."<br><br>";
            }
        }

        public function upd(){
            try{
                $sql = "UPDATE categoria SET nomcat=:nomcat, descat=:descat, fec_crea=:fec_crea, act=:act WHERE idcat=:idcat";
                $modelo = new Conexion();
                $conexion = $modelo ->get_conexion();
                $result = $conexion->prepare($sql);
                $idcat = $this->getIdcat();
                $result->bindParam(':idcat', $idcat);
                $nomcat = $this->getNomcat();
                $result->bindParam(':nomcat', $nomcat);
                $descat = $this->getDescat();
                $result->bindParam(':descat', $descat);
                $fec_actu = $this->getFec_crea();
                $result->bindParam(':fec_crea', $fec_crea);
                $act = $this->getAct();
                $result->bindParam(':act', $act);
                $result->execute();
            }catch(Exception $e){
                echo "Error".$e."<br><br>";
            }
        }

        public function del(){
            try{
                $sql = "DELETE FROM categoria WHERE idcat=:idcat";
                $modelo = new Conexion();
                $conexion = $modelo ->get_conexion();
                $result = $conexion->prepare($sql);
                $idcat = $this->getIdcat();
                $result->bindParam(':idcat', $idcat);
                $result->execute();
            }catch(Exception $e){
                echo "Error".$e."<br><br>";
            }
        }


    }
?>
