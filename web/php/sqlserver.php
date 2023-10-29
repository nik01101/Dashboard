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


    public function getDatosDetalleVentaMarca($marca) {
        $this->conBDPDO();
        $query = "SELECT c.pers_vend, cast(p.pers_rsoc as nvarchar(max)) as vendedor, sum(c.sum_valor) as valor, sum(c.sum_costo) as costo, sum(c.margen_soles) as margen
        FROM consolidado_diario_ven c INNER JOIN persona p ON p.pers_codi=c.pers_vend";
    
        if ($marca != null) {
            $query .= " WHERE c.periodo='202309' and marc_codi= :marca"; // Assuming 'marca' is the column name
        }
        $query .= " GROUP BY c.pers_vend, cast(p.pers_rsoc as nvarchar(max)) ORDER BY c.pers_vend";

        $stmt = $this->conn->prepare($query);
    
        if ($marca != null) {
            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
        }
    
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data);
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