<?php 
$id_usuario= $_SESSION["user"];
?>
{{-- CABECERA DE SECCION --}}
@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Pedidos')
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
@php $longitud=count($notas); @endphp
<link rel="stylesheet" type="text/css" href="{{ asset('css/estilo.css') }}">
@endif      


<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <div class="col mb-2 text-center">
          <div class="row ">
            <div class="col">
              <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
              <h4 class="tile-title text-left text-md-left">Listado de Pedidos</h4>
            </div>
            <form class="row d-flex justify-content-end" action="{{route('pedidos.index')}}" method="get"> 

              <div class="form-group col-md-4">
                <input class="form-control" type="text" name="id_pedido" id="id_pedido" placeholder="Buscar Pedido">
              </div>

              <div class="form-group col-md-4">
                <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Buscar Teléfono">
              </div>

              <div class="form-group mr-md-4">
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
                  <th class="text-left">Venta</th>
                  <th class="text-left">Vendedor</th>
                  <th class="text-left">Cliente</th>
                  <th class="text-left">Teléfono</th>
                  <th class="text-left">Dirección</th>
                  <th class="text-left">Barrio</th>
                  <th class="text-left">Importe</th>
                  <th class="text-left">Fecha</th>
                  <th class="text-center">Estado</th>
                  <th class="text-center" width="20%">Acciones</th>
                </tr>
              </thead>
              <tbody>
               @foreach($pedidos as $pedido)
               <tr
               @if($pedido->id_estado==1)
               class="alert alert-success"    
               @endif  
               @if($pedido->id_estado==5)
               class="table-primary"
               @endif 
                @if($pedido->id_estado==2)
               class="alert alert-danger"
               @endif 

                @if($pedido->id_estado==7)
               class="alert alert-info"
               @endif 

                @if($pedido->id_estado==9)
               class="alert alert-dark"
               @endif 
               
               > 
               <td class="venta" data-id="{{$pedido->id_venta}}" style="text-align: center;">
                <?php $x=0;?>


                @foreach($notas as $not)
                @if($not->id_venta==$pedido->id_venta)
                <?php $x++;?>
                @endif
                @endforeach
                @if($x>0)
                <i class="fa fa-lg fa-commenting-o"></i>
                @endif
                @foreach($notas as $not)
                @if($not->id_venta==$pedido->id_venta)
                <div class="toolTip" id="{{$pedido->id_venta}}"  style="display: none;">
                 <table style="border:0px; width: 400px; font-size: 12px; ">
                   <td style="border:0px; text-align: left; width: 120px;">{{$not->name}}</td>
                   <td style="border:0px; text-align: left;">{!!str_replace( "~",'<br >',$not->nota)!!}</td>
                 </table>
               </div>

               @endif
               @endforeach
             </td>
             <td>{{$pedido->id_venta}}</td>
             <td>{{$pedido->name}}


             </td>
             <td>{{$pedido->nombres}}</td>
             <td>{{$pedido->telefono}}</td>
             <td>{{$pedido->direccion}}</td>
             <td >{{$pedido->barrio}}</td>
             <td>{{$pedido->monto}}</td>
             <td>{{$pedido->fecha}}</td>
             <td>{{$pedido->estado}}</td>
             <td class="text-center" width="15%">
              <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $pedido->id_venta }}"><i class="m-0 fa fa-lg fa-eye"></i></button>
              @if($pedido->id_estado==1) 
              
              <button data-toggle="tooltip" data-placement="top"  title="Agrear Nota" class="btn btn-primary nota"  value="{{$pedido->id_venta}}"><i class="fa fa-lg fa-comment-o" ></i></button>   
              @endif


              @if($pedido->id_estado==5) 
              <a class="btn btn-primary" href="{{ route('procesar.confirmar',$pedido->id) }}"><i class="fa fa-lg fa-phone" title="Cliente a Confirmar"></i></a>
              <button data-toggle="tooltip" data-placement="top"  title="Agrear Nota" class="btn btn-primary nota"  value="{{$pedido->id_venta}}"><i class="fa fa-lg fa-comment-o" ></i></button>   
              <button data-toggle="tooltip" data-placement="top"  title="Venta Caida" class="btn btn-primary ventacaida"  value="{{$pedido->id_venta}}"><i class="fa fa-lg fa-times" ></i></button>   

                @endif
                @if($pedido->id_estado!=5) 
                <!--<button data-toggle="tooltip" data-placement="top" title="Descompuesto" class="btn btn-primary detalle"  value="{{ $pedido->id_venta }}"><i class="m-0 fa fa-lg fa-ban"></i></button>-->

                @endif

                @if($pedido->id_estado==7) 
                <!--<button data-toggle="tooltip" data-placement="top" title="Descompuesto" class="btn btn-primary detalle"  value="{{ $pedido->id_venta }}"><i class="m-0 fa fa-lg fa-ban"></i></button>-->
              <button data-toggle="tooltip" data-placement="top"  title="Devolver Pedido" class="btn btn-primary ventadevuelta"  value="{{$pedido->id_venta}}"><i class="fa fa-share-square-o" ></i></button>   



                @endif

              </td> 
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
        {{$pedidos->appends(Request::only(['id_pedido' , 'telefono']))->links()}}
        <!--sección para definir paginación de laravel-->
      </div>
    </div>
  </div>
