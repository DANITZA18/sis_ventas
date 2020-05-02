@extends('layouts.admin')

@section('pagina')
Productos
@endsection

@section('css')

@endsection

@section('content')

<!-- Content Header (Page header) -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">PRODUCTOS</h3>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('productos.create')}}" class="btn btn-sm btn-success pull-right">
                        <span>Nuevo producto</span> <i class="fa fa-plus"></i>
                    </a>
                    <h2 class="titulo_panel">LISTA DE PRODUCTOS</h2>
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

                    @if(session('noActualizable'))
                    <div class="alert alert-warning">
                        <button data-dismiss="alert" class="close">&times;</button>
                        {{session('noActualizable')}}
                    </div>
                    @endif
                    @if(session('bienIngreso'))
                    <div class="alert alert-success">
                        <button data-dismiss="alert" class="close">&times;</button>
                        {{session('bienIngreso')}}
                    </div>
                    @endif
                    
                    <table class="data-table table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nombre</th>
                                <th>Costo Bs.</th>
                                <th>Disponible</th>
                                <th>Ingresos</th>
                                <th>Salidas</th>
                                <th>Descripción</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cont =1;
                            @endphp
                            @foreach($productos as $producto)
                            <tr>
                                <td>{{$cont++}}</td>
                                <td>
                                    {{$producto->nom}}
                                </td>
                                <td>
                                    {{$producto->costo}}
                                </td>
                                <td>
                                    {{$producto->disponible}}
                                </td>
                                <td>
                                    {{$producto->ingresos}}
                                </td>
                                <td>
                                    {{$producto->salidas}}
                                </td>
                                <td>
                                    {{$producto->descripcion}}
                                </td>
                                <td class="btns-opciones">
                                    @if(Auth::user()->tipo =='ADMINISTRADOR')
                                    <a href="{{route('productos.edit',$producto->id)}}" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>
                                    @endif

                                    <a href="" data-url ="{{route('productos.ingreso',$producto->id)}}" data-toggle="modal" data-target="#modal-ingreso" class="ingreso evaluar"><i class="fa fa-plus" data-toggle="tooltip" data-placement="left" title="Registrar ingreso"></i></a>

                                    @if(Auth::user()->tipo =='ADMINISTRADOR')
                                    <a href="#" data-url="{{route('productos.destroy',$producto->id)}}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
                                    @endif
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
@include('modal.ingreso')

@endsection

@section('scripts')
<script>
    //DATA-TABLE
    $('table.data-table').removeAttr('width').DataTable({
        responsive: true,
        columns : [
            {width:"5%"},
            null,
            {width:"10%"},
            {width:"10%"},
            {width:"10%"},
            {width:"10%"},
            null,
            {width:"15%"}
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

    // ELIMINAR
    $(document).on('click','table.data-table tbody tr td.btns-opciones a.ingreso',function(e){
        e.preventDefault();
        let registro = $(this).parents('tr').children('td').eq(1).text();
        $('#nomProducto').html(`Registrar ingresos del producto <b>${registro}</b>`);
        let url = $(this).attr('data-url');
        $('#formRegistraIngreso').prop('action',url);
    });

    $('#btnRegistraIngreso').click(function(){
        //validar
        let cantidad = $('#cantidadIngreso').val();
        if(cantidad != '' && cantidad != null)
        {
            $('#errorVacio').addClass('oculto');
            if(cantidad > 0)
            {
                $('#errorCero').addClass('oculto');
                $('#formRegistraIngreso').submit();
            } 
            else{
                $('#errorCero').removeClass('oculto');
            }
        }
        else{
            $('#errorVacio').removeClass('oculto');
        }
    });
 
</script>
@endsection
