<?php 
$id_usuario= $_SESSION["user"];
?>
{{-- CABECERA DE SECCION --}}
@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Sliders')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', route('slider.create') ) 
@section('display_edit', 'd-none')    @section('link_edit', route('slider.edit',auth()->user()->id))
@section('display_trash','d-none')    @section('link_trash')

@section('content')

@if(Session::has('message'))
<div class="alert alert-success">

   {{ Session::get('message') }} 
</div>
@endif
<input type="hidden" name="tipom" id="tipom" value="<?php echo $tipo ?>">
<input type="hidden" name="mensaje" id="mensaje" value="{{$mensaje}}"> 

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <div class="col mb-3 text-center">
          <div class="row ">
            <div class="col">
              <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
              <h4 class="tile-title text-left text-md-left">Listado de Sliders</h4> <br>
          </div>
          <form class="row d-flex justify-content-end" action="{{route('slider.index')}}" method="get"> 

              <div class="form-group col-mb-4">
                <input class="form-control" type="text" name="titulo" id="titulo" placeholder="Buscar Título">
            </div>

            <div class="form-group col-mb-3">
                <input class="form-control" type="date" name="fecha" id="fecha" placeholder="Buscar Fecha">
            </div>

            <div class="form-group col-mb-3">
                <select name="usuario" id="usuario" class="form-control">
                  <option value="">Usuarios</option> 
                  @foreach($usuarios as $usuario)  
                  <option value="{{$usuario->id}}"> {{ $usuario->name }} </option>
                 @endforeach
                </select>
            </div>
            <div class="form-group col-mb-3">
                <select name="publico" id="publico" class="custom-select" placeholder="Publico">
                    <option value="">Público</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>


            <div class="form-group col-mb-3">
                <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
            </div>
        </form>
    </div>
</div>
<div class="tile-body ">
  <div class="table-responsive">
    <table class="table table-hover " id="sampleTable">
      <thead>
        <tr>
          <th>#</th>
          <th class="text-left">Titulo</th>
          <th class="text-center">Público</th>
          <th class="text-center">Posición</th>
          <th class="text-center">Fecha</th>
          <th class="text-center">Imagen</th>
          <th class="text-center" width="20%">Acciones</th>
      </tr>
  </thead>
  <tbody>
    @foreach($slider as $item)
     <tr> 
      <td>{{$item->id}}</td>
      <td class="text-left">{{$item->descripcion}}</td>@if($item->publico == 1)
      <td class="text-center">Sí</td>
      @endif
      @if($item->publico == 0)
      <td class="text-center">No</td>
      @endif
      <td class="text-center">{{$item->posicion}}</td>
      <td class="text-center">{{$item->created_at}}</td>
      <?php 
                        $url=$item->url;
                         if(!empty($url))   
                          $zurl = config('app.url') . '/slider/' . $url ;
                        else
                          $zurl = 'img/silueta2.png';
                      ?>
      <td class="text-center"><img src="{{asset($zurl)}}" class="img-fluid" width="100px" alt=""></td>
         <td width="10%" class="text-center">
            <div class="btn-group">
              <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver/Editar" href="{{ URL::to('ecommerce/slider/' . $item->id . '/edit') }}"><i class="m-0 fa fa-lg fa-edit"></i></a>
              <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$item->id}}"><i class="fa fa-lg fa-trash"></i></button>    
          </div>
      </td> 
  </tr>
   @endforeach
</tbody>
</table>
</div>
<div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
   
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">Eliminar Slider</h4>
      </div>
      <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
        <div class="modal-body">
          <p>Está seguro que desea eliminar este Slider?</p>
          <p class="debug-url"></p>
        </div>
      </form> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
        <button type="button" class="btn btn-danger delete-slider" >Si</button>
        <input type="hidden" id="item-id" name="item-id" value="0">
      </div>
    </div>
  </div>
</div>


@endsection

@push('scripts')

<script type="text/javascript" language="javascript">
    window.onload = load;
    function load(){
      var valor  = $("#tipom").val();
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

    };
    $("input#boton").bind('click', function (event) {
      $("form").submit();
    });

/////Modales

$(document).on('click', '.confirm-delete', function () {
    var slider_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#item-id').val(slider_id);
});

$(document).on('click', '.delete-slider', function () {
    var url = "slider";
    var slider_id = $('#item-id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + slider_id,
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            $("#item" + slider_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Slider eliminado con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
            $('#confirm-delete').modal('hide');
            $("#rese").html("No se pudo eliminar el Slider");
            $("#rese, #res-content").css("display","block");
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }

    });
    location.reload();
});
</script>
@endpush