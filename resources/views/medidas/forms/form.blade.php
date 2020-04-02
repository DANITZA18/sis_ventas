<div class="row">
    <div class="col-md-3">
        <div class="contenedor-info-inline">
            <div class="elemento-info">
                <div class="titulo-elemento wp-100">
                    Nombre(s)*
                </div>
                <div class="contenedor-informacion-input">
                    {{ Form::text('nom',null,['class'=>'form-control','required']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="contenedor-info-inline">
            <div class="elemento-info">
                <div class="titulo-elemento wp-100">
                    Descripción*
                </div>
                <div class="contenedor-informacion-input">
                    {{ Form::text('descripcion',null,['class'=>'form-control','required']) }}
                </div>
            </div>
        </div>
    </div>
</div>