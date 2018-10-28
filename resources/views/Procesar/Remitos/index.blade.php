@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Remitos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">

  <div class="col-12 ">
    <div class="tile">
      <div class="col mb-3 text-center">
          <form class="row" method="get" action="{{ route('remitos.index') }}">
            <div class="col-md-3 p-0">
              <h3 class="tile-title text-center text-md-left">Listado de Remitos</h3>
            </div>
            <div class="form-group col-md-2 p-0 pr-1">
              <input class="form-control" type="text" name="remito" placeholder="Remito">
            </div>
            <div class="form-group col-md-2 p-0 pr-1">
              <input class="form-control" type="text" name="delivery" placeholder="Delivery">
            </div>
            <div class="form-group col-md-2 p-0 pr-1">
              <input class="form-control" type="date" name="fecha" >
            </div>
            <div class="form-group col-md-2 p-0 pr-1">
              <select class="form-control" name="estado">
                <option disabled selected value="0">Estado</option>
                @foreach ($estados as $estado)
                  <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                @endforeach
              </select>
            </div>
             <div class="form-group col-md-1 p-0 text-right">
              <input class="btn btn-warning" type="submit" value="Filtrar" name="filtrar">
            </div>
          </form>
        </div>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th class="text-center">Remito</th>
                    <th class="text-center">Delivery</th>
                    {{-- <th class="text-center">Cliente</th> --}}
                    {{-- <th class="text-center">Teléfono</th> --}}
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Importe</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($remitos as $remito)                    
                  <tr>
                    <td class="text-center id_remito">{{ $remito->id }}</td>
                    <td class="text-center">{{ $remito->nombre_delivery}}</td>
                    {{-- <td class="text-center">{{ $remito->nombre_cliente }}</td> --}}
                    {{-- <td class="text-center">{{ $remito->telefono }}</td> --}}
                    <td class="text-center">{{ $remito->fecha }}</td>
                    <td class="text-center" data-id="{{ $remito->id_estado }}">
                      {{ $remito->estado }}
                    </td>
                    <td class="importe text-right">{{ $remito->importe }}</td>
                    {{-- <td class="importe">
                      {!!number_format($remito->importe, 0, ',', '.')!!}
                    </td> --}}
                    <td width="10%" class="text-center">
                      <div class="btn-group">                        
                        <a class="btn btn-primary acciones" data-toggle="modal" data-target="#ModalProductos{{ $remito->id }}" href="#" data-title="tooltip" title="Ver">
                          <i class="m-0 fa fa-lg fa-eye"></i>
                        </a>
                        {{-- @if ( $remito->estado == "Delivery" ) --}}
                        @if ( $remito->id_estado == 6 )
                        <a class="btn btn-primary acciones" data-toggle="modal" data-target="#ModalProductosConfirmar{{ $remito->id }}" href="#" data-title="tooltip" title="Confirmar">
                          <i class="fa fa-check-square-o"></i>
                        </a>                          
                        @endif
                      </div>
                    </td>
                  @endforeach
                  </tr>
                  <tr>
                    <td colspan="4" class="text-right">
                      <h4>Total:</h4>
                    </td>
                    {{-- <td colspan="2"><h4>{{ $remito->sum('importe') }}</h4></td> --}}
                    <td colspan="2">
                      <h4 id="total" class="text-right"></h4>
                    </td>
                  </tr>
                </tbody>
              </table>
              {{-- Paginacion --}}
              {{ $remitos->render() }}
            </div>
          </div>
        </div>
    </div>
  </div>

 