</div>
</div>

<!--Ventana Modal de Notas  -->
<div class="modal fade" id="ModalNota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog  modal-dialog-centered " role="document">
   <div style="display: none;" class="alert-top fixed-top text-center alert alert-danger remodal" id="remodal"> </div>
   <div class="modal-content">
    <div class="modal-header">   
      <h4 class="modal-title" id="myModalLabel"><input type="text" class="form-control-plaintext" name="lnota" id="lnota"></h4>
    </div>
    <form id="frmnota" name="frmnota" class="form-horizontal" novalidate="">
      <textarea type="text" rows="3" cols="75" class="form-control" name="nota"  id="nota"></textarea>
    </form> 
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="btn-nota">Guardar</button>
      <input type="hidden" id="tipo" name="tipo">
      <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
      <input type="hidden" id="id_venta" name="id_venta" value="0">
      <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
    </div>
  </div>
</div>
</div>


<!--Ventana Modal de Vista Previa del Pedido-->
<div class="modal fade" id="ModalVenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="title">Detalles del Pedido {{$pedido->id_venta}}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th style="text-align: center;">Cliente</th>
            <th style="text-align: center;">Ruc</th>
            <th style="text-align: center;">Teléfono</th>
            <th style="text-align: center;">Email</th>              
          </tr>
        </thead>
        <tbody id="cliente_detalle"> 
        </tbody>
      </table>
    </div>
    <div class="table-responsive">
     <table class="table">
      <thead>
        <tr>
          <th style="text-align: center;">Dirección</th>             
          <th colaspan="2" style="text-align: center;">Zona</th>
          <th colaspan="2" style="text-align: center;">Ubicación</th>
        </tr>
      </thead>
      <tbody id="cliente_detalle2">  
      </tbody>
    </table>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th style="text-align: center;">Tipo Cliente</th>
          <th style="text-align: center;">Fecha Venta</th>
          <th style="text-align: center;">Fecha Entrega</th>
          <th style="text-align: center;">Forma de Pago</th>
        </tr>
      </thead>
      <tbody id="cliente_detalle3">
      </tbody>
    </table>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th class="text-center">Horario de Entrega</th>
          <th class="text-center">Vendedor</th>
        </tr>
      </thead>
      <tbody id="horario_detalle">
      </tbody>
    </table>
  </div> 
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th style="text-align: center;">Código</th>
          <th style="text-align: center;">Producto</th>
          <th style="text-align: center;">Cantidad</th>
          <th style="text-align: center;">Precio</th>
          <th style="text-align: right;">Importe</th>
        </tr>
      </thead>
      <tbody id="productos_detalle">     
      </tbody>  
    </table>
    
  </div>        
  <div class="modal-footer">

    <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
  </div>
</div>
</div>
</div>



@endsection

