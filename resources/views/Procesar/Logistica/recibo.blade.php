<!DOCTYPE html>
<html lang="es_ES">
  <head>
    <title>Factura</title>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ asset('js/bootstrap.min.js') }}"></script>
      <style type="text/css">
     input, input:hover, input:focus, input:active {
      background: transparent;
      border: 0;
      border-style: none;
      border-color: transparent;
      outline: none;
      outline-offset: 0;
      box-shadow: none;
      font-size: 14px;
      }
      body{
        margin-left: 67px;
      }
      #heather{
        width:1000px;
        height:135px;
        vertical-align: center;
      }
      #cabeza{
        width:750px;
        height:105px;
        float: left;
        margin-left: 10px;
      }
      #lado{
        text-align: left;
        width:100px;
        height:105px;
        float: left;
      }
      #cabeza, #lado{
        display: inline-block;
      }
      #registros_table{
        font-family: "Arial", sans-serif;
        font-size: 12px;
        width:1000px;
        height: 470px;
      }
      #codpro{
        width: 98px;
      }
      #cantidad{
        width: 50px;
      }
      #producto{
        width: 420px;
      }
      #precio{
        width: 400px;
      }
      #importe{
        float: right;
      }
      #venta{
        display: none;
      }
      #letras{
        width: 1000px;
        height: 40px;
        margin-left: 10px;
      }
      #let{
        padding-left: 140px;
        font-size: 16px;
      }
      #imp{
        float: right;
        text-align: right;
        font-size: 16px;
      }
      #iva{
        float: right;
        text-align: right;
        font-size: 14px;
        padding-right: 50px;
        padding-top: 10px;
      }
      #piva{
        float: right;
        text-align: right;
        font-size: 14px;
        padding-top: 10px;
        padding-right: 50px;
      }
      #divisorio{
        width: 1000px;
        height: 330px;
      }
      #cabezad{
        width:750px;
        height:105px;
        float: left;
        margin-left: 10px;
      }
      #ladod{
        text-align: left;
        width:100px;
        height:105px;
        float: left;
      }
      #cabezad, #ladod{
        display: inline-block;
      }
      #registros_tabled{
        font-family: "Arial", sans-serif;
        font-size: 12px;
        width:1000px;
        height: 470px;
      }
      #letrasd{
        width: 1000px;
        height: 40px;
        margin-left: 10px;
      }
      #letd{
        padding-left: 140px;
        font-size: 16px;
      }
      #impd{
        float: right;
        text-align: right;
        font-size: 16px;
      }
      #ivad{
        float: right;
        text-align: right;
        font-size: 14px;
        padding-right: 50px;
        padding-top: 10px;
      }
      #pivad{
        float: right;
        text-align: right;
        font-size: 14px;
        padding-top: 10px;
        padding-right: 50px;
      }
      </style>
  </head>

<body align="center" >
<br><br><br><br><br>
 @foreach($venta as $item)  
     <table border="0"   style="width: 100%;">
    
       <tr>
         <td style="padding-left:70px; font-size: 12px;">{{$dated}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$datem}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$datea}}</td>
         <td></td>
         <td></td>
         <td style="padding-left:50px; font-size: 12px;">{{$item->ruc_ci}}</td>
        </tr>
        <tr>      
         <td style="padding-left:70px; font-size: 12px;">{{$item->nombres}}</td> 
         <td ></td>
         <td ></td>
         <td style="padding-left:80px; font-size: 12px;">{{$item->telefono}}</td> 
          
        </tr>
        <tr>
         <td style="padding-left:70px; font-size: 12px;">{{$item->direccion}}</td>    
         <td></td>
         <td></td>
         <td style="padding-left:100px; font-size: 12px;" size="100" id="con">Contado</td> 
        </tr> 
    
