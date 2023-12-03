var urlParams = new URLSearchParams(window.location.search);
var marc = urlParams.get('marc');
var prd = urlParams.get('periodo');
var table5;

function DibujarTabla($marca){
table5 = $('#myTable4').DataTable( {
  "serverSide": true,
    ajax: {
        "url": "php/tablas_interface.php",
        "dataType": "json",
        data: {
            'marc': $marca,
            'request': 8
        },
        "contentType": "application/json; charset=utf-8",
        "type": "GET",
        "dataSrc": ""
    },
    columns: [
        { data: 'fami_descl' },
        { data: 'prod_codi' },
        { data: 'prod_descc' },
        { data: 'prod_unid' },
        { data: 'prod_cant', render: $.fn.dataTable.render.number( ',', '.', 2 ) },
        { data: 'prod_costo', render: $.fn.dataTable.render.number( ',', '.', 2 )  },
        { data: 'prod_stot', render: $.fn.dataTable.render.number( ',', '.', 2 ) }
    ],dom: "Bfrtip",
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
    processing: true,
    paging: false,
    scrollCollapse: true,
    scrollY: '800px'
  } );
};
$.ajax({
  url: "php/tablas_interface.php",
  dataType: 'json',
data: {
      'request': 9 //valorado para stock x marca
  },
  contentType: "application/json; charset=utf-8",
  method: "GET",
  success: function(data) {
      const valor = data[0].prod_stot;
      const currencyFormat = new Intl.NumberFormat('en-us').format(valor);
      document.getElementById("valoradostk").value +=currencyFormat;
  },
  error: function(data) {
      console.log(data);
  }
});
  $.ajax({
    url: "php/tablas_interface.php",
    dataType: 'json',
  data: {
        'request': 10 //variacion stock x marca
    },
    contentType: "application/json; charset=utf-8",
    method: "GET",
    success: function(data) {
        const valor = data[0].prod_stot_var;
        const currencyFormat = new Intl.NumberFormat('en-us').format(valor);
        document.getElementById("variaciontotstk").innerHTML +=currencyFormat;
    },
    error: function(data) {
        console.log(data);
    }
  });
  $.ajax({
    url: "php/tablas_interface.php",
    dataType: 'json',
  data: {
        'request': 11 //promedio t2 stock x marca
    },
    contentType: "application/json; charset=utf-8",
    method: "GET",
    success: function(data) {
        const valor = data[0].prom_stk;
        const currencyFormat = new Intl.NumberFormat('en-us').format(valor);
        document.getElementById("promediot2stk").value +=currencyFormat;
        const valElement = document.getElementById("valoradostk");
          const proElement = document.getElementById("promediot2stk");
          const diastockElement = document.getElementById("diastockmarc");
  
          const val = parseFloat(valElement.value.replace(/,/g, '')).toFixed(1);
          const pro = parseFloat(proElement.value.replace(/,/g, '')).toFixed(1);
          const diastock = (val/pro);
        console.log(diastock,val,pro);
          const currencyFormat1 = new Intl.NumberFormat('en-us').format(diastock);
          diastockElement.value = currencyFormat1;
    },
    error: function(data) {
        console.log(data);
    }
  });
 
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

  $('#miComboBox').on('change',function(){
		var optionText = $("#miComboBox option:selected").text().valueOf();
		$.ajax({
        url: 'Stock_por_marca.php',
        type: 'GET',
		data: {
            'mn': optionText
        },
        dataType: 'text',
        success: function(data) {
            document.getElementById("marcanom").innerHTML = "Marca: "+optionText;
            var prdo = document.getElementById("miComboBox").value;
            console.log(prdo);
            $('#myTable4').DataTable().clear().destroy();
            DibujarTabla(prdo);
        },
        error: function() {
        }
    });
    });