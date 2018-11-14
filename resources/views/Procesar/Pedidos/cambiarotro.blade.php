<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
 $name_user= $_SESSION["nombre"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Cambiar por Otro Producto')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  {{-- DATOS DEL CLIENTE // AL MARCAR EL CELULAR SI EL CLIENTE EXISTE TRAE LOS DATOS, SI NO LO REGISTRA --}}
  <div class="col-12">
    <div class="tile">
    <h3 class="tile-title text-center text-md-left">Detalles del Cliente</h3>
      <div class="tile-body ">
        <div class="row">
          <input type="hidden" name="id_cliente" id="id_cliente" value="{{$venta[0]->idcliente}}">
            <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
             <input type="hidden" name="id_venta" id="id_venta" value="{{$venta[0]->id}}">
          <div class="form-group col-md-4">
            <label for="telefono_cliente">Teléfono</label>
            <input class="form-control" type="text" id="telefono_cliente" name="telefono_cliente" placeholder="..." onkeypress="return soloNumeros(event);" value="{{$venta[0]->telefono}}" maxlength="15" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="nombre_cliente">Nombres</label>
            <input class="form-control" type="text" id="nombre_cliente" name="nombre_cliente" placeholder="..."  onkeypress="return soloLetras(event);" maxlength="50"  oncopy="return false" value="{{$venta[0]->nombres}}" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="email_cliente">Email</label>
            <input class="form-control" id="email_cliente" name="email_cliente" type="email" aria-describedby="emailHelp" placeholder="..." maxlength="50"  oncopy="return false" value="{{$venta[0]->email}}" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="ruc_cliente">RUC</label>
            <input class="form-control" type="text" id="ruc_cliente" name="ruc_cliente" placeholder="..."  onkeypress="return soloNumeros(event);" maxlength="15"  oncopy="return false" value="{{$venta[0]->ruc_ci}}" disabled>
          </div>
          <div class="form-group col-12 col-md-4">
            <label for="tipo_cliente">Tipo de Cliente</label>
            <select class="form-control" id="tipo_cliente" name="tipo_cliente" disabled>
             @if($venta[0]->id_tipo==1)
              <option selected value="1" selected>Natural</option>
              @else
              <option value="2" selected>Jurídico</option>
              @endif
            </select>
          </div>
          <div class="form-group col-12 col-md-4">
            <label for="departamento_cliente">Departamento</label>
            <select class="form-control departamento" id="departamento_cliente" name="departamento_cliente" disabled>
               <option value="{{$venta[0]->id_departamento}}">{{$venta[0]->departamento}}</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="ciudad_cliente">Ciudad</label>
            <select class="form-control ciudades" id="ciudad_cliente" name="ciudad_cliente" disabled>
              <option  value="{{$venta[0]->id_ciudad}}">{{$venta[0]->ciudad}}</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="barrio_cliente">Barrio</label>
            <select class="form-control barrios" id="barrio_cliente" name="barrio_cliente" disabled>
              <option value="{{$venta[0]->barrio}}">{{$venta[0]->barrio}}</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="ubicacion_cliente">Ubicación</label>
            <input class="form-control" type="text" id="ubicacion_cliente" name="ubicacion_cliente" placeholder="..." onkeypress="return soloNumeros(event);" value="{{$venta[0]->ubicacion}}" disabled>
          </div>
          <div class="form-group col-md-12">
            <label for="direccion_cliente">Dirección</label>
            <input class="form-control" type="text" id="direccion_cliente" name="direccion_cliente" placeholder="..." maxlength="150" value="{{$venta[0]->direccion}}" disabled>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN DATOS CLIENTES --}}
</div>
<div class="row">
    {{-- DATOS DE LA VENTA --}}
  <div class="col-7 d-flex" >

    <div class="tile flex-fill m-0" >
      <h3 class="tile-title text-center text-md-left opacity-x">Detalles de la Venta</h3>
        <div class="tile-body ">
          <div class="row opacity-x" >

            <div class="form-group col-md-4">
              <label for="">Fecha de Venta</label>
              <input class="form-control" type="date" id="fecha_venta" name="fecha_venta" data-date-format="DD/MM/YYYY" value="{{date('Y-m-d', strtotime($venta[0]->fecha))}}" >
            </div>
             <div class="form-group col-md-4">
              <label for="">Fecha de Entrega</label>
              <input class="form-control" type="date" id="fecha_entrega" name="fecha_entrega" data-date-format="DD/MM/YYYY" value="{{date('Y-m-d', strtotime($venta[0]->fecha_activo))}}">
            </div>
            <div class="form-group col-md-4">
              <label for="">Horario de Entrega</label>
              <select class="form-control" id="horario_venta" name="horario_venta">
                <option value="{{$venta[0]->id_horario}}">{{$venta[0]->horario}}</option>
               @foreach($horarios as $horario)  
                      <option value="{{$horario->id}}"> {{ $horario->horario }} </option>
                 @endforeach         
                    
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="">Forma de Pago</label>
              <select class="form-control" id="forma_pago" name="forma_pago" disabled>
                  <option value="{{$venta[0]->id_forma_pago}}">{{$venta[0]->forma_pago}}</option>
                @foreach($formas as $forma)  
                    <option value="{{$forma->id}}"> {{ $forma->forma_pago }} </option>
                 @endforeach   
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="">Factura</label>
              <select id="factura" class="form-control" id="factura" name="factura">
                <option value="">Seleccione</option>
                <option value="1" selected>No</option>
                <option value="2">Si</option>
                <option value="3">Sin Nombre</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="">Vendedor</label>
              <select class="form-control" id="vendedor" name="vendedor" disabled>
                <option value="{{$id_usuario}}">{{$name_user }}</option>
                
              </select>
            </div>
            {{-- ESTOS CAMPOS APARECEN CUANDO SE SELECCIONA FACTURA : SI / SIN NOMBRE   --}}
            <div id="nombres_factura" class=" d-none form-group col-md-4">
              <label for="">Nombres</label>
              <input class="form-control" type="text" id="factura_nomb" name="factura_nomb"   maxlength="50"  oncopy="return false" >
            </div>
            <div id="direccion_factura" class=" d-none form-group col-md-8">
              <label for="">Direccion</label>
              <input class="form-control" type="text" id="factura_dir" name="factura_dir" maxlength="150" >
            </div>
            <div id="ruc_factura" class=" d-none form-group col-md-4">
              <label for="">RUC</label>
              <input class="form-control" type="text" id="factura_ruc" name="factura_ruc"  onkeypress="return soloNumeros(event);" maxlength="15"  oncopy="return false">
            </div>
            {{-- //// --}}
            
            <div class="form-group col-md-8">
              <label for="">Delivery</label>
              <div class="row">
                <div class="col-3 text-right">
                  <label class="form-check-label mt-2">
                    <input class="form-check-input" id="delivery" type="checkbox" name="monto" type="checkbox" value="1">Gratis
                  </label>
                </div>
                <div class="col-9">
               
              <select class="form-control" id="monto" name="monto" >
                <option value="">Monto</option>
               @foreach($deliverys as $delivery)  
                      <option value="{{$delivery->id}}"> {!!number_format($delivery->monto, 0, ',', '.')!!} </option>
                 @endforeach             
              </select>
                 
                </div>
              </div>
            </div>
            <div class="form-group col-md-12">
              <label for="">Nota</label>
              <textarea name="nota_venta" id="nota_venta" class="form-control" cols="5"></textarea>
            </div>
              
          </div>


        </div>


    </div>
   <div class="d-none" id="img-product">
      <div  class="col-12 d-flex justify-content-center align-items-center" style="position: absolute; z-index: 999; left: 0; height: 100%">
          <div id="img-p" class="col-6">
           
          </div>   
      </div>
    </div>
  
    
     
  </div>

  {{-- FIN DATOS DE LA VENTA --}}
  {{-- /// --}}
  {{-- SELECCION DE PRODUCTOS --}}
 
  <div class="col-md-5 d-flex">
    <div class="tile flex-fill m-0">
    <h3 class="tile-title text-center text-md-left">Selección de Productos</h3>
      <div class="tile-body">
        <div class="row">
          <div class="form-group col-md-12">
            <div class="row">
              <div class="col">
                <label for="descripcion">Descripción</label>
                <input class="form-control" autocomplete="off" type="text" id="descripcion" name="descripcion" >
                {{-- ESTE SE LLENA CON EL ID DEL PRODUCTO --}}
                <input type="hidden" id="id_producto"  name="id_producto">
                {{-- //// --}}
              </div>
              
                <div class="col-2 align-items-end row d-none" id="eye">
                  <div class="row align-items-end">
                    <span id="eye-hover" class="btn " ><i class="m-0 fa fa-lg fa-eye "></i></span>
                  </div>
                </div>
              
              
              <div class="selec_productos col-12 d-none">
                <ul class="list-group " id="list-productos">
                   {{-- ESTE ESPACIO APARECE Y SE LLENA CON AJAX, SE ACATUALIZA CADA QUE SUELTAS LA TECLA --}}
                </ul>
              </div>
              {{-- //// --}}
            </div>
          </div>
          
          
          <div class="form-group col-md-6 opacity-p">
            <label for="">Cod. Producto</label>
            <input class="form-control" type="text" id="cod_producto" name="cod_producto" readonly>
          </div>
          <div class="form-group col-md-6 opacity-p">
            <label for="">Stock</label>
            <input class="form-control" type="text" id="stock" name="stock"  readonly>
          </div>
          <div class="form-group col-md-6 opacity-p">
            <label for="">Cantidad</label>
            <input class="form-control" type="text" id="cantidad" name="cantidad"  onkeypress="return soloNumeros(event);"  >
          </div>
          <div class="form-group col-md-6 opacity-p">
            <label for="">Precio</label>
            <input class="form-control" type="text" id="precio" name="precio" >
          </div>
          <div class="col-sm-12 opacity-p d-flex justify-content-between mt-4">
            <a class="btn btn-primary " onclick="add_cesta();" id="btn-add" value="add"><i class=" fa fa-lg fa-plus"></i>Añadir</a>
            <a id="refrescar" class="btn btn-secondary " ><i class=" fa fa-lg fa-refresh"></i>Refrescar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN SELECCION DE PRODUCTOS --}}
</div>
<div id="spacio" style="display: block;">&nbsp;</div>
<div class="alert alert-danger bg-danger text-white mt-4" id="fal-content" style="display: none" role="alert">
 <div id="faltante"></div>
</div>
<div class="row">
     <div class="col-md-12">
    {{-- CESTA DE COMPRA --}}
      <div class="tile">
        <h3 class="tile-title text-center text-md-left">Productos en la Cesta</h3>
          <div class="tile-body ">
            <div class="table-responsive">
              <input type='hidden' id='total_venta' value="">
              <table class="table"  id="cesta-list" name="cesta-list">
                <thead>
                  <tr>
                    <th width="15%">Cod.</th>
                    <th width="30%">Producto</th>
                    <th width="15%"  class="text-center">Cantidad</th>
                    <th width="20%"  class="text-center">Precio</th>
                    <th width="20%"  class="text-center">Importe</th>
                    <th width="15%" class="text-center">Acciones</th>
                  </tr>
                </thead>
                
                <tbody>
                  
                </tbody>

                  
               
              </table>
               <div class="text-right col-md-"><h3><div id='total'></div></h3>
               <button class="btn btn-primary" type="submit" id="btn-save" disabled>Guardar</button></div>
            </div>
          </div>
      </div>
      {{-- FIN CESTA DE COMPRA --}}
   </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Detalle de Producto</h4>
     </div>
     <div class="modal-body">
       <div class="row">
          <div class="col-md-8">
    <div class="tile">
      <div class="tile-body">
        <div class="row">
          <div class="col-12 table-responsive">
            <h2><div id="det-descripcion"></div></h2>
            <table class="table mt-4">
              <tbody>
                <tr>
                  <th>Código:</th>
                  <td><div id="det-codigo" ></div></td>
                </tr>
                <tr>
                  <th>Categoría:</th>
                  <td><div id="det-categoria" ></div></td>
                </tr>
                <tr>
                  <th>Subcategoria:</th>
                  <td><div id="det-subcategoria" ></div></td>
                </tr>
                <tr>
                  <th>Precio Ideal:</th>
                  <td><div id="det-precio" ></div></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-12">
             <h3>Especificaciones</h3>
             <p ><div id="det-especifcaciones" ></div></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 text-center">
      <div id="carouselProducto" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            {{-- Imagen principal --}}
            <div class="carousel-item active" id="img-prod" ></div>
            {{-- ///////////// --}}
            {{-- Imagenes de galiria de producto --}}
            
             <div  class="carousel-item" id="det-carousel"></div>
           </div>
          <a class="carousel-control-prev" href="#carouselProducto" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselProducto" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
       
    </div>
</div>

  
        <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
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
 <meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Procesar/js_ventas.js')}}"></script>
<script type="text/javascript" charset="utf-8" async defer>
   

     window.onload = function(){
      var fecha = new Date(); //Fecha actual
      var mes = fecha.getMonth()+1; //obteniendo mes
      var dia = fecha.getDate(); //obteniendo dia
      var ano = fecha.getFullYear(); //obteniendo año
      if(dia<10)
        dia='0'+dia; //agrega cero si el menor de 10
      if(mes<10)
        mes='0'+mes //agrega cero si el menor de 10
      document.getElementById('fecha_venta').value=ano+"-"+mes+"-"+dia;
      document.getElementById('fecha_entrega').value=ano+"-"+mes+"-"+dia;

    }
    

  var url1 = '{{ $url1 }}';
  var url2 = '{{ $url2 }}';

  //ACTIVA Y DESACTIVA EL MONTO DEL DELIVERY
  //
    $('#delivery').change(function(){
      if ($('#delivery').prop('checked')){
        
        $('#monto').prop('disabled', true);

      }
      else{
       $('#monto').prop('disabled', false);
      }
    });

    // APARECEN MAS CUAMPOS CUANDO SELECCIONO FACTURA
    
    $('#factura').change(function(){

     var seleccion = $(this).val();

     if (seleccion == 1) {
        $('#nombres_factura').addClass('d-none');
        $('#direccion_factura').addClass('d-none');
        $('#ruc_factura').addClass('d-none');
     }
     if (seleccion == 2) {
        $('#nombres_factura').removeClass('d-none');
        $('#factura_nomb').val("");
        $('#factura_nomb').prop('readonly', false);
        $('#direccion_factura').removeClass('d-none').removeClass('col-md-12').addClass('col-md-8');
        $('#ruc_factura').removeClass('d-none'); 
        $('#factura_ruc').val(""); 
        $('#factura_ruc').prop('readonly', false);

        $('#factura_nomb').val(document.getElementById('nombre_cliente').value);
        $('#factura_ruc').val(document.getElementById('ruc_cliente').value);
        $('#factura_dir').val(document.getElementById('direccion_cliente').value);
     }
     if (seleccion == 3) {
        var nombre='SIN NOMBRE';
        var ruc='44444401-7';
        $('#nombres_factura').removeClass('d-none');
        $('#factura_nomb').val(nombre);
        $('#factura_nomb').prop('readonly', true);
        $('#direccion_factura').addClass('d-none');
        $('#ruc_factura').removeClass('d-none');  
        $('#factura_ruc').val(ruc); 
        $('#factura_ruc').prop('readonly', true);
     }
    });
    

    // REFRESCA LOS CAMPOS DE SELCCION DE PRODUCTO

    $('#refrescar').click(function(){
      $('#cantidad').val('');
      $('#descripcion').val('');
      $('#cod_producto').val('');
      $('#stock').val('');
      $('#precio').val('');
      $('#id_producto').val('');
      $('#img-product').addClass('d-none');
      $('.opacity-x').css('opacity', '1');
      $('#img-p').html('');
      $('#eye').addClass('d-none');
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
                $('#list-productos').append('<li  onclick="captura(this)" data-value='+item.id+' class=" list-group-item list-group-item-action cursor-pointer"><div  class="row no-gutters d-flex align-items-center"><div  class="col mr-1 ">'+item.descripcion+'</div><div class="col-1 ml-1"><span  class=" badge badge-primary badge-pill ">'+item.stock_activo+'</span></div></div></li>');
              });
            }

                
          }

        });
      }else{
        $('.selec_productos').addClass('d-none');
        $('.opacity-p').css('opacity','1');
      }

    });

    // CAPTURA CUANDO SELECCIONO UN PRODUCTO DE LA LISTA

    function captura(elemento){

      var value = $(elemento).data('value');

      $('.selec_productos').addClass('d-none');
      $('.opacity-p').css('opacity','1');
      $('#eye').removeClass('d-none');

      $.ajax({
          type: "get",
          url: '{{ route('producto_click') }}',
          dataType: "json",
          cache: false,
          data: { id_producto: value },
          success: function (data){

            $('#descripcion').val(data.descripcion);
            $('#cod_producto').val(data.codigo_producto);
            $('#stock').val(data.stock_activo);
            $('#precio').val(data.precio_ideal.toLocaleString('de-DE'));
            $('#id_producto').val(data.id);
            if(data.stock_activo==0){
               $('#fecha_entrega').prop('disabled', false);
            }
            var img = data.img;

            if (img.length > 0) {
              var zurl = url1+img;
              $('#img-p').html('<img src="'+zurl+'" alt="" class="img-fluid">');
              $('#eye-hover').addClass('btn-primary').removeClass('btn-secondary');
              // HOVER DE LA IMAGEN LUEGO QUE SELECCIONO EL PRODUCTO

              $("#eye-hover" ).mouseover(function() {
                $('#img-product').removeClass('d-none');
                $('.opacity-x').css('opacity', '0');
              }).mouseout(function() {
                $('#img-product').addClass('d-none');
                $('.opacity-x').css('opacity', '1');
              });
            }else{
              var zurl = url2;
              $('#img-p').html('');
              $('#eye-hover').addClass('btn-secondary').removeClass('btn-primary');
              $('.opacity-x').css('opacity', '1');
              $('#img-product').addClass('d-none');
            }
     
          }

        });


    }

 $(document).on('click', '.open_modal', function(){
    var id_producto = $(this).val();
     var url_img="";
      var url_i="";
       $('#img-prod').html('');
      $('#det-carousel').html('');

    $.get('ventas/detalle/'+ id_producto, function(data){
      console.log(data);
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
    });  

          $('#det-descripcion').html(data.productos.descripcion);
          $('#det-codigo').html(data.productos.codigo_producto);
          $('#det-categoria').html(data.categoria);
          $('#det-subcategoria').html(data.subcategoria);
          $('#det-precio').html(data.productos.precio_ideal+' Gs');
          $('#det-especifcaciones').html(data.productos.descripcion_producto);
          
          var url_img=data.productos.img;
                       if(url_img===""){
                        var zurl =   url2;
                       }
                       else{
                        var zurl =   url1 + url_img;
                      }
                     
                   $('#img-prod').append('<img class="d-block w-100" src="'+zurl+'" alt="Primer slide">');
              $.each(data.imagenes, function(l, item) {

                var url_i=item.imagen;
                      if(url_i===""){
                        var zurl =  url2;
                       }
                       else{
                        var zurl =   url1 + url_i;
                      }
                     
                $('#det-carousel').append('<img class="d-block w-100" src="'+zurl+'" alt="Segundo slide">');
              
              });
          $('#myModal').modal('show');
       
    
})
    });
$("#telefono_cliente").blur(function(){
         var value=$(this).val();
 
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        $.get('{{ route('searchCliente') }}' + '/' + value, function(data){
          console.log(data);
              if(data.length==0){
                
                    $("#rese").html("El Cliente No Existe debe Registrarlo");
                    $("#rese, #res-content").css("display","block");
                    $("#rese, #res-content").fadeIn( 300 ).delay( 1500 ).fadeOut( 1500 );

              }else{
                  $.each(data, function(i, item) {
                      $('#id_cliente').val(item.id);
                      $('#nombre_cliente').val(item.nombres);
                      $('#email_cliente').val(item.email);
                      $('#ruc_cliente').val(item.ruc_ci);
                      $('#tipo_cliente').val(item.id_tipo);
                      $('select[name=departamento_cliente]').val(item.id_departamento);
                      cargarComboCiudad(item.id_departamento, item.id_ciudad);
                 //     $('select[name=ciudad_cliente]').val(item.id_ciudad);
                     cargarComboBarrio(item.id_ciudad,item.barrio);
                    //  $('select[name=barrio_cliente]').val(item.barrio);
                      $('#ubicacion_cliente').val(item.ubicacion);
                      $('#direccion_cliente').val(item.direccion);

                  
                  });
      
              }

      });

    });


