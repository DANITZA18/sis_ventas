<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                Nombre*
            </label>
            {{ Form::text('nom',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>
                Descuento % (0-100)*
            </label>
            {{ Form::number('descuento',null,['class'=>'form-control','required','min'=>'0','max'=>'100','step'=>'0.01']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>
                Descripción*
            </label>
            {{ Form::text('descripcion',null,['class'=>'form-control','required']) }}
        </div>
    </div>
</div>