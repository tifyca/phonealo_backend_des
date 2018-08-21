@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Productos')
@section('descripcion', 'Descripcion Opcional')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('registro/productos/show') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Productos</h3>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Tienda</th>
                    <th>Descompuesto</th>
                    <th>Stock</th>
                    <th>Precio Ideal</th>
                    <th>Image</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>00</td>
                    <td>0898</td>
                    <td>System Architect</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('productos.update',2) }}"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" href="{{ route('productos.update',2) }}"><i class="m-0 fa fa-lg fa-plus-circle"></i></a>
                        <a class="btn btn-primary" href="{{ route('productos.update',2) }}"><i class="m-0 fa fa-lg fa-info"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>00</td>
                    <td>0898</td>
                    <td>System Architect</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('productos.update',2) }}"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" href="{{ route('productos.update',2) }}"><i class="m-0 fa fa-lg fa-plus-circle"></i></a>
                        <a class="btn btn-primary" href="{{ route('productos.update',2) }}"><i class="m-0 fa fa-lg fa-info"></i></a>
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
</div>

  

@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush