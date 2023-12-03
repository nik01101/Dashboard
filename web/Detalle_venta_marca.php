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
	<link href="css/style.css" rel="stylesheet">
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

					<li class="sidebar-item active">
					<a class="sidebar-link" href="Detalle_venta_marca.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Detalle Por Marca</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="venta_por_periodo.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Ventas Por Periodo</span>
            </a>
					</li>

					<li class="sidebar-item">
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
                				<img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1"> <span class="text-dark">username</span>
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
							<h5 id="marcanom">Marca:</h5>
								<form method="get" action="Detalle_venta_marca.php">
										<select id="miComboBox" name="marc" class="border-2" >
  											<option value="" selected disabled hidden >Selecciona una marca</option>
										</select>
										<h5 id="pernom">Periodo:</h5>
										<select id="cbPeriodos" name="periodo" class="border-2">
											  <option value="" selected disabled hidden>Selcciona un Periodo</option>
											  <option  value="202301">ENERO</option>
											  <option value="202302">FEBRERO</option>
											  <option value="202303">MARZO</option>
											  <option value="202304">ABRIL</option>
											  <option value="202305">MAYO</option>
											  <option value="202306">JUNIO</option>
											  <option value="202307">JULIO</option>
											  <option value="202308">AGOSTO</option>
											  <option value="202309">SEPTIEMBRE</option>
											  <option value="202310">OCTUBRE</option>
											  <option value="202311">NOVIEMBRE</option>
											  <option value="202312">DICIEMBRE</option>
										</select>	
								</form>
							</div>
						</div>
				<!--pestañas para opciones de Venta por familias o por Vendedores-->
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								<!--pestaña 1-->
  								<li class="nav-item" role="presentation">
    								<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Ventas Por Familias</button>
  								</li>
								<!--pestaña 2-->
  								<li class="nav-item" role="presentation">
    								<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Ventas Por Vendedores</button>
  								</li>
							</ul>
							<!--contenido de las pestañaas-->
								<div class="tab-content" id="pills-tabContent">
									<!--pestaña 1-->
  									<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								  		<div class=" d-flex">
											<div class="card flex-fill ">
												<div class="card-header">
												<h5 class="card-title m-3">Tabla de Datos</h5>
            										
												</div>
												<div class="card-body mx-1">
													<table id="myTable"   class="table table-striped" style="width:100%">
    													<thead>
        													<tr>
            													<th>Codigo</th>
            													<th>Vendedor</th>
																<th>Valor</th>
																<th>Costo</th>
																<th>Margen</th>
        													</tr>
    													</thead>
    													<tbody>
    													</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								<!--pestaña 2-->
  								<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								  <div class=" d-flex">
											<div class="card flex-fill ">
												<div class="card-header">
												<h5 class="card-title m-3">Tabla de Datos</h5>
												<tbody class="m-5">
													
												</tbody>
												</div>
												<div class="card-body mx-1">
													<table id="myTable2"  class="table table-bordered table-hover table-striped m-3" style="width:100%">
    													<thead>
        													<tr>
                                                                <th>Codigo</th>
            													<th>Familia</th>
																<th>Valor</th>
																<th>Costo</th>
																<th>Margen</th>
																<th>Periodo</th>
																<th>Marca</th>
        													</tr>
    													</thead>
    													<tbody>
    													</tbody>
													</table>
												</div>
											</div>
										</div>
								</div>
							</div>
							<div class="row">
							<div class="col-12 col-lg-4 col-xxl-4 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="card-title mb-0">Ventas Por Familia</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
									<div class="align-self-center chart chart-lg">
										<canvas id="chartjs-dashboard-bar1"></canvas>
									</div>
										</div>
									</div>
								</div>
							</div>
								<div class="col-12 col-lg-4 col-xxl-4 d-flex">
										<div class="card flex-fill">
											<div class="card-header">
												<h5 class="card-title mb-0">Ventas Por Periodo</h5>
											</div>
											<div class="card-body d-flex">
												<div class="align-self-center w-100">
												<div class="align-self-center chart chart-lg">
													<canvas id="chartjs-dashboard-bar2"></canvas>
												</div>
												</div>
											</div>
										</div>
									</div>
									
										<div class="col-12 col-lg-4 col-xxl-4 d-flex">
										<div class="card flex-fill">
											<div class="card-header">
												<h5 class="card-title mb-0">ULTIMAS VENTAS DIARIAS</h5>
											</div>
											<div class="card-body d-flex">
												<div class="align-self-center w-100">
												<div class="align-self-center chart chart-lg">
													<canvas id="chartjs-dashboard-bar3"></canvas>
												</div>
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
			</main>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/date-1.5.1/r-2.5.0/sl-1.7.0/datatables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.13.6/dataRender/percentageBars.js"></script>
	<script src="js/app.js"></script>
	<script src="js/dtllvtamarca.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
	<script>
		Chart.register(ChartDataLabels);
		var marcaSeleccionada = "<?php echo isset($_SESSION['marca_seleccionada']) ? $_SESSION['marca_seleccionada'] : ''; ?>";
		console.log(marcaSeleccionada);
		var opcionSeleccionada = "<?php echo isset($_SESSION['opcion_seleccionada']) ? $_SESSION['opcion_seleccionada'] : ''; ?>";
		console.log(opcionSeleccionada);
		var marcaNombre = "<?php echo isset($_SESSION['mn']) ? $_SESSION['mn'] : ''; ?>";
		var periodoNombre = "<?php echo isset($_SESSION['pn']) ? $_SESSION['pn'] : ''; ?>";
		
		
	</script>
</body>
</html>