<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Barrios')
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
        <h3 class="tile-title">Nuevo Barrio</h3>
        <div class="tile-body ">
          <form id="frmc" name="frmc"  novalidate="">
              <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
              {{ csrf_field() }} 
            <div class="row">
              <div class="form-group col-12 col-md-3">
                <label for="departamento-select">Departamento</label>
                <select class="form-control departamento" id="departamento-select">
                  <option value="0">Seleccione</option>
                </select>
              </div>
              <div class="form-group col-12 col-md-3">
                <label for="">Ciudad</label>
                <select class="form-control ciudades" id="ciudad">
                  <option value="0">Seleccione</option>
                </select>
              </div>
               <div class="form-group col-12  col-md-4">
                <label class="control-label">Barrio</label>
                <input class="form-control" type="text" placeholder="Nombre Barrio" id="nombreBarrio" name="nombreBarrio" oncopy="return false" onpaste="return false" onkeypress="return soloLetras(event)"  maxlength="50">
              </div>
              <div class="form-group col-12  col-md-3">
                <label class="control-label">Latitud</label>
                <input class="form-control" type="text"  id="lat" name="lat" onkeypress="return soloNumeros(event);">
              </div>
              <div class="form-group col-12  col-md-3">
                <label class="control-label">Logitud</label>
                <input class="form-control" type="text"  id="lon" name="lon" onkeypress="return soloNumeros(event);">
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
         <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Barrios</h3>
            </div>
      <div class="col mb-3">
         <div class="row">
        <!--form class="row d-flex justify-content-end" action="{{route('barrios')}}" method="get"-->
        <div class="form-group col-md-3">
              <input type="text" class="form-control" id="buscarbarrio" name="buscarbarrio" placeholder="Buscar" onkeypress="return soloLetras(event)"  maxlength="50">
            </div>
            <div class="form-group col-md-3">
                 <select class="form-control departamento" id="departamento-select-list" name="departamento-select-list">
                 <option value="">Departamento</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                 <select class="form-control ciudades" id="ciudades-select-list" name="ciudades-select-list">
                 <option value="">Ciudad</option>
                </select>
              </div>
            <div class="col-md-1 mr-md-3">
              <button  id="btnBuscar" class="btn btn-primary">Filtrar</button>    
            </div>
          <!--/form-->
          </div>
        <div class="tile-body ">
         
              
          <div class="table-responsive">
            <div class="barrios" id="divbarrios">
                    @component('Configurar.Direcciones.lista_barrios')
                        @slot('barrios', $barrios)
                    @endcomponent
             </div>
          </div>
        </div>
    </div>
  </div>
 
</div>

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog  modal-lg">
    <div class="modal-content">
     <div class="modal-header">
     <div style="display: none;" class="alert-top fixed-top col-12  text-center alert alert-danger" id="remodal"> </div>
      <h4 class="modal-title" id="myModalLabel">Editar Barrio</h4>
     </div>
     <div class="modal-body ">
      <form id="frmciudades" name="frmciudades" class="form-horizontal" novalidate="">
        
       <div class="row">
              <div class="form-group col-12  col-md-4">
                <label class="control-label">Barrio</label>
                <input class="form-control" type="text" placeholder="Nombre Barrio" id="nombre" name="nombre" oncopy="return false" onpaste="return false" onkeypress="return soloLetras(event)"  maxlength="50">
              </div>
              <div class="form-group col-12  col-md-4">
                <label class="control-label">Latitud</label>
                <input class="form-control" type="text"  id="latedit" name="latedit" onkeypress="return soloNumeros(event);">
              </div>
              <div class="form-group col-12  col-md-4">
                <label class="control-label">Logitud</label>
                <input class="form-control" type="text"  id="lonedit" name="lonedit" onkeypress="return soloNumeros(event);">
              </div>
              
        </div>
      </form>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="btn-save-edit" value="update">Guardar</button>
      <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
      <input type="hidden" id="barrio_id" name="barrio_id" value="0">
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
                     <button type="button" class="btn btn-danger delete-barrio" >Si</button>
                    <input type="hidden" id="barrio-id" name="barrio-id" value="0">
                </div>
            </div>
        </div>
   </div>
 


