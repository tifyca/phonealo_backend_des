
{{-- CABECERA DE SECCION --}}
@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Faltantes - Consolidado')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

@if(Session::has('message'))
<div class="alert alert-success">

 {{ Session::get('message') }} 
</div>
@endif      


<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <div class="col mb-2 text-center">
          <div class="row ">
            <div class="col">
              <h4 class="tile-title text-left text-md-left">
                Listado Consolidado de Faltantes
              </h4>
            </div>
            <form class="row d-flex justify-content-end" action="{{route('faltantes-consolidado.index')}}" method="get"> 

              <div class="form-group col-md-7">
                <input class="form-control" type="text" name="producto" id="producto" placeholder="Buscar Producto">
              </div>

              {{-- <div class="form-group col-md-3"> --}}
                {{-- <input class="form-control" type="date" name="fecha" id="fecha"> --}}
              {{-- </div> --}}

              <div class="col-md-1 mr-md-5 form-group">
                <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
              </div>
              <div class="mr-3"></div>
            </form>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover" id="sampleTable">
            <thead>
              <tr>
                <th class="text-center">Código</th>
                <th class="text-center">Producto</th>
                <th class="text-center">Categoría</th>
                <th class="text-center">Stock Actual</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Detalles</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pedidos as $pedido)
              <tr>
                <td class="text-center">{{ $pedido->codigo_producto }}</td>
                <td class="text-center">{{ $pedido->descripcion }}</td>
                <td class="text-center">{{ $pedido->categoria }}</td>
                <td class="text-center">{{ $pedido->stock_activo }}</td>
                <td class="text-center">{{ $pedido->cantidad }}</td>
                <td class="text-center">
                  <div class="action-buttons">
                    <a href="#" class="detalles">
                      <i class="fa fa-angle-double-down fa-2x text-dark"></i>
                      <span class="sr-only">Details</span>
                    </a>
                  </div>
                </td>
              </tr>
              <tr class="detalles oculto no-hover">
                <td colspan="6" class="no-hover">
                  <table width="100%" class="table-bordered no-hover">
                    <thead>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Teléfono</th>
                      <th class="text-center">Cliente</th>
                      <th class="text-center">Cantidad</th>
                    </thead>
                    <tbody>
                      @foreach ($ventas as $venta)
                      @if ( $venta->codigo_producto == $pedido->codigo_producto  )
                      <tr>                        
                        <td class="text-center">{{ $venta->fecha }}</td>                      
                        <td class="text-center">{{ $venta->telefono }}</td>                      
                        <td class="text-center">{{ $venta->nombres }}</td>                      
                        <td class="text-center">{{ $venta->cantidad }}</td>                      
                      </tr>
                      @endif                 
                      @endforeach
                    </tbody>
                  </table>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
     <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
          <!--sección para definir paginación de laravel-->
         {{ $pedidos->appends( Request::only(['producto']) )->links() }}
    </div>
    </div>
  </div>
</div>
</div>


@endsection

@push('scripts')
<script>
  $(function(){
    $('a.detalles').on('click', function(e){
      e.preventDefault();
      $(this).children('i').toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up')
        .parents('tr').toggleClass('bg-primary').toggleClass('font-weight-bold')
        .next('tr.detalles').toggleClass('oculto');
    });
  });
</script>
@endpush




