function cargarComboCiudad(id_departamento, id_ciudad_selected){
         console.log(id_ciudad_selected);
          $("#ciudad_cliente").children('option:not(:first)').remove();

         $.ajax({
          type: "get",
          url: '{{ route('ciudadesCombo') }}',
          dataType: "json",
          data: {id_departamento: id_departamento},
          success: function (data){
            console.log(data);
          // $(".ciudades").append('<option value=0> Seleccione </option>');
          $.each(data, function(l, item1) {
            var selected = (item1.id == id_ciudad_selected)?"selected":"";
          //$(".ciudades option:eq(1)").prop("selected", true);
          $("#ciudad_cliente").append('<option value='+item1.id+' '+selected+'>'+item1.ciudad+'</option>');
          });
          }
  });
};

function cargarComboBarrio(id_ciudad, id_barrio_selected){
       //   var id_ciudad = $(this).val();
        $("#barrio_cliente").children('option:not(:first)').remove();

console.log("Buscar: "+id_barrio_selected);
           $.ajax({
              type: "get",
              url: '{{ route('barriosCombo') }}',
              dataType: "json",
              data: {id_ciudad: id_ciudad},
              success: function (data){

                 $.each(data, function(l, item1) {
                              var selected = (normalize(item1.barrio) == normalize(id_barrio_selected))?"selected":"";
                              // console.log("Buscar: "+item1.barrio);
                 // $(".barrios").append('<option value=0> Seleccione </option>');
                   //$(".ciudades option:eq(1)").prop("selected", true);
                   $("#barrio_cliente").append('<option value="'+item1.barrio+'" '+selected+'>'+item1.barrio+'</option>');
                  });
              }
          });
 };
 

 var normalize = (function() {
  var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç", 
      to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
      mapping = {};
 
  for(var i = 0, j = from.length; i < j; i++ )
      mapping[ from.charAt( i ) ] = to.charAt( i );
 
  return function( str ) {
      var ret = [];
      for( var i = 0, j = str.length; i < j; i++ ) {
          var c = str.charAt( i );
          if( mapping.hasOwnProperty( str.charAt( i ) ) )
              ret.push( mapping[ c ] );
          else
              ret.push( c );
      }      
      return ret.join( '' );
  }
 
})();
 $(document).ready(function(){
    {{-- SE LLENA EL SELECT DE LOS DEPARTAMENTOS CON AJAX --}}
      $.ajax({
          type: "get",
          url: '{{ route('departamentos_ajax') }}',
          dataType: "json",
          success: function (data){

             $.each(data, function(i, item) {

              //$(".departamento option:eq(1)").prop("selected", true);
              $(".departamento").append('<option value='+item.id+'>'+item.nombre+'</option>');
              });
          }

      });
      // AL SELECCIONAR EL DEPARTAMENTO SE ENVIA EL ID Y SE RECIBE LAS CIUDADES
      $('#departamento_cliente').change(function(){
        var id_departamento = $(this).val();


          $(".ciudades").html('');

           $.ajax({
              type: "get",
              url: '{{ route('ciudadesCombo') }}',
              dataType: "json",
              data: {id_departamento: id_departamento},
              success: function (data){
                    $(".ciudades").append('<option value=0> Seleccione </option>');
                 $.each(data, function(l, item1) {

                   //$(".ciudades option:eq(1)").prop("selected", true);
                   $(".ciudades").append('<option value='+item1.id+'>'+item1.ciudad+'</option>');
                  });
              }
          });
      });

      // AL SELECCIONAR CIUDAD SE ENVIA EL ID Y SE RECIBE LOS BARRIOS
      $('#ciudad_cliente').change(function(){
        var id_ciudad = $(this).val();


          $(".barrios").html('');

           $.ajax({
              type: "get",
              url: '{{ route('barriosCombo') }}',
              dataType: "json",
              data: {id_ciudad: id_ciudad},
              success: function (data){
                $(".barrios").append('<option value=0> Seleccione </option>');

                 $.each(data, function(l, item2) {
                 // $(".barrios").append('<option value=0> Seleccione </option>');
                   //$(".ciudades option:eq(1)").prop("selected", true);
                   $(".barrios").append('<option value="'+item2.barrio+'">'+item2.barrio+'</option>');
                  });
              }
          });
      });

  
  });

  
  </script>
  













@endpush