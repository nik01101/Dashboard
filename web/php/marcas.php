<?php
include("./sqlserver.php");
header('Content-Type: application/json');
$sqlserver = new SqlServer();
$sqlserver->getMarcas();
?>