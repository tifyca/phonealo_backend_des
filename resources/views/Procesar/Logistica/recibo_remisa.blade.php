<!DOCTYPE html>
<html lang="es">
  <head>
<title>Mercaderia</title>
  <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   
    

</head>

<body>
	<br><br><br><br><br><br>
	<table width="80%" align="center" style="border:1px solid black; border-radius:7px;margin-top:10px;" >
		<tr>
			
				<td style="text-align:center; font-size:13pt;"><b>SALIDA DE MERCADERIA {{$remito[0]->idremito}}</b></td>
			
		</tr>
	</table>
		
	<table  width="80%" align="center"  style="border:1px solid black;border-radius:7px;margin-top:5px;">
		<tr>
			<td style="text-align:center;">
				<p style="font-size:10pt;"><b>Fecha de Emisión</b><br><br />{{$fecha}}</p>
			</td>
			<td style="text-align:center;">
				<p style="font-size:10pt;"><b>ID Repartidor</b><br><br />{{$empleado->id}}</p>
			</td>
		
			<td style="text-align:center;">
				<p style="font-size:10pt;"><b>Nombre repartidor</b><br><br />{{$empleado->nombres}}</p>
			</td>
			 
			<td style="text-align:center;">
				<p style="font-size:10pt;"><b>Hora de Entrega</b><br><br />{{$empleado->horario}}</p>
			</td>
		</tr>
	</table>			
   <table  width="80%" style="font-size:9pt;padding-bottom:-10px; border:1px solid black;border-radius:7px;margin-top:5px;" align="center">
							<thead>
								<tr>
									<th style="text-align:center;">Pedido</th>
									<th style="text-align:center;">Producto</th>
									<th style="text-align:center;">Cantidad</th>
									<th style="text-align:center;">Importe</th>
									<th style="text-align:center;">Zona</th>
									<th style="text-align:center;">Vendedor</th>
									
								</tr>
							</thead>
							<tbody  >
								 <?php  $timporte=0; ?>
										@foreach($remito as $item2) 
								
								<tr>
									<td style="text-align:center;">{{$item2->id_pedido}}</td>
									<?php if(empty($item2->nombre_original)|| is_null($item2->nombre_original)){?>     
					                <td >{{$item2->descripcion}}</td>
					                <?php }else{?>
					                <td >{{$item2->nombre_original}}</td>
					                <?php } ?>   
									
									<td style="text-align:center;">{{$item2->cantidad}}</td>
									<td style="text-align:center;">{{$item2->importe}}</td>
									<td >{{$item2->barrio}}</td>
									<td style="text-align:center;">{{$item2->usuario}}</td>
							        <?php $timporte+=$item2->importe?>
								</tr>
								@endforeach 
							
								<tr>
									<td colspan="8">
										<p style="font-size:10pt;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total:&nbsp;{{ $timporte}} Gs.</b></p>
									</td>
								</tr>
							</tbody>
						</table>
						
					<table width="80%" style="font-size:7pt;padding-bottom:-10px; border:1px solid black;border-radius:7px;margin-top:5px;" align="center">
						<br>
						<td style="text-align:center; font-size:13pt; margin-top:10px;"><b>FIRMA DE AUTORIZACIÓN Y RECEPCIÓN POR PARTE DEL REPARTIDOR</b><br />
						<p style="font-size:9pt;">Autorizado por: _________________________ Repartidor: _________________________</p>
					</td>
					</table>
					
	

</body>
</html>