<?php   
   @session_start();
   $_SESSION["user"]        = Auth::user()->id;
   $_SESSION["perfil"]      = Auth::user()->perfil;
   $_SESSION["altonivel"]   = Auth::user()->alto_nivel;
   $_SESSION["empleados"]   = Auth::user()->empleados;
   $_SESSION["contratados"] = Auth::user()->contratados;
   $_SESSION["obreros"]     = Auth::user()->obreros;
   $_SESSION["jubilados"]   = Auth::user()->jubilados;
   $nombre = Auth::user()->name;
   $perfil = Auth::user()->rol_id;
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta name="description" content="ERPG">
    <!-- Twitter meta-->
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="cache-control" content="must-revalidate" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" /> 
    <meta name="csrf-token" content="{{ csrf_token() }}">   
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="ERPG">
    <meta property="og:url" content="http://localhost/dbeneficiot">
    <meta property="og:description" content="ERPG">
    <title>Conexpar - Gestión Administrativa </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="{{ route('home') }}">ERPG</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
          
        </li>
        <!--Notification Menu-->
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> Cerrar Sesion</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
</form> 
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">

        <div class="d-flex justify-content-center flex-wrap">
          <div class="col-12 text-center p-0">
            <img class="app-sidebar__user-avatar avatar img-fluid"  src="{{ asset('img/logo2.png') }}" alt="User Image">
          </div>
          <div class="col-12 text-center mt-3">
            <p class="app-sidebar__user-name">{{ $nombre }}</p>
            <i class="app-sidebar__user-name">Perfil</i>
          </div>
        </div>
        
      </div>
      @include('layouts.menu')
    </aside>
    <main class="app-content">
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">

          {{-- ACCIONES  --}}
          <div class="btn-group">
            <a class="btn btn-primary @yield('display_back')" href="@yield('link_back')"><i class="m-0 fa fa-lg fa-arrow-left"></i></a>
          </div>
          {{-- \\\\\\\\\ --}}

        </ul>

        <div>
          {{-- TITULO DE CABECERA DE SECCION --}}
          <h1><i class="fa @yield('icono_titulo')"></i> @yield('titulo')</h1>
          <p>@yield('descripcion')</p>
          {{-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
        </div>
        
        <ul class="app-breadcrumb breadcrumb">

          {{-- ACCIONES  --}}
          <div class="btn-group">
            <a class="btn btn-primary @yield('display_new')" href="@yield('link_new')"><i class="m-0 fa fa-lg fa-plus"></i></a>
            <a class="btn btn-primary @yield('display_edit')" href="@yield('link_edit')"><i class="m-0 fa fa-lg fa-edit"></i></a>
            <a class="btn btn-primary @yield('display_trash')" href="@yield('link_trash')"><i class="m-0 fa fa-lg fa-trash"></i></a>
          </div>
          {{-- \\\\\\\\\ --}}

        </ul>

      </div>
      @yield('content')
      <div class="row">
      </div>
    </main>
    <!-- Essential javascripts for application to work-->

@yield('javascript')

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('js/plugins/pace.min.js') }}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{ asset('js/plugins/chart.js') }}"></script>
    <script type="text/javascript">
      var data = {
      	labels: ["Enero", "Febrero", "Marzo", "Abril", "May"],
      	datasets: [
      		{
      			label: "My First dataset",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56]
      		},
      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86]
      		}
      	]
      };
      var pdata = [
      	{
      		value: 300,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Complete"
      	},
      	{
      		value: 50,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "In-Progress"
      	}
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
      <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

<script type="text/javascript">
    $('.datepicker').datepicker({
    format: "yyyy-mm-dd",
    language: "es"
});
 </script> 

     @stack('scripts')
  </body>
</html>