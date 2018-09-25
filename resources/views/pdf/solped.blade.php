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
    <td colspan="8">
     <table border="0" width="550"  cellspacing="0" cellpadding="0">
       <tr>
         <td align="left">  
          <img src="{{ asset('img/logo_conexpar.png') }}" width="12%"><br>
        </td>
        <td colspan="2" align="center">
          <font size="16px"><strong>Solicitud de Pedido Nro:{{ $solped->nro_documento}} </strong></font>
        </td>    
        <td colspan="5"><font size="11px"><b>Fecha de Emision: {{date("d-m-y")}}</b></font>
        </td>
      </tr>
    </table>
  </td>
</tr>   

<br>
</table>
<table  border="0" width="550"  cellspacing="0" cellpadding="0">
 <tr>
  <td colspan="8" align="left">
    <font size="14px"><strong>Datos del Proveedor </strong></font>
  </td>
</tr>    
<tr>
  <td colspan="2" align="left"><font size="14px"><b>Nombres y/o Descripción</b></font></td>
  <td colspan="6" align="left"><font size="14px" >
   @foreach($proveedores as $proveedor)
   @if($proveedor->id == $solped->id_proveedor)
   {{$solped->id_proveedor}} {{$proveedor->nombres}}</font>
   @endif
   @endforeach           
 </b></font>
</td>
</tr>
</table>
<br><br>
<table border="0" width="550"  cellspacing="0" cellpadding="0">   

 <tr> 
   <td colspan="8">
    <table border="0" width="550"  cellspacing="0" cellpadding="0" >
     <tr>
      <td bgcolor="#cccccc" width="30"> <font size="12px"><b>Codigo</b></font></td>
      <td bgcolor="#cccccc" width="30"> <font size="12px"><b>Descripción</b></font></td>
      <td bgcolor="#cccccc" width="30" align="center"> <font size="12px"><b>Precio</b></font></td>
      <td bgcolor="#cccccc" width="30" align="center"> <font size="12px"><b>Cantidad</b></font></td>
      <td bgcolor="#cccccc" width="30" align="center"> <font size="12px"><b>Importe</b></font></td>
    </tr>
    <?php 
    $i=0;
    $totalm = 0;
    $total_beneficio = 0;
    $total_categoria = 0;
    ?>

    @foreach($detallesolped as $detalle) 

    <tr>  
     <td width="30"> <font size="12px">{{$detalle->codigo}}</font></td>
     <td width="30"> <font size="12px"></font>{{$detalle->desprod}}</td>
     <td width="30" align="right"> 
      <font size="12px">
        <?php echo number_format($detalle->precio_confirmado,2);?>
      </font>
    </td>
    <td width="100" align="center"> <font size="12px">{{$detalle->cantidad_confirmada}}</font></td>
    <?php $monto = $detalle->precio_confirmado * $detalle->cantidad_confirmada; ?>
    <td width="30" align="right"> <font size="12px"><?php echo number_format($monto,2);?></font></td>
  </tr>
  <?php 
  $i++;
  $totalm = $totalm + ($detalle->precio_confirmado*$detalle->cantidad_confirmada);
  ?>

  @endforeach 
  <tr>
    <td colspan="3" bgcolor="#cccccc" width="30"> <font size="14px"><b>Total</b></font></td>
    <td colspan="2" bgcolor="#cccccc" width="30" align="right"> <font size="14px"><b><?php echo number_format($totalm,2);?></b></font></td>
  </tr>
  
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