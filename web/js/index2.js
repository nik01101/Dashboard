function index() {
    this.ini = function () {
        console.log("Iniciando...");
        this.getDatosGraficas();
        console.log("graficas");
    }
    this.getDatosGraficas = function () {
        $.ajax({
            statusCode: {
                404: function () {
                    console.log("Esta página no existe");
                }
            },
            url: 'php/servidor.php',
            method: 'POST',
            data: {
                rq: "1"
            }
        
        }).done(function (datos) {
            //La lógica
            if (datos != '') {
                var jDatos = datos;
                var data = jDatos.map
                };



                var ctx = document.getElementById('idGrafica').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: etiquetas,
                        datasets: [
                            {
                                label: 'Ventas',
                                data: tValor    ,
                                backgroundColor: coloresV
                            },
                            {
                                label: 'Precios',
                                data: tPrecio,
                                backgroundColor: coloresP
                            }
                        ]
                    }
                });
            }
        });
    }
}