<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['marc'])) {
        $_SESSION["marca_seleccionada"] = $_GET['marc'];
    }
	if (isset($_GET['mn'])) {$_SESSION['mn'] = $_GET['mn'];}
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">

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

					<li class="sidebar-item ">
					<a class="sidebar-link" href="Detalle_venta_marca.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Detalle Por Marca</span>
            </a>
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="venta_por_periodo.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Ventas Por Periodo</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="Detalle_stock_marca.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Stock Por Marca</span>
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
							<h2>Ventas Por Periodo</h2>
							<h5 id="pernom">Periodo:</h5>
								<form method="get" action="venta_por_periodo.php">
										<select id="cbPeriodos" name="periodo" class="border-2">
										<option selected disabled hidden>Selcciona un Periodo</option>
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
    								<input type="submit" value="Enviar">
								</form>
							</div>
							<div class="card-body mx-5">
								<table id="tablaporperiodo"   class="table table-striped" style="width:100%">
    								<thead>
        								<tr>
            								<th>Codigo</th>
            								<th>Marca</th>
											<th>Marca Desc.</th>
											<th>Valor</th>
											<th>Costo</th>
											<th>Margen</th>
											<th>SKU</th>
											<th>Cobertura</th>
        								</tr>
    								</thead>
    								<tbody>
    								</tbody>
								</table>
							</div>	
						</div>
						<div class="row">
							<div class="col-12 col-lg-4 col-xxl-4 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="card-title mb-0">COMPOSICION DE VENTAS</h5>
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
												<h5 class="card-title mb-0">EVOLUCION DE VENTAS</h5>
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
			<footer class="footer">
			</footer>
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
	Chart.register(ChartDataLabels);
	var opcionSeleccionada = "<?php echo isset($_SESSION['opcion_seleccionada']) ? $_SESSION['opcion_seleccionada'] : ''; ?>";
	var periodoNombre = "<?php echo isset($_SESSION['pn']) ? $_SESSION['pn'] : ''; ?>";
	console.log(opcionSeleccionada);

	
	$(document).ready(function() {
	document.getElementById("pernom").innerHTML = "Periodo: "+periodoNombre;
	$('#cbPeriodos').on('change',function(){
		var optionText = $("#cbPeriodos option:selected").text().valueOf();
		$.ajax({
        url: 'Detalle_venta_marca.php',
        type: 'GET',
		data: {
            'pn': optionText
        },
        dataType: 'text',
        success: function(data) {

            // Actualizar el contenido de otro elemento (por ejemplo, #resultado)
            document.getElementById("pernom").innerHTML = "Periodo: "+optionText;
        },
        error: function() {
            // Manejar errores si es necesario
        }
    });
    });
});


  

  $(document).ready(function() {
	$.ajax({
        url: "php/barras.php",
        dataType: 'json',
		data: {
            'request': 1,
			'periodo':opcionSeleccionada,
			'marca': 1
        },
        contentType: "application/json; charset=utf-8",
        method: "GET",
        success: function(data) {
            var marc_descc = [];
            var sum_valor = [];
            console.log(data);
 
            for (var i in data) {
                marc_descc.push(data[i].marc_descc);
                sum_valor.push((Math.round(data[i].sum_valor) / 100).toFixed(2));
            };
 
            var grafico = new Chart(document.getElementById("chartjs-dashboard-bar1"), {
				type: "bar",
				data: {
					labels: marc_descc,
					datasets: [{
						label: "Composicion de Ventas",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: sum_valor,
						barPercentage: .75,
						categoryPercentage: 1
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							
							gridLines: {
								display: true
							},
							stacked: false,
							ticks: {
								suggestedMax: 1000,
								beginAtZero: true,
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: true,
							gridLines: {
								color: "transparent"
							}
						}]
					},plugins: {
            datalabels: {
                display: true, // Show data labels
                align: 'end', // Position of the data labels (e.g., 'end', 'start', 'center')
                anchor: 'end', // Anchor point for positioning data labels
                color: 'black' // Color of the data labels
            }
        }
				}
			});
		
        },
        error: function(data) {
            console.log(data);
        }
    });
    	$.ajax({
        url: "php/barras.php",
        dataType: 'json',
		data: {
            'request': 2,
			'periodo':opcionSeleccionada,
			'marca': 1
        },
        contentType: "application/json; charset=utf-8",
        method: "GET",
        success: function(data) {
            var periodo = [];
            var sum_valor = [];
            console.log(data);
 
            for (var i in data) {
                periodo.push(data[i].periodo);
                sum_valor.push((Math.round(data[i].sum_valor) / 1000).toFixed(2));
            };
 
            var grafico = new Chart(document.getElementById("chartjs-dashboard-bar2"), {
				type: "bar",
				data: {
					labels: periodo,
					datasets: [{
						label: "Evolucion de Ventas",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: sum_valor,
						barPercentage: .75,
						categoryPercentage: 1
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							
							gridLines: {
								display: true
							},
							stacked: false,
							ticks: {
								suggestedMax: 1000,
								beginAtZero: true,
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: true,
							gridLines: {
								color: "transparent"
							}
						}]
					},plugins: {
            datalabels: {
                display: true, // Show data labels
                align: 'end', // Position of the data labels (e.g., 'end', 'start', 'center')
                anchor: 'end', // Anchor point for positioning data labels
                color: 'black' // Color of the data labels
            }
        }
				}
			});
		
        },
        error: function(data) {
            console.log(data);
        }
    });

	$.ajax({
        url: "php/barras.php",
        dataType: 'json',
		data: {
            'request': 3,
			'periodo':opcionSeleccionada,
			'marca':1
        },
        contentType: "application/json; charset=utf-8",
        method: "GET",
        success: function(data) {
            var fecha_em = [];
            var valor = [];
            console.log(data);
 
            for (var i in data) {
                fecha_em.push(data[i].fecha_em);
                valor.push((Math.round(data[i].valor) / 100).toFixed(2));
            };
 
            var grafico = new Chart(document.getElementById("chartjs-dashboard-bar3"), {
				type: "bar",
				data: {
					labels: fecha_em,
					datasets: [{
						label: "Ultimas Ventas Diarias",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: valor,
						barPercentage: .75,
						categoryPercentage: 1
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							
							gridLines: {
								display: true
							},
							stacked: false,
							ticks: {
								suggestedMax: 100,
								beginAtZero: true,
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: true,
							gridLines: {
								color: "transparent"
							}
						}]
					},plugins: {
            datalabels: {
                display: true, // Show data labels
                align: 'end', // Position of the data labels (e.g., 'end', 'start', 'center')
                anchor: 'end', // Anchor point for positioning data labels
                color: 'black' // Color of the data labels
            }
        }
				}
			});
		
        },
        error: function(data) {
            console.log(data);
        }
    });
});
	
	</script>

	
</body>
</html>