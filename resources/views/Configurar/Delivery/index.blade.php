<?php
if(isset($_SESSION["user"]))
 $id_usuario= $_SESSION["user"];


?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Montos Deliverys')
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
      <h3 class="tile-title">Nuevo Montos Delivery</h3>
      <div class="tile-body ">
        <input type="hidden" name="mensaje" id="mensaje" value="{{$mensaje}}">
        <input type="hidden" name="tipo" id="tipo" value="{{$tipo}}">

        <form id="frmc" name="frmc" action="{{route('montos_delivery.store')}}" novalidate="" method="POST">
          {{ csrf_field() }} 
          <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
          <div class="row">
           <div class="form-group col-12  col-md-4">
            <label class="control-label">Monto</label>
            <input class="form-control" type="number" placeholder="..." id="monto_delivery" name="monto_delivery" oncopy="return false" onpaste="return false"  maxlength="50">
          </div>


          <div class="tile-footer text-center border-0" >
            <button class="btn btn-primary save" type="submit" value="add"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>

<div class="col-12">
  <div class="tile">
    {{-- FILTRO --}}
    {{-- FILTRO --}}
    <div class="col mb-6 text-center">
      <div class="row">
        
          <h3 class="tile-title text-center text-md-left">Listado de Montos Delivery</h3>
      
        
        
        <form class="row d-flex justify-content-end" action="#" method="get">

          <div class="form-group col-md-6">
            <input type="text" class="form-control" id="buscarmonto" name="buscarmonto" placeholder="Buscar"  maxlength="50">
          </div>

          <div class="col-md-1 mr-md-2">
            <button  id="btnBuscar" class="btn btn-primary">Filtrar</button>             
          </div>
        </form>
      </div>
    </div>
    {{-- FIN FILTRO --}}
    <div class="tile-body ">
      <div class="table-responsive">
        <div class="montos_delivery" id="divmontos_delivery">
          <table class="table table-hover" id="sampleTable">
            <thead>
              <tr>
                <th width="30%">Id</th>
                <th width="30%">Monto</th>
                <th width="15%" class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody id="categorias-list" name="categorias-list"> 
              @foreach($montos_delivery as $montos)           
              <tr id="categoria{{$montos->id}}">
                <td width="30%">{{$montos->id}}</td>
                <td width="30%">{{$montos->monto}}</td>
                <td class="text-center"> <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm eliminar" value="{{$montos->id}}"><i class="fa fa-lg fa-trash"></i></button></td>
              </tr>
              @endforeach

            </tbody>
          </table>       

          <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">

            {{$montos_delivery->appends(Request::only(['buscarmonto']))->links()}}
          </div>      </div>
        </div>

      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="form-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">Eliminar Monto</h4>
      </div>
      <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
        <div class="modal-body">
          <p>Está seguro que desea Eliminar?</p>
          <p class="debug-url"></p>
        </div>
      </form> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
        <button type="button" class="btn btn-danger eliminar_monto" >Si</button>
        <input type="hidden" id="monto-id" name="monto-id" value="0">
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')


<script type="text/javascript" language="javascript">
  window.onload = load;
  function load(){
    var valor  = $("#tipo").val();
    var mensaje = $("#mensaje").val();

    if(valor==1){

     $("#res").html(mensaje);
     $("#res, #res-content").css("display","block");
     $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
   }
   if(valor==2){

    $("#rese").html(mensaje);
    $("#rese, #res-content").css("display","block");
    $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
  }
  $("#tipom").val(" ");
  $("#mensaje").val(" ");
} 

$ = jQuery;
jQuery(document).ready(function () {



});


// muestra modal para la confirmar eliminar   categoria
$(document).on('click', '.eliminar', function () {
  var id = $(this).val();
  $('#form-delete').modal('show');
  $('#monto-id').val(id);
});



$(document).on('click', '.eliminar_monto', function () {

  var id = $('#monto-id').val();
  var valor = id;
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });

  $.ajax({
    type: "GET",
    url: '{{ route('montos_delivery.anular') }}',
    dataType: "json",
    data: { id: valor ,  _token: '{{csrf_token()}}' },
    success: function (data){
      console.log(data);
      $('#form-delete').modal('hide');
      $("#res").html("Monto Eliminado con Éxito");
      $("#res, #res-content").css("display","block");
      $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
    },    
    error: function (data) {
      console.log('Error:', data);
      $('#form-delete').modal('hide');
      $("#rese").html("No se pudo eliminar el monto");
      $("#rese, #res-content").css("display","block");
      $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
    }

  });
  $("#mensaje").val(" ");
  $('#tipom').val(" ");  
  location.reload(true);

});


$(document).on('click', '.btnBuscar', function () {

  var id = $('#buscarmonto').val();
  var valor = id;
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });

  $.ajax({
    type: "GET",
    url: 'montos_delivery',
    dataType: "json",
    data: { id: valor ,  _token: '{{csrf_token()}}' },
    success: function (data){
      console.log(data);
    },    
    error: function (data) {
    }

  });
  $("#mensaje").val(" ");
  $('#tipom').val(" ");  
  location.reload(true);

});


</script>


@endpush