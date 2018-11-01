{{-- CABECERA DE SECCION --}}
@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
<?php 
  $titulo = "Relación de Ventas por Producto: ".$productos->descripcion;
?>
@section('titulo', $titulo)
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('inventario/consolidado'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <div class="col mb-3 text-center">
          <div class="row ">
            <div class="col">
              <h4 class="tile-title text-center text-md-left">Listado</h4>
            </div>
            <form class="row d-flex justify-content-end" action="{{route('consolidado.ventas',$productos->id)}}" method="get"> 
              <div class="form-group col-md-6">
                <input class="form-control" type="date" id="fecha_venta" name="fecha_venta" data-date-format="DD/MM/YYYY" value="{{date('Y-m-d')}}">
              </div>
              <div class="form-group col-md-4">
               <select class="form-control" name="filas" id="filas">
                 <option value="0">Filas</option>
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
             <div class="col-md-1 mr-md-4">
              <input type="submit" name="boton" class="btn btn-primary" value="Filtrar">
            </div>
          </form>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              
              <th>Id</th>
              <th>Fecha</th>
              <th>Cliente</th>
              <th class="text-center">Cantidad</th>
              <th class="text-center">Precio</th>
              <th class="text-center">Remito</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ventas as $sol)
            <tr> 
              <td>{{$sol->id_venta}}</td>
              <td class="text-center">{{$sol->fecha}}</td>
              <td>{{$sol->nombres}}</td>
              <td class="text-center">{{$sol->cantidad}} </td>
              <?php $monto = number_format($sol->precio, 0, ',', '.');?>
              <td class="text-right">{{$monto}} </td>
              <td class="text-center">{{$sol->id_remito}} </td>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">

      {{$ventas->appends(Request::only(['fecha']))->links()}}
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