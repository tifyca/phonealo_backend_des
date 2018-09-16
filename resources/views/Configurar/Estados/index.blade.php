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
              <input type="text" class="form-control" id="buscarestado" name="buscarestado" placeholder="Buscar" oncopy="return false" onpaste="return false"  maxlength="50">
            </div>
             <div class="col-md-1 mr-md-3">
              <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">       
            </div>
          </form>
          
        </div>
        {{-- FIN FILTRO --}}
     
        <div class="tile-body ">
          <div class="tile-body">
            <div class="estados">
              <table class="table table-hover" id="sampleTable">
                <thead>
                  <tr>
                    <th width="90%">Nombre</th>
		                <th width="10%" class="text-center">Acción</th>
                  </tr>
                </thead>
                <tbody id="estados-list" name="estados-list">
                  @foreach($estados as $item)           
                     <tr id="estado{{$item->id}}">
                      <td width="90%">{{$item->estado}}</td>
                
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                      <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$item->id}}"><i class="m-0 fa fa-lg fa-edit"  ></i></button>               
                      </div>
                      </td>
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
         
            <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $estados->render(); ?>
            </div>
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
