<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Nombre(s)*:</label>
            <input type="text" name="nombre" class="form-control" value="" required autofocus>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Paterno*:</label>
            <input type="text" name="paterno" class="form-control" value="" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Materno:</label>
            <input type="text" name="materno" class="form-control" value="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <label>Carnet de identidad*:</label>
        <input type="number" name="ci" id="ci" class="form-control" required>
    </div>
    <div class="col-md-2">
        <label>Expedido*:</label>
        <select name="ci_exp" id="ci_exp" class="form-control" required>
            <option value="" disabled selected>Seleccione</option>
            <option value="LP">LA PAZ</option>
            <option value="CB">COCHABAMBA</option>
            <option value="SC">SANTA CRUZ</option>
            <option value="PT">POTOSI</option>
            <option value="CH">CHUQUISACA</option>
            <option value="TJ">TARIJA</option>
            <option value="BN">BENI</option>
            <option value="PD">PANDO</option>
            <option value="OR">ORURO</option>
        </select>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Correo*:</label>
            <input type="email" name="correo" class="form-control" value="" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Celular*:</label>
            <input type="text" name="cel" class="form-control" value="" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Teléfono:</label>
            <input type="text" name="fono" class="form-control" value="">
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
            <label>Usuario*:</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="" disabled selected>Seleccione</option>
                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                <option value="EMPLEADO">EMPLEADO</option>
            </select>
        </div>
    </div>
</div>