var urlParams = new URLSearchParams(window.location.search);
var marc = urlParams.get('marc');
var prd = urlParams.get('periodo');


  
  
  let table4 = $('#myTable3').DataTable( {
    ajax: {
        "url": "php/tablas_interface.php",
        "dataType": "json",
        data: {
            'periodo': prd,
            'marc': marc,
            'request': 4
        },
        "contentType": "application/json; charset=utf-8",
        "type": "GET",
        "dataSrc": ""
    },
    columns: [
        { data: 'marc_codi' },
        { data: 'marc_descl' },
        { data: 'prodtot', render: $.fn.dataTable.render.number( ',', '.', 2 ) },
        { data: 'participacion' },
        { data: 'variacion', render: $.fn.dataTable.render.number( ',', '.', 2 ) }
    ],columnDefs: [ {
      targets: 3,
      render: DataTable.render.percentBar( 'round','#FFF', '#7abde6', '#2242b2', '#7abde6', 2, 'groove' )
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

  
$.ajax({
  url: "php/tablas_interface.php",
  dataType: 'json',
data: {
      'request': 5
  },
  contentType: "application/json; charset=utf-8",
  method: "GET",
  success: function(data) {
      const valor = data[0].prodtot;
      const currencyFormat = new Intl.NumberFormat('en-us').format(valor);
      document.getElementById("valorado").value +=currencyFormat;
  },
  error: function(data) {
      console.log(data);
  }
});



$.ajax({
  url: "php/tablas_interface.php",
  dataType: 'json',
data: {
      'request': 6
  },
  contentType: "application/json; charset=utf-8",
  method: "GET",
  success: function(data) {
      const valor = data[0].prodtotvar;
      const currencyFormat = new Intl.NumberFormat('en-us').format(valor);
      document.getElementById("variaciontot").innerHTML +=currencyFormat;
  },
  error: function(data) {
      console.log(data);
  }
});



$.ajax({
  url: "php/tablas_interface.php",
  dataType: 'json',
data: {
      'request': 7
  },
  contentType: "application/json; charset=utf-8",
  method: "GET",
  success: function(data) {
      const valor = data[0].avg_sumastock;
      const currencyFormat = new Intl.NumberFormat('en-us').format(valor);
      document.getElementById("promediot2").value +=currencyFormat;
      const valElement = document.getElementById("valorado");
	    const proElement = document.getElementById("promediot2");
	    const diastockElement = document.getElementById("diastock");
      console.log(valElement.value);
	    const val = parseFloat(valElement.value.replace(/,/g, '')).toFixed(1);
      console.log(val);
	    const pro = parseFloat(proElement.value.replace(/,/g, '')).toFixed(1);
	    const diastock = (val/pro).toFixed(1);
	    const currencyFormat1 = new Intl.NumberFormat('en-us').format(diastock);
	    diastockElement.value = currencyFormat1;
  },
  error: function(data) {
      console.log(data);
  }
});




var date = $('#fecha').dtDateTime();
      $('#fecha').on( 'change', function () {
      table
      .columns( 1 )
      .search( date.val())
      .draw();

} );

const comboBox = document.getElementById('miComboBox');

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
    $.fn.dataTable.table2({ visible: true, api: true }).columns.adjust();
});