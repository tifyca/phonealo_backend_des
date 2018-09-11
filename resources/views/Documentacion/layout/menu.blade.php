<ul class="app-menu">

  <li><a class="app-menu__item {{ Request::is('/','home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Inicio</span></a></li>
  
  <li class="treeview"><a class="app-menu__item" href="{{ route('documentacion.configurar') }}"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Mod. Configurar</span></a></li>

  <li class="treeview"><a class="app-menu__item" href="{{ route('documentacion.registro') }}"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Mod. Registro</span></a></li>

  <li class="treeview"><a class="app-menu__item" href="{{ route('documentacion.inventario') }}"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Mod. Inventario</span></a></li>

  <li class="treeview"><a class="app-menu__item" href="{{ route('documentacion.procesar') }}"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Mod. Procesar</span></a></li>

  <li class="treeview"><a class="app-menu__item" href="{{ route('documentacion.caja') }}"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Mod. Caja</span></a></li>

  <li class="treeview"><a class="app-menu__item" href="{{ route('documentacion.seguridad') }}"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Mod. Seguridad</span></a></li>

</ul>