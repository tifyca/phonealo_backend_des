@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Monitoreo de Remitos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<?php $pos=1;   //dd($remitos);?>
<div class="row">
	@foreach($repartidores as $repartidor)
	<div class="col-lg-6 col-md-12">
		<div class="card">
			<div class="card-header card-header-warning">
				<h4 class="card-title">Repartidor: {{$repartidor->nombres}}</h4>
				<p class="card-category">Horario de Entrada</p>
				<p class="card-category">Promedio</p><a class="card-link" href="#">Informe</a><a class="card-link" href="#">Ver Recorrido</a>
			</div>
			@php
			$data=[];
			foreach($gremitos as $gremito)
			{
				if($gremito->id_delivery==$repartidor->id_delivery)
				{
					$data[]=[
						'id_remito' => $gremito->id_remito,
						'importe' => $gremito->importe

					];
				}	
			} 
			$ventas=[];
			foreach($remitos as $remito)
			{
				if($remito->id_delivery==$repartidor->id_delivery)
				{
					$ventas[]=[
						'id_venta' => $remito->id_venta,
						'id_remito' => $remito->id_remito,
						'id_estado' => $remito->id_estado

					];
				}	
			} 	
					//dd($remitos);
			@endphp
			<div class="card-body table-responsive">
				<table class="table table-hover">

					@foreach($data as $data)
					<thead class="text-warning">
						<tr>
							<th>Remito</th>	
							<th colspan="4">{{ $data["id_remito"] }}</th>
						</tr>
						<tr>
							<th>Pedido</th>
							<th>Situacion</th>
							<th>Horario </th>
							<th>Importe</th>
							<th>Chat</th>
						</tr>
					</thead>
					<tbody>
					  @foreach($ventas as $venta)
						@if($data["id_remito"]==$venta["id_remito"])
						<tr>
							<td>{{ $venta["id_venta"] }}</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					    @endif	
					</tbody>
					@endforeach	
				@endforeach	
				</table>
			</div>
		</div>
	</div>
	@endforeach


</div>






@endsection