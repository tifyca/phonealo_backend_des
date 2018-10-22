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
                    <td class="text-center">{{ $remito->estado }}</td>
                    <td class="importe text-right">{{ $remito->importe }}</td>
                    {{-- <td class="importe">
                      {!!number_format($remito->importe, 0, ',', '.')!!}
                    </td> --}}
                    <td width="10%" class="text-center">
                      <div class="btn-group">                        
                        <a class="btn btn-primary acciones" data-toggle="modal" data-target="#ModalProductos{{ $remito->id }}" href="#">
                          <i class="m-0 fa fa-lg fa-eye"></i>
                        </a>
                        @if ( $remito->estado == "Delivery" )
                        <a class="btn btn-primary acciones" data-toggle="modal" data-target="#ModalProductosConfirmar{{ $remito->id }}" href="#">
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
              <tr>
                <td class="text-center">{{ $venta->id }}</td>
                <td class="text-center">{{ $venta->nombre_cliente }}</td>
                <td class="text-center">{{ $venta->telefono }}</td>
                {{-- <td class="text-center">Importe</td> --}}
                <td class="text-center">{{ $venta->forma_pago }}</td>
                <td class="text-center">{{ $venta->estado }}</td>
                {{-- <td class="text-center">Fecha</td> --}}
                <td class="text-center">
                  <div class="btn-group">                    
                    <a class="btn btn-primary boton-accion-venta" data-toggle="collapse" href="#collapseExample{{ $venta->id }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $venta->id }}"><i class="m-0 fa fa-eye"></i>
                    </a>
                    <a class="btn btn-primary" href="#">
                      <i class="fa fa-share-square-o"></i>
                    </a>
                    <a class="btn btn-primary" href="#">
                      <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-primary" href="#">
                      <i class="fa fa-ban"></i>
                    </a>
                  </div>
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
        @foreach ($remitosVentas as $venta)
        @if ( $venta->dr_id_remito == $remito->id) 
        <div class="collapse table-responsive px-4" id="collapseExample{{ $venta->id }}" >
          <h5 class="modal-title" id="exampleModalLabel{{ $venta->id }}">Productos - Venta #{{ $venta->id }}</h5>
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
              @if ( $producto->id_venta == $venta->id )            
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
          <button type="submit" class="btn btn-danger" name="confirmar" value="1">Si</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{--  --}}
@endforeach
  

@endsection

@push('scripts')
<script>
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


});
</script>
@endpush