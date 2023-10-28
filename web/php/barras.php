<?php
include("./sqlserver.php");
// Seteamos la cabecera a JSON
header('Content-Type: application/json');
$sqlserver = new SqlServer();
$sqlserver->getDatosBarras();