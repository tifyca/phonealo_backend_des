<ul class="app-menu">

  <li><a class="app-menu__item {{ Request::is('/','home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Inicio</span></a></li>
  
  <li class="treeview"><a class="app-menu__item" href="{{ route('delivery.documentacion.ingresar') }}"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Endpoints</span></a></li>


</ul>