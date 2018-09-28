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
        <div class="col mb-3 text-center">
          <div class="row ">
            <form class="row d-flex justify-content-end" action="{{route('productos.ajustar')}}" method="get"> 
              <input type="hidden" id="activo" name="activo" value="{{$activar}}">
              <div class="form-group col-md-3">
                <input class="form-control" type="text" name="id_producto" id="id_producto" placeholder="Producto">
              </div>
              <div class="form-group col-md-3">
                <select class="form-control" id="id_proveedor" name="id_proveedor" ">
                  <option value="">Proveedor</option>
                  @foreach($proveedores as $proveedor)
                  <option value="{{$proveedor->id}}">{{$proveedor->nombres}}</option>
                  @endforeach
                </select>
              </div>
              
              <div class="col-md-1 mr-md-5">
                <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
              </div>
            </form>
          </div>
        </div>
   
     
          <div class="table-responsive">
            <table class="table table-hover " id="sampleTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Código</th>
                  <th>Descripcion(Interna)</th>
                  <th>Nombre(Según Proveedor)</th>
                  <th class="text-center">Precio Ideal</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php $producto=""; ?>
                @foreach($productos as $ficha)
                   
                 @if(!empty($ficha->producto))
                   @php $producto = $ficha->producto; @endphp
                 @endif
                      
                 
                <tr >
                  <td class="" >{{$ficha->id}}</td>
                  <td>{{$ficha->codigo_producto}}</td>
                  <td width="40%"><input type="text" class="form-control" name="descripcion[]" value="{{$ficha->descripcion}}" disabled=""></td>
                   <td width="40%"><input type="text" class="form-control read" name="nombres[]" value="{{$producto}}" disabled=""></td>
                  <td width="30%"><input type="text" class="form-control read text-right" name="descripcion[]" value="{{$ficha->precio_ideal}}" disabled=""></td>
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
                    
                    {{$productos->appends(Request::only(['id_proveedor' , 'id_producto']))->links()}}
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
  var verifica = $("#activo").val();
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
  if(verifica==1)
  {     $('.read').prop('readonly', false);
      $('.read').prop('disabled', false); }
  else
   {    $('.read').prop('readonly', true);
      $('.read').prop('disabled', true);} 


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