<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['marc'])) {
        $_SESSION["marca_seleccionada"] = $_GET['marc'];
    }
	if (isset($_GET['mn'])) {$_SESSION['mn'] = $_GET['mn'];}
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['periodo'])) {
        $_SESSION["opcion_seleccionada"] = $_GET['periodo'];
    }
	if (isset($_GET['pn'])) {$_SESSION['pn'] = $_GET['pn'];}
}
?>
</script>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Dashboard Version 1.0</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
	<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/date-1.5.1/r-2.5.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar collapsed">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          			<span class="align-middle">Dashboard</span>
        		</a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Paginas
					</li>
					<li class="sidebar-item">
					<a class="sidebar-link" href="index.php">
              			<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">INDEX</span>
            		</a>
					</li>

					<li class="sidebar-item">
					<a class="sidebar-link" href="Detalle_venta_marca.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Detalle Por Marca</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="venta_por_periodo.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Ventas Por Periodo</span>
            </a>
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="Detalle_stock_marca.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Stock Por Marca</span>
            </a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="Stock_por_marca.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Detalle Stock Por Marca</span>
            </a>
					</li>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle m-1">
          			<i class="hamburger align-self-center "></i>
        		</a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                				 <span class="text-dark">username</span>
              				</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Log out</a>
							</div>
						
					</ul>
				</div>
			</nav>

			<main class="content">
						<div class="card flex-fill">
							<div class="card-header">
							<h2>Detalle de Venta Por Marca</h2>
							<div class="row justify-content-start">
    						<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
        						<h4 id="fecreport">Fecha de Reporte: </h4>
        						<h4>Stock Valorado: <input id="valorado" type="text" size="9" disabled/></h4>
        						<h4 id="variaciontot">Variacion: </h4>
    						</div>
    						<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
        						<h4>Promedio Costo T2: <input id="promediot2" type="text" size="9" disabled/></h4>
    						</div>
    						<div class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-8">
        						<h4>Dias Stock: <input id="diastock" type="text" size="9" disabled/></h4>
    						</div>
						</div>

							</div>
								<div class="card-body mx-1">
													<table id="myTable3"  class="table table-bordered table-hover table-striped m-3" style="width:100%">
    													<thead>
        													<tr>
                                                                <th>Codigo</th>
            													<th>marca</th>
																<th>Stock Valorado</th>
																<th>Partic.%</th>
																<th>Variacion</th>
        													</tr>
    													</thead>
    													<tbody>
    													</tbody>
													</table>
								</div>
						</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/date-1.5.1/r-2.5.0/sl-1.7.0/datatables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.13.6/dataRender/percentageBars.js"></script>
	<script src="js/app.js"></script>
	<script src="js/index.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
	<script>
	const currentDateTimeElement = document.getElementById("fecreport");
	const currentDate = new Date();
	const dateTimeString = currentDate.toLocaleString();
	currentDateTimeElement.innerHTML = `Fecha de Reporte: ${dateTimeString}`;
	
	</script>
</body>
</html>