<ul class="app-menu">
        <li><a class="app-menu__item {{ Request::is('/','home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Inicio</span></a></li>
       
        <li class="treeview {{ Request::is('configurar/*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Configurar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu ">
           @if ($perfil==1 || $perfil==2)  
            <li><a class="treeview-item {{ Request::is('configurar/cargos*') ? 'active' : '' }}" href="{{ route('cargos.index') }}"><i class="icon fa fa-circle-o"></i>Cargos</a></li>
            <li><a class="treeview-item  {{ Request::is('configurar/categorias*') ? 'active' : '' }}" href="{{ route('categorias.index') }}"><i class="icon fa fa-circle-o"></i>Categorias</a></li>
            <li><a class="treeview-item {{ Request::is('configurar/estados*') ? 'active' : '' }}" href="{{ route('estados') }}"><i class="icon fa fa-circle-o"></i>Estados</a></li>
            <li><a class="treeview-item {{ Request::is('configurar/subcategorias*') ? 'active' : '' }}" href="{{ route('subcategorias.index') }}"><i class="icon fa fa-circle-o"></i>Subcategorias</a></li>
            <li><a class="treeview-item {{ Request::is('configurar/direcciones*') ? 'active' : '' }}" href="{{ route('direcciones.index') }}"><i class="icon fa fa-circle-o"></i>Direcciones</a></li>
          @endif
          </ul>
        </li>

        <li class="treeview {{ Request::is('registro/*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Registro</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">

            <li><a class="treeview-item {{ Request::is('registro/clientes*') ? 'active' : '' }}" href="{{ route('clientes.index') }}"><i class="icon fa fa-circle-o"></i>Clientes</a></li>
            <li><a class="treeview-item {{ Request::is('registro/proveedores*') ? 'active' : '' }}" href="{{ route('proveedores.index') }}"><i class="icon fa fa-circle-o"></i>Proveedores</a></li>
            <li><a class="treeview-item {{ Request::is('registro/productos*') ? 'active' : '' }}" href="{{ route('productos.index') }}"><i class="icon fa fa-circle-o"></i>Productos</a></li>
            <li><a class="treeview-item {{ Request::is('registro/empleados*') ? 'active' : '' }}" href="{{ route('empleados.index') }}"><i class="icon fa fa-circle-o"></i>Empleados</a></li>
            <li><a class="treeview-item {{ Request::is('registro/gastos*') ? 'active' : '' }}" href="{{ route('gastos.index') }}"><i class="icon fa fa-circle-o"></i>Gastos</a></li>
          </ul>
        </li>

        
        @if ($perfil==1 || $perfil==2) 
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Procesar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Ventas</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Pedidos</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Cargas</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Provisorio</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Remitos</a></li>            
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Descompuestos</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Consignación</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Confirmación</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Logística</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Monitoreo</a></li>
          </ul>
        </li>


        @endif
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Generar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">

            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Inventario</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Estadístico</a></li>
          </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Seguridad</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Usuarios</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Perfiles</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Auditoria</a></li>
          </ul>
        </li>

      </ul>