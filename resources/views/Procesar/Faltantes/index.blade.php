
{{-- CABECERA DE SECCION --}}
@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Faltantes')
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
              <h4 class="tile-title text-left text-md-left">Listado de Faltantes</h4>
            </div>
            <form class="row d-flex justify-content-end" action="{{route('entradas.index')}}" method="get"> 

              <div class="form-group col-md-5">
                <input class="form-control" type="text" name="producto" id="producto" placeholder="Buscar Producto">
              </div>

              <div class="form-group col-md-4">
                <input class="form-control" type="date" name="fecha" id="fecha">
              </div>


              <div class="col-md-1 mr-md-5">
                <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
              </div>
            </form>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover " id="sampleTable">
            <thead>
              <tr>
                <th>Telefono</th>
                <th>Nombres</th>
                <th>Código</th>
                <th class="text-rigth">Código</th>
                <th class="text-center">Producto</th>
                <th class="text-center">Categoría</th>
                <th class="text-center">Stock Actual</th>
                <th align="center">Cantidad</th>
                <th>Usuario</th>
                <th>Fecha</th>
              </tr>
            </thead>
            <tbody>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td ></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
          </tbody>
        </table>
      </div>
     <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
          <!--sección para definir paginación de laravel-->
    </div>
    </div>
  </div>
</div>
</div>


@endsection

@push('scripts')

 @endpush




































