@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Modificación en Masa de Productos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
  @if(Session::has('message'))
                         <div class="alert alert-success">

                           {{ Session::get('message') }} 
                          </div>
                      @endif   
<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
     
     
          <div class="table-responsive">
            <table class="table table-hover " id="sampleTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Código</th>
                  <th>Producto</th>
                  <th>Nombre Original</th>
                  <th class="text-center">Precio Ideal</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($productos as $ficha)
                <tr >
                  <td class="" >{{$ficha->id}}</td>
                  <td>{{$ficha->codigo_producto}}</td>
                  <td width="40%"><input type="text" class="form-control" name="descripcion[]" value="{{$ficha->descripcion}}"></td>
                   <td width="40%"><input type="text" class="form-control" name="descripcion[]" value="{{$ficha->nombre_original}}"></td>
                  <td width="30%"><input type="text" class="form-control text-right" name="descripcion[]" value="{{$ficha->precio_ideal}}"></td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a data-toggle="tooltip" data-placement="top" title="Actualizar" class="btn btn-primary" href="{{ route('productos.edit',$ficha->id) }}" ><i class="m-0 fa fa-lg fa-check"></i></a>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
           <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    
                    {{$productos->appends(Request::only(['id_categoria' , 'valor', 'id_subcategoria']))->links()}}
              </div>
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

    $("select#id_categoria").bind('change', function (event) {
      var valor = $(this).val();
    $("#id_subcategoria").html('');
    $("#id_subcategoria").append('<option value='+'>Subcategoria</option>');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({
        type: "GET",
        url: '{{ url('mostrar_subcategorias') }}',
        dataType: "json",
        data: { idc: valor ,  _token: '{{csrf_token()}}' },
        success: function (data){
          console.log(data);
         $.each(data, function(l, item1) {
                     $("#id_subcategoria").append('<option value='+item1.id+'>'+item1.sub_categoria+'</option>');
               });
       }    


     });
    
     


    });

    $("input#boton").bind('click', function (event) {
      $("form").submit();
    });
    
 });



</script>
@endpush