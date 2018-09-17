@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Galería')
@section('descripcion', '')

{{-- ACCIONES --}}

@section('display_back', '') @section('link_back',  url('registro/productos'))
@section('display_new','')  
@section('link_new')
{{ route('galeria.new',$id) }}
@endsection 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
@if(Session::has('message'))
                         <div class="alert alert-success">

                           {{ Session::get('message') }} 
                          </div>
                      @endif    
<input type="hidden" name="tipom" id="tipom" value="{{$tipo}}">
<input type="hidden" name="mensaje" id="mensaje" value="{{$mensaje}}">  

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <h3 class="tile-title text-center text-md-left">{{$nombre}}</h3>
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th align="center">Título</th>
                  <th align="center">Imagen</th>
                  <th align="center">Estatus</th>
                  <th align="center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($galeria as $ficha)
                <tr>
                  <td align="center">{{$ficha->titulo}}</td>
                  <td class="text-center">
                  <?php 
                      $url=$ficha->img;
                       if($url)
                        
                        $zurl = config('app.url') . '/productos/' . $url ;
                      else
                        $zurl = 'img/img-default.png';
                     
                  ?>                    
                    <img src="{{ asset($zurl) }}" class="img-fluid w-25" alt="">
                  </td>
                  <td align="center">
                    @if($ficha->estatus==0) Inactivo @endif 
                    @if($ficha->estatus==1) Activo @endif
                  </td>

                  <td width="10%" class="text-center">
                    <div class="btn-group">
                      <a data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm" href="{{ route('galeria.edit',$ficha->id) }}" title="Ver/Editar"><i class="m-0 fa fa-lg fa-pencil"></i></a>
                      <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$ficha->id}}"><i class="fa fa-lg fa-trash"></i></button>                                  

                    </div>
                      
                  </td>
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
           <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $galeria->render(); ?>
              </div>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">Eliminar Imágen de Galería</h4>
      </div>
      <form id="frmdel" name="frmdel" class="form-horizontal" novalidate="">
        <div class="modal-body">
          <p>Está seguro que desea Eliminar Imágen?</p>
          <p class="debug-url"></p>
        </div>
      </form> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"></span>No</button>
        <button type="button" class="btn btn-danger delete-imagen" >Si</button>
        <input type="hidden" id="imagen-id" name="imagen-id" value="0">
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

} 


  $ = jQuery;
  jQuery(document).ready(function () {


    $("input#boton").bind('click', function (event) {
      $("form").submit();
    });
    
  });


// muestra modal para la confirmar eliminar   categoria
$(document).on('click', '.confirm-delete', function () {
    var id = $(this).val();
    $('#confirm-delete').modal('show');
    $('#imagen-id').val(id);
    
});



$(document).on('click', '.delete-imagen', function () {

    var id = $('#imagen-id').val();
    var valor = id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    
        $.ajax({
          type: "GET",
          url: '{{ route('galeria.destroy') }}',
          dataType: "json",
          data: { id: valor ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
            $('#confirm-delete').modal('hide');
            $("#res").html("Imagen Eliminada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
          },    
        error: function (data) {
            console.log('Error:', data);
            $('#confirm-delete').modal('hide');
            $("#rese").html("No se pudo eliminar la imagen");
            $("#rese, #res-content").css("display","block");
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        }

        });


});


</script>

@endpush