</div>
@foreach ($remitos as $remito)
<!-- Modal -->
<div class="modal fade" id="ModalProductos{{ $remito->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $remito->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel{{ $remito->id }}">Ventas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table" width="100%">
            <thead>
              <tr>
                <th class="text-center">Venta</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Teléfono</th>
                {{-- <th class="text-center">Importe</th> --}}
                <th class="text-center">Forma de Pago</th>
                <th class="text-center">Estado</th>
                {{-- <th class="text-center">Fecha</th> --}}
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($remitosVentas as $venta)
              @if ( $venta->dr_id_remito == $remito->id)              
              {{-- @if ( $venta->dr_id_remito == 14463)               --}}
              <tr>
                <td class="text-center">{{ $venta->id_venta }}</td>
                <td class="text-center">{{ $venta->nombre_cliente }}</td>
                <td class="text-center">{{ $venta->telefono }}</td>
                {{-- <td class="text-center">Importe</td> --}}
                <td class="text-center">{{ $venta->forma_pago }}</td>
                <td class="text-center estado_venta" data-id="{{ $venta->id_estado }}">
                  {{ $venta->estado }}
                </td>
                {{-- <td class="text-center">Fecha</td> --}}
                <td class="text-center">
                  <form action="{{ route('remitos.update', $venta->id_venta) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="btn-group">                    
                      <a class="btn btn-primary boton-accion-venta" data-toggle="collapse" href="#collapseExample{{ $venta->id_venta }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $venta->id_venta }}" data-title="tooltip" title="Detalles"><i class="m-0 fa fa-eye"></i>
                      </a>
                      {{-- @if ( $remito->estado <> 'Cobrado' && $remito->estado <> 'Baja' )        --}}
                      @if ( $remito->id_estado <> 3 && $remito->id_estado <> 2 && $venta->dr_id_estado <> 2)
                      <button class="btn btn-primary" type="submit" name="accion" value="devolver_venta" data-id="{{ $venta->id_venta }}" data-title="tooltip" title="Devolver">
                        <i class="fa fa-share-square-o"></i>
                      </button>
                      <button class="btn btn-primary" type="submit" name="accion" value="confirmar_venta" data-id="{{ $venta->id_venta }}" data-title="tooltip" title="Confirmar">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                      </button>
                      <button class="btn btn-primary" type="submit" name="accion" value="rechazar_venta" data-id="{{ $venta->id_venta }}" data-title="tooltip" title="Rechazar" data-target="#ModalNota{{ $venta->id_venta }}" data-toggle="modal">
                        <i class="fa fa-ban"></i>
                      </button>            
                      @endif
                    </div>
                  </form>
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
        @foreach ($remitosVentas as $venta)
        @if ( $venta->dr_id_remito == $remito->id) 
        <div class="collapse table-responsive px-4" id="collapseExample{{ $venta->id_venta }}" >
          <h5 class="modal-title" id="exampleModalLabel{{ $venta->id_venta }}">Productos - Venta #{{ $venta->id_venta }}</h5>
           <table class="table ">
            <thead>
              <tr>
                <th class="text-center col col-md-2">Código</th>
                <th class="text-center col col-md-4">Producto</th>
                <th class="text-center col col-md-1">Cantidad</th>
                <th class="text-center col col-md-2">Precio</th>
                <th class="text-center col col-md-3">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($remitosProductos as $producto)
              @if ( $producto->id_venta == $venta->id_venta )            
              <tr>
                <td class="text-center">{{ $producto->codigo_producto }}</td>
                <td class="text-center">{{ $producto->descripcion }}</td>
                <td class="text-center">{{ $producto->cantidad }}</td>
                <td class="text-center precio_producto">{{ $producto->precio }}</td>
                <td class="text-center">
                  <div class="btn-group">
                    <a class="btn btn-primary" href="##"><i class="m-0 fa fa-lg fa-print"></i></a>
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-file"></i></a>
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-times"></i></a>
                  </div>
                </td>
              </tr>
              @endif
              @endforeach      
            </tbody>
          </table>        
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalProductosConfirmar{{ $remito->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2{{ $remito->id }}" aria-hidden="true">
  <div class="modal-dialog {{-- modal-dialog-centered --}}" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel2{{ $remito->id }}">Confirmar Remito</h4>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
          {{-- <span aria-hidden="true">&times;</span> --}}
        {{-- </button> --}}
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
  @foreach ($remitosVentas as $venta)
  @if ( $venta->dr_id_remito == $remito->id) 
  <!--Ventana Modal de Notas  -->
  <div class="modal fade " id="ModalNota{{ $venta->id_venta }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{ $venta->id_venta }}" aria-hidden="true" style="z-index: 1080 !important;">
    <div class="modal-dialog  modal-dialog-centered " role="document">
      <div style="display: none;" class="alert-top fixed-top text-center alert alert-danger remodal" id="remodal">      
      </div>
      <div class="modal-content">
        <div class="modal-header">   
          <h4 class="modal-title" id="myModalLabel{{ $venta->id_venta }}">Agregar Nota del Pedido</h4>
        </div>
        <form id="frmnota" name="frmnota" class="form-horizontal form_nota" novalidate="">
          <textarea type="text" rows="3" cols="75" class="form-control" name="nota" class="nota" id="nota"></textarea>
        </form> 
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-nota" id="btn-nota" >Guardar</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
          <input type="hidden" id="id_venta" class="id_venta" name="id_venta" value="{{ $venta->id_venta }}">
          <input type="hidden" id="id_usuario" class="id_usuario" name="id_usuario" value="{{ Auth::user()->id }}">
        </div>
      </div>
    </div>
  </div>
  @endif
  @endforeach
@endforeach
  

@endsection

@push('scripts')
<script>
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
</script>
<script>
$(function(){
  $('button[value="rechazar_venta"]').click(function(e) {
    e.preventDefault();
  });

  $('button[value="devolver_venta"], button[value=confirmar_venta]').click(function(e){
    e.preventDefault();
    const boton = $(this);
    const id = $(this).data('id');
    const url = $(this).parents('form').attr('action');
    const accion = $(this).val();
    const icono_accion = $(this).children('i').attr('class');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: url,
      type: 'put',
      dataType: 'json',
      data: {
        id:  id,
        accion: accion
      },
      beforeSend: function(){
        boton.children('i.fa').toggleClass(icono_accion).toggleClass('fa fa-refresh fa-spin');
      }
    })
    .done(function(data) {
      boton.children('i.fa').toggleClass('fa fa-refresh fa-spin').toggleClass(icono_accion);
      boton.parents('tr').children('td.estado_venta').text(data.estado.estado)
        .attr("data-id", data.estado.id);
      if ( data.estado.id == 1 ) {
        boton.parent().children('button[name="accion"]').css('display', 'none');
      }
    })
    .fail(function(a,b,c) {
      alert("error");
      console.log(a);
      console.log(b);
      console.log(c);
    });
    // .always(function() {
    //   console.log("complete");
    // });
    
  });
});
$(function(){

  let importe, total = 0, precio_producto, boton_confirmar, mensaje_confirmacion; 
  importe = $('.importe');
  precio_producto = $('.precio_producto');
  boton_confirmar = $('button[name=confirmar]');
  mensaje_confirmacion = "{{ session('mensaje') }}";
  boton_accion_venta = $('a.boton-accion-venta');  
  ////////////////////////////////////////////////////////////////
  // Sumar la columnas importes por pagina y separadores de mil //
  ////////////////////////////////////////////////////////////////
  importe.each( function(index) {
    // console.log( "Monto:"+$(this).text()+" Fila#"+index );  
    // Total de importe por pagina  
    total = total + Number( $(this).text() );
    // Formatear a separador de mil
    $(this).text( new Intl.NumberFormat("de-DE").format( $(this).text() ) );
  });
  // console.log("Total por pagina: "+total);
  // // Formatear a separador de mil
  $('#total').text( new Intl.NumberFormat("de-DE").format(total) );

  $(".acciones").click(function(e){
    let id = $(this).parents('td').siblings('.id_remito').text();
    // alert(id);
  });

  precio_producto.each( function(index) {
    $(this).text( new Intl.NumberFormat("de-DE").format( $(this).text() ) );
  });

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