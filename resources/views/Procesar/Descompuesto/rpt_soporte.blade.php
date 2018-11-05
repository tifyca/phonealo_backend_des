<!DOCTYPE html>
<html lang="es">
  <head>
<title>Mercaderia</title>
  <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   
    

</head>

<body>
	<br><br><br><br><br><br>
	@if($opt==1)
    	<table border="0" width="100%">
        <tr>
            <td colspan="2" style="text-align: center; border:1px solid #000;"><h3>REMITO DE PRODUCTOS DESCOMPUESTOS</h3></td>

        </tr>
        <tr> 
            <td colspan="2" style="text-align: center;font-size: 26px;  border:1px solid #000;">N° de Caso:<br>{{$report->id}}</td>
        </tr>
        <tr>
            <td  colspan="2" style="text-align: left; border:1px solid #000;padding: 10px; font-size: 20px;">Fecha: {{$fecha}}</td> 
        </tr>
        <tr  >
            <td align="left" width="30%" style=" border:1px solid #000; padding: 10px; font-size: 20px;" >Nombre del Producto: </td>
            <td style="text-align: left; border:1px solid #000;padding: 10px; font-size: 20px;">{{$report->descripcion}}</td> 
        </tr>
        <tr>
            <td align="left" width="30%" style="border:1px solid #000; text-align: left; padding: 10px; font-size: 20px;">Detalles: </td> 
            <td style="border:1px solid #000;text-align: left; padding: 10px; font-size: 20px;">{{$report->nota}}</td> 
        </tr>
        <tr> 
          <td colspan="2"  align="center" style="text-align:center;  padding: 60px; " >__________________<br> Firma del Receptor</td>
        </tr>
        <tr>
          <td colspan="2"  style="padding: 10px; ">Fecha de Recepción: ____________________________</td>
        </tr>
            
      </table>
	@else
        <table border="0" width="100%">
    <tr>
        <td colspan="3" style="text-align: center; border:1px solid #000;"><h3>REMITO DE PRODUCTOS DESCOMPUESTOS</h3></td>

    </tr>
    <tr>
        <td  colspan="3" style="text-align: left; border:1px solid #000;padding: 10px; font-size: 20px;">Fecha: {{$fecha}}</td> 
    </tr>
    <tr>
        <td align="center" width="15%" style=" border:1px solid #000;  font-size: 20px;" > N° de Caso:</td>
        <td align="center" width="42%" style="border:1px solid #000; font-size: 20px;">Nombre del Producto:</td> 
        <td align="center" width="43%" style="border:1px solid #000;  font-size: 20px;">Detalles: </td> 
    </tr>
  @foreach ($report as $item)                                    
    <tr>
                   
        <td style="text-align: center;font-size: 20px;border:1px solid #000; vertical-align: middle;"> {{$item->id}}</td>
        <td style="text-align: left;font-size: 20px;border:1px solid #000; vertical-align: middle;"> {{$item->descripcion}}</td>
        <td  style="text-align: left;font-size: 20px;border:1px solid #000; vertical-align: middle;">{{ $item->nota}} </td>
      </tr>
  @endforeach
     <tr> 
      <td colspan="3"  align="center" style="text-align:center;  padding: 60px; " >__________________<br> Firma del Receptor</td>
    </tr>
    <tr>
      <td colspan="3"  style="padding: 10px; ">Fecha de Recepción: ____________________________</td>
    </tr>
        
  </table>
  @endif

	

</body>
</html>