<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>
@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'A Confirmar')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
@php $longitud=count($notaventa); @endphp

<div class="row">

@if($aconfirmarp!="")
  <div class="col-12">
    <div class="tile ">
      <h3 class="tile-title text-center text-md-left">Clientes por Atender <small>(48 hr. Sin Respuesta)</small> </h3>
      <div class="tile-body ">
        <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    
                    <th>Venta</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Barrio</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Vendedor</th>
                    <th>Importe</th>
                    <th>Acciones</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
                  <?php $total = 0; ?>
                  @foreach($aconfirmarp as $item2)
                  <tr  class="table-danger">
                    <td class="venta"   <?php $x=0; ?>
                                          @for($i=0; $i<$longitud; $i++)
                                            @if($item2->id==$notaventa[$i]->id_venta)
                                               <?php $x=$x+1; ?>
                                                  @if($x==1)
                                                     data-id="{{$item2->id}}"
                                                  @endif
                                            @endif
                                          @endfor  style="text-align: center;">{{$item2->id}}    
                                     <?php $x=0; ?>
                                  @for($i=0; $i<$longitud; $i++)
                                    @if($item2->id==$notaventa[$i]->id_venta)
                                     <?php $x=$x+1; ?>
                                     @if($x==1)
                                       &spades;
                                     @endif
                                    @endif
                                  @endfor
                                  <div class="toolTip" id="{{$item2->id}}" style="display: none;">
                              @foreach($nota as $itemn)
                                @if($itemn->id_venta==$item2->id)
                                   <table style="border:0px; width: 850px; font-size: 12px; ">
                                    <td style="border:0px; text-align: left; width: 140px;">{{$itemn->fecha}}</td>
                                    <td style="border:0px; text-align: left; width: 110px;">{{$itemn->nombre}}</td>
                                    <td style="border:0px; text-align: left;">{{$itemn->nota}}</td>
                                   </table>
                                @endif
                              @endforeach
                                  </div>
                                          </td>
                    <td>{{$item2->nombres}}</td>
                    <td>{{$item2->telefono}}</td>
                    <td>{{$item2->direccion}}</td>
                    <td>{{$item2->barrio}}</td>
                    <td>{{$item2->fecha}}</td>
                    <td>{{$item2->estado}}</td>
                    <td>{{$item2->name}}</td>
                    <td>{!!number_format($item2->importe, 0,',', '.')!!}</td>
                    
                     <td width="10%" class="text-center">
                      <div class="btn-group">
                        <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $item2->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>
                        <button class="btn btn-primary acciones" data-toggle="modal" data-target="#modalCliente" value="{{$item2->id}}"><i class="m-0 fa fa-lg fa-phone"></i></button>
                      </div>
                    </td>    
                  </tr>
                  <?php $total += $item2->importe; ?>
                  @endforeach
                  <tr>
                    <td colspan="8" class="text-right">
                      <h4>Total Gs.:</h4>
                    </td>
                    <td colspan="2">
                     <h4>{!!number_format($total, 0,',', '.')!!}</h4>
                    </td>
                  </tr>
        
 
                 
                </tbody>
              </table>
            </div>
      </div>
    </div>
  </div>
