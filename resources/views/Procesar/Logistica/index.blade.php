@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Logistica')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row" >
  {{-- TABLA DE REMISAS --}}
  {{-- ESTA LISTA SE MANTIENE OCULTA, SOLO APARECE CUANDO AÑADO UNA VENTA A REMISA --}}
  @if(count($remisas) > 0)
  <div class="col-12" >
    <div class="tile ">
      <div class="d-flex justify-content-end row">
        <div class="col">
          <h3 class="tile-title text-center text-md-left"> Remisa </h3>
        </div>
        <div class="col-4 text-right">
          <a href="{{ route('logistica.remisa') }}" class="btn btn-primary"><i class="m-0 fa fa-lg fa-sign-out"></i>Remisa</a>
        </div>
      </div>
      <div class="tile-body ">
        <div class="table-responsive">
              <table class="table table-hover table-bordered " id="remisas-list">
                <thead>
                  <tr>
                    <th style="text-align: center">Venta</th>
                    <th style="text-align: center">Cliente</th>
                    <th style="text-align: center">Teléfono</th>
                    <th style="text-align: center">Dirección</th>
                    <th style="text-align: center">Fecha</th>
                    <th style="text-align: center">Fecha Activo</th>
                    <th style="text-align: center">Ciudad</th>
                    <th style="text-align: center">Horario</th>
                    <th style="text-align: center">Forma Pago</th>
                    <th style="text-align: right;">Importe</th>
                    <th style="text-align: center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                     <!-- jgonzalez LISTADO DE VENTAS PARA REMISA-->
                  @foreach($remisas as $remisa)
                   <tr class="table-success">
                      <td style="text-align: center">{{$remisa->id}}</td>
                      <td style="text-align: center">{{$remisa->nombres}}</td>
                      <td style="text-align: center">{{$remisa->telefono}}</td>
                      <td style="text-align: center">{{$remisa->direccion}}</td>
                      <td style="text-align: center">{{$remisa->fecha}}</td>
                      <td style="text-align: center">{{$remisa->fecha_activo}}</td>
                      <td style="text-align: center">{{$remisa->ciudad}}</td>
                      <td style="text-align: center">{{$remisa->horario}}</td>
                      <td style="text-align: center">{{$remisa->forma_pago}}</td>
                      <td style="text-align: right;">{{$remisa->importe}}</td>
                      <td width="10%" class="text-center">
                        <div class="btn-group">
                         
                        <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $remisa->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>
                        
                        @if($remisa->factura==2 || $remisa->factura==3) 
                         <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $remisa->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>
                        @else
                         <button class="btn btn-primary disabled-btn factura" data-toggle="modal" data-target="#ModalFactura" id="factura" value="{{ $remisa->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>
                        @endif  

                        <button data-toggle="tooltip" data-placement="top" title="noremisa" class="btn btn-primary noremisa"  value="{{ $remisa->id }}"><i class="m-0 fa fa-lg fa-minus"></i></button>
                        <a  data-toggle="tooltip" ata-placement="top" title="Editar" class="btn btn-primary" href="Ventas/editar/{{$remisa->id}}"><i class="m-0 fa fa-lg fa-pencil"></i></a>   
                        </div>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            
      </div>
    </div>
  </div>
  @endif

  <div>
    <!--Formulario para filtros -->
      <form action="{{ route('logistica.submit') }} " method="POST">
        {{ csrf_field() }}
      <div class="col mb-3 text-center">
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Busqueda</h3>
            </div>
            
            <div class="form-group col-md-2">
              <input class="form-control " type="date" id="fecha1" name="fecha1">
            </div>
            <div class="form-group col-md-2">
              <input class="form-control" type="date" id="fecha2" name="fecha2">
            </div>
            <div class="form-group col-md-2">
              <!-- CIUDADES-->
              <select class="form-control read " id="ciudad" name="id_ciudad">
                <option value="">Ciudad</option>
                  @foreach($ciudades as $ciudad)
                    <option value="{{$ciudad->id}}" 
                      @if($ciudad->id==0) 
                        selected=""
                      @endif>
                    {{$ciudad->ciudad}}</option>
                  @endforeach
              </select>
            </div>
             <div class="form-group col-md-2">
              <!-- HORARIOS-->
              <select class="form-control read " id="horario" name="id_horario">
                <option value="">Horarios</option>
                  @foreach($horarios as $horario)
                    <option value="{{$horario->id}}" 
                      @if($horario->id==0) 
                        selected=""
                      @endif>
                    {{$horario->horario}}</option>
                  @endforeach
              </select>
              </div>
              <!-- boton filtrar -->
              <div >
                <input type="submit"class="btn btn-primary" value="Filtrar">      
              </div>
          </div>
        </div>
        </form>
        <!---->
  </div>

    {{-- TABLA POR ATENDER --}}
  {{-- ESTA TABLA SOLO APARECE CUANDO HAY VENTAS POR ATENDER --}}
  @if(count($xatender) > 0)
   <div class="col-12" >
    <div class="tile ">
      <h3 class="tile-title text-center text-md-left"> Ventas por Atender </h3>
      <div class="tile-body ">
        <div class="table-responsive">
              <table class="table table-hover table-bordered " id="xatender-list">
                <thead>
                  <tr>
                    <th style="text-align: center">Venta</th>
                    <th style="text-align: center">Cliente</th>
                    <th style="text-align: center">Teléfono</th>
                    <th style="text-align: center">Dirección</th>
                    <th style="text-align: center">Fecha</th>
                    <th style="text-align: center">Fecha Activo</th>
                    <th style="text-align: center">Ciudad</th>
                    <th style="text-align: center">Horario</th>
                    <th style="text-align: center">Forma Pago</th>
                    <th style="text-align: center">Importe</th>
                    <th style="text-align: center">Acciones</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- jgonzalez LISTADO DE VENTAS EN ATENDER-->
                  
                  @foreach($xatender as $atender)
                   <tr class="table-danger">
                      <td style="text-align: center">{{$atender->id}}</td>
                      <td style="text-align: center">{{$atender->nombres}}</td>
                      <td style="text-align: center">{{$atender->telefono}}</td>
                      <td style="text-align: center">{{$atender->direccion}}</td>
                      <td style="text-align: center">{{$atender->fecha}}</td>
                      <td style="text-align: center">{{$atender->fecha_activo}}</td>
                      <td style="text-align: center">{{$atender->ciudad}}</td>
                      <td style="text-align: center">{{$atender->horario}}</td>
                      <td style="text-align: center">{{$atender->forma_pago}}</td>
                      <td style="text-align: center">{{$atender->importe}}</td>
                      <td width="10%" class="text-center">
                        <div class="btn-group">
                         
                        <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $atender->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>

                        @if($atender->factura==2 || $atender->factura==3) 
                         <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $atender->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>
                        @else
                         <button class="btn btn-primary disabled-btn factura" data-toggle="modal" data-target="#ModalFactura" id="factura" value="{{ $atender->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>
                        @endif  
                        <button data-toggle="tooltip" data-placement="top" title="aremisa" class="btn btn-primary remisa"  value="{{ $atender->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>
                        <a  data-toggle="tooltip" ata-placement="top" title="Editar" class="btn btn-primary" href="Ventas/editar/{{$atender->id}}"><i class="m-0 fa fa-lg fa-pencil"></i></a>   
                        </div>
                      </td>
                    </tr>
                    
                  @endforeach

                </tbody>
              </table>
            </div>
      </div>
    </div>
  </div>
  @endif
  {{--  --}}
  {{--  --}}


  {{-- TABLA EN ESPERA --}}
  {{-- ESTA TABLA SOLO APARECE CUANDO HAY VENTAS EN ESPERA --}}
  @if(count($enEsperas) > 0)
   <div class="col-12" >
    <div class="tile ">
      <h3 class="tile-title text-center text-md-left"> Ventas en Espera </h3>
      <div class="tile-body ">
        <div class="table-responsive">
              <table class="table table-hover table-bordered " id="esperas-list">
                <thead>
                  <tr>
                    <th style="text-align: center">Venta</th>
                    <th style="text-align: center">Cliente</th>
                    <th style="text-align: center">Teléfono</th>
                    <th style="text-align: center">Dirección</th>
                    <th style="text-align: center">Fecha</th>
                    <th style="text-align: center">Fecha Activo</th>
                    <th style="text-align: center">Ciudad</th>
                    <th style="text-align: center">Horario</th>
                    <th style="text-align: center">Forma Pago</th>
                    <th style="text-align: center">Importe</th>
                    <th style="text-align: center">Acciones</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- jgonzalez LISTADO DE VENTAS EN ESPERA-->
                  
                  @foreach($enEsperas as $enEspera)
                   <tr 
                    @if($enEspera->id_estado == '5')
                      class="table-info"
                    @elseif($enEspera->id_estado == '12')
                      class="table-light"
                    @endif 
                    >
                      <td style="text-align: center">{{$enEspera->id}}</td>
                      <td style="text-align: center">{{$enEspera->nombres}}</td>
                      <td style="text-align: center">{{$enEspera->telefono}}</td>
                      <td style="text-align: center">{{$enEspera->direccion}}</td>
                      <td style="text-align: center">{{$enEspera->fecha}}</td>
                      <td style="text-align: center">{{$enEspera->fecha_activo}}</td>
                      <td style="text-align: center">{{$enEspera->ciudad}}</td>
                      <td style="text-align: center">{{$enEspera->horario}}</td>
                      <td style="text-align: center">{{$enEspera->forma_pago}}</td>
                      <td style="text-align: center">{{$enEspera->importe}}</td>
                      <td width="10%" class="text-center">
                        <div class="btn-group">
                       
                        <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>
                        
                        @if($enEspera->factura==2 || $enEspera->factura==3) 
                         <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $enEspera->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>
                        @else
                         <button class="btn btn-primary disabled-btn factura" data-toggle="modal" data-target="#ModalFactura" id="factura" value="{{ $enEspera->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>
                        @endif 

                        @if($enEspera->id_estado == 12 || $enEspera->id_estado == 5) 
                        <button data-toggle="tooltip" data-placement="top" title="aremisa" class="btn btn-primary disabled-btn remisa"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>
                        @else
                        <button data-toggle="tooltip" data-placement="top" title="aremisa" class="btn btn-primary  remisa"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>
                        @endif 

                        <a  data-toggle="tooltip" ata-placement="top" title="Editar" class="btn btn-primary" href="Ventas/editar/{{$enEspera->id}}"><i class="m-0 fa fa-lg fa-pencil"></i></a>

                        <button data-toggle="tooltip" data-placement="top" title="activar" class="btn btn-primary activar"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-asterisk"></i></button>   
                        </div>
                      </td>
                    </tr>
                    
                  @endforeach

                </tbody>
              </table>
            </div>
      </div>
    </div>
  </div>
  @endif
  {{--  --}}
  {{--  --}}
  
  <div class="col-12">
    <div class="tile">
      <div class="col mb-3 text-center">
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado</h3>
            </div>
          </div>
        </div>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="activas-list">
                <thead>
                  <tr>
                    <th style="text-align: center">Venta</th>
                    <th style="text-align: center">Cliente</th>
                    <th style="text-align: center">Teléfono</th>
                    <th style="text-align: center">Dirección</th>
                    <th style="text-align: center">Fecha</th>
                    <th style="text-align: center">Fecha Activo</th>
                    <th style="text-align: center">Ciudad</th>
                    <th style="text-align: center">Horario</th>
                    <th style="text-align: center">Forma Pago</th>
                    <th style="text-align: center">Importe</th>
                    <th style="text-align: center">Acciones</th>
                  </tr>
                </thead>
                <tbody id="ventaActiva">
                  <!-- jgonzalez LISTADO DE VENTAS ACTIVAS-->
                  <?php 
                    $total = 0;
                  ?>

                  
                  @foreach($activas as $activa)
                   <tr 
                   @if($activa->id_estado == '1')
                      class="table-active"
                    @elseif($activa->id_estado == '11')
                      class="table-warning"
                    @endif 
                   >
                      <td style="text-align: center">{{$activa->id}}</td>
                      <td style="text-align: center">{{$activa->nombres}}</td>
                      <td style="text-align: center">{{$activa->telefono}}</td>
                      <td style="text-align: center">{{$activa->direccion}}</td>
                      <td style="text-align: center">{{$activa->fecha}}</td>
                      <td style="text-align: center">{{$activa->fecha_activo}}</td>
                      <td style="text-align: center">{{$activa->ciudad}}</td>
                      <td style="text-align: center">{{$activa->horario}}</td>
                      <td style="text-align: center">{{$activa->forma_pago}}</td>
                      <td style="text-align: center">{{$activa->importe}}</td>
                      <td width="10%" class="text-center">
                        <div class="btn-group">
                         
                        <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $activa->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>

                         @if($activa->factura==2 || $activa->factura==3) 
                         <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $activa->id }}"><i class="m-0 fa fa-lg fa-print"></i></button>
                        @else
                         <button class="btn btn-primary disabled-btn factura" data-toggle="modal" data-target="#ModalFactura" id="factura" value="{{ $activa->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>
                        @endif 
                        <!--<a class="btn btn-primary"  href="#"><i class="m-0 fa fa-lg fa-plus"></i></a>-->
                        <button data-toggle="tooltip" data-placement="top" title="aremisa" class="btn btn-primary remisa"  value="{{ $activa->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>

                        <a  data-toggle="tooltip" ata-placement="top" title="Editar" class="btn btn-primary" href="Ventas/editar/{{$activa->id}}"><i class="m-0 fa fa-lg fa-pencil"></i></a> 
                        </div>
                      </td>
                    </tr>
                    <?php 
                      $total += $activa->importe;
                    ?>
                  @endforeach
                    <tr>
                    <td colspan="9" class="text-right">
                      <h4>Total:</h4>
                    </td>
                    <td colspan="2">
                      <h4>
                        {{ $total }}
                      </h4>
                    </td>
                  </tr>
                 
                </tbody>
              </table>

            </div>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalle de Venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center;">Venta</th>
                <th style="text-align: center;">Cliente</th>
                <th style="text-align: center;">Teléfono</th>
                <th style="text-align: center;">Dirección</th>
              </tr>
            </thead>
            <tbody id="cliente_detalle">
              
            </tbody>
          </table>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center;">Código</th>
                <th style="text-align: center;">Producto</th>
                <th style="text-align: center;">Cantidad</th>
                <th style="text-align: right;">Precio</th>
              </tr>
            </thead>
            <tbody id="productos_detalle">
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
{{--  --}}
<div class="modal fade" id="ModalFactura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
          <form name="form1" action="{{ route('logistica.factura') }}"  accept-charset="UTF-8" method="GET"  enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body">
        <div class="table-responsive">
          <table class="table ">
            <tbody>
              <tr>
                  <th>Factura</th>
                  <td><input class="form-control" type="text" id="num_fact" name="num_fact" ></td>
                  <td >
                   <button class="btn btn-primary" id="btn-generar" type="submit"><i class="m-0 fa fa-lg fa-print"></i></button>
                  </td>
                </tr>
                <tr>
                  <th >Movimiento</th>
                  <td  colspan="1"></td>
                  <td>
                  
                  <button class="btn btn-primary" id="btn-generar" type="submit"><i class="m-0 fa fa-lg fa-print"></i></button>
                  </td>
                </tr>
                <tr>
                  <th>Recibo</th> 
                   <td  colspan="1"></td>
                    <td >
                   <button class="btn btn-primary" id="btn-generar" type="submit"><i class="m-0 fa fa-lg fa-print"></i></button>
              
                  </td>
               </tr>
             
            </tbody>
          </table>
        </div>
  
            <input type="hidden" name="id_venta" id="id_venta" value="0">
          
    
    
    </form>
      </div>

