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
                    <th>Venta</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Fecha</th>
                    <th>Fecha Activo</th>
                    <th>Ciudad</th>
                    <th>Horario</th>
                    <th>Forma Pago</th>
                    <th>Importe</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                     <!-- jgonzalez LISTADO DE VENTAS PARA REMISA-->
                  @foreach($remisas as $remisa)
                   <tr class="table-active">
                      <td>{{$remisa->id}}</td>
                      <td>{{$remisa->nombres}}</td>
                      <td>{{$remisa->telefono}}</td>
                      <td>{{$remisa->direccion}}</td>
                      <td>{{$remisa->fecha}}</td>
                      <td>{{$remisa->fecha_activo}}</td>
                      <td>{{$remisa->ciudad}}</td>
                      <td>{{$remisa->horario}}</td>
                      <td>{{$remisa->forma_pago}}</td>
                      <td>{{$remisa->importe}}</td>
                      <td width="10%" class="text-center">
                        <div class="btn-group">
                         
                        <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $remisa->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalFactura" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                        <button data-toggle="tooltip" data-placement="top" title="noremisa" class="btn btn-primary noremisa"  value="{{ $remisa->id }}"><i class="m-0 fa fa-lg fa-minus"></i></button>
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-pencil"></i></a>  
                        </div>
                      </td>
                  </tr>
                </tbody>
              </table>
            </div>
            @endforeach
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
                    <th>Venta</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Fecha</th>
                    <th>Fecha Activo</th>
                    <th>Ciudad</th>
                    <th>Horario</th>
                    <th>Forma Pago</th>
                    <th>Importe</th>
                    <th>Acciones</th>
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
                      <td>{{$enEspera->id}}</td>
                      <td>{{$enEspera->nombres}}</td>
                      <td>{{$enEspera->telefono}}</td>
                      <td>{{$enEspera->direccion}}</td>
                      <td>{{$enEspera->fecha}}</td>
                      <td>{{$enEspera->fecha_activo}}</td>
                      <td>{{$enEspera->ciudad}}</td>
                      <td>{{$enEspera->horario}}</td>
                      <td>{{$enEspera->forma_pago}}</td>
                      <td>{{$enEspera->importe}}</td>
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
      <div class="col mb-3 text-center">
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado</h3>
            </div>
            <div class="form-group col-md-2">
              <input class="form-control" type="date" id="" name="" >
            </div>
            <div class="form-group col-md-2">
              <input class="form-control" type="date" id="" name="" placeholder="ldhd">
            </div>
            <div class="form-group col-md-2">
              <!-- CIUDADES-->
              <select class="form-control read" id="ciudad" name="ciudad">
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
              <select class="form-control read" id="id_horario" name="id_horario">
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
          </div>
        </div>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>Venta</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Fecha</th>
                    <th>Fecha Activo</th>
                    <th>Ciudad</th>
                    <th>Horario</th>
                    <th>Forma Pago</th>
                    <th>Importe</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- jgonzalez LISTADO DE VENTAS ACTIVAS-->
                  <?php 
                    $total = 0;
                  ?>

                  <!-- esta es la hora actual supongo que esta ajustada al pais-->
                  {{ date("H:i") }}
                  @foreach($activas as $activa)
                   <tr 
                    @if(date("H:i") > "09:00" || date("H:i") > "11:59")
                      class="table-danger"
                    @elseif(date("H:i") > "12:00" || date("H:i") > "14:59")
                      class="table-danger"
                    @elseif(date("H:i") > "15:00" || date("H:i") > "17:59")
                      class="table-danger" 
                    @elseif(date("H:i") > "18:00:00" || date("H:i") > "20:59:59")
                      class="table-danger"
                    @elseif(date("H:i") > "21:00:00")
                      class="table-danger" 
                    @else
                      class="table-active"
                   @endif
                   >
                      <td>{{$activa->id}}</td>
                      <td>{{$activa->nombres}}</td>
                      <td>{{$activa->telefono}}</td>
                      <td>{{$activa->direccion}}</td>
                      <td>{{$activa->fecha}}</td>
                      <td>{{$activa->fecha_activo}}</td>
                      <td>{{$activa->ciudad}}</td>
                      <td>{{$activa->horario}}</td>
                      <td>{{$activa->forma_pago}}</td>
                      <td>{{$activa->importe}}</td>
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
        <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
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

    $('#productos_detalle').html(''); //LIMPIA EL MODAL

    $('#ModalProductos').modal('show'); //ABRE EL MODAL
    
   
      $.ajax({
        type: "GET",
        url: '{{ url('detalle_venta') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},

        success: function (data){

          //CICLO DE LOS DATOS RECIBIDOS
          $.each(data, function(l, item) {

            $("#productos_detalle").append('<tr><td>'+item.codigo_producto+'</td><td>'+item.descripcion+'</td><td>'+item.cantidad+'</td><td>'+item.precio+'</td><td><div class="btn-group"><a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-print"></i></a><a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-file"></i></a><a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-times"></i></a></div></td></tr>');
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


</script>

  
@endpush