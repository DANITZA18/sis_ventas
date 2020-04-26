<div class="row">
    <div class="col-md-4">
        <label>Nombre completo*</label>
        {{Form::text('nombre',null,['class'=>'form-control','required','autofocus'])}}
    </div>
    <div class="col-md-3">
        <label>Carnet de identidad*:</label>
        {{Form::number('ci',null,['class'=>'form-control','required'])}}
        @if ($errors->has('ci'))
        <span class="invalid-feedback" style="color:red;" role="alert">
            <strong>{{ $errors->first('ci') }}</strong>
        </span>
        @endif
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
    <div class="col-md-3">
        <div class="form-group">
            <label>Celular*:</label>
            {{Form::text('cel',null,['class'=>'form-control','required'])}}
        </div>
    </div>
</div>