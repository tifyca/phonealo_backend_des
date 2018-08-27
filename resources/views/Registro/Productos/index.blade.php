@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Productos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('registro/productos/show') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <div class="col mb-3 text-center">
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Productos</h3>
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="" name="">
                <option value="">Categoría</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="" name="">
                <option value="">Subcategoria</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="col-md-1 mr-md-3">
              <button class="btn btn-primary" type="">Ver Todo</button>
            </div>
          </div>
        </div>
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Código</th>
                  <th>Producto</th>
                  <th>Categoría</th>
                  <th>Descompuesto</th>
                  <th>Stock</th>
                  <th>Precio Ideal</th>
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
                  <td>Lorem</td>
                  <td>Lorem</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a class="btn btn-primary" href="{{ route('productos.update',2) }}"><i class="m-0 fa fa-lg fa-pencil"></i></a>
                      <a class="btn btn-primary" href="{{ route('productos.detalle',2) }}"><i class="m-0 fa fa-lg fa-info"></i></a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>00</td>
                  <td>0898</td>
                  <td>System Architect</td>
                  <td>Lorem</td>
                  <td>Lorem</td>
                  <td>Lorem</td>
                  <td>Lorem</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a class="btn btn-primary" href="{{ route('productos.update',2) }}"><i class="m-0 fa fa-lg fa-pencil"></i></a>
                      <a class="btn btn-primary" href="{{ route('productos.detalle',2) }}"><i class="m-0 fa fa-lg fa-info"></i></a>
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

  

@endsection

@push('scripts')

@endpush