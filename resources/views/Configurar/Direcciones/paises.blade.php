<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Países')
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
        <h3 class="tile-title">Nuevo País</h3>
        <div class="tile-body ">
          <form id="frmc" name="frmc"  novalidate="">
              <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
              {{ csrf_field() }} 
            <div class="row">
               <div class="form-group col-12  col-md-4">
                <label class="control-label">País</label>
                <input class="form-control" type="text" placeholder="Nombre País"  id="nombrePais" name="nombrePais" onkeypress="return soloLetras(event)"  oncopy="return false" onpaste="return false"  maxlength="50">
              </div>
              <div class="tile-footer text-center border-0" >
                <button class="btn btn-primary save" type="submit" id="btn-save" value="add"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
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
             <!--form class="row d-flex justify-content-end" action="{{route('paises')}}" method="get"-->
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado Países</h3>
            </div>
             <div class="form-group col-md-3">
              <input type="text" class="form-control" id="scope"  placeholder="Buscar"  maxlength="50">
            </div>
            <div class="col-md-1 mr-md-3">
              <button  id="btnBuscar" class="btn btn-primary">Filtrar</button>      
            </div>
          <!--/form-->
          </div>
        </div>
        {{-- FIN FILTRO --}}
      
        <div class="tile-body ">
          <div class="table-responsive">
            <div class="paises" id="divpaises">
                  @component('Configurar.Direcciones.lista_paises')
                        @slot('paises', $paises)
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
      <h4 class="modal-title" id="myModalLabel">Editar País</h4>
     </div>
     <div class="modal-body">
      <form id="frmpaises" name="frmpaises" class="form-horizontal" novalidate="">
        
       <div class="row">
              <div class="form-group col-12  col-md-8">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" placeholder="..." id="nombre" name="nombre" onkeypress="return soloLetras(event)"  oncopy="return false" onpaste="return false"  maxlength="50">
              </div>
          
            </div>
        </div>
      </form>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="btn-save-edit" value="update">Guardar</button>
      <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
      <input type="hidden" id="pais_id" name="pais_id" value="0">
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
                    
                    <h4 class="modal-title" id="myModalLabel">Eliminar País</h4>
                </div>
            <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
                <div class="modal-body">
                    <p>Está seguro que desea eliminar este País?</p>
                    <p class="debug-url"></p>
                </div>
              </form> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
                     <button type="button" class="btn btn-danger delete-pais" >Si</button>
                    <input type="hidden" id="pais-id" name="pais-id" value="0">
                </div>
            </div>
        </div>
   </div>


@endsection

@push('scripts')
<meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Configurar/crud_paises.js')}}"></script>
@endpush