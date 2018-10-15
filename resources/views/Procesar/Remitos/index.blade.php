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
                <option value="">Estado</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
             <div class="form-group col-md-1 p-0">
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
                    {{-- <th class="text-center">Cliente</th> --}}
                    <th class="text-center">Delivery</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Importe</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($remitos as $remito)                    
                  <tr>
                    <td class="text-center">{{ $remito->id }}</td>
                    {{-- <td class="text-center">{{ $remito->nombre_cliente }}</td> --}}
                    <td class="text-center">{{ $remito->nombres }}</td>
                    <td class="text-center">{{ $remito->fecha }}</td>
                    <td class="text-center">{{ $remito->estado }}</td>
                    <td class="importe text-right">{{ $remito->importe }}</td>
                    {{-- <td class="importe">
                      {!!number_format($remito->importe, 0, ',', '.')!!}
                    </td> --}}
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalProductos" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
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

<!-- Modal -->
<div class="modal fade" id="ModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ventas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Venta</th>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Importe</th>
                <th>Forma de Pago</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Venta</td>
                <td>Cliente</td>
                <td>Teléfono</td>
                <td>Importe</td>
                <td>Forma de Pago</td>
                <td>Fecha</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="m-0 fa fa-lg fa-eye"></i></a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="collapse table-responsive px-4" id="collapseExample" >
          <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
           <table class="table ">
            <thead>
              <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Código</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-file"></i></a>
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-times"></i></a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>        
        </div>
      </div>
    </div>
  </div>
</div>
{{--  --}}

  

@endsection

@push('scripts')
<script>
$(function(){
  let importe, total = 0; 
  importe = $('.importe');
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
});
</script>
@endpush