<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Subcategorias')
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
        <h3 class="tile-title">Nueva Subcategoria</h3>
        <div class="tile-body ">
          <form id="frmc" name="frmc"  novalidate="">
            {{ csrf_field() }} 
            <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
            <div class="row">
              <div class="form-group col-12  col-md-4">
                <label for="exampleSelect1">Categoría</label>
                <select class="form-control" id="categoria" name="categoria">
                  <option value="">Seleccione</option>       
                @foreach($categorias as $categoria)   
                <option value="{{$categoria->id}}"> {{ $categoria->categoria }} </option>
                 @endforeach
                </select>
              </div>
              <div class="form-group col-12  col-md-4">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" placeholder="..." id="nombreSubcategoria" name="nombreSubcategoria" onkeypress="return soloLetras(event)">
              </div>
              <div class="form-group row col-12 col-md-2">
                  <label class="control-label col-md-12">Estatus</label>
                  <div class="col-md-12 ">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="1"  id="statusSubcategoria" name="statusSubcategoria" checked>Activo
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="0" id="statusSubcategoria2" name="statusSubcategoria">Inactivo
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
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Subcategorias</h3>
            </div>
             <div class="form-group col-md-2">
              <input type="text" class="form-control" name="" placeholder="Buscar">
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="" name="">
                <option value="">Categoría</option>
                <option>Lorem</option>
                <option>Lorem</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="" name="">
                <option value="">Estatus</option>
                <option>Activo</option>
                <option>Inactivo</option>
              </select>
            </div>
          </div>
        </div>
        {{-- FIN FILTRO --}}
      
        <div class="tile-body">
          <div class="tile-body table-responsive">
            <div class="subcategorias">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
             
                  <tbody id="subcategorias-list" name="subcategorias-list"> 
                  @foreach($subcategorias as $subcategoria)           
                     <tr id="subcategoria{{$subcategoria->id}}">
                      <td width="30%">{{$subcategoria->sub_categoria}}</td>
                      <td width="30%">{{$subcategoria->categoria}}</td>
                <?php if ($subcategoria->status==1){ ?>
                      <td width="25%"><?=  'Activo' ?></td>
                <?php }else{ ?> 
                      <td width="25%"><?='Inactivo' ?></td>
                <?php } ?> 
                      <td width="15%" class="text-center">
                      <div class="btn-group">
                      <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$subcategoria->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$subcategoria->id}}"><i class="fa fa-lg fa-trash"></i></button>                   
                      </div>
                      </td>
                    </tr>
                    @endforeach
                                 
                </tbody>
              </table>
            <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $subcategorias->render(); ?>
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
     
      <h4 class="modal-title" id="myModalLabel">Editar Categoria</h4>
     </div>
     <div class="modal-body">
      <form id="frmsubcategoria" name="frmsubcategoria" class="form-horizontal" novalidate="">
        
       <div class="row">
        <div class="form-group col-12  col-md-4">
                <label for="exampleSelect1">Categoría</label>
                <select class="form-control" id="cat" name="cat">
                  <option value="">Seleccione</option>       
                @foreach($categorias as $categoria)   
                <option value="{{$categoria->id}}"> {{ $categoria->categoria }} </option>
                 @endforeach
                </select>
              </div>
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
      <input type="hidden" id="subcategoria_id" name="subcategoria_id" value="0">
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
                    
                    <h4 class="modal-title" id="myModalLabel">Eliminar Categoria</h4>
                </div>
            <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
                <div class="modal-body">
                    <p>Está seguro que desea Eliminar este Categoria?</p>
                    <p class="debug-url"></p>
                </div>
              </form> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
                     <button type="button" class="btn btn-danger delete-subcategoria" >Si</button>
                    <input type="hidden" id="subcategoria-id" name="subcategoria-id" value="0">
                </div>
            </div>
        </div>
   </div>  

@endsection

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
 <script src="{{asset('js/Configurar/crud_subcategorias.js')}}"></script>
@endpush