@endsection

@push('scripts')
<meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Configurar/crud_barrios.js')}}"></script>

<script  type="text/javascript" charset="utf-8">

 /* $("#boton").click(function (e) {
    var buscarbarrio =  $('#buscarbarrio').val();
    var id_departamento = $('#departamento-select-list').val();
    var id_ciudad = $('#ciudades-select-list').val();

    e.preventDefault();
     $("#barrios-list").html('');

           $.ajax({
              type: "get",
              url: '{{route('barrios')}}',
              dataType: "json",
              data: {buscarbarrio: buscarbarrio, id_departamento:id_departamento, id_ciudad:id_ciudad },
              success: function (data){
                console.log(data);
                $.each(data, function(l, item3) {

          

                    $("#barrios-list").append('<tr id="barrios'+ item3.id +'"><td width="35%">'+item3.barrio+'</td><td width="25%">'+item3.nombre+'</td><td width="25%">'+item3.ciudad+'</td><td width="15%"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="'+ item3.id +'"><i class="fa fa-lg fa-edit"  ></i></button><button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="'+ item3.id +'"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>');
                  });
                $('#buscarbarrio').val('');
                $('#departamento-select-list').val('');
                $('#ciudades-select-list').val('');
              }
          });
       });*/

  $(document).ready(function(){
    {{-- SE LLENA EL SELECT DE LOS DEPARTAMENTOS CON AJAX --}}
      $.ajax({
          type: "get",
          url: '{{ route('departamentos_ajax') }}',
          dataType: "json",
          success: function (data){

             $.each(data, function(i, item) {

              //$(".departamento option:eq(1)").prop("selected", true);
              $(".departamento").append('<option value='+item.id+'>'+item.nombre+'</option>');
              });
          }

      });
      // AL SELECCIONAR EL DEPARTAMENTO SE ENVIA EL ID Y SE RECIBE LAS CIUDADES
      $('#departamento-select').change(function(){
        var id_departamento = $(this).val();


          $(".ciudades").html('');

           $.ajax({
              type: "get",
              url: '{{ route('ciudadesCombo') }}',
              dataType: "json",
              data: {id_departamento: id_departamento},
              success: function (data){
             
                 $.each(data, function(l, item1) {

                   //$(".ciudades option:eq(1)").prop("selected", true);
                   $(".ciudades").append('<option value='+item1.id+'>'+item1.ciudad+'</option>');
                  });
              }
          });
      });

      $('#departamento-select-list').change(function(){
        var id_departamento = $(this).val();


          $("#ciudades-select-list").html('<option value="">Seleccione</option>');

           $.ajax({
              type: "get",
              url: '{{ route('ciudadesCombo') }}',
              dataType: "json",
              data: {id_departamento: id_departamento},
              success: function (data){

                 $.each(data, function(l, item1) {

                    $("#ciudades-select-list").append('<option value='+item1.id+'>'+item1.ciudad+'</option>');
                  });
              }
          });
      });

     /* $('#ciudades-select-list').change(function(){
        var id_ciudad = $(this).val();


          $("#barrios-list").html('');

           $.ajax({
              type: "get",
              url: '{{ route('barriosCombo') }}',
              dataType: "json",
              data: {id_ciudad: id_ciudad},
              success: function (data2){
                console.log(data2);

                $.each(data2, function(l, item2) {

                    $("#barrios-list").append('<tr id="barrios'+ item2.id +'"><td width="35%">'+item2.barrio+'</td><td width="25%">'+item2.nombre+'</td><td width="25%">'+item2.ciudad+'</td><td width="15%"><div class="btn-group"><button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="'+ item2.id +'"><i class="fa fa-lg fa-edit"  ></i></button><button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="'+ item2.id +'"><i class="fa fa-lg fa-trash"></i></button></div></td></tr>');
                  });
              }
          });
      });*/
  });
</script>
@endpush