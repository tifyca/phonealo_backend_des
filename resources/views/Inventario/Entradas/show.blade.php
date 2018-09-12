@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Nueva Entrada')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('inventario/entradas'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <div class="tile-body ">
          <form>
          <div class="row">
            <div class="form-group col-12 col-md-3">
              <label for="tipo_entrada">Tipo de Entrada</label>
              <select class="form-control" id="tipo_entrada" name="tipo_entrada" required="">
                <option value="">Seleccione</option>
                <option>Pedido</option>
                <option>Carga Inicial</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="fecha_entrada">Fecha</label>
              <input class="form-control" type="date" id="fecha_entrada" name="fecha_entrada" required="">
            </div>
            <div class="form-group col-md-3">
              <label for="n_documento_entrada">Número de Documento</label>
              <input class="form-control" type="text" id="n_documento_entrada" name="n_documento_entrada" placeholder="..." required="">
            </div>
            <div class="form-group col-md-3">
              <label for="proveedor_entrada">Proveedor</label>
                     <select class="form-control" id="id_proveedor" name="id_proveedor" required="">
                <option value="">Proveedor</option>
                 @foreach($proveedores as $provee)
                 <option value="{{$provee->id}}">{{$provee->nombres}}</option>
                 @endforeach
              </select>

            </div>
           
          </div>
       
        </div>
    </div>
  </div>
  <div class="col-12">
    <div class="tile">
      <h3 class="tile-title text-center text-md-left">Detalles del Producto</h3>
        <div class="tile-body ">
          <div class="row">

            <div class="form-group col-md-1">
              <label for="cod_entrada">Cod.</label>
              <input class="form-control" type="text" id="cod_producto" name="cod_producto" >
            </div>
            <div class="form-group col-md-4">
              <label for="descripcion">Descripción</label>
              <input class="form-control" type="text" id="descripcion" name="descripcion" >
            </div>
            <div class="selec_productos col-12 d-none">
                <ul class="list-group" id="list-productos">
                   {{-- ESTE ESPACIO APARECE Y SE LLENA CON AJAX, SE ACATUALIZA CADA QUE SUELTAS LA TECLA --}}
                </ul>
              </div>

            <div class="form-group col-md-2">
              <label for="precio_entrada">Precio</label>
              <input class="form-control" type="text" id="precio" name="precio" >
            </div>
            <div class="form-group col-md-2">
              <label for="cantidad_entrada">Cantidad</label>
              <input class="form-control" type="text" id="cantidad" name="cantidad" >
            </div>
            <div class="form-group col-md-2">
              <label for="Total">Total</label>
              <input class="form-control" type="text" id="Total" name="Total" readonly >
            </div>
            <div class="col-sm-1">
              <a class="btn btn-primary mt-4" href="#"><i class=" m-0 fa fa-lg fa-plus"></i></a>
            </div>

          </div>
        </div>
         <div class="tile-footer col-12 pl-3">
              <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
    </div>
  </div>
   </form>
</div>

  

@endsection

@push('scripts')
<script type="text/javascript" charset="utf-8" async defer>

    

    // REFRESCA LOS CAMPOS DE SELCCION DE PRODUCTO

    $('#refrescar').click(function(){
      $('#descripcion').val('');
      $('#cod_producto').val('');
      $('#stock').val('');
      $('#precio').val('');
      $('#id_producto').val('');
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
            $('#cod_producto').val(data.codigo_producto);
            $('#stock').val(data.stock_activo);
            $('#precio').val(data.precio_ideal);
            $('#id_producto').val(data.id);
                
          }

        });


    }





  </script>
  














@endpush