@endif
  <div class="col-12">
    <div class="tile">
      <div class="col mb-3 text-center">
             <form action="{{ route('aconfirmar.submit') }} " method="POST">
               {{ csrf_field() }}
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Clientes por Confirmar</h3>
            </div>
            <div class="form-group col-md-2">
              <input class="form-control" type="text" id="venta" name="venta" placeholder="Venta">
            </div>
            <div class="form-group col-md-2">
              <input class="form-control" type="date" id="fecha" name="fecha" >
            </div>
            <div class="form-group col-md-2">
               <select class="form-control" id="vendedor" name="vendedor" >  
                <option value="">Vendedor</option>
                @foreach($vendedor as $item2)
                <option value="{{$item2->id}}">{{$item2->name }}</option>     
                @endforeach        
              </select>
            </div>
        <div class="form-group col-md-1 p-0 text-right">
              <input class="btn btn-warning" type="submit" value="Filtrar" name="filtrar">
            </div>
        </form>
        </div>
          </div>
        <div class="tile-body ">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    
                    <th>Venta</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Barrio</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Vendedor</th>
                    <th>Importe</th>
                    <th>Acciones</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
                  <?php $total = 0; ?>
                  @foreach($aconfirmar as $item)
                  <tr>
                    <td class="venta"   <?php $x=0; ?>
                                          @for($i=0; $i<$longitud; $i++)
                                            @if($item->id==$notaventa[$i]->id_venta)
                                               <?php $x=$x+1; ?>
                                                  @if($x==1)
                                                     data-id="{{$item->id}}"
                                                  @endif
                                            @endif
                                          @endfor  style="text-align: center;">{{$item->id}}    
                                     <?php $x=0; ?>
                                  @for($i=0; $i<$longitud; $i++)
                                    @if($item->id==$notaventa[$i]->id_venta)
                                     <?php $x=$x+1; ?>
                                     @if($x==1)
                                       &spades;
                                     @endif
                                    @endif
                                  @endfor
                                  <div class="toolTip" id="{{$item->id}}" style="display: none;">
                              @foreach($nota as $itemn)
                                @if($itemn->id_venta==$item->id)
                                   <table style="border:0px; width: 850px; font-size: 12px; ">
                                    <td style="border:0px; text-align: left; width: 140px;">{{$itemn->fecha}}</td>
                                    <td style="border:0px; text-align: left; width: 110px;">{{$itemn->nombre}}</td>
                                    <td style="border:0px; text-align: left;">{{$itemn->nota}}</td>
                                   </table>
                                @endif
                              @endforeach
                                  </div>
                                          </td>
                    <td>{{$item->nombres}}</td>
                    <td>{{$item->telefono}}</td>
                    <td>{{$item->direccion}}</td>
                    <td>{{$item->barrio}}</td>
                    <td>{{$item->fecha}}</td>
                    <td>{{$item->estado}}</td>
                    <td>{{$item->name}}</td>
                    <td>{!!number_format($item->importe, 0,',', '.')!!}</td>
                    
                     <td width="10%" class="text-center">
                      <div class="btn-group">
                        <button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary detalle"  value="{{ $item->id }}"><i class="m-0 fa fa-lg fa-eye"></i></button>
                        <button class="btn btn-primary acciones" data-toggle="modal" data-target="#modalCliente" value="{{$item->id}}"><i class="m-0 fa fa-lg fa-phone"></i></button>
                      </div>
                    </td>    
                  </tr>
                  <?php $total += $item->importe; ?>
                  @endforeach
                  <tr>
                    <td colspan="8" class="text-right">
                      <h4>Total Gs.:</h4>
                    </td>
                    <td colspan="2">
                     <h4>{!!number_format($total, 0,',', '.')!!}</h4>
                    </td>
                  </tr>
        
 
                 
                </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
  
<!-- Modal -->
<div class="modal fade" id="ModalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form name="formd"   name="formd" class="form-horizontal" novalidate="">
      <div class="modal-body">
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
                <th style="text-align: center;">Horario de Entrega</th>
                <th style="text-align: center;">Vendedor</th>
              </tr>
            </thead>
            <tbody >
              <tr>
                <td style="text-align: center;"> 
                  <select class="form-control horarios" id="idhorario" name="idhorario"> 
                  </select>
                </td>
                <td style="text-align: center;" class="vendedor"></td> 
              </tr>
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
        <div class="table-responsive">
           <table class="table" >
            <thead id="historico_n">
            </thead>
             <tbody id="historico_notas">  

             
           
            </tbody>  
          </table>
        </div>
     </form>
            <div class="text-right col-md-">
               <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
               <button class="btn btn-primary" id="btn-save-edit" >Guardar</button>
               <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
               <input type="hidden" name="id_venta" id="id_venta" value="">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{--  --}}
<!-- Modal -->
<div class="modal fade" id="ModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form name="formd"   name="formd" class="form-horizontal" novalidate="">
      <div class="modal-body">
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
                <th style="text-align: center;">Horario de Entrega</th>
                <th style="text-align: center;">Vendedor</th>
              </tr>
            </thead>
            <tbody >
              <tr>
                <td style="text-align: center;"> 
                  <select class="form-control horarios" id="idhorario" name="idhorario"> 
                  </select>
                </td>
                <td style="text-align: center;" class="vendedor"></td> 
              </tr>
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
        <div class="table-responsive">
           <table class="table" >
            <thead id="historico_n">
            </thead>
             <tbody id="historico_notas">  

             
           
            </tbody>  
          </table>
        </div>
     </form>
            <div class="text-right col-md-">
               <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
               <button class="btn btn-primary" id="btn-save-edit" >Guardar</button>
               <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
               <input type="hidden" name="id_venta" id="id_venta" value="">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{--  --}}
