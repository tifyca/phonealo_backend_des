<?php 
$id_usuario= $_SESSION["user"];
?>
{{-- CABECERA DE SECCION --}}
@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Sliders')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', route('slider.create') ) 
@section('display_edit', 'd-none')    @section('link_edit', route('slider.edit',auth()->user()->id))
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
        <div class="col mb-3 text-center">
          <div class="row ">
            <div class="col">
              <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
              <h4 class="tile-title text-left text-md-left">Listado de Sliders</h4> <br>
          </div>
          <form class="row d-flex justify-content-end" action="#" method="get"> 

              <div class="form-group col-mb-4">
                <input class="form-control" type="text" name="titulo" id="titulo" placeholder="Buscar Título">
            </div>

            <div class="form-group col-mb-3">
                <input class="form-control" type="date" name="fecha" id="fecha" placeholder="Buscar Fecha">
            </div>

            <div class="form-group col-mb-3">
                <select name="usuario" id="usuario" class="form-control" placeholder="usuario">
                    <option value="">Usuario</option>
                </select>
            </div>
            <div class="form-group col-mb-3">
                <select name="publico" id="publico" class="custom-select" placeholder="Publico">
                    <option value="">Público</option>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                </select>
            </div>


            <div class="form-group col-mb-3">
                <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
            </div>
        </form>
    </div>
</div>
<div class="tile-body ">
  <div class="table-responsive">
    <table class="table table-hover " id="sampleTable">
      <thead>
        <tr>
          <th>#</th>
          <th class="text-left">Titulo</th>
          <th class="text-center">Público</th>
          <th class="text-center">Posición</th>
          <th class="text-center">Fecha</th>
          <th class="text-center" width="20%">Acciones</th>
      </tr>
  </thead>
  <tbody>
     <tr> 
        <th>1</th>
         <td>Prueba Slider</td>

         <td class="text-center">Si</td>
         <td class="text-center">1</td>
         <td class="text-center">13-10-2018</td>
         <td width="10%" class="text-center">
            <div class="btn-group">
              <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver/Editar" href="{{ URL::to('ecommerce/slider/' . auth()->user()->id . '/edit') }}"><i class="m-0 fa fa-lg fa-edit"></i></a>
              <button data-toggle="tooltip" data-placement="top"  title="Eliminar" class="btn btn-primary nota"  value=""><i class="fa fa-lg fa-trash" ></i></button>   
          </div>
      </td> 
  </tr>

</tbody>
</table>
</div>
<div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
   
</div>
</div>
</div>
</div>
</div>



@endsection

