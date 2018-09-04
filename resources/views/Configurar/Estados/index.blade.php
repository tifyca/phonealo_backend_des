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
        <h3 class="tile-title">Listado de Estados</h3>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="estados">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
		                <th>Acción</th>
                  </tr>
                </thead>
                <tbody id="estados-list" name="estados-list">
                  @foreach($estados as $item)           
                     <tr id="estado{{$item->id}}">
                      <td width="90%">{{$item->estado}}</td>
                
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                      <button class="btn btn-primary open_modal" value="{{$item->id}}"><i class="fa fa-lg fa-edit"  ></i></button>               
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
  <div style="display: none;" class="col-12 text-center alert alert-success" id="res"></div>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
     
      <h4 class="modal-title" id="myModalLabel">Editar Estado</h4>
     </div>
     <div class="modal-body">
      <form id="frmestados" name="frmestados" class="form-horizontal" novalidate="">
        
       <div class="row">
              <div class="form-group col-12  col-md-8">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" placeholder="..." id="nombre" name="nombre" onkeypress="return soloLetras(event)">
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
