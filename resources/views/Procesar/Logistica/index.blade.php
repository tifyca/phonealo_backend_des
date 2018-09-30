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
  {{-- TABLA DE REMITOS --}}
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
              <table class="table table-hover table-bordered " id="sampleTable">
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
                   <tr class="table-active">
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
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-pencil"></i></a>  
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
  
  {{-- TABLA POR ATENDER --}}
  {{-- ESTA TABLA SOLO APARECE CUANDO HAY VENTAS POR ATENDER --}}
  @if(count($enEsperas) > 0)
   <div class="col-12" >
    <div class="tile ">
      <h3 class="tile-title text-center text-md-left"> Ventas por Atender </h3>
      <div class="tile-body ">
        <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
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
                    @if($enEspera->id_estado = '1')
                      class="table-active"
                    @elseif($enEspera->id_estado = '5')
                      class="table-primary"
                    @elseif($enEspera->id_estado = '11')
                      class="table-secondary"
                    @elseif($enEspera->id_estado = '12')
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
                        <button data-toggle="tooltip" data-placement="top" title="aremisa" class="btn btn-primary remisa"  value="{{ $enEspera->id }}"><i class="m-0 fa fa-lg fa-plus"></i></button>
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-pencil"></i></a>  
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
      <!--Formulario para filtros -->
      <form action="{{ route('logistica.submit') }} " method="POST">
        {{ csrf_field() }}
      <div class="col mb-3 text-center">
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado</h3>
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
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
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

                  <!-- esta es la hora actual supongo que esta ajustada al pais-->
                  {{-- date("H:i") --}}
                  @foreach($activas as $activa)
                   <tr id="{{$activa->id}}"   
                    @if(date("H:i") > "09:00" || date("H:i") > "11:59")
                      class="table-danger respFiltro"
                    @elseif(date("H:i") > "12:00" || date("H:i") > "14:59")
                      class="table-danger respFiltro"
                    @elseif(date("H:i") > "15:00" || date("H:i") > "17:59")
                      class="table-danger respFiltro" 
                    @elseif(date("H:i") > "18:00:00" || date("H:i") > "20:59:59")
                      class="table-danger respFiltro"
                    @elseif(date("H:i") > "21:00:00")
                      class="table-danger respFiltro" 
                    @else
                      class="table-active respFiltro"
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

                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-pencil"></i></a>  
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
                <th style="text-align: center;">Telefono</th>
                <th style="text-align: center;">Direccion</th>
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
                <th style="text-align: center;">Accion</th>
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
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
          <form name="form1" action="{{ route('logistica.factura') }}"  accept-charset="UTF-8" method="GET"  enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row d-flex justify-content-center">
           
          <div class="form-group col-md-6">
            <label for="">Nro. Factura</label>
            <input class="form-control" type="text" id="num_fact" name="num_fact" >
          </div>
          <div class="tile-footer col-md-12 text-center ">
            <button class="btn btn-primary" id="btn-generar" type="submit">Generar</button>
          </div>
        </div>
    
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
              <td style="text-align: center;"><div class="btn-group"><a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
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
          $('#num_fact').val(data.id);    
        }

    });
  });

  //<!-- Filtros -->
  $('.ciudad').change(function(){

      var id = $(this).val();  //CAPTURA EL ID
      console.log(id);
      $.ajax({
        type: "GET",
        url: '{{ url('filtro_ciudad') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},
        success: function (data){
          console.log(data);
          
        }
      });
  
  });

  $('.horario').change(function(){

      var id = $(this).val();  //CAPTURA EL ID
      console.log(id);
      $.ajax({
        type: "GET",
        url: '{{ url('filtro_horario') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},
        success: function (data){
            console.log(data);
            data.forEach( function(valor, indice, array) {
              console.log("En el índice " + indice + " hay este valor: " + valor[+indice]);
            });
        }
          
      });

  });
 


</script>

  
@endpush