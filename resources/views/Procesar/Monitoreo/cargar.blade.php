@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Cargar Lista de Monitoreo')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('procesar/monitoreo'))
@section('display_new','d-none')  @section('link_edit', '') 
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-6">
    <div class="tile">
        <h3 class="tile-title">Listado de Productos</h3>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
             <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>                              
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Categoría </th>
                    <th>Subcategoria</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td widtd="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-plus m-0"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td widtd="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-plus m-0"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td widtd="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-plus m-0"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td widtd="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-plus m-0"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td widtd="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-plus m-0"></i></a>
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
  <div class="col-6">
    <div class="tile">
        <h3 class="tile-title">Añadidos a la lista</h3>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
             <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>                              
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Categoría </th>
                    <th>Subcategoria</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td widtd="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-times m-0"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td widtd="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-times m-0"></i></a>
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

@endpush