@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Vista de Solicitud de Pedido')
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
      <form name="form1" action="#" accept-charset="UTF-8"  method="post">
          
          <div class="row">
            <div class="form-group col-md-3">
              <label for="fecha_entrada">Fecha</label>
              <input class="form-control" type="date" id="fecha_entrada" name="fecha_entrada" required="" value="{{$solped->fecha}}" readonly="">
            </div>
            <div class="form-group col-md-3">
              <label for="n_documento_entrada">Número de Documento</label>
              <input class="form-control" type="text" id="nro_documento" name="nro_documento" placeholder="..." readonly="" maxlength="30" value="{{$solped->nro_documento}}">
            </div>
            <div class="form-group col-md-3">
              <label for="proveedor_entrada">Proveedor</label>
              <select class="form-control" id="id_proveedor" name="id_proveedor" readonly>
                <option value="">Proveedor</option>
                @foreach($proveedores as $provee)
                <option value="{{$provee->id}}" @if($solped->id_proveedor==$provee->id) selected="" @endif>{{$provee->nombres}}</option>
                @endforeach
              </select>

            </div>

            <div class="form-group col-md-3">
              <label for="fecha_entrada">Fecha Confirmación</label>
              <input class="form-control" type="date" id="fecha_confirmacion" name="fecha_confirmacion" required="" value="{{$solped->fecha_confirmacion}}" readonly="">
            </div>

         <div class="form-group col-md-12">
              <label for="n_documento_entrada">Observaciones</label>
              <textarea name="observaciones" class="form-control" id="observaciones" cols="80" rows="2" readonly="">{{$solped->observaciones}}</textarea>
            </div>
          </div>
          </div>

        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="tile">
        <div class="tile-body ">
          <div class="table-responsive">
            <table id="detalles" class="table">
              <thead>
                <tr class="table-secondary">
                  <td colspan="5" class="text-left"><b>Detalles Pedido</b></td>
                  <td colspan="4" class="text-left" ><b>Datos de Confirmación</b></td>
                </tr>
                <tr>
                  <td><b>Cod.</b></td>
                  <td><b>Producto</b></td>
                  <td align="center"><b>Cantidad</b></td>
                  <td align="right"><b>Precio</b></td>
                  <td align="center"><b>Importe</b></td>
                  <td align="center" ><b>Factura</b></td>
                  <td align="center"><b>Cantidad</b></td>
                  <td align="right"><b>Precio</b></td>
                  <td align="center"><b>Importe</b></td>
                </tr>
               </thead>
              <tbody>
                <?php $total=0; $zztotal=0;?>
                @foreach($detalles as $det)
                <tr
                  @if($det->precio != $det->precio_confirmado && $det->precio_confirmado>0)
                  class="table-warning" 
                  @endif
                 @if($det->cantidad != $det->cantidad_confirmada && $det->cantidad_confirmada>0)
                  class="table-warning" 
                  @endif     
                       
                >
                  <td>{{$det->codigo}}</td>
                  <td>{{$det->desprod}}</td>
                  <td  align="center">{{$det->cantidad}}</td>
                  <td align="right">{{$det->precio}}</td>
                  <td align="right"><?php $importe=$det->precio*$det->cantidad;
                      $ztotal = number_format($importe, 2, ',', '.');
                      $total = $total + $importe;
                     echo $ztotal;?></td>
                  <td align="center">{{$det->nfactura}}</td>
                  <td align="center">{{$det->cantidad_confirmada}}</td>
                  <td align="right">{{$det->precio_confirmado}}</td>
                  <td align="right"><?php $importe=$det->precio_confirmado*$det->cantidad_confirmada;
                      $ztotal = number_format($importe, 2, ',', '.');
                      $zztotal = $zztotal + $importe;
                     echo $ztotal;?></td>
                </tr>
                @endforeach
              </tbody>
              </tbody>
               <tr class="table-secondary">
                    <td  colspan="4" class="text-right"><b>Total</b></td>
                    <td  class="table-active text-right" id="ztotal">
                    <?php 
                      $ztotal = number_format($total, 2, ',', '.');
                      
                     echo "<b>".$ztotal."</b>";?>
                      

                    </td>
                    <td  colspan="3" class="text-right "><b>Total</b></td>
                    <td  id="ztotal" class="text-right ">
                    <?php 
                      $ztotal = number_format($zztotal, 2, ',', '.');
                      
                     echo "<b>".$ztotal."</b>";?>
                      

                    </td>
                  </tr>
            </table>
          </div>
        </div>
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
    $('#nro_documento').keyup(function(event) {
        $valor=$('#this').val();
        if($valor!=""){
          document.form1.descripcion.disabled = false
          document.form1.precio.disabled = false
          document.form1.cantidad.disabled = false
        }
    });
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
          $('#idproducto').val(data.id);
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

      $("input#nro_documento").bind('change', function (event) {
        var valor = $(this).val();
        document.form1.nro_documento.value=valor.toUpperCase();
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
  productos=[];
  subtotal=[];
  ptotal=0;
  noincluir=0;
  function incluir()
    {
      ndocu        = document.form1.nro_documento.value;
      codigo      = $('#cod_producto').val();
      descripcion = $('#descripcion').val();
      cantidad    = $('#cantidad').val();
      precio      = $('#precio').val();
      idproducto  = $('#idproducto').val();
      verificar(contador+1);
      if(codigo!="" && cantidad!="" && cantidad>0  && precio!="" && precio>0)
      {
        if(noincluir==0)
        {
        subtotal[contador]=(precio*cantidad);
        ptotal = ptotal + subtotal[contador];
        name1 = "cod"+contador+1;
        var fila = '<tr class="selected" id="fila'+contador+'"><td><button type="button"class="btn btn-warning" onclick="eliminar('+contador+');"><i class="m-0 fa fa-lg fa-trash"></i></button></td><td><input type="hidden" name="cod[]" id="'+name1+'" value="'+idproducto+'"><input type="text" class="form-control" name="des[]" value="'+descripcion+'" readonly></td><td><input type="number" class="form-control" name="cant[]" value="'+cantidad+'" readonly></td><td><input type="number" class="form-control" name="prec[]" value="'+precio+'" readonly></td><td>'+subtotal[contador]+'</td><td></td></tr>';
          productos[contador]=idproducto;
         ndoc =$('#nro_documento').val();
         
         $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "GET",
          url: '{{ url('cdetalle') }}',
          dataType: "json",
          data: { ndoc: ndocu , idc: idproducto , prec: precio , cant: cantidad , desc: descripcion ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
          }});    
        contador++;
        limpiar();
        $("#ztotal").html("Gns/." + ptotal);
        
        $("#detalles").append(fila);
      }
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
  function verificar(z)
  {
     x=0;
     for(i=0;i<z;i++){
      if(productos[i]==$('#idproducto').val()){
        x++;
      }

     }
     if(x>0){alert('Producto Ya Incluido');
     limpiar();
     noincluir=1;}
  }
  function eliminar(index)
  {
    ptotal = ptotal - subtotal[index];
    $("#ztotal").html("Bs/." + ptotal);
    $("#fila"+index).remove();
    idc = productos[index];
    ndocu        = document.form1.nro_documento.value;
             $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "GET",
          url: '{{ url('edetalle') }}',
          dataType: "json",
          data: { ndoc: ndocu , idc: idc ,  _token: '{{csrf_token()}}' },
          success: function (data){
            console.log(data);
          }});    

    verificar();
  }
</script>  






 @endpush