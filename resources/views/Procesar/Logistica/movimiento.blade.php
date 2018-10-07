<!DOCTYPE html>
<html lang="es_ES">
  <head>
<title>Movimiento de Mercader&iacute;a</title>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
       <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
       <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>
<!--<body align="center" onload="get_all()">-->
<body align="center">

     @foreach($venta as $item)  
      <table border="0" cellspacing="10px"  style="width: 100%;">
          <tr>
            <td colspan="2" style="width: 100%;text-align: center; border:1px solid #000;"><h3 style="font-weight: 900;font-size: 30px;line-height: 1.5em;margin: 0;">GU&Iacute;A DE PEDIDO</h3>
            </td>
          </tr>
          <tr>
            <td  style="text-align: center;width: 50%;">
              <img src="{{ public_path('img/codeQr.jpg')}}" alt="codeQr" style="width: 100px;">
            </td>
            <td style="width: 50%;border:1px solid #000; vertical-align: middle;">
              <table style="width: 100%;">
                    <tr><th  style="text-align: center;font-weight: 800;font-size: 26px;">N&Uacute;MERO DE GU&Iacute;A</th></tr>
                    <tr><td style="text-align: center;font-size: 26px;">{{$item->id}}</td></tr>
              </table>
            </td>
          </tr>
         <tr>
            <td colspan="2" style="width: 100%;border:1px solid #000;padding: 10px; font-size: 20px;">
              <table border="0">
                <tr>
                  <td style="font-weight: bold;">Fecha:</td>
                  <td style="font-weight: bold;"><?php echo date('d/m/Y');?></td>
                </tr>
              </table>
            </td>
         </tr>
        <tr>
          <td colspan="2" style="width: 100%;border:1px solid #000;padding: 10px; font-size: 16px;"> 
            
            <table  border="0" style="width: 100%;">
                 <tr>
                  <th align="left" style="width: 135px;">Nombre del cliente:</th>
                  <td align="left" id="nom_cli">{{$item->nombres}} </td>
                 </tr>
                 <tr>
                  <th align="left" style="width: 135px;" >Celular:</th>
                  <td align="left" id="celular">{{$item->telefono}} </td>
                 </tr>
                 <tr>
                  <th align="left" style="width: 135px;"  >Direcci&oacute;n:</th>
                  <td align="left"  id="dir_cli">{{$item->direccion}}</td>
                 </tr>
                 <tr>
                  <th align="left" style="width: 135px;" >Zona:</th>
                  <td  align="left" id="bar_cli">{{$item->barrio}} </td>
                </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="width: 100%;border:1px solid #000;padding: 10px; font-size: 16px;"> 
              <table border="0" style="width: 100%;">
                <tr>
                  <th align="left" style="width: 135px;">Forma de Pago:</th>
                  <td align="left" id="fp">{{$item->forma_pago}}</td>
                </tr>
                <tr>
                  <th align="left" style="width: 135px;">Horario Entrega:</th>
                  <td align="left" id="he">{{$item->horario}}</td>
                </tr>
                <tr>
                  <th align="left" style="width: 135px;">Fecha activo:</th>
                  <td align="left" id="fa">{{$fecha}}</td>
                </tr>
                <tr>
                  <th align="left" style="width: 135px;">Notas:</th>
                  <td align="left" id="notas">{{$item->notas}}</td>
                </tr>
            </table>

          </td>
        </tr>
    
        <tr>
          <td colspan="2" style="width: 100%;border:1px solid #000;padding: 10px; font-size: 16px;"> 
            
              <table border="0" style="width: 100%;" >
                  <thead>
                    <tr>
                      <th align="left" width="20%">C&oacute;digo</th>
                      <th align="left" width="50%">Producto</th>
                      <th align="left" width="10%">Cantidad</th>
                      <th align="left" width="10%">Precio</th>
                      <th align="left" width="10%">Importe</th>
                    </tr>
                  </thead>
                 <?php $l=0; $timporte=0; $subimporte=0; ?>
                @foreach($factura as $item2)  
                <?php  $l= $l+1; ?>
                  <tbody>
                      <tr>
                        <td align="left" width="20%">{{$item2->codigo_producto}}</td>
                        <?php if(empty($item2->nombre_original)|| is_null($item2->nombre_original)){?>     
                        <td align="left" width="50%">{{$item2->descricion}}</td>
                        <?php }else{?>
                        <td align="left" width="50%">{{$item2->nombre_original}}</td>
                        <?php } ?>
                        <td align="left" width="10%">{{$item2->cantidad}}</td>
                        <td align="left" width="10%">{{$item2->precio}}</td>
                        <?php $subimporte= $item2->cantidad * $item2->precio;
                         $timporte+=$subimporte;?>
                        <td align="left" width="10%">{{$subimporte}}</td>
                      </tr>
                  </tbody>
                  <tfoot>
                @endforeach 
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="left"><b>Total: </b></td>
                        <td align="left"><b>{{$timporte }}Gs</b></td>
                      </tr>
                  </tfoot>
              </table>
            </td>
        </tr>
        <tr>
          <td colspan="2" style="width: 100%;border:1px solid #000;padding: 10px; font-size: 16px;"> 
            <table border="0" style="width: 100%;">
              <tr>
                <th align="left" style="width: 135px;">Asesora de ventas:</th>
                <td align="left" id="vende">{{$item->name}}</td>
              </tr>
            </table>
        @endforeach
          </td>
        </tr>
        <tr>
          <td colspan="2" style="width: 100%;border:1px solid #000;padding: 10px; font-size: 16px; font-style: italic;"> 
            <p style="margin: 0;">Este documento es su garant&iacute;a, por favor cons&eacute;rvelo ya que contiene informaci&oacute;n &uacute;nica sobre su pedido.<br>Ante cualquier Eventualidad puede comunicarse al: 0981 102 764 / 0981 928 845</p>
          </td>
        </tr>
      </table>

</body>
</html>