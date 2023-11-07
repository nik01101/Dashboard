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
                if($_GET['marc']== null & $_GET['periodo'] != null){
                    $sqlserver->getDatosDetalleVentaMarca(null,$_GET['periodo']);
                }else if($_GET['marc'] != null & $_GET['periodo'] == null){
                    $sqlserver->getDatosDetalleVentaMarca($_GET['marc'],null);
                }else if($_GET['marc'] == null & $_GET['periodo'] == null){
                    $sqlserver->getDatosDetalleVentaMarca(null,null);
                }
                else{
                    $sqlserver->getDatosDetalleVentaMarca($_GET['marc'],$_GET['periodo']);
                };
                break;
            case 2:
                if($_GET['periodo']== null){
                    $sqlserver->getDatosPorPeriodo(null);
                }else{
                    $sqlserver->getDatosPorPeriodo($_GET['periodo']);
                };
                break;
            case 3:
                if (!empty($_GET['marc']) && !empty($_GET['periodo'])) {
                    $sqlserver->getDatosDetalleVentaFamilia($_GET['marc'], $_GET['periodo']);
                } else if (empty($_GET['marc']) && !empty($_GET['periodo'])) {
                    $sqlserver->getDatosDetalleVentaFamilia(null, $_GET['periodo']);
                } else if(!empty($_GET['marc']) && empty($_GET['periodo'])){
                    $sqlserver->getDatosDetalleVentaFamilia($_GET['marc'], null);
                }else{
                    $sqlserver->getDatosDetalleVentaFamilia(null, null);
                };
                break;
            case 4:
                $sqlserver->getStockMarca();
                break;
            case 5:
                $sqlserver->getStockValorado();
                break;
            case 6:
                $sqlserver->getStockValoradoVar();
                break;
            case 7:
                $sqlserver->getPromedioT2();
                break;
            case 8:
                if($_GET['marc']== null){
                    $sqlserver->getStockPorMarca(null);
                }else{
                     $sqlserver->getStockPorMarca($_GET['marc']);
                };
                break;
            case 9:
                $sqlserver->getValoradoStockMarca();
                break;
            case 10:
                $sqlserver->getValoradoStockMarcaVar();
                break;
            case 11:
                $sqlserver->getPromedioT2Stock();
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