</div>
{{--  --}}


@endsection

@push('scripts')

<script type="text/javascript">
  
//<!-- Detalle de Venta - Vista rapida de productos en la Venta -->
  $('.detalle').click(function(){

    var id = $(this).val();  //CAPTURA EL ID
    $('#cliente_detalle').html(''); //LIMPIA EL MODAL
    $('#productos_detalle').html(''); //LIMPIA EL MODAL

    $('#ModalProductos').modal('show'); //ABRE EL MODAL
    
   
      $.ajax({
        type: "GET",
        url: '{{ url('detalle_venta') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},

        success: function (data){
          console.log(data);
          $("#cliente_detalle").append(`<tr>
                                          <td style="text-align: center;">${data[0].id}</td>
                                          <td style="text-align: center;">${data[0].nombres}</td>
                                          <td style="text-align: center;">${data[0].telefono}</td>
                                          <td style="text-align: center;">${data[0].direccion}</td>
                                      </tr>`);
          //CICLO DE LOS DATOS RECIBIDOS
          $.each(data, function(l, item) {

            $("#productos_detalle").append(`<tr>

              <td style="text-align: center;">${item.codigo_producto}</td>
              <td style="text-align: center;">${item.descripcion}</td>
              <td style="text-align: center;">${item.cantidad}</td>
              <td style="text-align: right;">${item.precio}</td>
              </tr>`);
          });
        }

    });


  });

  //<!-- Agregar a Remisa -->
  $('.remisa').click(function(){
    
    var id = $(this).val();  //CAPTURA EL ID  
    console.log(id);
      $.ajax({
        type: "GET",
        url: '{{ url('agregar_remisa') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},
        success: function (data){
          
             $('#respAgregarRemisa').html('REMISADO');     
        }
    });

    location.reload(true);
  });

  //<!-- Quitar de  Remisa -->
  $('.noremisa').click(function(){
    
    var id = $(this).val();  //CAPTURA EL ID  
    console.log(id);
      $.ajax({
        type: "GET",
        url: '{{ url('quitar_remisa') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},
        success: function (data){
          
             $('#respQuitarRemisa').html('NO REMISADO');     
        }
    });

    location.reload(true);
  });
      

  $('.factura').click(function(){

      var id = $(this).val();  //CAPTURA EL ID  
  
      $.ajax({
        type: "GET",
        url: '{{ url('num_factura') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},

        success: function (data){
          console.log(data);
          $('#num_fact').val(data[0].id_venta); 
          $('#id_venta').val(data[0].id_venta);    
        }

    });
  });

  $('#btn-generar').submit(function(e) { 
    e.preventDefault(); 
    console.log('aqui');
    // Coding 
    $('#ModalFactura').modal('hide'); 
    return false; 
}); 

  //<!-- Activar venta En Espera-->
  $('.activar').click(function(){
    
    var id = $(this).val();  //CAPTURA EL ID  
    console.log(id);
      $.ajax({
        type: "GET",
        url: '{{ url('activar_venta') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},
        success: function (data){
          
             $('#respActivarVenta').html('ACTIVADA');     
        }
    });

    location.reload(true);
  });

  
 


</script>

  
@endpush