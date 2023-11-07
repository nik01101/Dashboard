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
                $sqlserver->getDatosBarras($accion,$_GET['periodo'],$_GET['marca']);
                break;
            case 2:
                $sqlserver->getDatosBarras($accion,$_GET['periodo'],$_GET['marca']);
                break;
            case 3:
                $sqlserver->getDatosBarras($accion,$_GET['periodo'],$_GET['marca']);
                break;
            case 4:
                $sqlserver->getDatosBarras($accion,$_GET['periodo'],$_GET['marca']);
                break;
            case 5:
                $sqlserver->getDatosBarras($accion,$_GET['periodo'],$_GET['marca']);
                break;
            case 6:
                $sqlserver->getDatosBarras($accion,$_GET['periodo'],$_GET['marca']);
                break;
            default:
                echo "Acción no válida";
                break;
        }
    } else {
        echo "Falta el parámetro 'accion' en la solicitud POST.";
    }
}
