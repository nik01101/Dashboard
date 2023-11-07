<?php
session_start();
include("./sqlserver.php");
// Seteamos la cabecera a JSON
header('Content-Type: application/json');
$sqlserver = new SqlServer();


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['request'])) {
        $accion = $_GET['request'];
        switch ($accion) {
            case 1:
                $marca = $_GET['marc'];
                $periodo = $_GET['periodo'];
                
                if (!empty($marca) && !empty($periodo)) {
                    $sqlserver->getDatosDetalleVentaFamilia($marca, $periodo);
                } else if (empty($marca) && !empty($periodo)) {
                    $sqlserver->getDatosDetalleVentaFamilia(null, $periodo);
                } else if(!empty($marca) && empty($periodo)){
                    $sqlserver->getDatosDetalleVentaFamilia($marca, null);
                }else{
                    $sqlserver->getDatosDetalleVentaFamilia(null, null);
                }
                break;
            default:
                echo "Acción no válida";
                break;
        }
    } else {
        echo "Falta el parámetro 'accion' en la solicitud POST.";
    }
}
?>