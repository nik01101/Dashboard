const comboBox = document.getElementById('miComboBox');
var table;
var table2;
fetch('php/marcas.php')
  .then(response => response.json())
  .then(data => {
    // Itera sobre los datos y agrega opciones al ComboBox
    data.forEach(item => {
      const option = document.createElement('option');
      option.value = item.marc_codi; // El valor que quieres asociar con la opción
      option.text = item.marc_descl;   // El texto que se mostrará en el ComboBox
      comboBox.appendChild(option);
    });
    
  })
  .catch(error => {
    console.error('Error al cargar los datos: ', error);
  });

$(document).on('shown.bs.pill', 'a[data-toggle="pill"]', function (e) {
    DibujarTabla2();
    $.fn.dataTable.table2({ visible: true, api: true }).columns.adjust();
});

function copyTextValue(){
    function copyTextValue() {
    var text1 = $("#periodo").find(":selected").text();;
    
    }
}

$(document).ready(function() {
document.getElementById("marcanom").innerHTML = "Marca: "+marcaNombre;
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
    var mrc = document.getElementById("miComboBox").value;
            console.log(prdo,mrc);
            $('#myTable').DataTable().clear().destroy();
            DibujarTabla(prdo,mrc);
            $('#myTable2').DataTable().clear().destroy();
            DibujarTabla2(prdo,mrc);
},
error: function() {
}
});
});
$('#miComboBox').on('change',function(){
var optionText = $("#miComboBox option:selected").text().valueOf();
$.ajax({
url: 'Detalle_venta_marca.php',
type: 'GET',
data: {
    'mn': optionText
},
dataType: 'text',
success: function(data) {
    document.getElementById("marcanom").innerHTML = "Marca: "+optionText;
    var prdo = document.getElementById("cbPeriodos").value;
    var mrc = document.getElementById("miComboBox").value;
            console.log(prdo,mrc);
            $('#myTable').DataTable().clear().destroy();
            DibujarTabla(prdo,mrc);
            $('#myTable2').DataTable().clear().destroy();
            DibujarTabla2(prdo,mrc);
},
error: function() {
}
});
});

$.ajax({
url: "php/barras.php",
dataType: 'json',
data: {
    'request': 4,
    'periodo':202301,
    'marca': marcaSeleccionada
},
contentType: "application/json; charset=utf-8",
method: "GET",
success: function(data) {
    var fami_descc = [];
    var Valor = [];
    console.log(data);

    for (var i in data) {
        fami_descc.push(data[i].fami_descc);
        Valor.push((Math.round(data[i].Valor) / 1000).toFixed(2));
    };

    var grafico = new Chart(document.getElementById("chartjs-dashboard-bar1"), {
        type: "bar",
        data: {
            labels: fami_descc,
            datasets: [{
                label: "Consolidado Por Periodo",
                backgroundColor: window.theme.primary,
                borderColor: window.theme.primary,
                hoverBackgroundColor: window.theme.primary,
                hoverBorderColor: window.theme.primary,
                data: Valor,
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
    'request': 5,
    'periodo':null,
    'marca': null
},
contentType: "application/json; charset=utf-8",
method: "GET",
success: function(data) {
    var periodo = [];
    var sum_valor = [];
    console.log(data);

    for (var i in data) {
        periodo.push(data[i].periodo);
        sum_valor.push((Math.round(data[i].sum_valor) / 1000	).toFixed(2));
    };

    var grafico = new Chart(document.getElementById("chartjs-dashboard-bar2"), {
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
    'request': 6,
    'periodo':null,
    'marca': null
},
contentType: "application/json; charset=utf-8",
method: "GET",
success: function(data) {
    var fecha_em = [];
    var Ventas = [];
    console.log(data);

    for (var i in data) {
        fecha_em.push(data[i].fecha_em);
        Ventas.push((Math.round(data[i].Ventas) / 100).toFixed(2));
    };

    var grafico = new Chart(document.getElementById("chartjs-dashboard-bar3"), {
        type: "bar",
        data: {
            labels: fecha_em,
            datasets: [{
                label: "Consolidado Por Periodo",
                backgroundColor: window.theme.primary,
                borderColor: window.theme.primary,
                hoverBackgroundColor: window.theme.primary,
                hoverBorderColor: window.theme.primary,
                data: Ventas,
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

function DibujarTabla($periodo,$marca){
    table = $('#myTable').DataTable( {
    ajax: {
        "url": "php/tablas_interface.php",
        "dataType": "json",
        data: {
            'periodo': $periodo,
            'marc': $marca,
            'request': 1
        },
        "contentType": "application/json; charset=utf-8",
        "type": "GET",
        "dataSrc": ""
    },
    columns: [
        { data: 'pers_vend' },
        { data: 'vendedor' },
        { data: 'valor', render: $.fn.dataTable.render.number( ',', '.', 2 ) },
        { data: 'costo', render: $.fn.dataTable.render.number( ',', '.', 2 ) },
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
            
        if ($periodo=='202301'){
            var arrowIcon = sum_valorValue > 0 ? '<span class="green-arrow">&#9650;</span>' : '<span class="red-arrow">&#9660;</span>';
            var sum_valorValue = parseFloat(data.valor);
            var formattedValue = new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(sum_valorValue);
                    $('td:eq(2)', row).html(arrowIcon + ' ' + formattedValue);
        }else{
            $.ajax({
                url: 'php/tablas_interface.php',
                type: 'GET',
                dataType: 'json',
                dataSrc: '',
                data: {'periodo' : $periodo,
                        'marca' : $marca,
                        'request': 15},
                success: function(response) {
                    console.log(response.valor+'aa');
                    var Valorvar = parseFloat(response[0].valor);
                    console.log(Valorvar);
                    var sum_valorValue = parseFloat(data.valor);
                    console.log(sum_valorValue);
                    var porcentaje = ((sum_valorValue - Valorvar)/Valorvar)*100;
                    var porcertajeformat = new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(porcentaje);
                    var arrowIcon = sum_valorValue > Valorvar ? '<span class="green-arrow">&#9650;'+porcertajeformat+'%</span>' : '<span class="red-arrow">&#9660;'+porcertajeformat+'%</span>';
                    var formattedValue = new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(sum_valorValue);
                    $('td:eq(2)', row).html(arrowIcon + ' ' + formattedValue);
                },
                error: function(xhr, status, error) {
                    console.error('Error making AJAX request:', status, error);
                }
            });
        }
        
    }  
  } );
};
function DibujarTabla2($periodo,$marca){
    table2 = $('#myTable2').DataTable( {
    ajax: {
        "url": "php/tablas_interface.php",
        "dataType": "json",
        data: {
            'periodo': $periodo,
            'marc': $marca,
            'request': 3
        },
        "contentType": "application/json; charset=utf-8",
        "type": "GET",
        "dataSrc": ""
    },
    columns: [
        { data: 'fami_codi' },
        { data: 'familia' },
        { data: 'valor', render: $.fn.dataTable.render.number( ',', '.', 2 ) },
        { data: 'costo', render: $.fn.dataTable.render.number( ',', '.', 2 ) },
        { data: 'margen' },
        {data: 'periodo'},
        {data: 'marc_codi'}
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
    scrollY: '800px'
    
  } );
};