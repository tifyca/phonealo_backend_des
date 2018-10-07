
{{-- CABECERA DE SECCION --}}
@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Pedidos')
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
              <h4 class="tile-title text-left text-md-left">Listado de Pedidos</h4>
            </div>
            <form class="row d-flex justify-content-end" action="{{route('pedidos.index')}}" method="get"> 

              <div class="form-group col-md-5">
                <input class="form-control" type="text" name="id_pedido" id="id_pedido" placeholder="Buscar Pedido">
              </div>

              <div class="form-group col-md-5">
                <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Buscar Teléfono">
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
                <th class="text-left">Venta</th>
                <th class="text-left">Vendedor</th>
                <th class="text-left">Cliente</th>
                <th class="text-left">Teléfono</th>
                <th class="text-left">Dirección</th>
                <th class="text-left">Barrio</th>
                <th class="text-left">Importe</th>
                <th class="text-left">Fecha</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
             @foreach($pedidos as $pedido)
             <tr
              @if($pedido->id_estado==1)
                class="table-secondary"    
              @if($pedido->id_estado==5)
               class="table-primary"
             > 
              <td>{{$pedido->id}}</td>
              <td>{{$pedido->name}}</td>
              <td>{{$pedido->nombres}}</td>
              <td>{{$pedido->telefono}}</td>
              <td>{{$pedido->direccion}}</td>
              <td >{{$pedido->barrio}}</td>
              <td>{{$pedido->monto}}</td>
              <td>{{$pedido->fecha}}</td>
              <td>{{$pedido->estado}}</td>
             </tr>
              @endforeach
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




































