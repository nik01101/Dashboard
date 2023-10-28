<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Dashboard Version 1.0</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/date-1.5.1/r-2.5.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/busy-load@0.1.2/dist/app.min.css" rel="stylesheet">
	<link href="css/datatables.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet"
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
              			<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Pagina1</span>
            		</a>
					</li>

					<li class="sidebar-item active">
					<a class="sidebar-link" href="Detalle_venta_marca.php">
              <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Pagina2</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-in.html">
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
							<h5>Marca:</h5>
								<form method="get" action="php/tabla_detalle_venta_marca.php">
										<select id="miComboBox" name="campo1" class="border-2">
  											<option value="">Selecciona una marca</option>
										</select>
    								<input type="submit" value="Enviar">
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
								<!--pestaña 3-->
  								<li class="nav-item" role="presentation">
    								<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
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
												<tbody class="m-5">
													<tr>
            											<td>FECHA:</td>
            											<td><input type="text" id="fecha" name="fecha" class="border-2"></td>
        											</tr>
													
												</tbody>
												</div>
												<div class="card-body">
													<table id="myTable"   class="display m-3">
    													<thead>
        													<tr>
            													<th>Periodo</th>
            													<th>Fecha</th>
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

								</div>
								<!--pestaña 3-->
  								<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

								</div>
							</div>
			</main>
			<footer class="footer">
			</footer>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/date-1.5.1/r-2.5.0/sl-1.7.0/datatables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
	<script src="js/app.js"></script>
	<script>

    
        function realizarConsulta(parametro) {
    // Realiza una solicitud AJAX al servidor para obtener los nuevos datos con el parámetro.
        $.ajax({
        url: 'php/tabla_detalle_venta_marca.php'.campo1, // Ruta de tu script en el servidor que realiza la consulta.
        type: 'POST',
        data: { campo1: campo1 }, // Envía el parámetro al servidor.
        dataType: 'json', // Espera datos JSON como respuesta.
        success: function(data) {
            // 3. Borra los datos existentes y agrega los nuevos datos.
            myTable.clear().rows.add(data).draw();
        },
        error: function() {
            console.error('Error al obtener los datos.');
        }
    });
}
$(document).ready(function() {
    realizarConsulta(campo1);
});
    </script>

	
</body>
</html>