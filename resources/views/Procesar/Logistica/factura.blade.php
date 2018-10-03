
<!DOCTYPE html>
<html lang="en">
  <head>
<title>Factura</title>
  <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   
     <style type="text/css" media="all">
     input, input:hover, input:focus, input:active {
      background: transparent;
      outline: none;
      border: 0;
      border-style: none;
      border-color: transparent;
      outline-offset: 0;
      box-shadow: none;
      font-size: 14px;
      }
      body{
        margin-left: 5px;
        font-weight: bold;
      }
      @media print{
        @page {
    size: 210mm 297mm; /* portrait */
    /* you can also specify margins here: */
    margin: 8mm;
    margin-bottom: 0mm;
  }
        #heather{
        width:1100px;
        height:155px;
        vertical-align: center;
      }
      #cabeza{
        border: 0;
        width:1030px;
        height:180px;
        float: left;
        margin-left: 50px;
        font-weight: bold;
        font-size: 16px;
      }
      #indi{
        float: left;
        font-weight: bold;
        font-size: 16px;
      }
      #indid{
        float: left;
        font-weight: bold;
        font-size: 16px;
      }
      #cabeza, #lado{
        display: inline-block;  
      }
      #registros_table{
        padding-top: 5px;
        float: left;
        font-family: "Arial", sans-serif;
        font-size: 16px;
        width:950px;
        height: 565px;
        padding-left: 50px;
      }
      #cantidad{
        width: 40px;
        text-align: left;
      }
      #producto{
        width: 600px;
      }
      #precio{
        width: 150px;
        text-align: left;
      }
      #importe{
        float: right;
      }
      #venta{
        display: none;
      }
      #divisorio{
        width: 1100px;
        height: 835px;
      }
      #cabezad{
        border: 0;
        width:1030px;
        height:180px;
        float: left;
        font-size: 16px;
        margin-left: 50px;
        font-weight: bold;
      }
      #ladod{
        text-align: left;
        width:100px;
        height:155px;
        float: left;
        font-weight: bold;
      }
      #cabezad, #ladod{
        display: inline-block;     
      }
      #registros_tabled{
        padding-top: 5px;
        float: left;
        font-family: "Arial", sans-serif;
        font-size: 16px;
        width:950px;
        height: 565px;
        padding-left: 55px;
      }
      }
      
      </style>

</head>

<body align="center">


      @foreach($venta as $item)  
      <br><br><br><br><br>
  <table class=" table table-hover" width="100%">
<tr>
  <td style="padding-left:5px; padding-top: 5px; font-size: 12px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php setlocale(LC_ALL,"es_ES"); echo strftime("%d de %B de %Y");?></td>
  <td></td>
</tr>
<tr>
 <td  style="padding-left:5px; padding-top: 2px; font-size: 12px;" id="nom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->nombres}}</td>
<td  style="padding-left:5px; padding-top: 2px; font-size: 12px;"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X
</tr>
<tr>
  <td  style="padding-left:5px; padding-top: 2px; font-size: 12px;"  id="telefono">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->telefono}}</td>
  <td type="text" style="padding-top: 5px; font-size: 12px;" id="ruc" size="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->ruc_ci}}
   </td>
</tr>
<tr>
  <td style="padding-left:5px; padding-top: 5px; font-size: 12px;"  id="dir">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->direccion}}</td>
  <td></td>
</tr>
  </table>
  <br>
  <table class=" table table-hover"   width="100%">
           
        
                <?php $l=0; $timporte=0; $subimporte=0; ?>
                @foreach($factura as $item2)  
                <?php  $l= $l+1; ?>
              
                <tr>
                  <td id="cantidad" align="center" style="font-size: 12px; width: 1px;">{{$item2->cantidad}}</td>
                  <?php if($item2->nombre_original==""||$item2->nombre_original==NULL){?>     
                  <td colspan="4" id="producto" align="left" style="font-size: 12px width: 79px;">{{$item2->descricion}}</td>
                  <?php }else{?>
                  <td colspan="4" id="producto" align="left" style="font-size: 12px; width: 79px;">{{$item2->nombre_original}}</td>
                  <?php } ?>
                  <td style="width: 10px; font-size: 12px;">{{$item2->precio}}</td>
                  <?php $subimporte= $item2->cantidad * $item2->precio;
                  $timporte+=$subimporte;?>
                  <td id="importe" style="font-size: 12px; width: 10px;" align="center">{{$subimporte}}</td>
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
                    <td align="center" style="font-size: 12px; width: 10px; ">{{$item->precio}}</td>
                  </tr>
              @endforeach 
                  <tr>
                    <td align="center"  colspan="5" style="font-size: 12px;"> {!!NumerosEnLetras::convertir($timporte)!!}</td>
                    <td style="width: 10px;"></td>
                    <td align="center"  style="font-size: 12px;">{{$timporte}} <br><br>{!!number_format($timporte, 0, ',', '.')!!}</td>
                  </tr>
                  <tr>
                    <td  align="left" >&nbsp;.</td>
                    <td align="center" colspan="4" style="width: 10px;font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!!number_format($timporte/11, 0, ',', '.')!!}</td>
                    <td align="right" style="font-size: 12px;">{!!number_format($timporte/11, 0, ',', '.')!!}</td>
                    <td  align="center" style="font-size: 12px;">&nbsp; </td>
                  </tr>
        
              </table>


{{--/////////////////////////////////////////////////////////////////////////////////////--}}


      @foreach($venta as $item)  
      <br><br><br><br><br>
  <table class=" table table-hover" width="100%">
<tr>
  <td style="padding-left:5px; padding-top: 5px; font-size: 12px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php setlocale(LC_ALL,"es_ES"); echo strftime("%d de %B de %Y");?></td>
  <td></td>
</tr>
<tr>
 <td  style="padding-left:5px; padding-top: 2px; font-size: 12px;" id="nom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->nombres}}</td>
<td  style="padding-left:5px; padding-top: 2px; font-size: 12px;"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X
</tr>
<tr>
  <td  style="padding-left:5px; padding-top: 2px; font-size: 12px;"  id="telefono">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->telefono}}</td>
  <td type="text" style="padding-top: 5px; font-size: 12px;" id="ruc" size="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->ruc_ci}}
   </td>
</tr>
<tr>
  <td style="padding-left:5px; padding-top: 5px; font-size: 12px;"  id="dir">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->direccion}}</td>
  <td></td>
</tr>
  </table>
  <br>
  <table class=" table table-hover"   width="100%">
           
        
                <?php $l=0; $timporte=0; $subimporte=0; ?>
                @foreach($factura as $item2)  
                <?php  $l= $l+1; ?>
              
                <tr>
                  <td id="cantidad" align="center" style="font-size: 12px; width: 1px;">{{$item2->cantidad}}</td>
                  <?php if($item2->nombre_original==""||$item2->nombre_original==NULL){?>     
                  <td colspan="4" id="producto" align="left" style="font-size: 12px width: 79px;">{{$item2->descricion}}</td>
                  <?php }else{?>
                  <td colspan="4" id="producto" align="left" style="font-size: 12px; width: 79px;">{{$item2->nombre_original}}</td>
                  <?php } ?>
                  <td style="width: 10px; font-size: 12px;">{{$item2->precio}}</td>
                  <?php $subimporte= $item2->cantidad * $item2->precio;
                  $timporte+=$subimporte;?>
                  <td id="importe" style="font-size: 12px; width: 10px;" align="center">{{$subimporte}}</td>
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
                    <td align="center" style="font-size: 12px; width: 10px; ">{{$item->precio}}</td>
                  </tr>
              @endforeach 
                  <tr>
                    <td align="center"  colspan="5" style="font-size: 12px;"> {!!NumerosEnLetras::convertir($timporte)!!}</td>
                    <td style="width: 10px;"></td>
                    <td align="center"  style="font-size: 12px;">{{$timporte}} <br><br>{!!number_format($timporte, 0, ',', '.')!!}</td>
                  </tr>
                  <tr>
                    <td  align="left" >&nbsp;.</td>
                    <td align="center" colspan="4" style="width: 10px;font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!!number_format($timporte/11, 0, ',', '.')!!}</td>
                    <td align="right" style="font-size: 12px;">{!!number_format($timporte/11, 0, ',', '.')!!}</td>
                    <td  align="center" style="font-size: 12px;">&nbsp; </td>
                  </tr>
        
              </table>

</body>

    

</html>