<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Departamentos')
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
        <h3 class="tile-title">Nuevo Departamento</h3>
        <div class="tile-body ">
          <form id="frmc" name="frmc"  novalidate="">
            <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
            {{ csrf_field() }} 
            <div class="row">
               <div class="form-group col-12  col-md-4">
                <label class="control-label">Departamento</label>
                <input class="form-control" type="text" placeholder="Nombre Departamento"  id="nombreDpto" name="nombreDpto" onkeypress="return soloLetras(event)">
              </div>
              <div class="tile-footer text-center border-0" >
                <button class="btn btn-primary" type="submit" id="btn-save" value="add"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
   <div style="display: none;" class="col-12 text-center alert alert-success" id="res"></div>

     <div style="display: none;" class="col-12 alert alert-danger" id="rese"> </div>
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Departamentos</h3>
        <div class="tile-body ">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="dpto-list" name="dpto-list">
                @foreach ($departamentos as $item)
                 <tr id="dpto{{$item->id}}">
                  <td>{{ $item->nombre }}</td>
                  <td width="10%">
                    <div class="btn-group">
                        <button class="btn btn-primary open_modal" value="{{$item->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button class="btn btn-primary confirm-delete" value="{{$item->id}}"><i class="fa fa-lg fa-trash"></i></button> 
                      </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              </table>    
          </div>
          <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $departamentos->render(); ?>
              </div>
        </div>
    </div>
  </div>

</div>

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
     
      <h4 class="modal-title" id="myModalLabel">Editar Departamento</h4>
     </div>
     <div class="modal-body">
      <form id="frmdpto" name="frmdpto" class="form-horizontal" novalidate="">
        
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
      <input type="hidden" id="dpto_id" name="dpto_id" value="0">
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
                    
                    <h4 class="modal-title" id="myModalLabel">Eliminar Departamento</h4>
                </div>
            <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
                <div class="modal-body">
                    <p>Está seguro que desea eliminar este Departamento?</p>
                    <p class="debug-url"></p>
                </div>
              </form> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
                     <button type="button" class="btn btn-danger delete-dpto" >Si</button>
                    <input type="hidden" id="dpto-id" name="dpto-id" value="0">
                </div>
            </div>
        </div>
   </div> 

@endsection

@push('scripts')
<meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/crud_dptos.js')}}"></script>
@endpush