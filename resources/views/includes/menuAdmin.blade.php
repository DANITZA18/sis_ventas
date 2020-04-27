<li class="{{request()->is('ventas*')? 'active':''}}">
    <a href="{{route('ventas.index')}}">
    <i class="fa fa-dolly-flatbed"></i> <span>Ventas</span>
    </a>
</li>
<li class="{{request()->is('users*')? 'active':''}}">
    <a href="{{route('users.index')}}">
    <i class="fa fa-users"></i> <span>Empleados</span>
    </a>
</li>
<li class="{{request()->is('productos*')? 'active':''}}">
    <a href="{{route('productos.index')}}">
    <i class="fa fa-wine-bottle"></i> <span>Productos</span>
    </a>
</li>

<li class="{{request()->is('descuentos*')? 'active':''}}">
    <a href="{{route('descuentos.index')}}">
    <i class="fa fa-percentage"></i> <span>Descuentos</span>
    </a>
</li>
<li class="{{request()->is('promociones*')? 'active':''}}">
    <a href="{{route('promociones.index')}}">
    <i class="fa fa-clipboard-list"></i> <span>Promociones</span>
    </a>
</li>
<li class="{{request()->is('clientes*')? 'active':''}}">
    <a href="{{route('clientes.index')}}">
    <i class="fa fa-users"></i> <span>Clientes</span>
    </a>
</li>
<li class="{{request()->is('masVendidos*')? 'active':''}}">
    <a href="{{route('productos.index')}}">
    <i class="fa fa-chart-bar"></i> <span>Estadisticas</span>
    </a>
</li>

<li class="{{request()->is('solicitudes*')? 'active':''}}">
    <a href="{{route('solicitudes.index')}}">
    <i class="fa fa-key"></i> <span>Contraseñas</span>
    </a>
</li>