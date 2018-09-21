@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
<?php $titulo = "Confirmaci�n de Solicitud de Pedido";
      $tit = utf8_decode($titulo);?>
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Confirmacion de Solicitud de Pedido' )
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
      <form name="form1" action="{{route('entradas.carga')}}" accept-charset="UTF-8"  method="post">
            {{ csrf_field() }}
          <div class="row">
            <div class="form-group col-md-3">
              <label for="fecha_entrada">Fecha</label>
              <input class="form-control" type="date" id="fecha_entrada" name="fecha_entrada" required="" value="{{$solped->fecha}}" readonly="">
            </div>
            <div class="form-group col-md-3">
              <input type="hidden" id="cant" name="cant" value="{{$cant}}">
              <input type="hidden" id="idsolped" name="idsolped" value="{{$solped->id}}">
              <label for="n_documento_entrada">N&uacutemero de Documento</label>
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
            <?php $fecha=date('Y-m-d');?>
            <div class="form-group col-md-3">
              <label for="fecha_entrada">Fecha Confimaci&oacuten</label>
              <input class="form-control" type="date" id="fecha_confirmacion" name="fecha_confirmacion" required="" value="{{$fecha}}" >
            </div>

           <div class="form-group col-md-10">
              <label for="n_documento_entrada">Observaciones</label>
              <textarea name="observaciones" class="form-control" id="observaciones" cols="60" rows="2"></textarea>
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
              <input class="form-control" type="text" id="cod_producto" name="cod_producto" readonly="">
              <input type="hidden" name="idproducto" id="idproducto">
              
            </div>
            <div class="form-group col-md-4">
              <label for="descripcion">Descripci&oacuten</label>
              <input class="form-control" type="text" name="descripcion" id="descripcion" >
            </div>
            <div class="selec_productos col-12 d-none">
              <ul class="list-group" id="list-productos">
               {{-- ESTE ESPACIO APARECE Y SE LLENA CON AJAX, SE ACATUALIZA CADA QUE SUELTAS LA TECLA --}}
             </ul>
           </div>

           <div class="form-group col-md-2">
            <label for="precio_entrada">Precio</label>
            <input class="form-control" type="text" id="precio" name="precio">
          </div>
          <div class="form-group col-md-1">
            <label for="cantidad_entrada">Cantidad</label>
            <input class="form-control" type="text" id="cantidad" name="cantidad">
          </div>
          <div class="form-group col-md-2">
            <label for="Total">Total</label>
            <input class="form-control" type="text" id="total" name="total" readonly >
          </div>
          <div class="col-sm-1">
            <button type="button" id="agregar" class="btn btn-primary mt-4" href="#" ><i class=" m-0 fa fa-lg fa-plus" dis></i></button>
            <a </a>
          </div>

        </div>
      </div>

      <div class="tile">
        <h3 class="tile-title text-center text-md-left">Productos de la Solicitud de Pedido</h3>
        <div class="tile-body ">
          <div class="table-responsive">
             <input type="hidden" id="ListaProd1" name="ListaProd" value="" required />
            <table id="detalles" class="table">
              <thead>
                <tr>
                  <td><b>#</b></td>
                  <td><b>Producto</b></td>
                  <td class="text-center"><b>Cantidad</b></td>
                  <td class="text-left"><b>Precio</b></td>
                  <td class="text-left"><b>Importe</b></td>
                  <td class="text-center"><b>Nombre S/Factura</b></td>
                  <td class="text-center"><b>Cantidad(Conf)</b></td>
                  <td class="text-left"><b>Precio(Conf)</b></td>
                  
                </tr>
               </thead>
              <tbody>
                <?php $total=0; $z=1; 
                $name3="idproducto".$z;
                $name="cantidad_conf".$z;
                 $name2="precio_conf".$z;
                 $name4="nombre_conf".$z;
                 $name5="cantidad".$z;
                 $name6="precio".$z;
                $contador=0;
                ?>
                @foreach($detalles as $det)
                <tr>
                  <input type="hidden" name="idproducto[]" id="{{$name3}}" value="{{$det->idproducto}}" >
                  <td>
                    <div class="form-check">
                         <input type="checkbox" class="form-check-input" name="producto[]" onclick="activar('{{$name}}','{{$name2}}','{{$name4}}');">
                    </div>
                  </td>
                  <td>{{$det->desprod}}</td>
                                      <?php $cant=$det->cantidad;
                      $zcan = number_format($cant, 0, ',', '.');?>

                  <td align="text-center"><input type="text" class="form-control" name="precio[]" id="{{$name5}}" value="<?php echo $zcan;?>" size="3" disabled>
                        
                  </td>
                  <td align="right">
                    <?php $prec=$det->precio;
                      $zcan = number_format($prec, 2, ',', '.');?>
                     <input type="text" class="form-control" name="cantidad[]" id="{{$name6}}" value="<?php echo $zcan;?>" size="16" disabled>
                    
                  </td>
                  <td><?php $importe=$det->precio*$det->cantidad;
                      $ztotal = number_format($importe, 2, ',', '.');
                      $total = $total + $importe;
                     echo $ztotal;$z++;
                    //$name="cantidad_conf"+$z;
                    //$name2="precio_conf"+$z;
                    //$name3="idproducto"+$z;
                     ?></td>
                <td><input type="text" class="form-control" name="nombre_conf[]"  id="{{$name4}}"disabled="" value="{{$det->nombre_fiscal}}" size="10"></td>                     
                  <td><input type="text" class="form-control" name="cantidad_conf[]" id="{{$name}}" disabled="" value="{{$det->cantidad_confirmada}}" size="2"></td>
                  <td><input type="text" size="4" class="form-control" name="precio_conf[]"  id="{{$name2}}" disabled="" value="{{$det->precio_confirmado}}"></td>
                
                </tr>
                <?php $contador++;
                   $name3="idproducto".$z;
                   $name="cantidad_conf".$z;
                   $name2="precio_conf".$z;
                   $name4="nombre_conf".$z;
                    $name5="cantidad".$z;
                     $name5="precio".$z;
                ?>
                @endforeach
              </tbody>
              </tbody>
               <tr class="table-secondary">
                    <td  colspan="5" class="text-right"><b>Total Importe</b></td>
                    <td  id="ztotal">
                    <?php 
                      $ztotal = number_format($total, 2, ',', '.');
                      
                     //echo $ztotal;?>
                      

                    </td>
                     <?php 
                      $ztotal = number_format($total, 2, ',', '.');
                      
                     //echo $ztotal;?>
                    <td  class="text-right" colspan="2"><input type="hidden" name="ctotal" id="ctotal" value="{{$total}}" class="form-control" disabled maxlength="10">
                      <input type="text" name="ctotal2" id="ctotal2" value="{{$ztotal}}" class="form-control" disabled maxlength="10">
        
                    </td>
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

    $ = jQuery;
    jQuery(document).ready(function () {
     $("input#cantidad_conf").bind('keydown', function (event) {

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

     $("input#precio_conf").bind('keydown', function (event) {

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

         $('#total_conf').val(total);
         $('#precio_conf').val(precio);
       });

   $('#agregar').click(function() {
      incluir();
    });




});
 </script>
<script>
   $('#refrescar').click(function(){
      $('#descripcion').val('');
      $('#cod_producto').val('');
      $('#stock').val('');
      $('#precio').val('');
      $('#id_producto').val('');
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
  function activar(id,id2,id4){
    var checkbox = document.getElementById('producto');
    //alert(name1);
    console.log(checkbox);
    
    $("#"+id).removeAttr("disabled");
    $("#"+id2).removeAttr("disabled");
   $("#"+id4).removeAttr("disabled");
    $("#"+id4).focus();
  }
</script>
<script>
  
  var contador=$('#cant').val();
  contador++;
  json_productos = [];
  productos=[];
  subtotal=[];
  ptotal=0;
  noincluir=0;
  function incluir()
    {
      var aux = parseInt($("#ctotal").val()); 
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

        name1 = "idproducto"+contador+1;
        name2 = "cant"+contador+1;
        name3 = "prec"+contador+1;
        
        var fila = '<tr class="selected" id="fila'+contador+'"><td><button type="button"class="btn btn-warning" onclick="eliminar('+contador+');"><i class="m-0 fa fa-lg fa-trash"></i></button></td><td><input class="form-control" size="3" type="hidden" name="idproducto" id="'+name1+'" value="'+idproducto+'" readonly><input type="text" class="form-control" name="des[]" value="'+descripcion+'" readonly size="40"></td><td><input type="text" class="form-control" size="3" name="cant[]" value="'+cantidad+'" readonly></td><td><input type="text" size="5" class="form-control" name="prec[]" value="'+precio+'" id="'+name3+'" readonly></td><td>'+subtotal[contador]+'</td><td></td></tr>';
          productos[contador]=idproducto;
          ndoc =$('#nro_documento').val();
////////////////////////////////////////////7
        item = {}
        item["documento"]=ndoc;
        item["fecha"]=$('#fecha_entrada');
        item["proveedor"]=$('#id_proveedor');
        item["id"]=idproducto;
        item["descripcion"]=descripcion;
        item["cantidad"]=cantidad;
        item["precio"]=precio;
        json_productos.push(item);
        
//////////////////////////////////////////////
        contador++;
        limpiar();
        ptotal2 = 0;
        ptotal2 = parseFloat(aux) + parseFloat(cantidad*precio);
        $("#ctotal").val(ptotal2); 
        $("#ctotal2").val(ptotal2); 
        //$("#ztotal").html("Gns/." + ptotal);
             
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
    $('#ListaProd1').val(JSON.stringify(json_productos));
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
     var aux = parseInt($("#ctotal").val()); 
    ptotal = ptotal - subtotal[index];
    ptotal2 = parseFloat(aux) - parseFloat(subtotal[index]);
    $("#ctotal").val(ptotal2); 

    
    //$("#ztotal").html("Bs/." + ptotal);
    $("#fila"+index).remove();
    idc = productos[index];
    productos.splice(index, 1);
    json_productos.splice(index,1); 
    $('#ListaProd1').val("");
    $('#ListaProd1').val(JSON.stringify(json_productos));
    ndocu        = document.form1.nro_documento.value;
  
  }

</script>
 @endpush