<?php
include("./sqlserver.php");
// Seteamos la cabecera a JSON
header('Content-Type: application/json');
$sqlserver = new SqlServer();
if(isset($_GET['campo1'])== null){
    $sqlserver->getDatosDetalleVentaMarca(null);

}else{
    $sqlserver->getDatosDetalleVentaMarca($_GET['campo1']);
}
?>