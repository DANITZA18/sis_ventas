@extends('layouts.admin')

@section('pagina')
Promociones
@endsection

@section('css')

@endsection

@section('content')

<!-- Content Header (Page header) -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">PROMOCIONES</h3>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('promociones.create')}}" class="btn btn-sm btn-success pull-right">
                        <span>Nueva promoción</span> <i class="fa fa-plus"></i>
                    </a>
                    <h2 class="titulo_panel">LISTA DE PROMOCIONES</h2>
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
                                <th>Nombre</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Descuento %</th>
                                <th>Fecha inicio</th>
                                <th>Fecha finalización</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cont =1;
                            @endphp
                            @foreach($promociones as $promocion)
                            <tr>
                                <td>{{$cont++}}</td>
                                <td>
                                    {{$promocion->nom}}
                                </td>
                                <td>
                                    {{$promocion->producto->nom}}
                                </td>
                                <td>
                                    {{$promocion->inicio}} {{($promocion->fin != null)? 'a '.$promocion->inicio:'o mas' }} unidades
                                </td>
                                <td class="centreado">
                                    {{$promocion->descuento->descuento}}
                                </td>
                                <td>
                                    {{$promocion->fecha_inicio}}
                                </td>
                                <td>
                                    {{$promocion->fecha_fin}}
                                </td>
                                <td class="btns-opciones">
                                    <a href="{{route('promociones.edit',$promocion->id)}}" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>

                                    <a href="#" data-url="{{route('promociones.destroy',$promocion->id)}}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
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
            {width:"5%"},
            null,
            null,
            {width:"12%"}
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
