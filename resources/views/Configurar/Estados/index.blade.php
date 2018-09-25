<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Estados')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_edit', '') 
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      {{-- FILTRO --}}
      <div class="col mb-3 text-center">
          
             <form class="row d-flex justify-content-end" action="{{route('estados')}}" method="get">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Estados</h3>
            </div>
             <div class="form-group col-md-4">
              <input type="text" class="form-control" id="scope" name="scope" placeholder="Buscar" oncopy="return false" onpaste="return false"  maxlength="50">
            </div>
             <div class="col-md-1 mr-md-3">
               <button  id="btnBuscar" class="btn btn-primary">Filtrar</button>           
            </div>
          </form>
          
        </div>
        {{-- FIN FILTRO --}}
     
        <div class="tile-body ">
          <div class="tile-body">
            <div class="estados" id="divestados">
               @component('Configurar.Estados.lista')
                        @slot('estados', $estados)
                  @endcomponent
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
  

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
       <div style="display: none;" class="alert-top fixed-top col-12  text-center alert alert-danger" id="remodal"> </div>
      <h4 class="modal-title" id="myModalLabel">Editar Estado</h4>
     </div>
     <div class="modal-body">
      <form id="frmestados" name="frmestados" class="form-horizontal" novalidate="">
        
       <div class="row">
              <div class="form-group col-12  col-md-8">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" placeholder="..." id="nombre" name="nombre" onkeypress="return soloLetras(event)" oncopy="return false" onpaste="return false"  maxlength="50">
              </div>
              
            </div>
        </div>
      </form>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="btn-save-edit" value="update">Guardar</button>
      <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
      <input type="hidden" id="estado_id" name="estado_id" value="0">
      <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
     </div>
     
     
    </div>
   </div>
  </div>

 </div>

@endsection

@push('scripts')
  <meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Configurar/crud_estados.js')}}"></script>
@endpush
