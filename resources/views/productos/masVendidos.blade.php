@extends('layouts.admin')

@section('pagina')
Modificar producto
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/subirFoto.css')}}">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">PRODUCTOS</h3>
        </div>
        <input type="hidden" id="fecha_hoy" value="{{date('Y-m-d')}}">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="titulo_panel">Venta de productos</h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="form-group">
                                <select name="filtro" id="filtro" class="form-control">
                                    <option value="1">Hasta hoy</option>
                                    <option value="2">Filtrar fecha</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-md-offset-4">
                            <div class="form-group">
                                <input type="date" name="fecha_ini" id="fecha_ini" class="form-control oculto">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control oculto">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="contenedor_grafico"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<input type="hidden" id="urlEstadisticas" value="{{route('productos.estadisticas')}}">
@endsection

@section('scripts')
<script src="{{asset('js/vistas/productos/masVendidos.js')}}"></script>
@endsection
