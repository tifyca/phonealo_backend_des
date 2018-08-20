  @extends ('layouts.header')
  @section('content')

@section('icono_titulo', 'fa-home')
@section('titulo', 'Inicio')
@section('descripcion', '')

@section('display_new','d-none')  @section('link_edit', '') 
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash') 
{{--   <div class="row">
  	<div class="col-md-6 col-lg-3">
  		<div class="widget-small primary coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
  			<div class="info">
  				<h4>Ventas</h4>
  				<p><b>150</b></p>
  			</div>
  		</div>
  	</div>
  	<div class="col-md-6 col-lg-3">
  		<div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
  			<div class="info">
          <h4>Flujo de Caja</h4>
          <p><b>80</b></p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Cobrado</h4>
          <p><b>30</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
        <div class="info">
          <h4>Recibido</h4>
          <p><b>10</b></p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
        <div class="info">
          <h4>Costos</h4>
          <p><b>12</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Gastos del Día</h4>
          <p><b>30</b></p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Rechazado</h4>
          <p><b>30</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small primary coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
        <div class="info">
          <h4>Delivery</h4>
          <p><b>150</b></p>
        </div>
      </div>
    </div>
  
  </div>
  <div class="row">
  	<div class="col-md-6">
  		<div class="tile">
  			<h3 class="tile-title">Remitos</h3>
        <table class="table table-hover table-bordered" id="sampleTable">
         <thead>
          <tr>
           <th>Remito</th>
           <th>Delivery</th>
           <th>Importe</th>
           <th>Fecha</th>
           <th></th>
         </tr>
       </thead>
       <tr>

        <th>13427</th>
        <th>Oficina </th>
        <th>175000</th>
        <th>2018-08-13</th>
        <th>
          <a href="#" title="Ver ficha de Registro" class="uk-icon-link" uk-icon="icon: file" contextmenu="Ver Registro"><i class="fa fa-search "></i }></a> 
           <a href="#" title="Editar" class="uk-icon-link" uk-icon="icon: pencil" contextmenu="Editar Registro"><i class="fa fa-edit "></i }></a>                   
           </th>
         </tr>

       </table>
       
       
     </div>
   </div>
     <div class="col-md-6 col-lg-3">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
        <div class="info">
          <h4>Devuelto</h4>
          <p><b>80</b></p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Faltantes</h4>
          <p><b>30</b></p>
        </div>
      </div>
    </div>   
 </div>


</div> --}}
@endsection