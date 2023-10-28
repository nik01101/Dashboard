<?php


class SqlServer {
    private $usuarioBD,$nombreBD;
    private $conn = null;

    public function __construct() {
        require("../../config.php");
        global $nombreBD,$ipBD,$usuarioBD,$passBD;
        $this->nombreBD = $config['dbNombre'];
        $this->ipBD = $ipBD;
        $this->usuarioBD = $config['dbUser'];
        $this->passBD = $passBD;
        
        
    }
    public function conBDPDO()
    {  
        
        try {
            $this->conn = new PDO("sqlsrv:Server=".$this->usuarioBD.";Database=".$this->nombreBD);
            
            return true;
        } catch (PDOException $e) {
            echo "Error connecting to the database: " . $e->getMessage() . "\n";
            return false;
        }
    }

    public function getDatosDona(){
        $this->conBDPDO();
        
        $query = sprintf("SELECT TOP 5 prod_descl, unid_codi, fami_codi FROM producto");
 
        $result = $this->conn->query($query);

        $data = array();
        foreach ($result as $row) {
        	$data[] = $row;
        }
 
        $result->closeCursor();
        print json_encode($data);
    }

    public function getDatosBarras(){
        $this->conBDPDO();
        
        $query = sprintf("SELECT periodo, sum_valor FROM consolidado_periodo");
 
        $result = $this->conn->query($query);

        $data = array();
        foreach ($result as $row) {
        	$data[] = $row;
        }
 
        $result->closeCursor();
        print json_encode($data);
    }

    public function getDatosDetalleVentaMarca1($marca){
        $this->conBDPDO();
        if($marca == null){
        $query = sprintf("SELECT periodo, fecha_em from consolidado_diario_ven");
        $result = $this->conn->query($query);
        $data = array();
        $data = array_merge($data, $result->fetchAll(PDO::FETCH_ASSOC));
        
        print json_encode($data);
        }else{
        $query = sprintf("SELECT periodo, fecha_em from consolidado_diario_ven");
        $result = $this->conn->query($query);
        $data = array();
        $data = array_merge($data, $result->fetchAll(PDO::FETCH_ASSOC));
        
        print json_encode($data);
        }
    }

    public function getDatosDetalleVentaMarca($marca) {
        $this->conBDPDO();
        $query = "SELECT periodo, fecha_em FROM consolidado_diario_ven";
    
        if ($marca != null) {
            $query .= " WHERE marc_codi = :marca"; // Assuming 'marca' is the column name
        }
    
        $stmt = $this->conn->prepare($query);
    
        if ($marca != null) {
            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
        }
    
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
    public function getMarcas(){
        $this->conBDPDO();
    
            $query = sprintf("SELECT marc_codi,marc_descl from marca");
            $result = $this->conn->query($query);
            $data = array();
            $data = array_merge($data, $result->fetchAll(PDO::FETCH_ASSOC));
            
            print json_encode($data);
    }
}


?>