<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TORREMALL</title>
    <link href="{{asset('AdminBSBMaterialDesign-master/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/control.css')}}">
    {{-- KEYBOARD --}}
    <link rel="stylesheet" href="{{asset('js/Keyboard-master/css/keyboard.css')}}">
    <link rel="stylesheet" href="{{asset('js/Keyboard-master/css/keyboard-dark.css')}}">
    <link href="{{asset('js/Keyboard-master/docs/css/tipsy.css')}}" rel="stylesheet">
    
    <!-- Sweet Alert Css -->
    <link href="{{ asset('AdminBSBMaterialDesign-master/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/mapeo_control.css')}}">
</head>
<body>
    {{-- FORM PARA CERRAR SESSIÓN --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <ul class="opciones">
        <li><a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();"  data-toggle="tooltip" data-placement="bottom" title="Salir"><i class="fa fa-power-off"></i><span> Salir</span></a></li>
    </ul>

    <div class="container">
        <div class="row">
            <div class="col-md-12 contenedor_empresa">
                <div class="logo">
                    <img src="{{asset('imgs/empresa/'.$empresa->logo)}}" alt="Logo">
                </div>
                <div class="empresa">
                    {{$empresa->name}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 contenedor_fecha">
                <div class="fecha" id="fecha">
                    1 de enero del 2019
                </div>
                <div class="reloj" id="reloj">
                    00 : 00 : 00 a.m.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <input type="password" class="rfid" id="rfid" placeholder="Código RFID" autofocus>
                <img id="rfid-opener" class="tooltip-tipsy" title="Teclado" src="{{asset('js/Keyboard-master/css/images/keyboard.svg')}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="accion" id="accion">
                </div>
                <div id="marcado">
                    
                </div>
            </div>
        </div>


        {{-- inputs --}}
        <input type="text" name="txtHora" id="txtHora" readonly hidden>
        <input type="text" name="txtFecha" id="txtFecha" readonly hidden>
        <input type="text" name="txtAccion" id="txtAccion" readonly hidden>
        <input type="text" name="txtMapeo" id="txtMapeo" readonly hidden>
        <input type="text" name="vehiculo_id" id="vehiculo_id" readonly hidden> 
        <br>
        <input type="text" name="txtTiempo" id="txtTiempo" value="" readonly hidden> 
        <input type="text" name="txtHoraIngreso" id="txtHoraIngreso" readonly hidden> 
        <input type="text" name="txtFechaIngreso" id="txtFechaIngreso" readonly hidden> 
        <input type="text" name="txtTotal" id="txtTotal" readonly hidden> 
        <input type="text" name="a_nombre" id="a_nombre" readonly hidden> 
        <input type="text" name="nit" id="nit" readonly hidden> 
    </div>


    {{-- *************************************************************
                                    MODAL
         ************************************************************* --}}
         <div class="modal fade" id="m_ingreso">
             <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                     <div class="modal-header">
                        <h4>SELECCIONE UNA UBICACIÓN</h4>
                     </div>
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-md-12">
                                    <label class="form-label">SECCIÓN:</label>
                                    {{ Form::select('seccion',$array_secciones,isset($ingreso_salida)? $id_seccion:null,['class'=>'form-control','id'=>'seccion']) }}
                             </div>
                         </div>
                         <br>
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="contenedor" id="contenedor">
             
                                 </div>
                             </div>
                         </div>
                     </div>
                     {{-- <div class="modal-footer">
                        <button class="btn btn-primary" id="btnAceptar">ACEPTAR</button>
                     </div> --}}
                 </div>
             </div>
         </div>
    {{-- *************************************************************
                                FIN MODAL 
         *************************************************************--}}

    {{-- URL'S Y TOKEN --}}
    <input type="text" value="{{csrf_token()}}" id="token" hidden>
    <input type="text" value="{{route('ingresos_salidas.carga_accion')}}" id="url_accion" hidden>
    <input type="text" value="{{route('cobros.obtener_tarifa')}}" id="url_tarifa" hidden>
    <input type="text" value="{{route('mapeos.obtener_mapeo')}}" id="url_mapeo" hidden>
    <input type="text" value="{{route('ingresos_salidas.store')}}" id="url_guarda" hidden>
    <input type="text" value="{{route('secciones.obtener_seccion')}}" id="url_seccion" hidden>
    {{-- FIN URL'S --}}

    <!-- Jquery Core Js -->
    <script src="{{asset('AdminBSBMaterialDesign-master/plugins/jquery/jquery-3.2.1.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('AdminBSBMaterialDesign-master/plugins/bootstrap/js/bootstrap.js')}}"></script>

    {{-- <script src="{{asset('js/Keyboard-master/docs/js/jquery-latest-slim.min.js')}}"></script> --}}
	<script src="{{asset('js/Keyboard-master/docs/js/jquery-ui-custom.min.js')}}"></script>

    {{-- TECLADO --}}
    <script src="{{asset('js/Keyboard-master/js/jquery.keyboard.js')}}"></script>

    <script src="{{asset('js/Keyboard-master/languages/es.js')}}"></script>

    {{-- opcionales --}}
	<script src="{{asset('js/Keyboard-master/docs/js/jquery.tipsy.min.js')}}"></script>
    <script src="{{asset('js/Keyboard-master/js/jquery.mousewheel.js')}}"></script>
	<script src="{{asset('js/Keyboard-master/js/jquery.keyboard.extension-typing.js')}}"></script>
	<script src="{{asset('js/Keyboard-master/js/jquery.keyboard.extension-autocomplete.js')}}"></script>
	<script src="{{asset('js/Keyboard-master/js/jquery.keyboard.extension-caret.js')}}"></script>

    {{-- MIS SCRIPTS --}}
    <!-- Bootstrap Notify Plugin Js -->
    
    <!-- Sweet Alert Plugin Js -->
    <script src="{{ asset('AdminBSBMaterialDesign-master/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('AdminBSBMaterialDesign-master/js/pages/ui/notifications.js') }}"></script>
    <script src="{{ asset('AdminBSBMaterialDesign-master/js/pages/ui/notifications.js') }}"></script>

    <script>
        var rfid = $('#rfid');
        $(document).ready(function () {
            // $('[data-toggle="tooltip"]').tooltip();
            $('#rfid').keyboard({
                openOn : null,
                stayOpen : true,
                layout : 'qwerty',
                language: 'es',
                canceled      : function(e, keyboard, el) {
                },
                hidden      : function(e, keyboard, el) {
                },
            })
            .addTyping();

            $('#rfid-opener').click(function(){
                var kb = $('#rfid').getkeyboard();
                // close the keyboard if the keyboard is visible and the button is clicked a second time
                if ( kb.isOpen ) {
                    kb.close();
                    $('#rfid').focus();
                } else {
                    kb.reveal();
                }
            });
        });
    </script>

    <script src="{{asset('js/control.js')}}"></script>
</body>
</html>