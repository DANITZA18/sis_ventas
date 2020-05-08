@extends('layouts.admin')

@section('pagina')
Ventas
@endsection

@section('css')

@endsection

@section('content')

<!-- Content Header (Page header) -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">VENTAS</h3>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('ventas.create')}}" class="btn btn-sm btn-success pull-right">
                        <span>Nueva venta</span> <i class="fa fa-plus"></i>
                    </a>
                    <h2 class="titulo_panel">LISTA DE VENTAS</h2>
                </div>
                <div class="panel-body">
                    @if(session('bien'))
                    <div class="alert alert-success">
                        <button data-dismiss="alert" class="close">&times;</button>
                        {{session('bien')}}
                    </div>
                    @endif
                    @if(session('uso'))
                    <div class="alert alert-info">
                        <button data-dismiss="alert" class="close">&times;</button>
                        {{session('uso')}}
                    </div>
                    @endif
                    <table class="data-table table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Empleado</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Total Bs.</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cont =1;
                            @endphp
                            @foreach($ventas as $venta)
                            <tr>
                                <td>{{$cont++}}</td>
                                <td>
                                    @if($venta->user->empleado)
                                    {{$venta->empleado->nombre}} {{$venta->empleado->paterno}} {{$venta->empleado->materno}}
                                    @else
                                    {{$venta->user->name}}
                                    @endif
                                </td>
                                <td>
                                    {{$venta->cliente->nombre}}
                                </td>
                                <td>
                                    {{$venta->fecha_venta}}
                                </td>
                                <td>
                                    {{$venta->total}}
                                </td>
                                <td class="btns-opciones">
                                    <a href="{{route('ventas.show',$venta->id)}}" class="evaluar ver"><i class="fa fa-eye" data-toggle="tooltip" data-placement="left" title="Ver información"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@include('modal.eliminar')

@endsection

@section('scripts')
<script>
    //DATA-TABLE
    $('table.data-table').removeAttr('width').DataTable({
        responsive: true,
        columns : [
            {width:"5%"},
            null,
            null,
            null,
            null,
            {width:"5%"}
        ],
        scrollX: true,
        scrollY: "400px",
        scrollCollapse: true,
        language: lenguaje,
        pageLength:"25"
    });
    // ELIMINAR
    $(document).on('click','table.data-table tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let registro = $(this).parents('tr').children('td').eq(1).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro <b>${registro}</b>?`);
        let url = $(this).attr('data-url');
        $('#formEliminar').prop('action',url);
    });

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });

</script>
@endsection