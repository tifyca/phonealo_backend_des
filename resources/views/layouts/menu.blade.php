 @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            
                        @else
<ul class="app-menu">
  <li><a class="app-menu__item {{ Request::is('/','home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Inicio</span></a></li>
  
  <li class="treeview {{ Request::is('configurar/*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Configurar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu ">
     @if ($perfil==1 || $perfil==2)  
     <li><a class="treeview-item {{ Request::is('configurar/cargos*') ? 'active' : '' }}" href="{{ route('cargos.index') }}"><i class="icon fa fa-circle-o"></i>Cargos</a></li>
     <li><a class="treeview-item  {{ Request::is('configurar/categorias*') ? 'active' : '' }}" href="{{ route('categorias.index') }}"><i class="icon fa fa-circle-o"></i>Categorías</a></li>
     <li><a class="treeview-item {{ Request::is('configurar/subcategorias*') ? 'active' : '' }}" href="{{ route('subcategorias.index') }}"><i class="icon fa fa-circle-o"></i>Subcategorias</a></li>
     <li><a class="treeview-item {{ Request::is('configurar/estados*') ? 'active' : '' }}" href="{{ route('estados') }}"><i class="icon fa fa-circle-o"></i>Estados</a></li>
     
     <li><a class="treeview-item {{ Request::is('configurar/fuente*') ? 'active' : '' }}" href="{{ route('fuente.index') }}"><i class="icon fa fa-circle-o"></i>Fuentes</a></li>

     <li><a class="treeview-item {{ Request::is('configurar/direcciones/paises*') ? 'active' : '' }}" href="{{ route('paises') }}"><i class="icon fa fa-circle-o"></i>Países</a></li>
     <li><a class="treeview-item {{ Request::is('configurar/direcciones/departamentos*') ? 'active' : '' }}" href="{{ route('departamentos') }}"><i class="icon fa fa-circle-o"></i>Departamentos</a></li>
     <li><a class="treeview-item {{ Request::is('configurar/direcciones/ciudades*') ? 'active' : '' }}" href="{{ route('ciudades') }}"><i class="icon fa fa-circle-o"></i>Ciudades</a></li>
     <li><a class="treeview-item {{ Request::is('configurar/direcciones/barrios*') ? 'active' : '' }}" href="{{ route('barrios') }}"> <i class="icon fa fa-circle-o"></i>Barrios</a></li>
     <li><a class="treeview-item {{ Request::is('configurar/horas/horas*') ? 'active' : '' }}" href="{{ route('horas.index') }}"> <i class="icon fa fa-circle-o"></i>Horas</a></li>
     
     
     @endif
   </ul>
 </li>

 <li class="treeview {{ Request::is('registro/*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Registro</span><i class="treeview-indicator fa fa-angle-right"></i></a>
  <ul class="treeview-menu">

    <li><a class="treeview-item {{ Request::is('registro/clientes*') ? 'active' : '' }}" href="{{ route('clientes.index') }}"><i class="icon fa fa-circle-o"></i>Clientes</a></li>
    <li><a class="treeview-item {{ Request::is('registro/proveedores*') ? 'active' : '' }}" href="{{ route('proveedores.index') }}"><i class="icon fa fa-circle-o"></i>Proveedores</a></li>
    <li><a class="treeview-item {{ Request::is('registro/productos*') ? 'active' : '' }}" href="{{ route('productos.index') }}"><i class="icon fa fa-circle-o"></i>Productos</a></li>
    <li><a class="treeview-item {{ Request::is('registro/empleados*') ? 'active' : '' }}" href="{{ route('empleados.index') }}"><i class="icon fa fa-circle-o"></i>Empleados</a></li>
  </ul>
</li>

<li class="treeview {{ Request::is('inventario/*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Inventario</span><i class="treeview-indicator fa fa-angle-right"></i></a>
  <ul class="treeview-menu">
    <li><a class="treeview-item {{ Request::is('inventario/entradas*') ? 'active' : '' }}" href="{{ route('entradas.index') }}"><i class="icon fa fa-circle-o"></i>Entrada</a></li>
    <li><a class="treeview-item {{ Request::is('inventario/salidas*') ? 'active' : '' }}" href="{{ route('salidas.index') }}"><i class="icon fa fa-circle-o"></i>Salidas</a></li>

    <li><a class="treeview-item {{ Request::is('inventario/consolidado*') ? 'active' : '' }}" href="{{ route('consolidado.index') }}"><i class="icon fa fa-circle-o"></i>Consolidados</a></li>
  </ul>