</table>
  <table class=" table table-hover"   width="100%">
   <?php $l=0; $timporte=0; $subimporte=0; ?>
                @foreach($factura as $item2)  
                <?php  $l= $l+1; ?>
              
                <tr>
                  <td id="cantidad" align="center" style="font-size: 12px; width: 3px;">{{$item2->cantidad}}</td>
                  <?php  if(empty($item2->nombre_original)|| is_null($item2->nombre_original)){?>     
                  <td colspan="4" id="producto" align="left" style="font-size: 12px width: 79px;">{{$item2->descripcion}}</td>
                  <?php }else{?>
                  <td colspan="4" id="producto" align="left" style="font-size: 12px; width: 79px;">{{$item2->nombre_original}}</td>
                  <?php } ?>
                  <td style="width: 10px; font-size: 12px;">{!!number_format($item2->precio, 0, ',', '.')!!}</td>
                  <?php $subimporte= $item2->cantidad * $item2->precio;
                  $timporte+=$subimporte;?>
                  <td id="importe" style="font-size: 12px; width: 10px;" align="center">{!!number_format($subimporte, 0, ',', '.')!!}</td>
                @endforeach 
                </tr>
                @for ($i = $l; $i < 9; $i++)
                <tr>
                  <td id="cantidad" align="left" style="color: gray; width: 3px;">_</td>
                  <td   colspan="4" id="producto" align="left" style="color: gray; width: 79px;">_</td>
                    <td style="width: 10px; color: gray;">_</td>
                    <td style="width: 10px; color: gray;" align="center">_</td>
                  
                  </tr>
               @endfor
                  <tr>
                    <td align="left" style="width: 3px;" >&nbsp;&nbsp;</td>
                    <td colspan="4" style="width:79px;"></td>
                    <td style="width: 10px;"></td>
                    <td align="center" style="font-size: 12px; width: 10px; "></td>
                  </tr
              @endforeach 
                  <tr>
                    <td align="center"  colspan="5" style="font-size: 12px;"> {!!ucwords(strtolower(NumeroALetras::convertir($timporte)))!!}</td>
                    <td style="width: 10px;"></td>
                    <td align="center"  style="font-size: 12px;">{!!number_format($timporte, 0, ',', '.')!!} <br><br>{!!number_format($timporte, 0, ',', '.')!!}</td>
                  </tr>
                  <tr>
                    <td  align="left" style="width: 3px;"  >&nbsp;.</td>
                    <td align="center" colspan="4" style="width: 10px;font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!!number_format($timporte/11, 0, ',', '.')!!}</td>
                    <td align="right" style="font-size: 12px;">{!!number_format($timporte/11, 0, ',', '.')!!}</td>
                    <td  align="center" style="font-size: 12px;">&nbsp; </td>
                  </tr>
                  <tr><td></td><td></td><td> </td><td></td></tr>
                  <tr>
                     <td align="center"  colspan="5" style="font-size: 12px;"> {!!ucwords(strtolower(NumeroALetras::convertir($timporte)))!!}</td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td align="center" colspan="4" ></td>
                    <td> </td><td align="center"  style="font-size: 12px;">{!!number_format($timporte, 0, ',', '.')!!} </td>
                  </tr>
  
              </table>
{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
 <br><br><br><br>
 @foreach($venta as $item)  
 <table border="0"  style="width: 100%;">
      
        <tr>
         <td style="padding-left:70px; font-size: 12px;">{{$dated}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$datem}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$datea}}</td>
         <td></td>
         <td></td>
         <td style="padding-left:50px; font-size: 12px;">{{$item->ruc_ci}}</td>
        </tr>
        <tr>      
         <td style="padding-left:70px; font-size: 12px;">{{$item->nombres}}</td> 
         <td ></td>
         <td ></td>
         <td style="padding-left:80px; font-size: 12px;">{{$item->telefono}}</td> 
          
        </tr>
        <tr>
         <td style="padding-left:70px; font-size: 12px;">{{$item->direccion}}</td>    
         <td></td>
         <td></td>
         <td style="padding-left:100px; font-size: 12px;" size="100" id="con">Contado</td> 
        </tr> 
    
 </table>


  <table class=" table table-hover"   width="100%">
   <?php $l=0; $timporte=0; $subimporte=0; ?>
                @foreach($factura as $item2)  
                <?php  $l= $l+1; ?>
              
                <tr>
                  <td id="cantidad" align="center" style="font-size: 12px; width: 1px;">{{$item2->cantidad}}</td>
                  <?php  if(empty($item2->nombre_original)|| is_null($item2->nombre_original)){?>     
                  <td colspan="4" id="producto" align="left" style="font-size: 12px width: 79px;">{{$item2->descripcion}}</td>
                  <?php }else{?>
                  <td colspan="4" id="producto" align="left" style="font-size: 12px; width: 79px;">{{$item2->nombre_original}}</td>
                  <?php } ?>
                  <td style="width: 10px; font-size: 12px;">{!!number_format($item2->precio, 0, ',', '.')!!}</td>
                  <?php $subimporte= $item2->cantidad * $item2->precio;
                  $timporte+=$subimporte;?>
                  <td id="importe" style="font-size: 12px; width: 10px;" align="center">{!!number_format($subimporte, 0, ',', '.')!!}</td>
                @endforeach 
                </tr>
                @for ($i = $l; $i < 9; $i++)
                <tr>
                  <td id="cantidad" align="center" style="color: gray; width: 1px;">_</td>
                  <td   colspan="4" id="producto" align="left" style="color: gray; width: 79px;">_</td>
                    <td style="width: 10px; color: gray;">_</td>
                    <td style="width: 10px; color: gray;" align="center">_</td>
                  
                  </tr>
               @endfor
                  <tr>
                    <td align="left" style="width: 1px;" ></td>
                    <td colspan="4" style="width:79px;"></td>
                    <td style="width: 10px;"></td>
                    <td align="center" style="font-size: 12px; width: 10px; "></td>
                  </tr>
              @endforeach 
                  <tr>
                    <td align="center"  colspan="5" style="font-size: 12px;"> {!!ucwords(strtolower(NumeroALetras::convertir($timporte)))!!}</td>
                    <td style="width: 10px;"></td>
                    <td align="center"  style="font-size: 12px;">{!!number_format($timporte, 0, ',', '.')!!} <br><br>{!!number_format($timporte, 0, ',', '.')!!}</td>
                  </tr>
                  <tr>
                    <td  align="left" >&nbsp;.</td>
                    <td align="center" colspan="4" style="width: 10px;font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!!number_format($timporte/11, 0, ',', '.')!!}</td>
                    <td align="right" style="font-size: 12px;">{!!number_format($timporte/11, 0, ',', '.')!!}</td>
                    <td  align="center" style="font-size: 12px;">&nbsp; </td>
                  </tr>
                  <tr><td></td><td></td><td> </td><td></td></tr>
                  <tr>
                     <td align="center"  colspan="5" style="font-size: 12px;"> {!!ucwords(strtolower(NumeroALetras::convertir($timporte)))!!}</td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td align="center" colspan="4" ></td>
                    <td> </td><td align="center"  style="font-size: 12px;">{!!number_format($timporte, 0, ',', '.')!!} </td>
                  </tr>
  
              </table>

</body>
</html>