@extends('layouts.admin')

@section('pagina')
Información venta
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/vistas/ventas/ver_venta.css')}}">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">VENTAS</h3>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="titulo_panel">INFORMACIÓN DE VENTA</h2>
                </div>
                <div class="panel-body">
                    @php
                        $empresa = sis_ventas\Empresa::first();
                    @endphp
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{asset('imgs/empresa/'.$empresa->logo)}}" class="logo_factura" alt="Logo">
                            <div class="titulo">
                                <h2>{{$empresa->name}}</h2>
                                <p class="dir">{{$empresa->dpto}}-{{$empresa->pais}}, {{$empresa->zona}} {{$empresa->calle}} #{{$empresa->nro}}</p>
                            </div>

                            <div class="titulo_derecha">
                                <h2>Factura</h2>
                                <div class="contenedor_info">
                                    <p class="info"><strong>NIT: </strong><span>{{$empresa->nit}}</span></p>
                                    <p class="info"><strong>FACTURA N°: </strong><span>{{$venta->nro_factura}}</span></p>
                                    <p class="info"><strong>AUTORIZACIÓN: </strong><span>{{$empresa->nro_aut}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="datos_factura">
                                <div class="facturar_a">
                                    <p><strong>Cliente: </strong> {{$venta->cliente->nombre}}</p>
                                    <p><strong>NIT/C.I.: </strong> {{$venta->nit}}</p>
                                </div>
                                <div class="num_fac">
                                    <p><strong>Fecha: </strong> {{date('d/m/Y',strtotime($venta->fecha_venta))}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="factura">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>PRODUCTO</th>
                                        <th>C/U.(Bs.)</th>
                                        <th>Descuento %</th>
                                        <th>CANTIDAD</th>
                                        <th>SUBTOTAL (Bs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cont = 1;   
                                    ?>
                                    @foreach($venta->detalles as $detalle)
                                        <tr>
                                            <td>{{$cont++}}</td>
                                            <td>{{$detalle->producto->nom}}</td>
                                            <td>{{$detalle->costo}}</td>
                                            <td>{{$detalle->descuento->descuento}}</td>
                                            <td>{{$detalle->cantidad}}</td>
                                            <td>{{$detalle->total}}</td>
                                        </tr>
                                    @endforeach

                                   
@endsection

@section('scripts')
@endsection
