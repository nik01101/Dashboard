var urlParams = new URLSearchParams(window.location.search);
var marc = urlParams.get('marc');
var prd = urlParams.get('periodo');
var table3;
var tablefam;

function DibujarTabla($periodo){
 table3 = $('#tablaporperiodo').DataTable( {
    ajax: {
        "url": "php/tablas_interface.php",
        "dataType": "json",
        data: {
            'periodo': $periodo,
            'request': 2,
        },
        "contentType": "application/json; charset=utf-8",
        "type": "GET",
        "dataSrc": "",
		"processing": true
    },
    columns: [
        { data: 'marc_codi' },
        { data: 'marc_descl' },
        { data: 'marc_descc' },
        { data: 'sum_valor', render: $.fn.dataTable.render.number( ',', '.', 2 )},
        { data: 'margen' },
        { data: 'nro_sku' },
        { data: 'nro_cob' }
    ],columnDefs: [ {
      targets: 4,
      render: DataTable.render.percentBar( 'round','#FFF', '#7abde6', '#2242b2', '#7abde6', 1, 'groove' )
    } ],dom: "Bfrtip",
    buttons: [
        { extend: 'excel',text: 'Exportar Excel<i class="fas fa-file-excel fa-lg"></i>',
        className:'btn btn-success excel-exp'},
        { extend: 'copy',text: 'Copiar Datos<i class="fas fa-file-excel fa-lg"></i>',
        className:'btn btn-success excel-exp'},
        { extend: 'csv',text: 'Exportar CSV<i class="fas fa-file-excel fa-lg"></i>',
        className:'btn btn-success excel-exp'}
    ],
    language: {
    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        },
    select : true,
	responsive:true,
    paging: false,
    scrollCollapse: true,
        scrollY: '800px',
        "createdRow": function(row, data, dataIndex) {
            var sum_valorValue = parseFloat(data.sum_valor);
            var arrowIcon = sum_valorValue > 0 ? '<span class="green-arrow">&#9650;</span>' : '<span class="red-arrow">&#9660;</span>';

            $('td:eq(3)', row).html(arrowIcon + ' ' + sum_valorValue);
        }    
  } );

};
function DibujarTablaFam($marca){
    
    tablefam = $('#tablaporfamxmarca').DataTable( {
        ajax: {
            "url": "php/tablas_interface.php",
            "dataType": "json",
            data: {
                'periodo': prd,
                'request': 2,
                'marca': $marca
            },
            "contentType": "application/json; charset=utf-8",
            "type": "GET",
            "dataSrc": "",
            "processing": true
        },
        columns: [
            { data: 'marc_codi' },
            { data: 'marc_descl' },
            { data: 'marc_descc' },
            { data: 'sum_valor', render: $.fn.dataTable.render.number( ',', '.', 2 )},
            { data: 'margen' },
            { data: 'nro_sku' },
            { data: 'nro_cob' }
        ],columnDefs: [ {
          targets: 4,
          render: DataTable.render.percentBar( 'round','#FFF', '#7abde6', '#2242b2', '#7abde6', 1, 'groove' )
        } ],dom: "Bfrtip",
        buttons: [
            { extend: 'excel',text: 'Exportar Excel<i class="fas fa-file-excel fa-lg"></i>',
            className:'btn btn-success excel-exp'},
            { extend: 'copy',text: 'Copiar Datos<i class="fas fa-file-excel fa-lg"></i>',
            className:'btn btn-success excel-exp'},
            { extend: 'csv',text: 'Exportar CSV<i class="fas fa-file-excel fa-lg"></i>',
            className:'btn btn-success excel-exp'}
        ],
        language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            },
        select : true,
        responsive:true,
        paging: false,
        scrollCollapse: true,
            scrollY: '800px',
            "createdRow": function(row, data, dataIndex) {
                // Assuming 'margen' is the column index for the values you want to check
                var sum_valorValue = parseFloat(data.sum_valor);
    
                // Create an arrow icon based on the 'margen' value
                var arrowIcon = sum_valorValue > 0 ? '<span class="green-arrow">&#9650;</span>' : '<span class="red-arrow">&#9660;</span>';
    
                // Assuming you want to add the arrow to the sixth column (index 5)
                $('td:eq(3)', row).html(arrowIcon + ' ' + sum_valorValue);
            }    
      } );
}
function AddContext(){
  $.contextMenu({
    selector: '#tablaporperiodo tbody tr',
    callback: function (key, options) {
        // Get the selected row data
        var rowData = table3.row(this).data();

        // Handle context menu actions
        switch (key) {
            case 'edit':
                // Handle edit action
                console.log('Edit clicked for row with data:', rowData);
                $('#floatingCard').toggleClass('d-none');
                $('#tablaporfamxmarca').DataTable().clear().destroy();
                DibujarTablaFam(rowData.marc_codi);

                break;
            case 'delete':
                // Handle delete action
                console.log('Delete clicked for row with data:', rowData);
                break;
            // Add more cases for additional actions
        }
    },
    items: {
        edit: { name: 'Edit', icon: 'edit' },
        delete: { name: 'Delete', icon: 'delete' }
        // Add more context menu items as needed
    }
});
};

$(document).ready(function () {

    // Button click event
    $('#openDataTableBtn').on('click', function () {
        $('#floatingCard').toggleClass('d-none');
    });

    // Close button click event
    $('#closeDataTableBtn').on('click', function () {
        $('#floatingCard').addClass('d-none');
    });
});


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

            document.getElementById("pernom").innerHTML = "Periodo: "+optionText;
            var prdo = document.getElementById("cbPeriodos").value;
            console.log(prdo);
            $('#tablaporperiodo').DataTable().clear().destroy();
            DibujarTabla(prdo);
            AddContext();
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