<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Horario de Entrega')
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
        <h3 class="tile-title">Nuevo Horario de Entrega</h3>
        <div class="tile-body ">
          <form id="frmc" name="frmc"  novalidate="">
            {{ csrf_field() }} 
            <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
            <div class="row">
              <div class="form-group col-12  col-md-4">
                <label for="exampleSelect1">Estatus de Venta</label>
                <select class="form-control" id="statusVenta" name="statusVenta">
                  <option value="">Seleccione</option> 
                   <option value="1">Activo</option> 
                   <option value="5">Espera</option> 
                </select>
              </div>
              <div class="form-group col-12  col-md-4">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" placeholder="..." id="horaVenta" name="horaVenta"  oncopy="return false" onpaste="return false"  onkeypress="return soloLetras(event)">
              </div>
              <div class="form-group row col-12 col-md-2">
                  <label class="control-label col-md-12">Estatus</label>
                  <div class="col-md-12 ">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="1"  id="statusHora" name="statusHora" checked>Activo
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="0" id="statusHora2" name="statusHora">Inactivo
                      </label>
                    </div>
                  </div>
                </div>
              <div class="tile-footer col-12 col-md-2 text-center border-0" >
                <button class="btn btn-primary" type="submit"  id="btn-save" value="add"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
              </div>
            </div>
          </form>
        </div>
        
    </div>
  </div>

  
  <div class="col-12">
    <div class="tile">
      {{-- FILTRO --}}
      <div class="col mb-3 text-center">
        
            <form class="row d-flex justify-content-end" action="{{route('horas.index')}}" method="get">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Horario de Ventas</h3>
            </div>
             <div class="form-group col-md-2">
              <input type="text" class="form-control" id="buscarhora" name="buscarhora" placeholder="Buscar">
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="selectven" name="selectven">
                <option value="">Estatus de Venta</option>
                <option value="1">Activo</option> 
                <option value="5">Espera</option> 
              </select>
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="selectstatus" name="selectstatus">
                <option value="">Estatus</option>  
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>     
              </select>
            </div>
             <div class="col-md-1 mr-md-3">
              <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">       
            </div>
          </form>
        
        </div>
        {{-- FIN FILTRO --}}
      
        <div class="tile-body">
          <div class="tile-body table-responsive">
            <div class="horas">
              <table class="table table-hover" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Estatus Venta</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
             
                  <tbody id="horas-list" name="horas-list"> 
                 @foreach($horarios as $horario)           
                     <tr id="hora{{$horario->id}}">
                      <td width="30%">{{$horario->horario}}</td>
                <?php if ($horario->status_v==1){ ?>
                      <td width="25%"><?=  'Activo' ?></td>
                <?php }else{ ?> 
                      <td width="25%"><?='Espera' ?></td>
                <?php } ?> 
                <?php if ($horario->status==1){ ?>
                      <td width="25%"><?=  'Activo' ?></td>
                <?php }else{ ?> 
                      <td width="25%"><?='Inactivo' ?></td>
                <?php } ?> 
                      <td width="15%" class="text-center">
                      <div class="btn-group">
                      <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$horario->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$horario->id}}"><i class="fa fa-lg fa-trash"></i></button>                   
                      </div>
                      </td>
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
            <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                     <?php echo $horarios->render(); ?>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header">
      <div style="display: none;" class="alert-top fixed-top col-12  text-center alert alert-danger" id="remodal"> </div>
      <h4 class="modal-title" id="myModalLabel">Editar Horario de Entrega</h4>
     </div>
     <div class="modal-body">
      <form id="frmsubcategoria" name="frmsubcategoria" class="form-horizontal" novalidate="">
        
       <div class="row">
        <div class="form-group col-12  col-md-4">
                <label for="exampleSelect1">Estatus Venta</label>
                <select class="form-control" id="statusventa" name="statusventa">
                  <option value="">Seleccione</option>  
                  <option value="1">Activo</option> 
                   <option value="5">Espera</option>           
                </select>
              </div>
              <div class="form-group col-12  col-md-8">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" placeholder="..." id="horario" name="horario"  oncopy="return false" onpaste="return false"  onkeypress="return soloLetras(event)">
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
      <input type="hidden" id="hora_id" name="hora_id" value="0">
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
                    
                    <h4 class="modal-title" id="myModalLabel">Eliminar Horario de Venta</h4>
                </div>
            <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
                <div class="modal-body">
                    <p>Está seguro que desea Eliminar este Horario?</p>
                    <p class="debug-url"></p>
                </div>
              </form> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
                     <button type="button" class="btn btn-danger delete-hora" >Si</button>
                    <input type="hidden" id="hora-id" name="hora-id" value="0">
                </div>
            </div>
        </div>
   </div>  

@endsection

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
 <script src="{{asset('js/Configurar/crud_horas.js')}}"></script>
@endpush