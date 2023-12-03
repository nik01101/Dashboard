var urlParams = new URLSearchParams(window.location.search);
var marc = urlParams.get('marc');
var prd = urlParams.get('periodo');
var table3;
var tablefam;
var grafbar3;

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
            
            if ($periodo=='202301'){
                var arrowIcon = sum_valorValue > 0 ? '<span class="green-arrow">&#9650;</span>' : '<span class="red-arrow">&#9660;</span>';
                var sum_valorValue = parseFloat(data.sum_valor);
                var formattedValue = new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(sum_valorValue);
                        $('td:eq(3)', row).html(arrowIcon + ' ' + formattedValue);
            }else{
                $.ajax({
                    url: 'php/tablas_interface.php',
                    type: 'GET',
                    dataType: 'json',
                    dataSrc: '',
                    data: {'periodo' : $periodo,
                            'marca' : data.marc_codi,
                            'request': 13},
                    success: function(response) {
                        console.log(response.sum_valor+'aa');
                        var Valorvar = parseFloat(response[0].sum_valor);
                        console.log(Valorvar);
                        var sum_valorValue = parseFloat(data.sum_valor);
                        console.log(sum_valorValue);
                        var porcentaje = ((sum_valorValue - Valorvar)/Valorvar)*100;
                        var porcertajeformat = new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(porcentaje);
                        var arrowIcon = sum_valorValue > Valorvar ? '<span class="green-arrow">&#9650;'+porcertajeformat+'%</span>' : '<span class="red-arrow">&#9660;'+porcertajeformat+'%</span>';
                        var formattedValue = new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(sum_valorValue);
                        $('td:eq(3)', row).html(arrowIcon + ' ' + formattedValue);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error making AJAX request:', status, error);
                    }
                });
            }
            
        }    
  } );

};
function DibujarTablaFam($marca){
    var prdo = document.getElementById("cbPeriodos").value;
    tablefam = $('#tablaporfamxmarca').DataTable( {
        ajax: {
            "url": "php/tablas_interface.php",
            "dataType": "json",
            data: {
                'periodo': prdo,
                'request': 12,
                'marca': $marca
            },
            "contentType": "application/json; charset=utf-8",
            "type": "GET",
            "dataSrc": "",
            "processing": true
        },
        columns: [
            { data: 'fami_codi' },
            { data: 'fami_descl' },
            { data: 'fami_descc' },
            { data: 'valor', render: $.fn.dataTable.render.number( ',', '.', 2 )},
            { data: 'margen' }
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
                var valorValue = parseFloat(data.valor);
                var arrowIcon = valorValue > 0 ? '<span class="green-arrow">&#9650;</span>' : '<span class="red-arrow">&#9660;</span>';
    
                $('td:eq(3)', row).html(arrowIcon + ' ' + data.valor);
            } 
      } );
}
function AddContext(){
  $.contextMenu({
    selector: '#tablaporperiodo tbody tr',
    callback: function (key, options) {
        var rowData = table3.row(this).data();

        switch (key) {
            case 'fami':
                console.log('Edit clicked for row with data:', rowData);
                $('#floatingCard').toggleClass('d-none');
                $('#tablaporfamxmarca').DataTable().clear().destroy();
                DibujarTablaFam(rowData.marc_codi);

                break;
        }
    },
    items: {
        fami: { name: 'Ver familias', icon: 'table' }
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
// combo para grafico de barras ----------------------------------------------------------------


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
 
            grafbar3 = new Chart(document.getElementById("chartjs-dashboard-bar3"), {
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


$(document).ready(function() {
    
	$('#cbPeriodos2').on('change',function(){
        var prdo2 = document.getElementById("cbPeriodos2").value;
         console.log(prdo2);
        grafbar3.destroy();
		$.ajax({
            url: "php/barras.php",
            dataType: 'json',
            data: {
                'request': 3,
                'periodo': prdo2,
                'marca': 1
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
                grafbar3 = new Chart(document.getElementById("chartjs-dashboard-bar3"), {
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

    $('#filterButton').click(function () {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        
        console.log('Start Date:', startDate);
        console.log('End Date:', endDate);
        grafbar3.destroy();
		$.ajax({
            url: "php/barras.php",
            dataType: 'json',
            data: {
                'request': 7,
                'fecini': startDate,
                'fecfin': endDate
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
                grafbar3 = new Chart(document.getElementById("chartjs-dashboard-bar3"), {
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
                    display: true, 
                    align: 'end', 
                    anchor: 'end', 
                    color: 'black' 
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
});