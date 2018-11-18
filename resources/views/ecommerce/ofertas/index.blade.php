<?php 
$id_usuario= $_SESSION["user"];
?>
{{-- CABECERA DE SECCION --}}
@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Ofertas')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', route('ofertas.create') ) 
@section('display_edit', 'd-none')    @section('link_edit')
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
              <h4 class="tile-title text-left text-md-left">Listado de Ofertas</h4> <br>
          </div>
          <form class="row d-flex justify-content-end" action="{{route('ofertas.index')}}" method="get"> 
            <div class="form-group col-mb-3">
                <input class="form-control" type="text" name="producto" id="producto" placeholder="Buscar Producto">
            </div>

            <div class="form-group col-mb-3">
                <input name="precio" type="text" placeholder="Buscar Precio" id="precio" class="form-control">
            </div>
            <div class="form-group col-mb-3">
                <select name="home" id="home" class="form-control">
                    <option value="">Home</option>
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
          <th class="text-left">Código</th>
          <th class="text-left">Producto</th>
          <th class="text-center">Precio</th>
          <th class="text-center">Home</th>
          <th class="text-center">Banner</th>
          <th class="text-center" width="20%">Acciones</th>
      </tr>
  </thead>
  <tbody>
    @foreach($productos as $producto)
     <tr> 
      <td>{{$producto->id}}</td>
      <td class="text-left">{{$producto->codigo_producto}}</td>
      <td class="text-left">{{$producto->descripcion}}</td>
      <td class="text-center"><?php $precio = number_format($producto->precio_oferta, 2, ',', '.');
        echo $precio;?></td>
      @if($producto->home == 1)
      <td class="text-center">Sí</td>
      @endif
      @if($producto->home != 1)
      <td class="text-center">No</td>
      @endif
      <?php 
        $url=$producto->banner_oferta;
         if(!empty($url))   
          $zurl = config('app.url') . '/banner/' . $url ;
        else
          $zurl = 'img/silueta2.png';
      ?>
      <td class="text-center"><img src="{{asset($zurl)}}" class="img-fluid" width="100px" alt=""></td>
         <td width="10%" class="text-center">
            <div class="btn-group">
              <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver/Editar" href="{{ route('ofertas.edit',$producto->id) }}"><i class="m-0 fa fa-lg fa-edit"></i></a>
              <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$producto->id}}"><i class="fa fa-lg fa-trash"></i></button>
            </div>
      </td> 
  </tr>
  @endforeach
</tbody>
</table>
</div>
<div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
  {{$productos->appends(Request::only(['producto' , 'precio', 'home']))->links()}}
              </div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">Eliminar Oferta</h4>
      </div>
      <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
        <div class="modal-body">
          <p>Está seguro que desea eliminar esta Oferta?</p>
          <p class="debug-url"></p>
        </div>
      </form> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
        <button type="button" class="btn btn-danger delete-oferta" >Si</button>
        <input type="hidden" id="producto-id" name="producto-id" value="0">
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
    var producto_id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#producto-id').val(producto_id);
});

$(document).on('click', '.delete-oferta', function () {
    var url = "ofertas";
    var producto_id = $('#producto-id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url + '/' + producto_id,
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
            console.log(data);
            $("#producto" + producto_id).remove();
            $('#confirm-delete').modal('hide');
            $("#res").html("Oferta eliminada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
        error: function (data) {
            console.log('Error:', data);
            $('#confirm-delete').modal('hide');
            $("#rese").html("No se pudo eliminar la Oferta");
            $("#rese, #res-content").css("display","block");
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }

    });
    location.reload();
});
</script>
@endpush