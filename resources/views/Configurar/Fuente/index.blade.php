<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Fuentes')
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
        <h3 class="tile-title">Nueva Fuente</h3>
        <div class="tile-body ">
          <form id="frmc" name="frmc"  novalidate="">
             <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
            <div class="row">
               <div class="form-group col-12  col-md-4">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" placeholder="Nombre Fuente" id="nombreFuente" name="nombreFuente" onkeypress="return soloLetras(event)">
              </div>
              <div class="form-group row col-12 col-md-2">
                  <label class="control-label col-md-12">Estatus</label>
                  <div class="col-md-12 ">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input"  value="1" type="radio" id="statusFuente" name="statusFuente">Activo
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" value="0" type="radio" id="statusFuente2" name="statusFuente">Inactivo
                      </label>
                    </div>
                  </div>
                </div>
              <div class="tile-footer text-center border-0" >
                <button class="btn btn-primary" type="submit" id="btn-save" value="add"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
              </div>
            </div>
          </form>
        </div>
        
    </div>
  </div>
 
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Fuentes</h3>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <div class="fuentes">
             <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="fuentes-list" name="fuentes-list">
                   @foreach($fuentes as $fuente)           
                     <tr id="fuente{{$fuente->id}}">
                      <td width="45%">{{$fuente->fuente}}</td>
                <?php if ($fuente->status==1){ ?>
                      <td width="45%"><?=  'Activo' ?></td>
                <?php }else{ ?> 
                      <td width="45%"><?='Inactivo' ?></td>
                <?php } ?> 
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                      <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$fuente->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$fuente->id}}"><i class="fa fa-lg fa-trash"></i></button>                   
                      </div>
                      </td>
                    </tr>
                    @endforeach
              </table>       
               <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $fuentes->render(); ?>
              </div>
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
     
      <h4 class="modal-title" id="myModalLabel">Editar Fuente</h4>
     </div>
     <div class="modal-body">
      <form id="frmfuentes" name="frmfuentes" class="form-horizontal" novalidate="">
        
       <div class="row">
              <div class="form-group col-12  col-md-8">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" placeholder="..." id="nombre" name="nombre" onkeypress="return soloLetras(event)">
              </div>
              <div class="form-group row col-12 col-md-2">
                  <label class="control-label col-md-12">Estatus</label>
                  <div class="col-md-12 ">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" value="1" type="radio" id="status" name="status">Activo
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                         <input class="form-check-input" value="0" type="radio" id="status2" name="status">Inactivo
                      </label>
                    </div>
                  </div>
                </div>
          
            </div>
        </div>
      </form>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="btn-save-edit" value="update">Guardar</button>
      <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
      <input type="hidden" id="fuente_id" name="fuente_id" value="0">
      <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
     </div>
     
     
    </div>
   </div>
  </div>

 </div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
            
                <div class="modal-header">
                    
                    <h4 class="modal-title" id="myModalLabel">Eliminar Fuente</h4>
                </div>
            <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
                <div class="modal-body">
                    <p>Está seguro que desea eliminar esta Fuente?</p>
                    <p class="debug-url"></p>
                </div>
              </form> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
                     <button type="button" class="btn btn-danger delete-fuente" >Si</button>
                    <input type="hidden" id="fuente-id" name="fuente-id" value="0">
                </div>
            </div>
        </div>
   </div>

  

@endsection

@push('scripts')
 <meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Configurar/crud_fuentes.js')}}"></script>
@endpush