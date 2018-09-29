<html>
<head>
  <meta charset="utf-8">
  <style type="text/css">

  .container_12 {
    margin-left: 25px;
    margin-right: 25px;

  }

  #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; }
  #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; background-color: lightblue; }
  #footer .page:after { content: counter(page, upper-roman); }

</style>  
<title></title>
</head>
<body>

  <?php 
  $i=1;
  $z=1;
  $gbeneficio="";
  $total_beneficio=0;
  $gcategoria="";
  $total_categoria=0;  
  ?>
  @foreach($solped as $solped)
  
     <table border="0" width="550"  cellspacing="0" cellpadding="0">
       <tr>
         <td colspan="4" align="center">  
          <b>MÓDULO DE PEDIDOS</b>
        </td>
       </tr>
       <tr>
        <td bgcolor="#FFFF00" colspan="4" align="center">  
         <font size="16px"> <b> Proveedor: {{$solped->id_proveedor}} {{$proveedor->nombres}}</b></font>
        </td>
       </tr>
       <tr>
        <td colspan="4" align="center">
          <font size="14px"><strong>Solicitud de Pedido Nro:{{ $solped->nro_documento}} </strong></font>
        </td>    
       <tr>
      
    </table>
<br>
<table border="0" width="550"  cellspacing="0" cellpadding="0">   

 <tr> 
   <td colspan="8">
    <table border="1" width="550"  cellspacing="0" cellpadding="0" >
     <tr  color="#fff" bgcolor="#1a5276">
      <td width="2" align="center"> <font style="color:#FFF;" size="14px"><b>N°</b></font></td>
      <td width="5" align="center"> <font style="color:#FFF;" size="14px"><b>Código Interno</b></font></td>
      <td width="100" align="left"> <font style="color:#FFF;" size="14px"><b>Descripción del Producto +Código Interno del Proveedor</b></font></td>
      <td width="2" align="center"> <font style="color:#FFF;" size="14px"><b>Cantidad Pedido</b></font></td>
    </tr>
    <?php 
    $i=0;
    $pos=1;
    $totalm = 0;
    $total_beneficio = 0;
    $total_categoria = 0;
    ?>

    @foreach($detallesolped as $detalle) 

    <tr>  
     <td width="2" align="center"> <font size="12px">{{$pos}}</font></td> 
     <td width="5" align="center"> <font size="12px">{{$detalle->codigo}}</font></td>

     <td width="100" align="left"> <font size="12px">
      <?php $desc="";?>
       @foreach($productos_proveedor as $prod)
         <?php
         if($prod->id_producto==$detalle->idproducto){
           $desc = $prod->producto;   
         }              
         ?>
       @endforeach   
       <?php 
         if($desc=='') $desc=$detalle->desprod;
         $pos++;
       ?>
       {{$desc}}
       <br>
       </font>
   </td>
     <td width="2" bgcolor="#fdedec" align="center"> <font size="12px">{{$detalle->cantidad}}</font></td>
  </tr>
  <?php 
  $i++;
  $totalm = $totalm + ($detalle->precio_confirmado*$detalle->cantidad_confirmada);
  ?>

  @endforeach 
  
</table>
</td>
</tr> 
<br>
<br>
<tr>
</tr>

</table> 


@endforeach




</body>
</html>