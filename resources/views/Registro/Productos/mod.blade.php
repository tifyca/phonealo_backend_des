@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Modificación en Masa')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('productos/proveedor/crear') )  
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
  @if(Session::has('message'))
                         <div class="alert alert-success">

                           {{ Session::get('message') }} 
                          </div>
                      @endif   
<?php
  if(isset($tipo)) $tip=$tipo;
  else $tip="";

  if(isset($mensaje)) $men=$mensaje;
  else $men="";

?>
<input type="hidden" name="tipom" id="tipom" value="{{$tip}}">
<input type="hidden" name="mensaje" id="mensaje" value="{{$men}}">  

<div class="row">
    <div class="col-12">

    <div class="tile">
      <div class="tile-body ">

        <div class="col mb-3 text-center">
        
          <div class="row ">
        <h4>Listado de Productos</h4>
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
              <div class="form-group col-md-3">
                     <select class="form-control" name="filas" id="filas">
                         <option value="0">Nro de Filas</option>
                         <option value="10">10</option>
                         <option value="20">20</option>
                         <option value="30">30</option>
                         <option value="40">40</option>
                         <option value="60">60</option>
                         <option value="100">100</option>
                         <option value="150">150</option>
                         <option value="200">200</option>
                       </select>
              </div>
              <div class="col-md-1 mr-md-5">
                <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
              </div>
            </form>
            <br>

          </div>
        </div>
   
     
          <div class="table-responsive" style="overflow-x: scroll;">

            
       
            <table class="table table-hover" id="sampleTable">
              <thead>
                <tr class="table-info">
                   <th colspan="9" class="text-right"><b><small>Presione Enter para Guardar Cambios</small></b></th>
                </tr>
                <tr>
                  <th width="1%">#</th>
                  <th width="2%">Código</th>
                  <th width="5%">Descripcion(Interna)</th>
                  <th width="10%">Nombre/Orig.</th>
                   <th width="10%">Nombre(S/Proveedor)</th>
                  <th width="14%" class="text-center">Precio.Ideal</th>
                  <th width="14%" class="text-center">PrecioMin</th>
                  <th width="3%" class="text-center">Ult.Precio.Compra</th>
                  <th width="3%" class="text-center">Ult.Precio.Venta</th>
                </tr>
              </thead>
              <tbody>
                <?php $producto=""; ?>
                @foreach($productos as $ficha)
                   
                 @if(!empty($ficha->producto))
                   @php $producto = $ficha->producto; @endphp
                 @endif
                      
                 
                <tr >
                  <td class="" width="1%"><input type="hidden" id="id_proveedor2" name="id_proveedor2" value="{{$ficha->id_proveedor}}"><input type="hidden" id="id_producto2" name="id_producto2" value="{{$ficha->id}}">{{$ficha->id}}</td>
                  <td width="2%">{{$ficha->codigo_producto}}</td>
                  <td width="5%"><input type="text" class="form-control" name="descripcion" value="{{$ficha->descripcion}}" disabled=""></td>
                 
                  <td class="col-md-18">
                       
                          <input type="text" class="form-control" name="nombres_original" value="{{$ficha->nombre_original}}" id="nombres_original">
                       
                   </td>
                    <td width="10%"><input type="text" class="form-control read" name="nombresp" value="{{$producto}}" id="nombresp" readonly=""></td>
                  <td width="18%"><input type="text" class="form-control col-lg-12 text-right" name="precio_ideal" value="{{$ficha->precio_ideal}}" id="precio_ideal" size="20"></td>
                  <td width="18%"><input type="text" class="form-control col-lg-12 -right" name="precio_minimo" value="{{$ficha->precio_minimo}}" size="20" id="precio_minimo"></td>
                 <td width="3%" class="text-right">
                   <?php $pc="";?>
                   @foreach($compras as $compra)
                     @if($compra->id_producto==$ficha->id)
                        @php
                          $pc = $compra->precio_confirmado
                        @endphp
                     @endif
                   @endforeach
                   {{ $pc }}
                 </td>
                 <td width="3%" class="text-right">
                   <?php $pv="";?>
                   @foreach($ventas as $venta)
                     @if($venta->id_producto==$ficha->id)
                        @php
                          $pv = $venta->precio
                        @endphp
                     @endif
                   @endforeach
                   {{ $pv }}
                   
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
  var valor  = $("#tip").val();
  var mensaje = $("#mens").val();
  var verifica = $("#activo").val();
  if(verifica==1)
  {     $('.read').prop('readonly', false);
      $('.read').prop('disabled', false); }
else
 {    $('.read').prop('readonly', true);
     $('.read').prop('disabled', true);
   } 

  
  if(valor==1){

           $("#res").html(mens);
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
  }
  if(valor==2){

            $("#rese").html(mens);
            $("#rese, #res-content").css("display","block");
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
  }
  $("#tipom").val(" ");
  $("#mensaje").val(" ");


   
} 
</script>
<script>  
  $ = jQuery;
  jQuery(document).ready(function () {
     

    $("input#nombresp").bind('change', function (event) {
      var nom = $(this).val();
      var idproducto     = $("#id_producto2").val();
      var idproveedor     = $("#id_proveedor2").val();
      //alert(idproducto);
         $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "GET",
          url: '{{ url('productos/cambiar_nombres') }}',
          dataType: "json",
          data: { nombre: nom , idp: idproducto , idpp: idproveedor ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
          }});   


     });

   $("input#nombres_original").bind('change', function (event) {
      var nom = $(this).val();
      var idproducto     = $("#id_producto2").val();
      var idproveedor     = $("#id_proveedor2").val();
      //alert(idproducto);
         $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "GET",
          url: '{{ url('productos/cambiar_nombre_original') }}',
          dataType: "json",
          data: { nombre: nom , idp: idproducto , idpp: idproveedor ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
          }});   


     });

    
   $("input#precio_ideal").bind('change', function (event) {
      var prec = $(this).val();
      var idproducto     = $("#id_producto2").val();
      var idproveedor     = $("#id_proveedor2").val();
      //alert(idproducto);
         $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "GET",
          url: '{{ url('productos/cambiar_precio') }}',
          dataType: "json",
          data: { precio: prec , idp: idproducto , idpp: idproveedor ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
          }});   


     });

   $("input#precio_minimo").bind('change', function (event) {
      var prec = $(this).val();
      var idproducto     = $("#id_producto2").val();
      var idproveedor     = $("#id_proveedor2").val();
      //alert(idproducto);
         $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "GET",
          url: '{{ url('productos/cambiar_precio_minimo') }}',
          dataType: "json",
          data: { precio: prec , idp: idproducto , idpp: idproveedor ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
          }});   


     });



    });

    $("input#boton").bind('click', function (event) {
      $("form").submit();
    });
    
 



</script>
@endpush