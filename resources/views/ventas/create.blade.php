@extends('layouts.admin')

@section('pagina')
Nueva venta
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/subirFoto.css')}}">
<style>
    .select{
        padding: 0px!important;
    }
    .select select{
        cursor: pointer;
        border:0px;
    }
</style>
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
                    <h2 class="titulo_panel">REGISTRAR VENTA</h2>
                </div>
                <div class="panel-body">
                {{-- {!! Form::open(['route'=>'ventas.store','method'=>'POST','files'=>'true']) !!} --}}
                    @include('ventas.forms.form')
                    
                    {{-- {!! Form::close() !!} --}}
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="token" id="token" value="{{csrf_token()}}">
<input type="hidden" name="urlRegistraVenta" id="urlRegistraVenta" value="{{route('ventas.store')}}">
<input type="hidden" name="urlObtieneDescuento" id="urlObtieneDescuento" value="{{route('descuentos.info')}}">
@include('modal.agrega')
@endsection

@section('scripts')

<script src="{{asset('js/vistas/ventas/venta.js')}}"></script>

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

//DATA-TABLE
    $('table.data-table').removeAttr('width').DataTable({
        responsive: true,
        columns : [
            {width:"5%"},
            null,
            {width:"5%"},
            {width:"10%"},
            {width:"5%"}
        ],
        scrollX: true,
        scrollY: "400px",
        scrollCollapse: true,
        language: lenguaje,
        pageLength:25
    });

</script>
@endsection
