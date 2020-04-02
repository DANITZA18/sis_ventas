@extends('layouts.admin')

@section('pagina')
Modificar medida
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/subirFoto.css')}}">
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Medidas
    <small>Modificar medida</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="{{route('medidas.index')}}"> Medidas</a></li>
    <li class="active">Modificar</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3>Información</h3>
                </div>    
            
                <div class="box-body">
                    {!! Form::model($medida,['route'=>['medidas.update',$medida->id],'method'=>'PUT','files'=>'true','id'=>'form_validation']) !!}
                        @include('medidas.forms.form')
                        <div class="contenedor-info-inline">
                            <button class="btn btn-success btn-lg waves-effect" type="submit"><i class="fa fa-update"></i> <span> ACTUALIZAR</span></button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    </div>
</section>
<!-- /.content -->

@endsection

@section('scripts')
<script>

// SUBIR IMAGEN
   $('body').on('change','#foto',function(e){
        addImage(e);
    });

    function addImage(e){
        var file = e.target.files[0],
        imageType = /image.*/;

        if (!file.type.match(imageType))
            return;

        var reader = new FileReader();
        reader.onload = fileOnload;
        reader.readAsDataURL(file);
    }

    function fileOnload(e) {
        var result=e.target.result;
        $('#imagen_select').attr("src",result);
    }
// FIN SUBIR IMAGEN

//DateMask
$('[data-mask]').inputmask();
</script>
@endsection
