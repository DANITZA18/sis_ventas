<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Nombre*</label>
            {{ Form::text('nom',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Costo Bs.*</label>
            {{ Form::number('costo',null,['class'=>'form-control','required','step'=>'0.01']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Ingresa*</label>
            {{ Form::number('ingresos',isset($producto)? $producto->ingresos:'0',['class'=>'form-control','required','step'=>'1','min'=>'0']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Descripción</label>
            {{ Form::text('descripcion',null,['class'=>'form-control']) }}
        </div>
    </div>
</div>