@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Nueva Venta')
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
          <div class="form-group col-md-4">
            <label for="telefono_cliente">Teléfono</label>
            <input class="form-control" type="text" id="telefono_cliente" name="telefono_cliente" placeholder="...">
          </div>
          <div class="form-group col-md-4">
            <label for="nombre_cliente">Nombres</label>
            <input class="form-control" type="text" id="nombre_cliente" name="nombre_cliente" placeholder="...">
          </div>
          <div class="form-group col-md-4">
            <label for="email_cliente">Email</label>
            <input class="form-control" id="email_cliente" name="email_cliente" type="email" aria-describedby="emailHelp" placeholder="...">
          </div>
          <div class="form-group col-md-4">
            <label for="ruc_cliente">RUC</label>
            <input class="form-control" type="text" id="ruc_cliente" name="ruc_cliente" placeholder="...">
          </div>
          <div class="form-group col-12 col-md-4">
            <label for="tipo_cliente">Tipo de Cliente</label>
            <select class="form-control" id="tipo_cliente" name="tipo_cliente">
              <option value="">Seleccione</option>
              <option selected value="N">Natural</option>
              <option value="J">Jurídico</option>
            </select>
          </div>
          <div class="form-group col-12 col-md-4">
            <label for="departamento_cliente">Departamento</label>
            <select class="form-control" id="departamento_cliente" name="departamento_cliente">
              <option value="">Seleccione</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="ciudad_cliente">Ciudad</label>
            <select class="form-control" id="ciudad_cliente" name="ciudad_cliente">
              <option value="">Seleccione</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="barrio_cliente">Barrio</label>
            <select class="form-control" id="barrio_cliente" name="barrio_cliente">
              <option value="">Seleccione</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="ubicacion_cliente">Ubicación</label>
            <input class="form-control" type="text" id="ubicacion_cliente" name="ubicacion_cliente" placeholder="...">
          </div>
          <div class="form-group col-md-12">
            <label for="direccion_cliente">Dirección</label>
            <input class="form-control" type="text" id="direccion_cliente" name="direccion_cliente" placeholder="...">
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
              <input class="form-control" type="date" id="" name="" >
            </div>
             <div class="form-group col-md-4">
              <label for="">Fecha de Entrega</label>
              <input class="form-control" type="date" id="" name="" >
            </div>
            <div class="form-group col-md-4">
              <label for="">Horario de Entrega</label>
              <select class="form-control" id="" name="">
                <option value="">Seleccione</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="">Forma de Pago</label>
              <select class="form-control" id="" name="">
                <option value="">Seleccione</option>
                <option>Efectivo</option>
                <option>Giro Tigo</option>
                <option>Tarjeta</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="">Factura</label>
              <select id="factura" class="form-control" id="" name="">
                <option value="">Seleccione</option>
                <option value="1" selected>No</option>
                <option value="2">Si</option>
                <option value="3">Sin Nombre</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="">Vendedor</label>
              <select class="form-control" id="" name="">
                <option value="">Seleccione</option>
                <option value="">Item1</option>
                <option value="" selected>Item2</option>
                <option value="">Item3</option>
              </select>
            </div>
            {{-- ESTOS CAMPOS APARECEN CUANDO SE SELECCIONA FACTURA : SI / SIN NOMBRE   --}}
            <div id="nombres_factura" class=" d-none form-group col-md-4">
              <label for="">Nombres</label>
              <input class="form-control" type="text" id="" name="" >
            </div>
            <div id="direccion_factura" class=" d-none form-group col-md-8">
              <label for="">Direccion</label>
              <input class="form-control" type="text" id="" name="" >
            </div>
            <div id="ruc_factura" class=" d-none form-group col-md-4">
              <label for="">RUC</label>
              <input class="form-control" type="text" id="" name="" >
            </div>
            {{-- //// --}}
            
            <div class="form-group col-md-8">
              <label for="">Delivery</label>
              <div class="row">
                <div class="col-3 text-right">
                  <label class="form-check-label mt-2">
                    <input class="form-check-input" id="delivery" type="checkbox">Gratis
                  </label>
                </div>
                <div class="col-9">
                  <input class="form-control" type="text" id="monto" name="" placeholder="Monto" >
                </div>
              </div>
            </div>
            <div class="form-group col-md-12">
              <label for="">Nota</label>
              <textarea name="" class="form-control" cols="5"></textarea>
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
            <input class="form-control" type="text" id="cod_producto" name="" readonly>
          </div>
          <div class="form-group col-md-6 opacity-p">
            <label for="">Stock</label>
            <input class="form-control" type="text" id="stock" name=""  readonly>
          </div>
          <div class="form-group col-md-6 opacity-p">
            <label for="">Cantidad</label>
            <input class="form-control" type="text" id="" name="" >
          </div>
          <div class="form-group col-md-6 opacity-p">
            <label for="">Precio</label>
            <input class="form-control" type="text" id="precio" name="" >
          </div>
          <div class="col-sm-12 opacity-p d-flex justify-content-between mt-4">
            <a id="añadir" class="btn btn-primary " ><i class=" fa fa-lg fa-plus"></i>Añadir</a>
            <a id="refrescar" class="btn btn-secondary " ><i class=" fa fa-lg fa-refresh"></i>Refrescar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN SELECCION DE PRODUCTOS --}}