</li>
@if ($perfil==1 || $perfil==2) 

<li class="treeview {{ Request::is('procesar/*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-check"></i><span class="app-menu__label">Procesar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
  <ul class="treeview-menu">
    <li><a class="treeview-item {{ Request::is('procesar/gastos*') ? 'active' : '' }}" href="{{ route('gastos.index') }}"><i class="icon fa fa-circle-o"></i>Gastos</a></li>

    <li><a class="treeview-item {{ Request::is('procesar/ventas*') ? 'active' : '' }}" href="{{ route('ventas.index') }}"><i class="icon fa fa-circle-o"></i>Ventas</a></li>
    <li><a class="treeview-item {{ Request::is('procesar/logistica*') ? 'active' : '' }}" href="{{ route('logistica') }}"><i class="icon fa fa-circle-o"></i>Logística</a></li>
    {{-- <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Pedidos</a></li> --}}
    {{-- <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Cargas</a></li> --}}
    {{-- <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Provisorio</a></li> --}}
    <li><a class="treeview-item {{ Request::is('procesar/remitos*') ? 'active' : '' }}" href="{{ route('remitos.index') }}"><i class="icon fa fa-circle-o"></i>Remitos</a></li>            
    <li>
      <a class="treeview-item {{ Request::is('procesar/descompuestos') ? 'active' : '' }}" href="{{ route('descompuestos') }}">  <i class="icon fa fa-circle-o"></i>
        Descompuestos
      </a>
      <ul class="treeview-menu pl-3" >
        <li><a class="treeview-item {{ Request::is('procesar/descompuestos/soporte') ? 'active' : '' }}" href="{{ route('descompuestos.soporte') }}"><i class="icon fa fa-circle-o"></i>Soporte</a></li>
      </ul>
    </li>
    <li><a class="treeview-item {{ Request::is('procesar/aconfirmar*') ? 'active' : '' }}" href="{{ route('aconfirmar.index') }}"><i class="icon fa fa-circle-o"></i>A confirmar</a></li> 
    
    <li><a class="treeview-item {{ Request::is('procesar/conversiones*') ? 'active' : '' }}" href="{{ route('procesar.conversiones') }}"><i class="icon fa fa-circle-o"></i>Conversiones</a></li>
  </ul>
</li>


@endif

<li class="treeview {{ Request::is('caja*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Caja</span><i class="treeview-indicator fa fa-angle-right"></i></a>
  <ul class="treeview-menu">

    <li><a class="treeview-item {{ Request::is('caja/index*') ? 'active' : '' }}" href="{{ route('caja.index') }}"><i class="icon fa fa-circle-o"></i>Abrir Caja</a></li>
    <li><a class="treeview-item {{ Request::is('caja/cierres*') ? 'active' : '' }}" href="{{ route('caja.cierres') }}"><i class="icon fa fa-circle-o"></i>Cierres</a></li>
    <li><a class="treeview-item {{ Request::is('caja/historial*') ? 'active' : '' }}" href="{{ route('caja.historial') }}"><i class="icon fa fa-circle-o"></i>Historial de POS/otros ingresos</a></li>
  </ul>
</li>


<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-download"></i><span class="app-menu__label">Generar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
  <ul class="treeview-menu">

    <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Inventario</a></li>
    <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Estadístico</a></li>
  </ul>
</li>
<li class="treeview {{ Request::is('seguridad/*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Seguridad</span><i class="treeview-indicator fa fa-angle-right"></i></a>
  <ul class="treeview-menu">

    <li><a class="treeview-item {{ Request::is('seguridad/usuarios*') ? 'active' : '' }}" href="{{url('seguridad/usuarios')}}"><i class="icon fa fa-circle-o"></i>Usuarios</a></li>
    <li><a class="treeview-item {{ Request::is('seguridad/roles*') ? 'active' : '' }}" href="{{url('seguridad/roles')}}"><i class="icon fa fa-circle-o"></i>Perfiles</a></li>
    <li><a class="treeview-item {{ Request::is('seguridad/auditoria*') ? 'active' : '' }}" href="{{url('seguridad/auditoria')}}"><i class="icon fa fa-circle-o"></i>Auditoria</a></li>

  </ul>
</li> 


</ul>
@endguest