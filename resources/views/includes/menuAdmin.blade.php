<li class="{{request()->is('ventas*')? 'active':'active'}}">
    <a href="{{route('home')}}">
    <i class="fa fa-dolly-flatbed"></i> <span>Ventas</span>
    </a>
</li>
<li class="{{request()->is('empleados*')? 'active':''}}">
    <a href="{{route('home')}}">
    <i class="fa fa-users"></i> <span>Empleados</span>
    </a>
</li>
<li class="{{request()->is('productos*')? 'active':''}}">
    <a href="{{route('home')}}">
    <i class="fa fa-wine-bottle"></i> <span>Productos</span>
    </a>
</li>
<li class="{{request()->is('descuentos*')? 'active':''}}">
    <a href="{{route('home')}}">
    <i class="fa fa-percentage"></i> <span>Descuentos</span>
    </a>
</li>
<li class="{{request()->is('promociones*')? 'active':''}}">
    <a href="{{route('home')}}">
    <i class="fa fa-clipboard-list"></i> <span>Promociones</span>
    </a>
</li>