</div>
<div class="alert alert-danger bg-danger text-white mt-4" role="alert">
  Se agregó un producto faltante: <b>Nombre del Producto</b>.
</div>
<div class="row">
     <div class="col-md-12">
    {{-- CESTA DE COMPRA --}}
      <div class="tile">
        <h3 class="tile-title text-center text-md-left">Productos en la Cesta</h3>
          <div class="tile-body ">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <td>Cod.</td>
                    <td>Producto</td>
                    <td>Cantidad</td>
                    <td>Precio</td>
                    <td>Importe</td>
                    <td>Acciones</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>087609</td>
                    <td>Barbeador Recargable Resistente al agua - 4x1</td>
                    <td>9</td>
                    <td>9987</td>
                    <td>23459</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-trash"></i></a>
                        <a class="btn btn-primary" href="{{ route('productos.detalle',2) }}"><i class="m-0 fa fa-lg fa-info"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr class="table-danger">
                    <td>087609</td>
                    <td>Barbeador Recargable Resistente al agua - 4x1</td>
                    <td>9</td>
                    <td>9987</td>
                    <td>23459</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#" ><i class="m-0 fa fa-lg fa-trash"></i></a>
                        <a class="btn btn-primary" href="{{ route('productos.detalle',2) }}"><i class="m-0 fa fa-lg fa-info"></i></a>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <td colspan="5" class="text-right"><h4>Total: 0000000</h4></td>
                    <td><button class="btn btn-primary" type="submit">Guardar</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
      {{-- FIN CESTA DE COMPRA --}}
   </div>
</div>
  

@endsection

@php

   
      $url1 = config('app.url') . '/productos/';
    
      $url2 = 'img/img-default.png';
    

@endphp

              

@push('scripts')
<script type="text/javascript" charset="utf-8" async defer>

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
        $('#direccion_factura').removeClass('d-none').removeClass('col-md-12').addClass('col-md-8');
        $('#ruc_factura').removeClass('d-none'); 
     }
     if (seleccion == 3) {
        $('#nombres_factura').addClass('d-none');
        $('#direccion_factura').removeClass('d-none').removeClass('col-md-8').addClass('col-md-12');
        $('#ruc_factura').addClass('d-none');  
     }
    });
    

    // REFRESCA LOS CAMPOS DE SELCCION DE PRODUCTO

    $('#refrescar').click(function(){
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
            $('#precio').val(data.precio_ideal);
            $('#id_producto').val(data.id);

            var img = data.img;

            if (img.length > 0) {
              var zurl = url1+img;
              $('#img-p').html('<img src="'+zurl+'" alt="" class="img-fluid">');
              $('#eye-hover').addClass('btn-primary').removeClass('btn-secondary');
            }else{
              var zurl = url2;
              $('#img-p').html('');
              $('#eye-hover').addClass('btn-secondary').removeClass('btn-primary');
            }
     
          }

        });


    }

    // HOVER DE LA IMAGEN LUEGO QUE SELECCIONO EL PRODUCTO

    $("#eye-hover" ).mouseover(function() {
      $('#img-product').removeClass('d-none');
      $('.opacity-x').css('opacity', '0');
    }).mouseout(function() {
      $('#img-product').addClass('d-none');
      $('.opacity-x').css('opacity', '1');
    });




  </script>
  













@endpush