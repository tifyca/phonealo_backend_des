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
        <form name="form1">
          <div class="row">
            <div class="form-group col-md-3">
              <label for="fecha_entrada">Fecha</label>
              <input class="form-control" type="date" id="fecha_entrada" name="fecha_entrada" required="" value="{{$fecha}}">
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

            <div class="form-group col-md-2">
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
          <div class="form-group col-md-1">
            <label for="cantidad_entrada">Cantidad</label>
            <input class="form-control" type="text" id="cantidad" name="cantidad" >
          </div>
          <div class="form-group col-md-2">
            <label for="Total">Total</label>
            <input class="form-control" type="text" id="total" name="total" readonly >
          </div>
          <div class="col-sm-1">
            <button type="button" id="agregar" class="btn btn-primary mt-4" href="#"><i class=" m-0 fa fa-lg fa-plus"></i></button>
            <a </a>
          </div>

        </div>
      </div>
      <div class="tile">
        <div class="tile-body ">
          <div class="table-responsive">
            <table id="detalles" class="table">
              <thead>
                <tr>
                  <td>Cod.</td>
                  <td>Producto</td>
                  <td>Cantidad</td>
                  <td>Precio</td>
                  <td>Importe</td>
                </tr>
              </thead>
              <tbody>
               
              </tbody>
               <tr class="table-secondary">
                    <td colspan="5" class="text-right"><b>Total Importe</b></td>
                    <td colspan="2" id="ztotal"></td>
                  </tr>
            </table>
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
  <script type="text/javascript" language="javascript">
    $ = jQuery;
    jQuery(document).ready(function () {
     $("input#cantidad").bind('keydown', function (event) {

      if(event.shiftKey)
      {
        event.preventDefault();
      }
      if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 241 )    {
      }
      else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
            event.preventDefault();
          }
        } 
        else {
          if (event.keyCode < 96 || event.keyCode > 105) {
            event.preventDefault();
          }
        }
      }        
      ;
    });    
     $("input#cantidad").bind('change', function (event) {
      var valor = $(this).val();
      var precio = $('#precio').val();
      var ztotal = valor * precio;
      zprecio = Number(precio).toLocaleString();
        //alert(total);
         //total = ztotal.toFixed(2);
         total =  Number(ztotal).toLocaleString();

         $('#total').val(total);
         $('#precio').val(precio);
       });

   });  

$('#agregar').click(function() {
      incluir();
    });

 </script>

<script>
  var contador=0;
  subtotal=[];
  ptotal=0;
  function incluir()
    {
      codigo      = $('#cod_producto').val();
      descripcion = $('#descripcion').text();
      cantidad    = $('#cantidad').val();
      precio      = $('#precio').val();
      if(codigo!="" && cantidad!="" && cantidad>0  && precio!="" && precio>0)
      {
        subtotal[contador]=(precio*cantidad);
        ptotal = ptotal + subtotal[contador];
        var fila = '<tr class="selected" id="fila'+contador+'"><td><button type="button"class="btn btn-warning" onclick="eliminar('+contador+');"><i class="m-0 fa fa-lg fa-trash"></i></button></td><td><input type="text" class="form-control" name="codigo[]" value="'+codigo+'" readonly>'+descripcion+'</td><td><input type="number" class="form-control" name="cantidad[]" value="'+cantidad+'" readonly></td><td><input type="number" class="form-control" name="precio[]" value="'+precio+'" readonly></td><td>'+subtotal[contador]+'</td><td><div></div></td></tr>';
        

        contador++;
        limpiar();
        $("#ztotal").html("Gns/." + ptotal);
        verificar();
        $("#detalles").append(fila);
      }
      else{alert("Error al ingresar item de la solicitud");}
    }
  function limpiar()
  {
    $('#cantidad').val("");
    $('#cod_producto').val("");
    $('#descripcion').val("");
    $('#precio').val("");
    $('#total').val("");
  }
  function verificar()
  {
 
  }
  function eliminar(index)
  {
    ptotal = ptotal - subtotal[index];
    $("#ztotal").html("Bs/." + ptotal);
    $("#fila"+index).remove();
    verificar();
  }
</script>  










 @endpush