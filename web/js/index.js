var urlParams = new URLSearchParams(window.location.search);
var campo1 = urlParams.get('campo1');
console.log(campo1);
let table = $('#myTable').DataTable( {
    ajax: {
        "url": "php/tabla_detalle_venta_marca.php",
        "dataType": "json",
        data: {
            'campo1': campo1
        },
        "contentType": "application/json; charset=utf-8",
        "type": "GET",
        "dataSrc": ""
    },
    columns: [
        { data: 'pers_vend' },
        { data: 'vendedor' },
        { data: 'valor' },
        { data: 'costo' },
        { data: 'margen' }
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
        }
  } );


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


  

