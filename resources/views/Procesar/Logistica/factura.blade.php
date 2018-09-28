
<!DOCTYPE html>
<html lang="en">
  <head>
<title>Factura</title>
  <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('js/conversor.js') }}"></script>
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
        <script type="text/javascript">
    
function sep(cant){
  var c = cant;
  if(c.length<7){
    var b = c.substring(0, c.length-3)+'.'+c.substring(c.length-3, c.length);
  }else if(c.length>6 && c.length<10){
    var b = c.substring(0, c.length-6)+'.'+c.substring(c.length-6, c.length-3)+'.'+c.substring(c.length-3, c.length);
  }else{
    var b = c.substring(0, c.length-9)+'.'+c.substring(c.length-9, c.length-6)+'.'+c.substring(c.length-6, c.length-3)+'.'+c.substring(c.length-3, c.length);
  }
  
  return b;
}
 </script>

     	@foreach($venta as $item)  
       <div id="heather"></div>
 <div class="row">
   <div class="col-12">
<div  class="form-group col-md-8">
<p>
<input type="text" style="padding-left:5px; padding-top: 5px; font-size: 12px;" size="80" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php setlocale(LC_ALL,"es_ES"); echo strftime("%d de %B de %Y");?>">
</p>
<p>
<input type="text" style="padding-left:5px; padding-top: 2px; font-size: 12px;" size="80" id="nom" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->nombres}} ">
</p>
<p>
  <input type="text" style="padding-left:5px; padding-top: 2px; font-size: 12px;" size="80" id="telefono" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->telefono}}">
</p>
<p>
  <input type="text" style="padding-left:5px; padding-top: 5px; font-size: 12px;" size="80" id="dir" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->direccion}}">
</p>
  </div>
  <div  class="form-group col-md-4">
    <p>
    <input type="text" style="padding-top: 5px; font-size: 12px;" size="30" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X">
   </p>
   <p>
    <input type="text" style="padding-top: 5px;" id="ruc" size="30" value="{{$item->ruc_ci}}">
   </p>
    <p>
    <input type="text" style="padding-top: 5px; font-size: 12px;" size="20" id="ruc">
   </p>
 </div> 
</div>
</div>
<div id="registros_table">
  <table class=" table table-hover">
           <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th align="right"></th>
                  <th style="width: 70px;"></th>
                  <th style="width: 70px;" align="left"></th>
                </tr>
              </thead>
              <tbody id="tabla_tareas" >
                <?php $l=0;?>
                @foreach($factura as $item2)  
                <?php  $l= $l+1; ?>
              	<tr >
                  <td></td>
                  <td></td>
                  <td></td>
                  <td style="width: 70px;">  </td>
                  <td style="width: 70px;">  </td>
                  <td style="width: 70px;">  </td>
                </tr>
              	<tr>
                  <td id="codpro" align="left"></td>
                <tr>
                  <td id="cantidad" style="padding-top: 5px; font-size: 12px;">{{$item2->cantidad}}</td>
                  <?php if($item2->nombre_original==""||$item2->nombre_original==NULL){?>     
    				      <td id="producto" align="left" style="padding-top: 5px; font-size: 12px;">{{$item2->descricion}}</td>
                  <?php }else{?>
                  <td id="producto" align="left" style="padding-top: 5px; font-size: 12px;">{{$item2->nombre_original}}</td>
                  <?php } ?>
    				      <td id="precio" style="padding-top: 5px; font-size: 12px;">{{$item2->precio}}</td>
                  <td style="width: 70px; font-size: 12px;"> </td>
                  <td style="width: 70px; font-size: 12px;"> </td>
                  <td id="importe" style="padding-top: 5px; font-size: 12px;" align="left">{{$item2->precio}}</td>
                </tr>
                @endforeach 
                @for ($i = $l; $i < 9; $i++)
                <tr>
                  <td id="cantidad" style="color: gray;">_</td>
                  <td id="producto" align="left" style="color: gray;">_</td>
                    <td id="precio" style="color: gray;">_</td>
                    <td style="width: 70px;"></td>
                    <td style="width: 70px; "></td>
                    <td id="importe" style="width: 70px;  color: gray;" align="left">_</td>
                  </tr>
               @endfor
                  <tr>
                    <td align="left"  colspan="2"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="right" style="font-size: 12px;"> <br><br><br>{{$item->precio}}</td>
                  </tr>
                  <tr>
                    <td align="left"  colspan="5" style="font-size: 12px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!!strtolower(($item->importe))!!}</td>
                   	<td align="right"  style="font-size: 12px;"> <br><br><br>{!!number_format($item->importe, 0, ',', '.')!!}</td>
                  </tr>
                  <tr>
                    <td colspan="1" align="left" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.</td><td align="center" style="font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!!number_format($item->importe/11, 0, ',', '.')!!}</td>
                    <td colspan="4" align="center" style="font-size: 12px;">&nbsp; {!!number_format($item->importe/11, 0, ',', '.')!!}</td>
                  </tr>
                </tbody> 
              </table>
@endforeach 
</div>
<div id="venta"><input id="txtidv" value=""></div>
<div id="divisorio"></div>
  <div id="cabezad" class="row">
  
  
    <!--div id="indi" class="col-md-8"><p>
<input type="text" style="padding-left:5px; padding-top: 5px; font-size: 16px;" size="80" value=" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php setlocale(LC_ALL,"es_ES"); echo strftime("%d de %B de %Y");?>">
</p>
<p><input type="text" style="padding-left:5px; padding-top: 5px; font-size: 16px;" size="80" id="nomd"></p>
<p><input type="text" style="padding-left:5px; padding-top: 5px; font-size: 16px;" size="80" id="telefonod"></p>
<p><input type="text" style="padding-left:5px; padding-top: 5px; font-size: 16px;" size="80" id="dird"></p>
  </div><div id="lado" class="col-md-4"><p>
    <input type="text" style="padding-top: 5px; font-size: 16px;" size="30" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X"></p><p>
    <input type="text" style="padding-top: 5px; font-size: 16px;" id="rucd" size="30" value="(X) CONTADO"></p><p>
    <input type="text" style="padding-top: 5px; font-size: 16px;" size="30" id="rucd"></p>
  </div></div>
<div id="registros_tabled"></div-->
</body>

    

</html>