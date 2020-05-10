$(document).ready(function () {
    reiniciaFechas();
    cargaDatos();
    $('#filtro').change(function(){
        let filtro = $(this).val();
        if(filtro != 1)
        {
            $('#fecha_ini').removeClass('oculto');
            $('#fecha_fin').removeClass('oculto');
            cargaDatos();
        }   
        else{
            $('#fecha_ini').addClass('oculto');
            $('#fecha_fin').addClass('oculto');
            reiniciaFechas();
            cargaDatos();
        }
    });

    $('#fecha_ini').change(cargaDatos);
    // $('#fecha_ini').keyup(cargaDatos);

    $('#fecha_fin').change(cargaDatos);
    // $('#fecha_fin').keyup(cargaDatos);

});

function reiniciaFechas(){
    $('#fecha_ini').val($('#fecha_hoy').val());
    $('#fecha_fin').val($('#fecha_hoy').val());
}

var hoy = new Date();
var fecha_actual = ("0" + hoy.getDate()).slice(-2) + "-" + ("0" + (hoy.getMonth() + 1)).slice(-2) + "-" + hoy.getFullYear();

function cargaDatos()
{
    $.ajax({
        type: "GET",
        url: $('#urlEstadisticas').val(),
        data: {filtro:$('#filtro').val(),fecha_ini:$('#fecha_ini').val(),fecha_fin:$('#fecha_fin').val()},
        dataType: "json",
        success: function (response) {
            console.log(response.datos);
            // SETEAR EL CONTENEDOR, TIPO Y TITULO DEL GRÁFICO
            // options.chart = new Object();
            var options = {
                chart:{
                    renderTo:'contenedor_grafico',
                    type:'column',
                    options3d:{
                        enabled: true,
                        alpha: 15,
                        beta: 5,
                        depth: 100
                    }
                },
                title:{
                    text:'PRODUCTOS VENDIDOS'
                },
                subtitle:{
                    text:'Fecha: '+fecha_actual
                },
                xAxis:{
                    type:'category',
                    labels: {
                        skew3d: true,
                        style: {
                            fontSize: '12px',
                        }
                    }
                },
                yAxis:{
                    title: {
                        text: 'Cantidad vendida'
                    } 
                }
            };
            
            options.plotOptions = {
                                    column: {
                                        depth: 120
                                    }
                                };
        
            // SETEAR LOS VALORES
            options.series = [{
                colorByPoint:true,
                name: 'Unidades vendidas',
                data: response.datos,
                dataLabels: {
                    enabled: true,
                    rotation: 0,
                    color: '#FFFFFF',
                    align: 'center',
                    format: '{point.y:.0f}', // one decimal
                    y: 0, // -10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }];

         

           options.xAxis.crosshair = true;
        
            // INICIALIZAR GRÁFICOS
            var chart = new Highcharts.Chart(options);
        }
    });
}