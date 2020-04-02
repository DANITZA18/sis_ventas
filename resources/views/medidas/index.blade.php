@extends('layouts.admin')

@section('pagina')
Medidas
@endsection

@section('css')

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Medidas
    <small>Lista de medidas</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
    <li class="active">Medidas</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{route('medidas.create')}}" class="btn btn-primary">
                        <i class="fa fa-user-plus"></i>
                        <span>Nueva medida</span>
                    </a>
                </div>    
            
                <div class="box-body">
                    @if(session('bien'))
                    <div class="alert alert-success">
                        <button data-dismiss="alert" class="close">&times;</button>
                        {{session('bien')}}
                    </div>
                    @endif
                    <table class="data-table table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cont =1;
                            @endphp
                            @foreach($medidas as $medida)
                            <tr>
                                <td>{{$cont++}}</td>
                                <td>
                                    {{$medida->nom}}
                                </td>
                                <td>
                                    {{$medida->descripcion}}
                                </td>
                                <td class="btns-opciones">
                                    <a href="{{route('medidas.edit',$medida->id)}}" class="modificar">
                                        <i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i>
                                    </a>

                                    <a href="{{route('medidas.destroy',$medida->id)}}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar">
                                        <i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    </div>
</section>
<!-- /.content -->

@include('modal.eliminar')
@include('modal.realizarEvaluacion')

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
        let registro = $(this).parents('tr').children('td').eq(2).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro <b>${registro}</b>?`);
        let url = $(this).attr('href');
        $('#formEliminar').prop('action',url);
    });

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });
 
</script>
@endsection
