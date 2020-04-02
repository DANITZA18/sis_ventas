<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Nombre(s)*:</label>
            {{Form::text('nombre',null,['class'=>'form-control','required'])}}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Paterno*:</label>
            {{Form::text('paterno',null,['class'=>'form-control','required'])}}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Materno:</label>
            {{Form::text('materno',null,['class'=>'form-control'])}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <label>Carnet de identidad*:</label>
            {{Form::number('ci',null,['class'=>'form-control','required'])}}
    </div>
    <div class="col-md-2">
        <label>Expedido*:</label>
        {{Form::select('ci_exp',[
            '' => 'Seleccione',
            'LP' => 'LA PAZ',
            'CB' => 'COCHABAMBA',
            'SC' => 'SANTA CRUZ',
            'PT' => 'POTOSI',
            'CH' => 'CHUQUISACA',
            'TJ' => 'TARIJA',
            'BN' => 'BENI',
            'PD' => 'PANDO',
            'OR' => 'ORURO',
        ],null,['class'=>'form-control','required'])}}
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Correo*:</label>
            {{Form::email('correo',null,['class'=>'form-control','required'])}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Celular*:</label>
            {{Form::text('cel',null,['class'=>'form-control','required'])}}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Teléfono:</label>
            {{Form::text('fono',null,['class'=>'form-control'])}}
        </div>
    </div>
    @if(isset($persona))
    <div class="col-md-4 contenedor_foto">
        <img src="{{ asset('imgs/persona/'.$persona->foto) }}" width="150" height="155" id="imagen_select">
        <div class="form-group contenedor_subir">
            <input type="file" accept="image/*" style='opacity: 0;' name="foto" class="file" id="foto">
            <label class="subir"for="foto">
                <i class="fa fa-image"></i> <span>Elegir foto</span>
            </label>
        </div>
    </div>
    @else
    <div class="col-md-4 contenedor_foto">
        <img src="{{ asset('imgs/users/user_default.png') }}" width="150" height="155" id="imagen_select">
        <div class="form-group contenedor_subir">
            <input type="file" accept="image/*" style='opacity: 0;' name="foto" class="file" id="foto">
            <label class="subir"for="foto">
                <i class="fa fa-image"></i> <span>Elegir foto</span>
            </label>
        </div>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Rol*:</label>
            {{Form::text('rol',null,['class'=>'form-control','required'])}}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Usuario*:</label>
            {{Form::select('tipo',[
                '' => 'Seleccione',
                'ADMINISTRADOR' => 'ADMINISTRADOR',
                'EMPLEADO' => 'EMPLEADO',
            ],isset($empleado)? $empleado->user->tipo:null,['class'=>'form-control','required'])}}
        </div>
    </div>
</div>