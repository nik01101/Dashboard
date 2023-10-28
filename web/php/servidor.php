<?php
include("./sqlserver.php");
$oSQLSERVER = new SQLServer();

$response = "";
$rq = $_POST['rq'];

if ($rq == 1) {
    $response = $oSQLSERVER->getDatosDona();
} 

echo $response;
?>