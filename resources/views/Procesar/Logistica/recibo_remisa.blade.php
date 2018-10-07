<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<center>
		<div class="container" style="width:612px; height:792px;">
			<div class="row">
				<div class="container" style="width:90%;margin:10px auto;">
					<div class="row align-content-center" style="border:1px solid black; border-radius:5px;margin-top:10px;">
						<p class="align-middle" style="margin:0 auto;font-size:16pt;">SALIDA DE MERCADERIA {{$remito->id}}</p>
					</div>
					<div class="row" style="border:1px solid black;border-radius:5px;margin-top:5px;">
						<div class="col-md-4 offset-md-2" style="text-align:center;">
							<p style="font-size:8pt;">ID Repartidor<br />{{$empleado->id}}</p>
						</div>
						<div class="col-md-4" style="text-align:center;">
							<p style="font-size:7pt;">Nombre repartidor<br />{{$empleado->nombres}}</p>
						</div>
					</div>
					<div class="row" style="border:1px solid black;border-radius:5px;margin-top:5px;">
						<table class="table table-sm" style="font-size:7pt;width:98%;padding-bottom:-10px;" align="center">
							<thead>
								<tr>
									<th scope="col" class="text-center">Pedido</th>
									<th scope="col" class="text-center">Producto</th>
									<th scope="col" class="text-center">Cantidad</th>
									<th scope="col" class="text-center">Importe</th>
									<th scope="col" class="text-center">Zona</th>
									<th scope="col" class="text-center">Vendedor</th>
									<th scope="col" class="text-center">Cobrado</th>
									<th scope="col" class="text-center">Devuelto</th>
								</tr>
							</thead>
							<tbody>
								<!--no existe relacion entre entidades REMITOS y VENTAS no se puede realizar la busqueda de los detalles de productos (en el sistema anterior entidad "detalle_remito"-->
								<tr>
									<td class="text-center">36135</td>
									<td class="text-center">Auricular Bluetooth negro/ s163</td>
									<td class="text-center">1</td>
									<td class="text-center">145000</td>
									<td class="text-center">-</td>
									<td class="text-center">celeste.perez</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
								</tr>
								<tr>
									<td class="text-center">36206</td>
									<td class="text-center">Peine Alisador Modelador / B1</td>
									<td class="text-center">2</td>
									<td class="text-center">118000</td>
									<td class="text-center">MRA-san jorge</td>
									<td class="text-center">daysi.r</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
								</tr>
								<tr>
									<td colspan="8">
										<h5>Total: 463,000 Gs.</h5>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="row" style="border:1px solid black; border-radius: 5px;margin-top:5px;">
						<p class="align-middle" style="margin:0 auto;font-size:10pt;">FIRMA DE AUTORIZACIÓN Y RECEPCIÓN POR PARTE DEL REPARTIDOR</p><br /><p class="text-center" style="margin:0 auto;font-size:7pt;">Autorizado por: _________________________ Repartidor: _________________________</p>
					</div>
					<div class="row" style="border:1px solid black; border-radius: 5px;margin-top:5px;padding-bottom:5px;">
						<p class="align-middle" style="margin:0 auto;font-size:10pt;">RENDICIONES</p><br />
						<table style="font-size:7pt;width:98%;" border="1" align="center">
							<thead>
								<tr>
									<th scope="col" class="text-center" width="20%">Rendiciones</th>
									<th scope="col" class="text-center" width="20%">Cobrado</th>
									<th scope="col" class="text-center" width="20%">Devuelto</th>
									<th scope="col" class="text-center" width="20%">TOTAL</th>
									<th scope="col" class="text-center" width="20%">Firma</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">Primera</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
								</tr>
								<tr>
									<td class="text-center">Segunda</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
								</tr>
								<tr>
									<td class="text-center">Tercera</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
								</tr>
								<tr>
									<td class="text-center">Cuarta</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
								</tr>
								<tr>
									<td class="text-center">Totales</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
									<td class="text-center">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</center>
</body>
</html>