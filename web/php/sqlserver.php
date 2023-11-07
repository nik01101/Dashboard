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

    public function getDatosBarras($request,$parametro,$parametro2){
        $this->conBDPDO();
        switch ($request) {
            case 1:{
                $query = "SELECT top 8 m.marc_descc, c.sum_valor
                FROM consolidado_mes_marca c INNER JOIN marca m ON m.marc_codi=c.marc_codi";
    
                if ($parametro != null) {
                $query .= " WHERE c.periodo= :periodo"; 
                }
                $query .= " ORDER BY c.sum_valor DESC";

                $stmt = $this->conn->prepare($query);
    
                if ($parametro != null) {
                $stmt->bindParam(':periodo', $parametro, PDO::PARAM_STR);
                }
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                print json_encode($data);
            }break;
            case 2:{
                $query = sprintf("SELECT TOP 6 periodo, sum_valor
                FROM consolidado_periodo
                WHERE flag_cierre = 1 AND periodo<='202310'
                ORDER BY periodo DESC");
                $result = $this->conn->query($query);
                $data = array();
                foreach ($result as $row) {
        	    $data[] = $row;
                }
                $result->closeCursor();
                print json_encode($data);
            }break;
            case 3:{
                $query = sprintf("SELECT TOP 7 fecha_em, sum(sum_valor) as valor
                FROM consolidado_diario_ven
                WHERE periodo='202310'
                GROUP BY fecha_em
                ORDER BY fecha_em DESC");
                $result = $this->conn->query($query);
                $data = array();
                foreach ($result as $row) {
        	    $data[] = $row;
                }
                $result->closeCursor();
                print json_encode($data);
            }break;
            case 4:{
                $query = "SELECT  f.fami_descc, sum(c.sum_valor) as Valor
                FROM consolidado_mes_familia c JOIN familia f ON f.fami_codi=c.fami_codi";
    
                if ($parametro != null ) {
                $query .= " WHERE c.periodo= :periodo and f.marc_codi= :marca"; 
                }
                $query .= " GROUP BY f.fami_descc";

                $stmt = $this->conn->prepare($query);
    
                if ($parametro != null) {
                $stmt->bindParam(':periodo', $parametro, PDO::PARAM_STR);
                $stmt->bindParam(':marca', $parametro2, PDO::PARAM_STR);
                }
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                print json_encode($data);
            }break;
            case 5:{
                $query = sprintf("SELECT periodo,sum_valor
                FROM consolidado_periodo");
                $result = $this->conn->query($query);
                $data = array();
                foreach ($result as $row) {
        	    $data[] = $row;
                }
                $result->closeCursor();
                print json_encode($data);
            }break;
            case 6:{
                $query = sprintf("SELECT TOP 10 fecha_em,sum(sum_valor) as Ventas
                FROM consolidado_diario_ven
                GROUP BY periodo, fecha_em
                ORDER BY fecha_em DESC");
                $result = $this->conn->query($query);
                $data = array();
                foreach ($result as $row) {
        	    $data[] = $row;
                }
                $result->closeCursor();
                print json_encode($data);
            }break;
            default:{
                echo"solicitud invalida ". $request ."";
            }
    }
    }

    public function getDatosDetalleVentaMarca($marca,$periodo) {
        $this->conBDPDO();
        $sql = "EXEC GetDetalleVenta @marca = :marca, @periodo = :periodo";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':marca', $marca, PDO::PARAM_INT);
        $stmt->bindParam(':periodo', $periodo, PDO::PARAM_INT);
        
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
    public function getDatosDetalleVentaFamilia($marca, $periodo) {
        $this->conBDPDO();
    
        $sql = "EXEC GetFamiliasDato @marca = :marca, @periodo = :periodo";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':marca', $marca, PDO::PARAM_INT);
        $stmt->bindParam(':periodo', $periodo, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
    
    public function getStockMarca(){
        $this->conBDPDO();
        $sql = "EXEC GetStockMarca";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->execute();
        
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
    public function getStockValorado(){
        $this->conBDPDO();
        $sql = "EXEC GetStockValorado";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->execute();
        
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function getValoradoStockMarca(){
        $this->conBDPDO();
        $sql = "EXEC GetValoradoStockMarca";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->execute();
        
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function getStockValoradoVar(){
        $this->conBDPDO();
        $sql = "EXEC GetStockValoradoVar";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->execute();
        
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function getValoradoStockMarcaVar(){
        $this->conBDPDO();
        $sql = "EXEC GetValoradoStockMarcaVar";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->execute();
        
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function getPromedioT2(){
        $this->conBDPDO();
        $sql = "EXEC GetPromedioT2";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->execute();
        
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function getPromedioT2Stock(){
        $this->conBDPDO();
        $sql = "EXEC GetPromedioT2Stock";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->execute();
        
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
    
    public function getStockPorMarca($marca){
        $this->conBDPDO();
        $sql = "EXEC GetStockPorMarca @marca = :marca";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':marca', $marca, PDO::PARAM_INT);
        $stmt->execute();
        
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function getDatosPorPeriodo($periodo) {
        $this->conBDPDO();
        $sql = "EXEC GetPorPeriodo @periodo = :periodo";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':periodo', $periodo, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

}


?>