@push('scripts')
<script type="text/javascript">

  $(document).ready(function(){

   $('.venta').hover(function () {
     var data_id = $(this).data('id');

     $('.toolTip').each(function() {
       var div = $(this);

       if(div.attr('id') == data_id){
        div.show();
      }else{
        div.hide();
      }

    }); 

   },

   function () { $('.toolTip').css("display","none");}
   );

   $(document).on('click', '.detalle', function () {
    $('#detalle').val("");
    var idventa = $(this).val();
    $('#ModalVenta').modal('show');
    $('#id_venta').val(idventa);

    $.ajax({
      type: "GET",
      url: '{{ url('detalle_venta') }}',
      dataType: "json",
      data: { id:idventa, _token: '{{csrf_token()}}'},

      success: function (data){
        console.log(data);
        $("#cliente_detalle").append(`<tr>
         <td style="text-align: center;">${data.venta[0].nombres}</td>
         <td style="text-align: center;">${data.venta[0].ruc_ci}</td>
         <td style="text-align: center;">${data.venta[0].telefono}</td>
         <td style="text-align: center;">${data.venta[0].email}</td>
         </tr>`);
        $("#cliente_detalle2").append(`<tr>
          <td style="text-align: center;">${data.venta[0].direccion}</td>
          <td style="text-align: center;">${data.venta[0].barrio}</td> 
          <td style="text-align: center;">${data.venta[0].ubicacion}</td> 
          </tr>`);
        $("#cliente_detalle3").append('<tr>'+
          (data.venta[0].id_tipo==1 ? '<td style="text-align: center;">Natural</td>'
           :   '<td style="text-align: center;">Jurídico</td>')+'<td style="text-align: center;">'+data.venta[0].fecha+'</td><td style="text-align: center;">'+data.venta[0].fecha_cobro+'</td> <td style="text-align: center;">'+data.venta[0].forma_pago+'</td></tr>');

        $("#horario_detalle").append(`<tr>
         <td colspan="2" style="text-align: center;">${data.venta[0].horario}</td>
         <td colspan="2" style="text-align: center;">${data.venta[0].nameuser}</td>
         </tr>`);

          //CICLO DE LOS DATOS RECIBIDOS
          $.each(data.venta, function(l, item) {

           importes=item.cantidad*item.precio;
              // total+=importe;
              $("#productos_detalle").append(`<tr>

                <td style="text-align: left;">${item.codigo_producto}</td>
                <td style="text-align: left;">${item.descripcion}</td>
                <td style="text-align: center;">${item.cantidad}</td>
                <td style="text-align: right;">${item.precio.toLocaleString('de-DE')}</td>
                <td style="text-align: right;">${importes.toLocaleString('de-DE')}</td>
                </tr>`);
            });

          $("#productos_detalle").append(`<tr>
            <td colspan="5" style="text-align:  right;"><h5>Total: ${data.venta[0].importe.toLocaleString('de-DE')} Gs.</h5></td>
            </tr>`);



        }
      });



  });




   $(document).on('click', '.nota', function () {
    $('#nota').val("");
    var idventa = $(this).val();
    $('#lnota').val('Agregar Nota Pedido');
    $('#tipo').val('1');
    $('#ModalNota').modal('show');
    $('#id_venta').val(idventa);
    


  });

   $(document).on('click', '.ventacaida', function () {
    $('#nota').val("");
    var idventa = $(this).val();
    $('#lnota').val('Venta Caida. Motivo');
    $('#tipo').val('2');
    $('#ModalNota').modal('show');
    $('#id_venta').val(idventa);
    


  });

   $(document).on('click', '.ventadevuelta', function () {
    $('#nota').val("");
    var idventa = $(this).val();
    $('#lnota').val('Venta Devuelta. Motivo');
    $('#tipo').val('3');
    $('#ModalNota').modal('show');
    $('#id_venta').val(idventa);
    


  });


 });

  $('#btn-nota').click(function(){
    var id_venta  = $('#id_venta').val();
    var nota      = $('#nota').val();

    var id_usuario= $('#id_usuario').val();
    if ($('#nota').val()==""){

      $(".remodal").html("Por Favor Agregue una Nota");
      $(".remodal").css("display","block");
      $(".remodal").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
      return false;

    }else{

      var formData = {
        id_usuario:   id_usuario,
        nota      :   nota,
        id_venta  :   id_venta
      }
      valor=0;
      tipo = $("#tipo").val();
      $.ajax({
        type: "GET",
        url: '{{ url('add_notas') }}',
        dataType: "json",
        data: formData,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data){

         $('#ModalNota').modal('hide');
         $("#res").html("Se Agrego con Éxito una Nota a la Venta");
         $("#res, #res-content").css("display","block");
         $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
         valor=1;
       }      

     });

    }

     if(tipo=='2' || valor == 1)
     {
    
      var formData = {
        id  :   id_venta
      }
      $.ajax({
        type: "GET",
        url: '{{ url('caida') }}',
        dataType: "json",
        data: formData,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data){
         $("#res").html("Se ha dado de baja a la venta");
         $("#res, #res-content").css("display","block");
         $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
         location.reload(true);
       }      

     });

     } 
     if(tipo=='3' || valor == 1)
     {
    
      var formData = {
        id  :   id_venta
      }
      $.ajax({
        type: "GET",
        url: '{{ url('venta/devuelta') }}',
        dataType: "json",
        data: formData,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data){
         $("#res").html("Se ha devuelto la venta");
         $("#res, #res-content").css("display","block");
         $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
         location.reload(true);
       }      

     });

     } 


  });




</script>
@endpush




































