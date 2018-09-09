<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Ciudades')
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
        <h3 class="tile-title">Nueva Ciudad</h3>
        <div class="tile-body ">
          <form id="frmc" name="frmc"  novalidate="">
              <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
              {{ csrf_field() }} 
            <div class="row">
              <div class="form-group col-12 col-md-3">
                <label for="exampleSelect1">Departamento</label>
                <select class="form-control departamento" id="dpto" name="dpto">
                 <option value="0">Seleccione</option>
                </select>
              </div>
               <div class="form-group col-12  col-md-4">
                <label class="control-label">Ciudad</label>
                <input class="form-control" type="text" placeholder="Nombre Ciudad"  id="nombreCiudad" name="nombreCiudad" onkeypress="return soloLetras(event)">
              </div>
              <div class="tile-footer text-center border-0" >
                <button class="btn btn-primary" type="submit" type="submit" id="btn-save" value="add"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>

    <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado Ciudades</h3>
        <div class="tile-body ">
              <div class="form-group col-12 col-md-3">
                <label for="exampleSelect1">Seleccione Departamento</label>
                <select class="form-control departamento" id="departamento-select" name="departamento-select">
                 <option value="">Seleccione</option>
                </select>
              </div>
          <div class="table-responsive">
            <table class="table table-hover" id="sampleTable">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th width="10%">Acciones</th>
                </tr>
              </thead>
              <tbody id="ciudades-list" name="ciudades-list">
                {{-- ESTE LISTADO SE LLENA CON AJAX --}}
              </tbody>
              </table>
          </div>
           <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <!--?php echo $ciudades->render(); ?-->
              </div>
        </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
     
      <h4 class="modal-title" id="myModalLabel">Editar Ciudad</h4>
     </div>
     <div class="modal-body">
      <form id="frmciudades" name="frmciudades" class="form-horizontal" novalidate="">
        
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
      <input type="hidden" id="ciudad_id" name="ciudad_id" value="0">
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
                    
                    <h4 class="modal-title" id="myModalLabel">Eliminar Ciudad</h4>
                </div>
            <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
                <div class="modal-body">
                    <p>Está seguro que desea eliminar este Ciudad?</p>
                    <p class="debug-url"></p>
                </div>
              </form> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
                     <button type="button" class="btn btn-danger delete-ciudad" >Si</button>
                    <input type="hidden" id="ciudad-id" name="ciudad-id" value="0">
                </div>
            </div>
        </div>
   </div>
 

@endsection

@push('scripts')
<meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Configurar/crud_ciudades.js')}}"></script>

<script  type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    {{-- SE LLENA EL SELECT DE LOS DEPARTAMENTOS CON AJAX --}}
      $.ajax({
          type: "get",
          url: '{{ route('departamentos_ajax') }}',
          dataType: "json",
          success: function (data){
     
           
             $.each(data, function(i, item) {
               $(".departamento option:eq(1)").prop("selected", true);
                $(".departamento").append('<option value='+item.id+' >'+item.nombre+'</option>');
              });
          }

      });
      // AL SELECCIONAR EL DEPARTAMENTO TRAE LAS CIUDADES ASOCIADAS
      $('#departamento-select').change(function(){
        var id_departamento = $(this).val();

          $("#ciudades-list").html('');

           $.ajax({
              type: "get",
              url: '{{ route('ciudadesCombo') }}',
              dataType: "json",
              data: {id_departamento: id_departamento},
              success: function (data1){

                 $.each(data1, function(l, item1) {

                    $("#ciudades-list").append('<tr id="ciudades'+ item1.id +'"><td>'+item1.ciudad+'</td><td width="10%"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal m-0" value="'+ item1.id +'"><i class="fa fa-lg fa-edit"  ></i></button><button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="'+ item1.id +'"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>');
                  });
              }
          });
      });
  });
</script>
@endpush