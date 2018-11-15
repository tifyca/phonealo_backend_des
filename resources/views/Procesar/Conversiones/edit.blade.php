 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Editar Lista')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('procesar/conversiones'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content') 
              

<div class="row d-flex justify-content-center">
  <div class="col-md-6">
    <div class="tile">
        <div class="tile-body ">
          <form id="" name=""  novalidate="">
            <div class="row d-flex justify-content-center">
              <div class="form-group col-12">
                <label class="control-label">Nombre Lista</label>
                <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
                <input type="hidden" id="id_lista" name="id_lista" value="{{$monitoreo[0]->id}}">


                <input class="form-control"  type="text" placeholder="..." id="nombreLista" name="nombreLista" value="{{$monitoreo[0]->nombre}}" readonly>

              </div>
              <div class="form-group col-md-12">
                <div class="row">
                  <div class="form-group col-12">
                    <div class="row  no-guuters">
                      <div class="col-9">
                      <label for="descripcion">Descripción</label>
                      <input class="form-control" autocomplete="off" type="text" id="descripcion" name="descripcion" >
                    </div>
                      <div class="col-3 d-flex align-items-end">
                        <button class="btn btn-primary w-100"  id="btn-add"  ><i class="fa fa-fw fa-lg fa-plus"></i>Añadir</button>
                      </div>
                    </div>
                    
                      
                    {{-- ESTE SE LLENA CON EL ID DEL PRODUCTO --}}
                    <input type="hidden" id="id_producto"  name="id_producto">
                    {{-- //// --}}
                  </div>
                  
                  <div class="selec_productos col-12 d-none">
                    <ul class="list-group" id="list-productos">
                       {{-- ESTE ESPACIO APARECE Y SE LLENA CON AJAX, SE ACATUALIZA CADA QUE SUELTAS LA TECLA --}}
                    </ul>
                  </div>
                  {{-- //// --}}
                </div>
              </div>
              <div class="form-group col-md-7 opacity-p d-none" id="img-product">
                <div  class="col-12 d-flex justify-content-center align-items-center" >
                    <div id="img-p" class="col-md-7">
                     
                    </div>   
                </div>
              </div>
                      
            </div>
          </form>
        </div>  
    </div>
  </div>
  <div class="col-md-6">
    <div class="tile">
        <div class="tile-body ">
            <div class="row">
              <h4 class="tile-title text-center text-md-left col-9">Productos Agregados</h4>
              <div class="col-3">
                <button class="btn btn-primary w-100"  id="btn-edit" >Guardar</button>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table"  id="list-def" name="list-def">
                <thead>
                  <tr>
                    <th width="10%" style="display: none"></th>
                    <th width="80%">Descripción</th>
                    <th width="10%" align="center">Acción</th>
                  </tr>
                </thead>
                <tbody>              
                  @foreach($monitoreo as $item)
                     <tr> 
                      <td width="10%" style="display:none"> {{$item->id_producto}} </td>
                      <td width="80%">{{ $item->descripcion}}</td>
                      <td width="10%" align="center"><button class="btn btn-primary remove" id="btn-remove" value=" {{$item->id_producto}}" ><i class="m-0 fa fa-lg fa-times"></i></button></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>  
    </div>
  </div>
</div>

  

@endsection

@php

   
      $url1 = config('app.url') . '/productos/';
    
      $url2 = 'img/img-default.png';
    

@endphp

@push('scripts')

<script  type="text/javascript" charset="utf-8" >

  var url1 = '{{ $url1 }}';
  var url2 = '{{ $url2 }}';

$(document).on('click', '#btn-add', function (e) {
   
   e.preventDefault();

    var id_producto = $('#id_producto').val();
    var  descripcion= $('#descripcion').val();
          
                 // $('#d-cod_producto' + id_producto ).remove();

     var cesta  = '<tr><td width="10%" style="display:none">'+ id_producto + '</td><td width="80%">' + descripcion + '</td><td width="10%" align="center"><button class="btn btn-primary" id="btn-remove" value="'+ id_producto +'" ><i class="m-0 fa fa-lg fa-times"></i></button></td></tr>';


                
            $('#list-def > tbody').append(cesta);
                    
            $('#descripcion').val('');
            $('#id_producto').val('');
            $('#img-product').addClass('d-none');
            $('.opacity-x').css('opacity', '1');
            $('#img-p').html('');
            $('#eye').addClass('d-none');
          
        
                 
});  

$(document).on('click', '#btn-remove', function (e) {
   
   e.preventDefault();

      $(this).closest('tr').remove();   
          
});  


$("#btn-edit").click(function (e) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault();
  
            var parametros=[];
        
            $("#list-def > tbody > tr").each(function(i,e){

              if(i!=0){ 
                parametros.push ($(this).find('td').eq(0).html());
              }

            }); 
            
        var formData = {
         id_lista : $('#id_lista').val(), 
        parametros : parametros,
        id_usuario  : $('#id_usuario').val()
       }
       
  
    $.ajax({
        type: "POST",
        url: '../../conversiones/update',
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (data) {
           
            $("#res").html("Lista de Conversión Modificada con Éxito");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );

               location.href="/procesar/conversiones";
        },
       
          error: function (data,estado,error) { 
             var errorsHtml = '';
           var error = jQuery.parseJSON(data.responseText);
             errorsHtml +="<ul style='list-style:none;'>";
             for(var k in error.message){ 
                if(error.message.hasOwnProperty(k)){ 
                    error.message[k].forEach(function(val){

                       errorsHtml +="<li class='text-danger'>" + val +"</li>";
                       
                        
                        $("#rese").html(errorsHtml);
                        $("#rese, #res-content").css("display","block");
                     
                      }); 
                }
            }
          errorsHtml +="</ul>"; 
            $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );
        },
    });
});










   //CAPTURA AL SOLTAR EL TECLADO Y DESATA EL EVENTO Y BUSCA EL PRODUCTO.
    $('#descripcion').keyup(function(event) {
      
      var descripcion = $(this).val();
      if (descripcion.length > 0) {
        $.ajax({
          type: "get",
          url: '{{ route('productos_ajax') }}',
          dataType: "json",
          cache: false,
          data: { producto: descripcion },
          success: function (data){

            if (data.length == 0) {

              $('.selec_productos').addClass('d-none');
              $('.opacity-p').css('opacity','1');

            }else{

              $('.selec_productos').removeClass('d-none');
              $('.opacity-p').css('opacity','0.3');
              $('#list-productos').html('');

              $.each(data, function(l, item) {
                $('#list-productos').append('<li onclick="captura(this)" data-value='+item.id+' class="list-group-item list-group-item-action cursor-pointer"><div class="row no-gutters d-flex align-items-center"><div class="col mr-1">'+item.descripcion+'</div><div class="col-1 ml-1"><span class="badge badge-primary badge-pill ">'+item.stock_activo+'</span></div></div></li>');
              });
            }

                
          }

        });
      }else{
        $('.selec_productos').addClass('d-none');
        $('.opacity-p').css('opacity','1');
      }

    });

    function captura(elemento){

      var value = $(elemento).data('value');

      $('.selec_productos').addClass('d-none');
      $('.opacity-p').css('opacity','1');

      $.ajax({
          type: "get",
          url: '{{ route('producto_click') }}',
          dataType: "json",
          cache: false,
          data: { id_producto: value },
          success: function (data){
            
            $('#descripcion').val(data.descripcion);
            $('#id_producto').val(data.id);

             var img = data.img;

            if (img.length > 0) {
              var zurl = url1+img;
              $('#img-p').html('<img src="'+zurl+'" alt="" class="img-fluid">');      
                $('#img-product').removeClass('d-none');
                $('.opacity-x').css('opacity', '0');
             
            }else{
              var zurl = url2;
              $('#img-p').html('');
              $('.opacity-x').css('opacity', '1');
              $('#img-product').addClass('d-none');
            }   
          }

        });


    }

    $(document).on('click', '.remove', function (e) {
    e.preventDefault();
 
    $(this).closest('tr').remove();
    
       var formData = {
                    id_lista : $('#id_lista').val(),  
                    id_producto: $(this).val(),
                   }
              console.log(formData);
 
           $.ajaxSetup({
             headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
             });
               
            $.ajax({
                type: "POST",
                url: "../../conversiones/delProdLista",
                data: formData,
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (data) {
            
            $("#res").html("Producto Eliminado de la Lista");
            $("#res, #res-content").css("display","block");
            $("#res, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );

}
                
});

});  

 
</script>
  
@endpush