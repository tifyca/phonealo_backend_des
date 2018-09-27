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
  <div id="remisa" class="col-12 d-none" >
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

                  <tr id="respRemisa" >
                    
                  </tr>
          
                </tbody>
              </table>
            </div>
      </div>
    </div>
  </div>
  {{--  --}}
  {{-- TABLA POR ATENDER --}}
  {{-- ESTA TABLA SOLO APARECE CUANDO HAY VENTAS POR ATENDER --}}
  @if(!empty($enEsperas))
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
                    @if($enEspera->id_estado==5)
                      class="table-warning"
                    @elseif($enEspera->id_estado==1 && $enEspera->status_v==11)
                      class="table-primary"
                    @elseif($enEspera->id_estado==11 && $enEspera->status_v==11)
                      class="table-primary"
                    @elseif($enEspera->id_estado==1 && $enEspera->status_v=='')
                    
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

                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalFactura" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
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
              <select class="form-control read" id="id_categoria" name="id_categoria">
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
                  @foreach($activas as $activa)
                   <tr  
                    @if($activa->id_estado==5)
                      class="table-warning"
                    @elseif($activa->id_estado==1 && $activa->status_v==11)
                      class="table-primary"
                    @elseif($activa->id_estado==11 && $activa->status_v==11)
                      class="table-primary"
                    @elseif($activa->id_estado==1 && $activa->status_v=='')
                    
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

                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalFactura" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
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
            <input class="form-control" type="text" id="" name="" placeholder="0987654">
          </div>
          <div class="tile-footer col-md-12 text-center ">
            <button class="btn btn-primary" type="submit">Generar</button>
          </div>
        </div>
      </div>
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

            $("#productos_detalle").append('<tr><td>'+item.id_producto+'</td><td>'+item.descripcion+'</td><td>'+item.cantidad+'</td><td>'+item.precio+'</td><td><div class="btn-group"><a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-print"></i></a><a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-file"></i></a><a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-times"></i></a></div></td></tr>');
          });
        }

    });


  });

//<!-- Agregar Remisa -->

  $('.remisa').click(function(){

    $('#remisa').removeClass('d-none');
    var id = $(this).val();  //CAPTURA EL ID  
    console.log(id);
      $.ajax({
        type: "GET",
        url: '{{ url('agregar_remisa') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},

        success: function (data){
          
          $("#respRemisa").html(`
            <td>${data[0].id}</td>
            <td>${data[0].nombres}</td>
            <td>${data[0].telefono}</td>
            <td>${data[0].direccion}</td>
            <td>${data[0].fecha}</td>
            <td>${data[0].fecha_activo}</td>
            <td>${data[0].ciudad}</td>
            <td>${data[0].horario}</td>
            <td>${data[0].forma_pago}</td>
            <td>${data[0].importe}</td>
            <td width="10%" class="text-center">
            <div class="btn-group">
                <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="${data[0].id}"><i class="m-0 fa fa-lg fa-eye"></i></button>

                <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                {{-- se retira de la remisa --}}
                <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-minus"></i></a>
              </div>
            </td>
            `);

         
          
        }

    });


  });

function codeAddress() {
            alert('ok');
        }

//html.onload = codeAddress;
</script>

  
@endpush