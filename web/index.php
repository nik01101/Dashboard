<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Dashboard Version 1.0</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle">Dashboard</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Paginas
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="index.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Pagina1</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="Detalle_venta_marca.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Pagina2</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="venta_por_periodo.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Pagina3</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-up.html">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Pagina4</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-blank.html">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Pagina5</span>
            </a>
					</li>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          			<i class="hamburger align-self-center"></i>
        		</a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                				<img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" /> <span class="text-dark">username</span>
              				</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Dashboard</strong>De<strong>Ventas</strong></h1>

					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<!--Tarjeta 1-->
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Estadistica 1</h5>
													</div>
												</div>
												<h1 class="mt-1 mb-3">Dato aqui</h1>
												<div class="mb-0">
													<span class="text-muted">Mas datos</span>
												</div>
											</div>
										</div>
										<!--Tarjeta 2-->
										<div class="card">
										<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Estadistica 1</h5>
													</div>
												</div>
												<h1 class="mt-1 mb-3">Dato aqui</h1>
												<div class="mb-0">
													<span class="text-muted">Mas datos</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<!--Tarjeta 3-->
										<div class="card">
										<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Estadistica 1</h5>
													</div>
												</div>
												<h1 class="mt-1 mb-3">Dato aqui</h1>
												<div class="mb-0">
													<span class="text-muted">Mas datos</span>
												</div>
											</div>
										</div>
										<!--Tarjeta 4-->
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Estadistica 1</h5>
													</div>
												</div>
												<h1 class="mt-1 mb-3">Dato aqui</h1>
												<div class="mb-0">
													<span class="text-muted">Mas datos</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Grafico de lineas</h5>
								</div>
								<div class="card-body py-3">
									<div class="chart chart-sm">
										<canvas id="chartjs-dashboard-line"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--segunda linea del grid-->
					<div class="row">
						<!--grafico de pastel-->
						<div class="col-12 col-lg-8 col-xxl-9 d-flex">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Grafico de Pastel</h5>
								</div>
								<div class="card-body d-flex">
									<canvas id="miGrafico"></canvas> 
								</div>
							</div>
						</div>
						<!--calendario para elegir fecha-->
						<div class="col-12 col-lg-4 col-xxl-3 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="card-title mb-0">Calendario para seleccionar fecha</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div id="datetimepicker-dashboard"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--tercera linea del grid-->
					<div class="row">
						<div class="col-12 col-lg-8 col-xxl-9 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Datatable</h5>
								</div>
								<!--Insertar datatable-->
							</div>
						</div>
						<div class="col-12 col-lg-4 col-xxl-3 d-flex">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Consolidado del mes</h5>
								</div>
								<div class="card-body d-flex w-100">
									<div class="align-self-center chart chart-lg">
										<canvas id="chartjs-dashboard-bar"></canvas>
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
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
	<script src="js/app.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales ($)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>
	
	<script>
		 
$(document).ready(function() {
    $.ajax({
        url: "php/datos.php",
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        method: "GET",
        success: function(data) {
            var prod_descl = [];
            var unid_codi = [];
            var color = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];
            var bordercolor = ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
            console.log(data);
 
            for (var i in data) {
                prod_descl.push(data[i].prod_descl);
                unid_codi.push(data[i].unid_codi);
            }
 
            var chartdata = {
                labels: prod_descl,
                datasets: [{
                    label: prod_descl,
                    backgroundColor: color,
                    borderColor: color,
                    borderWidth: 2,
                    hoverBackgroundColor: color,
                    hoverBorderColor: bordercolor,
                    data: unid_codi
                }]
            };
 
            var mostrar = $("#miGrafico");
 
            var grafico = new Chart(mostrar, {
                type: 'doughnut',
                data: chartdata,
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
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
	<script>
		$(document).ready(function() {
    	$.ajax({
        url: "php/barras.php",
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        method: "GET",
        success: function(data) {
            var periodo = [];
            var sum_valor = [];
            console.log(data);
 
            for (var i in data) {
                periodo.push(data[i].periodo);
                sum_valor.push(data[i].sum_valor);
            };
 
            var grafico = new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: periodo,
					datasets: [{
						label: "Consolidado Por Periodo",
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
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
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
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
	</script>

</body>

</html>