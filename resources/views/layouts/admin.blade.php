<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISVENTAS | @yield('pagina')</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('bootstrap-3.3.7/dist/css/bootstrap.css')}}">

    <!-- JQuery DataTable Css -->
    <link href="{{asset('js/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

    {{-- Highcharts --}}
    <link rel="stylesheet"src="{{asset('Highcharts/code/css/highcharts.css')}}">

    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/miEstilo.css')}}">
    @yield('css')
</head>
<body>


    @yield('content')

    <!-- SCRIPTS -->
    <script src="{{asset('js/jquery-3.2.1.js')}}"></script>
    <script src="{{asset('bootstrap-3.3.7/dist/js/bootstrap.js')}}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('js/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('js/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('js/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('js/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

    <!-- Highcharts -->
    <script src="{{asset('Highcharts/code/highcharts.js')}}"></script>
    <script src="{{asset('Highcharts/code/modules/data.js')}}"></script>
    <script src="{{asset('Highcharts/code/modules/exporting.js')}}"></script>
    {{-- <script src="{{asset('Highcharts/code/modules/export-data.js')}}"></script> --}}
    <script src="{{asset('Highcharts/code/highcharts-3d.js')}}"></script>

    <script>

    Highcharts.setOptions({
        lang:{
            printChart:'Imprimir',
            downloadJPEG:'Descargar JPEG',
            downloadPNG:'Descargar PNG',
            downloadPDF:'Descargar documento PDF',
            downloadSVG:'Descargar archivo SVG',
        }
    });

    $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
            lenguaje = {
                "decimal": "",
                "emptyTable": "No se encontraron registros",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
                "infoFiltered": "(Filtrado de _MAX_ total registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                    }
                };

                $('[data-toggle="tooltip"]').tooltip();

    </script>
    @yield('scripts')

</body>
</html>