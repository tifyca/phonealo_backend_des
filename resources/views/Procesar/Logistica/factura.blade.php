<!DOCTYPE html>
<html lang="es">
  <head>
<title>Factura</title>
  <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   
    

</head>


<body >

      @foreach($venta as $item)  
      <br><br><br><br><br>
      <table class=" table table-hover" width="100%">
<tr>
  <td style="font-size: 12px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $date }}</td>
  <td></td>
</tr>
<tr>
 <td  style=" font-size: 12px;" id="nom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->nombres}}</td>
<td  style="font-size: 12px;"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X
</tr>
<tr>
  <td  style=" font-size: 12px;"  id="telefono">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->telefono}}</td>
  <td type="text" style="font-size: 12px;" id="ruc" size="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->ruc_ci}}
   </td>
</tr>
<tr>
  <td style="font-size: 12px;"  id="dir">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->direccion}}</td>
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
                  <?php if(empty($item2->nombre_original)|| is_null($item2->nombre_original)){?>     
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
                    <td align="center"  colspan="5" style="font-size: 12px;"> {!!ucwords(strtolower(NumeroALetras::convertir($timporte)))!!}</td>
                    <td style="width: 10px;"></td>
                    <td align="center"  style="font-size: 12px;">{{$timporte}} <br><br>{{$timporte}}</td>
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
  <td style="font-size: 12px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $date }}  </td>
  <td></td>
</tr>
<tr>
 <td  style=" font-size: 12px;" id="nom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->nombres}}</td>
<td  style="font-size: 12px;"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X
</tr>
<tr>
  <td  style=" font-size: 12px;"  id="telefono">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->telefono}}</td>
  <td type="text" style="font-size: 12px;" id="ruc" size="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->ruc_ci}}
   </td>
</tr>
<tr>
  <td style="font-size: 12px;"  id="dir">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->direccion}}</td>
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
                  <?php  if(empty($item2->nombre_original)|| is_null($item2->nombre_original)){?>     
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
                    <td align="center"  colspan="5" style="font-size: 12px;"> {!!ucwords(strtolower(NumeroALetras::convertir($timporte)))!!}</td>
                    <td style="width: 10px;"></td>
                    <td align="center"  style="font-size: 12px;">{{$timporte}} <br><br>{{$timporte}}</td>
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