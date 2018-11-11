 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Cobro de Remitosss')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', route('caja.remitos', ['caja' => $caja->id]))
@section('display_new','d-none')  @section('link_new',  '') 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row">
  <div class="col-12 col-md-7">
    <div class="tile">
      <div class="row d-flex justify-content-between">
        <div class="col">
          <h3 class="tile-title text-center text-md-left">Ventas </h3>
        </div>
       {{--  <div class="col-4 text-right">
           <a  class="btn btn-primary open_modal" href="" ><i class="fa m-0 fa-check"  ></i> Confirmar Todo</a>
        </div> --}}
      </div>       
        <div class="tile-body">
            <table class="table">
              <thead>
                <tr >
                  <th class="text-center" >N° Venta</th>
                  {{-- <th class="text-center" >Cliente</th> --}}
                  {{-- <th class="text-center" >Teléfono</th> --}}
                  <th class="text-center" >Importe</th>
                  <th class="text-center" >Estado</th>
                  <th class="text-center"  width="10%">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($remitosVentas as $venta)
                <tr>
                  <td class="text-center">{{ $venta->id_venta }}</td>
                  {{-- <td class="text-center">{{ $venta->nombre_cliente }}</td> --}}
                  {{-- <td class="text-center">{{ $venta->telefono }}</td>                   --}}
                  <td class="text-center">
                    @php
                      $suma = 0;
                    @endphp
                    @foreach ($importe_venta as $importe)
                      @if( $importe->id_venta == $venta->id_venta )
                        @php
                          $suma += $importe->precio*$importe->cantidad;                          
                        @endphp
                      @endif
                    @endforeach                
                    {!!number_format($suma, 0, ',', '.')!!}
                  </td>
                  <td class="text-center">{{ $venta->estado }}</td>
                  <td class="text-center">
                    {{-- <div class="btn-group"> --}}
                     {{--  <a data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary open_modal" href="" ><i class="fa m-0 fa-edit"  ></i></a> --}}
                      {{-- <a  data-placement="top" title="Confirmar" class="btn btn-primary confirm-delete" href="" data-toggle="modal" data-target="#Confirmar"  data-placement="top" title="Confirmar"><i class="fa m-0 fa-check"></i></a>  --}}
                      {{-- <a data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary confirm-delete" href="" ><i class="fa m-0 fa-times"></i></a> --}}
                    {{-- </div> --}}
                    <div class="btn-group">                    
                      <a class="btn btn-primary boton-accion-venta" data-toggle="collapse" href="#collapseExample{{ $venta->id_venta }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $venta->id_venta }}" data-title="tooltip" title="Detalles"><i class="m-0 fa fa-eye"></i>
                      </a> 
                     {{--  <a data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary open_modal" href="" ><i class="fa m-0 fa-edit"  ></i></a> --}}                 
                    {{--   <button class="btn btn-primary" type="submit" name="accion" value="devolver_venta" data-id="{{ $venta->id_venta }}" data-title="tooltip" title="Devolver">
                        <i class="fa fa-share-square-o"></i>
                      </button>
                      <button class="btn btn-primary" type="submit" name="accion" value="confirmar_venta" data-id="{{ $venta->id_venta }}" data-title="tooltip" title="Confirmar">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                      </button>
                      <button class="btn btn-primary" type="submit" name="accion" value="rechazar_venta" data-id="{{ $venta->id_venta }}" data-title="tooltip" title="Rechazar" data-target="#ModalNota{{ $venta->id_venta }}" data-toggle="modal">
                        <i class="fa fa-ban"></i>
                      </button>            --}}
                    </div>
                  </td>
                </tr>      
                @endforeach              
              </tbody>
            </table>
             @foreach ($remitosVentas as $venta)
              <div class="collapse table-responsive px-4" id="collapseExample{{ $venta->id_venta }}" >
                <div class="row content-justify-center">
                  <div class="col col-md-8 p-0">
                    <h5 class="modal-title" id="exampleModalLabel{{ $venta->id_venta }}">
                      Productos - Venta #{{ $venta->id_venta }}
                    </h5>
                    <div class="row content-justify-start">
                      <div class="col col-md-5 pr-0">
                        <h6>Cliente:</h6> {{ $venta->nombre_cliente }}
                      </div>
                      <div class="col col-md-4 pl-0">
                        <h6>Téléfono:</h6> {{ $venta->telefono }}
                      </div>
                      <div class="col col-md-3 pl-0">
                        <h6>F. Pago:</h6> {{ $venta->forma_pago }}
                      </div>
                    </div>                                        
                  </div>
                  <div class="col col-md-4 pr-0 pl-1 text-right">
                    <form class="btn-group" method="post" action="{{ route('remitos.update', $venta->id_venta) }}">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }} 
                      {{-- @if ( $venta->v_id_estado <> 8 && $venta->v_id_estado <> 1)                                             --}}
                      @if ( $venta->dr_id_estado == 1)                                            
                      <button class="btn btn-primary" type="submit" name="accion" value="devolver_venta" data-id="{{ $venta->id_venta }}" data-title="tooltip" title="Devolver">
                        <i class="fa fa-share-square-o"></i>
                      </button>
                     {{--  <button class="btn btn-primary" type="submit" name="accion" value="confirmar_venta" data-id="{{ $venta->id_venta }}" data-title="tooltip" title="Confirmar">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                      </button>  --}}
                      <button class="btn btn-primary" type="button" name="accion" value="confirmar_venta" data-id="{{ $venta->id_venta }}" data-title="tooltip" title="Confirmar" data-target="#Confirmar{{ $venta->id_venta }}" data-toggle="modal">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                      </button>
                      <button class="btn btn-primary" type="button" {{-- name="accion" value="rechazar_venta" --}} data-id="{{ $venta->id_venta }}" data-title="tooltip" title="Rechazar" data-target="#ModalNota{{ $venta->id_venta }}" data-toggle="modal">
                        <i class="fa fa-ban"></i>
                      </button>
                      @endif             
                    </form>
                  </div>
                </div>  
                 <table class="table ">
                  <thead>
                    <tr>
                      <th class="text-center ">Código</th>
                      <th class="text-center ">Producto</th>
                      <th class="text-center ">Cantidad</th>
                      <th class="text-center ">Precio</th>
                      {{-- <th class="text-center ">Acciones</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($remitosProductos as $producto)
                    @if ( $producto->id_venta == $venta->id_venta )            
                    <tr>
                      <td class="text-center">{{ $producto->codigo_producto }}</td>
                      <td class="text-center">{{ $producto->descripcion }}</td>
                      <td class="text-center">{{ $producto->cantidad }}</td>
                      <td class="text-center precio_producto">
                        {!!number_format($producto->precio, 0, ',', '.')!!}
                      </td>
                    {{--   <td class="text-center">
                        <div class="btn-group">
                          <a class="btn btn-primary" href="##"><i class="m-0 fa fa-lg fa-print"></i></a>
                          <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-file"></i></a>
                          <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-times"></i></a>
                        </div>
                      </td> --}}
                    </tr>
                    @endif
                    @endforeach      
                  </tbody>
                </table>        
              </div>
              <!-- Modal confirmar venta -->
              <div class="modal fade" id="Confirmar{{ $venta->id_venta }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle{{ $venta->id_venta }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle{{ $venta->id_venta }}">Confirmar</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form class="modal-body  py-5" method="post" action="{{ route('remitos.update', $venta->id_venta) }}">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}   
                      <input type="hidden" name="accion2" value="modificar_pago">   
                      <div class="col-12 d-flex justify-content-around">
                        <button type="submit" class="btn btn-primary col-2" {{-- data-dismiss="modal" --}} value="modo_pago_efectivo" name="accion">
                          Efectivo
                        </button>                        
                      </div>
                      <div class="col-12 mt-4">
                        <div class="row d-flex justify-content-center">
                          <input type="text" class="form-control col-8" name="input_otros" placeholder="Nombre">
                          <button type="submit" class="btn btn-primary col-2" {{-- data-dismiss="modal" --}} value="modo_pago_otros" name="accion">
                            Otros
                          </button>
                        </div>
                      </div>
                      <div class="col-12 mt-4">
                        <div class="row d-flex justify-content-center">
                          <input type="text" class="form-control col-6" name="input_pos" placeholder="Referencia">
                          <button type="submit" class="btn btn-primary col-2" {{-- data-dismiss="modal" --}} value="modo_pago_tarjeta" name="accion">
                            Tarjeta
                          </button>  
                          <button type="submit" class="btn btn-primary col-2" {{-- data-dismiss="modal" --}} value="modo_pago_debito" name="accion">
                            T. Debito
                          </button>

                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              {{-- Modal nota rechazado --}}
              <div class="modal fade " id="ModalNota{{ $venta->id_venta }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{ $venta->id_venta }}" aria-hidden="true" style="z-index: 1080 !important;">
                <div class="modal-dialog  modal-dialog-centered " role="document">
                  <div style="display: none;" class="alert-top fixed-top text-center alert alert-danger remodal" id="remodal">      
                  </div>
                  <div class="modal-content">

                     <form method="post" action="{{ route('remitos.update', $venta->id_venta) }}">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <div class="modal-header">   
                        <h4 class="modal-title" id="myModalLabel{{ $venta->id_venta }}">Agregar Nota del Pedido</h4>
                      </div>
                        <textarea type="text" rows="3" cols="75" class="form-control" name="nota" class="nota" id="nota"></textarea>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary {{-- btn-nota --}}" id="btn-nota"  name="accion" value="rechazar_venta">Guardar</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
                        <input type="hidden" id="id_venta" class="id_venta" name="id_venta" value="{{ $venta->id_venta }}">
                        <input type="hidden" id="id_usuario" class="id_usuario" name="id_usuario" value="{{ Auth::user()->id }}">
                      </div>
                    </form> 

                  </div>
                </div>
              </div>
              @endforeach
        </div>
    </div>
  </div>
   <div class="col-12 col-md-5">
    <div class="tile">
       <div class="d-flex justify-content-between mb-3">
          <h3 class=" text-left">Resumen</h3>
          <b class="mt-2 text-right">Delivery: {{ $delivery }}</b>
        </div>
        <div class="tile-body">
            <table class="table">
              <tbody>
                <tr>
                  <th>Total efectivo</th>
                  <td>{!!number_format($total_efectivo , 0, ',', '.')!!}</td>
                </tr>
                <tr>
                  <th>Total Pos</th>
                  <td>{!!number_format($total_pos , 0, ',', '.')!!}</td>
                </tr>
                <tr>
                  <th>Total otros</th>
                  <td>{!!number_format($total_otros , 0, ',', '.')!!}</td>
                </tr>
              </tbody>
            </table>            
            <div class="col-12 text-center pt-4">
              <a href="#" class="btn btn-primary" title="" data-target="#ConfirmarRemito" data-toggle="modal">Confirmar Remito</a>
            </div>
        </div>
    </div>
  </div>
</div>

{{-- <!-- Modal confirmar venta -->
<div class="modal fade" id="Confirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirmar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  py-5">
        <div class="col-12 d-flex justify-content-around">
          <button type="button" class="btn btn-primary col-2" data-dismiss="modal">Efectivo</button>
          
        </div>
        <div class="col-12 mt-4">
          <div class="row d-flex justify-content-center">
            <input type="text" class="form-control col-8" name="" placeholder="Nombre">
            <button type="button" class="btn btn-primary col-2" data-dismiss="modal">Otros</button>
          </div>
        </div>
        <div class="col-12 mt-4">
          <div class="row d-flex justify-content-center">
            <input type="text" class="form-control col-8" name="" placeholder="Referencia">
            <button type="button" class="btn btn-primary col-2" data-dismiss="modal">POS</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> --}}

<!-- Modal confirmar remito -->
<div class="modal fade" id="ConfirmarRemito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog {{-- modal-dialog-centered --}}" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel2">Confirmar Remito</h4>
      </div>
      <div class="modal-body">
        <p>¿Está seguro de confirmar el remito?</p>
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <form action="{{ route('remitos.update', $remito->id) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <button type="submit" class="btn btn-danger" name="accion" value="confirmar_remito">
            Si
          </button>
        </form>
      </div>
    </div>
  </div>
</div>  

@endsection

@push('scripts')
{{-- <script>
$(function(){
  $('button.btn-nota').click(function(e){
    e.preventDefault();
    var guardar_nota = $(this).parents("div.modal.fade");
    // var id_venta  = $('.id_venta').val();
    var id_venta  = $(this).siblings('input.id_venta').val();
    // var nota      = $('.nota').val();
    var nota      = $(this).parent().prev().children();
    // var id_usuario= $('.id_usuario').val();
    var id_usuario="{{ Auth::user()->id }}";
    if ( nota=="" ){
      $(".remodal").html("Por Favor Agregue una Nota");
      $(".remodal").css("display","block");
      $(".remodal").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
      return false;
    }else{
      var formData = {
        id_usuario:   id_usuario,
        nota      :   nota.val(),
        id_venta  :   id_venta
      }
      $.ajax({
        type: "GET",
        url: '{{ url('add_notas') }}',
        dataType: "json",
        data: formData,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data){
          // nota.val("");
          
          guardar_nota.modal('hide');
          $("#res").html("Se Agrego con Éxito una Nota a la Venta");
          $("#res, #res-content").css("display","block").css('z-index','1100');
          $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
          // location.reload(true);
        } 
      });
    }
  });

});
</script> --}}
<script>
$(function(){
  $('button[value="rechazar_venta"]').click(function(e) {
    // e.preventDefault();
  });

//   $('button[value="devolver_venta"]').click(function(e){
//     e.preventDefault();
//     const boton = $(this);
//     const id = $(this).data('id');
//     const url = $(this).parents('form').attr('action');
//     const accion = $(this).val();
//     const icono_accion = $(this).children('i').attr('class');
//     $.ajaxSetup({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//     });
//     $.ajax({
//       url: url,
//       type: 'put',
//       dataType: 'json',
//       data: {
//         id:  id,
//         accion: accion
//       },
//       beforeSend: function(){
//         boton.children('i.fa').toggleClass(icono_accion).toggleClass('fa fa-refresh fa-spin');
//       }
//     })
//     .done(function(data) {
//       boton.children('i.fa').toggleClass('fa fa-refresh fa-spin').toggleClass(icono_accion);
//       boton.parents('tr').children('td.estado_venta').text(data.estado.estado)
//         .attr("data-id", data.estado.id);
//       if ( data.estado.id == 1 ) {
//         boton.parent().children('button[name="accion"]').css('display', 'none');
//       }
//       if (data.baja == true) {
//         const id_fila_remito = boton.parents('div.modal.fade').attr('id');        
//         const boton_ver = $('a.confirmar_remito[data-target="#'+id_fila_remito+'"]');
//         boton_ver.siblings('a.acciones').hide();
//         boton_ver.parents('tr').children('td.estado_remito').text('Baja');
//       }
//     })
//     .fail(function(a,b,c) {
//       alert("error");
//       console.log(a);
//       console.log(b);
//       console.log(c);
//     });
//     // .always(function() {
//     //   console.log("complete");
//     // });
    
//   });
});
$(function(){

  let boton_confirmar, mensaje_confirmacion, boton_accion_venta; 
  boton_confirmar = $('button[name=confirmar]');
  mensaje_confirmacion = "{{ session('mensaje') }}";
  boton_accion_venta = $('a.boton-accion-venta');  

  boton_accion_venta.on('click', function(){
    $(this).toggleClass('btn-primary').toggleClass('btn-dark')    
      .children().toggleClass('text-primary');
  });
  //////////////////////////////////
  // Mensaje notificacion success //
  //////////////////////////////////   
  if ( mensaje_confirmacion ) {
    $("#res").html(mensaje_confirmacion);
    $("#res, #res-content").css("display","block");
    $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
  }  

  $('[data-title="tooltip"]').tooltip();

  $('[data-title="tooltip"]').click(function() {
    $(this).tooltip('hide');
  });
});
</script>

@endpush