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
                      <td style="text-align: left;">{{$remisa->nombres}}</td>
                      <td style="text-align: center">{{$remisa->telefono}}</td>
                      <td style="text-align: left;">{{$remisa->direccion}}</td>
                      <td style="text-align: center">{{$remisa->fecha}}</td>
                      <td style="text-align: center">{{$remisa->fecha_activo}}</td>
                      <td style="text-align: left;">{{$remisa->ciudad}}</td>
                      <td style="text-align: center">{{$remisa->horario}}</td>
                      <td style="text-align: center">{{$remisa->forma_pago}}</td>
                      <td style="text-align: right;">{!!number_format($remisa->importe, 0, ',', '.')!!}</td>
                      <td width="10%" class="text-center">
                        <div class="btn-group">
                         
                        <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $remisa->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>
                        
                         <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $remisa->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>  

                          <button data-toggle="tooltip" data-placement="top" title="No Remisa" class="btn btn-primary noremisa"  value="{{ $remisa->id }}"><i class="m-0 fa fa-lg fa-minus"></i></button>
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
                      <td style="text-align: left;">{{$atender->nombres}}</td>
                      <td style="text-align: center">{{$atender->telefono}}</td>
                      <td style="text-align: left;">{{$atender->direccion}}</td>
                      <td style="text-align: center">{{$atender->fecha}}</td>
                      <td style="text-align: center">{{$atender->fecha_activo}}</td>
                      <td style="text-align: left;">{{$atender->ciudad}}</td>
                      <td style="text-align: center">{{$atender->horario}}</td>
                      <td style="text-align: center">{{$atender->forma_pago}}</td>
                      <td style="text-align: center">{!!number_format($atender->importe, 0, ',', '.')!!}</td>
                      <td width="10%" class="text-center">
                        <div class="btn-group">
                         
                        <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $atender->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>

                         <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $atender->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>

                          <button data-toggle="tooltip" data-placement="top" title="A Remisa" class="btn btn-primary remisa"  value="{{ $atender->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>
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
    {{--LISTADO ACTIVO  --}}
  
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
                      <td style="text-align: left;">{{$activa->nombres}}</td>
                      <td style="text-align: center">{{$activa->telefono}}</td>
                      <td style="text-align: left;">{{$activa->direccion}}</td>
                      <td style="text-align: center">{{$activa->fecha}}</td>
                      <td style="text-align: center">{{$activa->fecha_activo}}</td>
                      <td style="text-align: left;">{{$activa->ciudad}}</td>
                      <td style="text-align: center">{{$activa->horario}}</td>
                      <td style="text-align: center">{{$activa->forma_pago}}</td>
                      <td style="text-align: center">{!!number_format($activa->importe, 0,',', '.')!!}</td>
                      <td width="10%" class="text-center">
                        <div class="btn-group">
                         
                        <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $activa->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>

                         <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $activa->id }}"><i class="m-0 fa fa-lg fa-print"></i></button>
                
                        <!--<a class="btn btn-primary"  href="#"><i class="m-0 fa fa-lg fa-plus"></i></a>-->
                        <button data-toggle="tooltip" data-placement="top" title="A Remisa" class="btn btn-primary remisa"  value="{{ $activa->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>

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
                        {!!number_format($total, 0,',', '.')!!}
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
                      <td style="text-align: left;">{{$enEspera->nombres}}</td>
                      <td style="text-align: center">{{$enEspera->telefono}}</td>
                      <td style="text-align: left;">{{$enEspera->direccion}}</td>
                      <td style="text-align: center">{{$enEspera->fecha}}</td>
                      <td style="text-align: center">{{$enEspera->fecha_activo}}</td>
                      <td style="text-align: left;">{{$enEspera->ciudad}}</td>
                      <td style="text-align: center">{{$enEspera->horario}}</td>
                      <td style="text-align: center">{{$enEspera->forma_pago}}</td>
                      <td style="text-align: center">{!!number_format($enEspera->importe, 0,',', '.')!!}</td>
                      <td width="10%" class="text-center">
                        <div class="btn-group">
                       
                        <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>
                        
                       
                         <button class="btn btn-primary factura" data-toggle="modal" title="Imprimir" data-target="#ModalFactura" id="factura" value="{{ $enEspera->id }}" ><i class="m-0 fa fa-lg fa-print"></i></button>

                          @if($enEspera->id_estado == 12 || $enEspera->id_estado == 5) 
                          <button data-toggle="tooltip" data-placement="top" title="A Remisa" class="btn btn-primary disabled-btn remisa"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>
                          @else
                          <button data-toggle="tooltip" data-placement="top" title="A Remisa" class="btn btn-primary  remisa"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>
                          @endif 

                        <a  data-toggle="tooltip" ata-placement="top" title="Editar" class="btn btn-primary" href="Ventas/editar/{{$enEspera->id}}"><i class="m-0 fa fa-lg fa-pencil"></i></a>

                        <!--button data-toggle="tooltip" data-placement="top" title="activar" class="btn btn-primary activar"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-asterisk"></i></button-->   
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
                <th style="text-align: center;">Precio</th>
                <th style="text-align: right;">Importe</th>
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
  <div class="modal-dialog  modal-dialog-centered " role="document">
    <div class="modal-content">
        
      <div class="modal-header" align="text-center">
         <h5 class="modal-title" id="title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body">
        <div class="table-responsive">
          <table class="table ">
            <tbody>
              <tr>
                  <form name="form1"  action="{{ route('logistica.factura') }}">
                      <input type="hidden" name="id_venta" id="id_venta" value="0">
                      <th>Factura</th>
                      <td><input class="form-control" type="text" id="num_fact" name="num_fact" ></td>
                      <td>
   
                      <div class="col-md-12 ">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" value="1" type="radio" id="tipo" name="tipo" checked>Ver
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                           <input class="form-check-input" value="2" type="radio" id="tipo" name="tipo">Pdf
                         </label>
                       </div>
                     </div>
                    </td>
             <td >
                          <button class="btn btn-primary fact" id="btn-fact" formtarget="_blank"  type="submit" ><i class="m-0 fa fa-lg fa-print" ></i></button>
                      </td>
                   </form>
                </tr>
                <tr>
                  <form name="form1"  action="{{ route('logistica.movimiento') }}" >
                      <input type="hidden" name="id_ventam" id="id_ventam" value="0">
                      <th >Movimiento</th>
                      <td  colspan="1"></td>
                      <td>
   
                      <div class="col-md-12 ">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" value="1" type="radio" id="tipo" name="tipo" checked>Ver
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                           <input class="form-check-input" value="2" type="radio" id="tipo" name="tipo">Pdf
                         </label>
                       </div>
                     </div>
                    </td>
                      <td>
                      <button class="btn btn-primary"  formtarget="_blank"  ><i class="m-0 fa fa-lg fa-print"></i></button>
                      </td>
                   </form>
                </tr>
                <tr>
                  <form name="form1" action="{{ route('logistica.recibo') }}" >
                      <input type="hidden" name="id_ventar" id="id_ventar" value="0">
                      <th>Stikers</th> 
                      <td  colspan="1"></td>
                      <td>
   
                      <div class="col-md-12 ">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" value="1" type="radio" id="tipo" name="tipo" checked>Ver
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                           <input class="form-check-input" value="2" type="radio" id="tipo" name="tipo">Pdf
                         </label>
                       </div>
                     </div>
                    </td>
                      <td >
                      <button class="btn btn-block btn-primary btn-xs" formtarget="_blank" ><i class="m-0 fa fa-lg fa-print" ></i></button>
                      </td>
                   </form>
                </tr>
             
            </tbody>
          </table>
        </div>
   
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
          var total=0;
          var importe=0;
          $("#cliente_detalle").append(`<tr>
                                          <td style="text-align: center;">${data[0].id}</td>
                                          <td style="text-align: left;">${data[0].nombres}</td>
                                          <td style="text-align: center;">${data[0].telefono}</td>
                                          <td style="text-align: left;">${data[0].direccion}</td>
                                      </tr>`);
          //CICLO DE LOS DATOS RECIBIDOS
          $.each(data, function(l, item) {

               importes=item.cantidad*item.precio;
              // total+=importe;
            $("#productos_detalle").append(`<tr>

              <td style="text-align: left;">${item.codigo_producto}</td>
              <td style="text-align: left;">${item.descripcion}</td>
              <td style="text-align: center;">${item.cantidad}</td>
              <td style="text-align: right;">${item.precio.toLocaleString('de-DE')}</td>
              <td style="text-align: right;">${importes.toLocaleString('de-DE')}</td>
              </tr>`);
          });

            $("#productos_detalle").append(`<tr>
              <td colspan="5" style="text-align:  right;"><h5>Total: ${data[0].importe.toLocaleString('de-DE')} Gs.</h5></td>
              </tr>`);
         
           
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

              $("#res").html('La Venta fue Remisada');
              $("#res, #res-content").css("display","block");          
              
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


            $("#res").html('La Venta fue  No Remisada');
            $("#res, #res-content").css("display","block");
          
            
        }
    });

    location.reload(true);
  });
      

 
  $('.factura').click(function(){

      $('#num_fact').val("");
      $('#id_venta').val(""); 
      $('#id_ventam').val(""); 
      $('#id_ventar').val(""); 
      var id = $(this).val();  //CAPTURA EL ID  
  
      $.ajax({
        type: "GET",
        url: '{{ url('num_factura') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},

        success: function (data){
          
          $('#title').html('Pedido: ' + data[0].venta);
          $('#id_venta').val(data[0].venta); 
          $('#id_ventam').val(data[0].venta); 
          $('#id_ventar').val(data[0].venta); 

          if (data[0].factura ==2 || data[0].factura ==3){
            if(data[0].impresa ==0)
              $('#btn-fact').prop('disabled', false);
            else
               $('#btn-fact').prop('disabled', true);
          }else{
              $('#btn-fact').prop('disabled', true);
          }      
        }
  

    });
  });




  //<!-- Activar venta En Espera-->
 /* $('.activar').click(function(){
    
    var id = $(this).val();  //CAPTURA EL ID  
    console.log(id);
      $.ajax({
        type: "GET",
        url: '{{ url('activar_venta') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},
        success: function (data){4


                     
            $("#res").html('La Venta fue Activada');
            $("#res, #res-content").css("display","block");
            // $('#respActivarVenta').html('ACTIVADA');     
        }
    });

    location.reload(true);
  });*/

  
 


</script>

  
@endpush