<!-- Modal -->
<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Acción de Venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="idventa" id="idventa" value="">
         <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
      <div class="modal-body">
        <div class="row">
             <div style="display: none;" class="alert-top fixed-top col-12  text-center alert alert-danger" id="remodal"> </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-secondary" onclick="ventacaida();" ><i class="fa fa-lg fa-times"></i>Venta Caida</button>
            <button class="btn btn-primary" onclick="reactivar();"><i class="fa fa-lg fa-check"></i>Venta Confirmada</button>
          </div>
          <div class="col-12 mt-3 border-top">
            <form action="" method="get" accept-charset="utf-8">
              <div class="form-group mt-3">
                <label for="exampleFormControlTextarea1">Respuesta del Cliente</label>
                <textarea class="form-control" id="nota"  name="nota" rows="3"></textarea>
              </div>
              <button  type="button" class="btn btn-primary" id="btn-nota">Enviar</button>
            </form>
          </div>
        </div>
        

        

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
   
});

$('.acciones').click(function(){

      $('#idventa').val("");
      var id = $(this).val(); 
      $('#idventa').val(id); 

})


function reactivar(){
  var id = $('#idventa').val(); 

  var url="aconfirmar";

  $.ajax({
        type: "POST",
        url: url + '/reactivar',
        data: {id:id},
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
                       
            $("#res").html("Venta Confirmada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );

              location.reload(true);
  
        }
 })

}

function ventacaida(){
  var id   = $('#idventa').val(); 
  var nota = $('#nota').val();
  var id_usuario= $('#id_usuario').val();
  var url="aconfirmar";


  if ($('#nota').val()==""){

                $("#remodal").html("Por Favor Agregue una Nota");
                $("#remodal").css("display","block");
                $("#remodal").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
                return false;
               
        }else{

  $.ajax({
        type: "POST",
        url: url + '/ventacaida',
        data: {id:id, nota:nota, id_usuario:id_usuario },
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
                       
            $("#res").html("Se Registro la Venta Caida con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );

              location.reload(true);
  
        }
 })

}

}


$('#btn-nota').click(function(){
        var id_venta  = $('#idventa').val();
        var nota      = $('#nota').val();
        var id_usuario= $('#id_usuario').val();

     if ($('#nota').val()==""){

                $("#remodal").html("Por Favor Agregue una Nota");
                $("#remodal").css("display","block");
                $("#remodal").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
                return false;
               
        }else{
  
        var formData = {
                    id_usuario:   id_usuario,
                    nota      :   nota,
                    id_venta  :   id_venta
                    }
            
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
     
  location.reload(true);
          }      

    });
  }

 });

 $('.detalle').click(function(){

    var id = $(this).val();  //CAPTURA EL ID
    $('#cliente_detalle').html(''); //LIMPIA EL MODAL
    $('#cliente_detalle2').html(''); 
    $('#cliente_detalle3').html(''); 
    $('#cliente_detalle4').html(''); 
    $('#productos_detalle').html(''); //LIMPIA EL MODAL
    $(".horarios").html('');
    $("#historico_n").html('');
    $("#historico_notas").html('');
    $('#ModalDetalle').modal('show'); //ABRE EL MODAL
    
      $.ajax({
          type: "get",
          url: '{{ route('horarios_ajax') }}',
          dataType: "json",
          success: function (datas){
             $.each(datas, function(i, item2) {

            $(".horarios").append('<option value='+item2.id+'>'+item2.horario+'</option>');
              });
          }

      });
   
      $.ajax({
        type: "GET",
        url: '{{ url('detalle_venta') }}',
        dataType: "json",
        data: { id:id, _token: '{{csrf_token()}}'},

        success: function (data){
          console.log(data);
          var total=0;
          var importe=0;
          var x=0;

          $("#id_venta").val(data.venta[0].id);
          $('#title').html('Detalle de Venta:  ' + data.venta[0].id);
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
           
            for (var i = 0; i < data.notas.length; i++) {



              if(data.notas[i].id_venta==data.venta[0].id){
                 x=x+1

                if(x==1){
                       $("#historico_n").append(`<tr>
                                        <th colspan="5" style="text-align: center; font-size: 14px;">Historico de Notas</th>
                                      </tr>
                                      <tr>
                                        <th style="text-align: center;">Vendedor</th>
                                        <th  colspan="3"  style="text-align: center;">Nota</th>
                                        <th style="text-align: center;">Fecha</th>
                                      </tr>`);
                }

              }
          }
            
            $.each(data.notas, function(l, item2)
             {
                  if(item2.id_venta==data.venta[0].id){

                    $("#historico_notas").append(` 
                                                  <tr>
                                                    <td style="text-align: center;">${item2.nombre}</td>
                                                    <td  colspan="3" style="text-align: left;">${item2.nota.replace(/~/g, '<br >' )}</td>
                                                    <td style="text-align: center;">${item2.fecha}</td>
                                                   </tr>`);
                  }
                 
             });

          $(".horarios").val(data.venta[0].id_horario);
          $(".vendedor").html(data.venta[0].nameuser);

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


</script>

@endpush