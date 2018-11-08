@extends ('Delivery.documentacion.layout.layout')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-home')
@section('titulo', 'Inicio')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_edit', '')
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
<div class="row">
	<div class=" col-12">
		<div class="accordion col-12" id="accordionExample">
			{{--  --}}
			<div class="card">
				<div class="card-header" id="headingOne">
					<h5 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseCargos" aria-expanded="true" aria-controls="collapseOne">
							Ingresar
						</button>
					</h5>
				</div>
				<div id="collapseCargos" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						Iniciar Sesion<br>
						Nombre de Endpoint: Ingresar<br>
						Ruta:/api/delivery/ingresar<br>
						Método => "POST"<br>
						Parámetros => array(<br>
						"email" => "varchar(100) / requerido / único",<br>
						"password" => "varchar(20) / requerido",),<br>
						"Éxito" => "token, idusuario, idempleado, nombre",<br>
						"Falla" => array(<br>
						"error" => array("Error en validación de datos", "Usuario o password incorrectos","Usuario no autorizado")<br>
						)
					</div>
				</div>
			</div>
			{{--  --}}
			<div class="card">
				<div class="card-header" id="headingTwo">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseCategorias" aria-expanded="false" aria-controls="collapseTwo">
							Iniciar Jornada
						</button>
					</h5>
				</div>
				<div id="collapseCategorias" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
					<div class="card-body">
						Iniciar Jornada<br>
						Nombre de Endpoint: Iniciar Jornada<br>
						Ruta:/api/delivery/iniciarjornada<br>
						Método => "POST"<br>
						Parámetros => array(<br>
						"idempleado" => integer / requerido / único",<br>
						"Éxito" => "id_empleado",<br>
						"Falla" => array(<br>
						"error" => array("Error en validación de datos")<br>
						)
					</div>
				</div>
			</div>
			{{--  --}}
			<div class="card">
				<div class="card-header" id="headingThree">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSubcategorias" aria-expanded="false" aria-controls="collapseThree">
							Home
						</button>
					</h5>
				</div>
				<div id="collapseSubcategorias" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					<div class="card-body">
						Home<br>
						Nombre de Endpoint: home<br>
						Ruta:/api/delivery/home<br>
						Método => "GET"<br>
						Parámetros => array(<br>
						"idempleado" => integer / requerido / único",<br>
						"Éxito" => "id_venta,id_empleado,telefono,horario,id_estado,estado","total_asignado","total_entregado", "total_pendiente", "total_cancelado"<br>
						"Falla" => array(<br>
						"error" => array("Error en validación de datos")<br>
						)
					</div>
				</div>
			</div>
			{{--  --}}
			<div class="card">
				<div class="card-header" id="headingThree">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEstados" aria-expanded="false" aria-controls="collapseThree">
							Detalle
						</button>
					</h5>
				</div>
				<div id="collapseEstados" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					<div class="card-body">
						Detalle de Pedido<br>
						Nombre de Endpoint: Detalle<br>
						Ruta:/api/delivery/detalle<br>
						Método => "GET"<br>
						Parámetros => array(<br>
						"idventa" => integer / requerido / único",<br>
						"Éxito" => "{id_venta,telefono,direccion,vendedor,observaciones}",detallev:"{codigo_producto,descripcion,cantidad,precio,importe}",<br>
						"Falla" => array(<br>
						"error" => array("Error en validación de datos")<br>
						)
					</div>
				</div>
			</div>
			{{--  --}}
			<div class="card">
				<div class="card-header" id="headingThree">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFuentes" aria-expanded="false" aria-controls="collapseThree">
							Entrega
						</button>
					</h5>
				</div>
				<div id="collapseFuentes" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					<div class="card-body">
						Entrega<br>
						Nombre de Endpoint: Entrega<br>
						Ruta:/api/delivery/entrega<br>
						Método => "POST"<br>
						Parámetros => array(<br>
						"idventa" => integer / requerido / único",<br>
						"Éxito" => "Pedido Entregado",<br>
						"Falla" => array(<br>
						"error" => array("Error en validación de datos")<br>
						)
					</div>
				</div>
			</div>
			{{--  --}}
			<div class="card">
				<div class="card-header" id="headingThree">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsePaises" aria-expanded="false" aria-controls="collapseThree">
							Observaciones
						</button>
					</h5>
				</div>
				<div id="collapsePaises" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					<div class="card-body">
						Observaciones de la Venta<br>
						Nombre de Endpoint: Observaciones<br>
						Ruta:/api/delivery/observaciones<br>
						Método => "POST"<br>
						Parámetros => array(<br>
						"idventa" => integer / requerido / único",<br>
						"idempleado" => integer / requerido / único",<br>
						"observaciones" => text / requerido / único",<br>
						"Status" => "Éxito",<br>
						"Falla" => array(<br>
						"error" => array("Error en validación de datos")<br>
						)
					</div>

				</div>
			</div>
			{{--  --}}
			<div class="card">
				<div class="card-header" id="headingThree">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEntrega" aria-expanded="false" aria-controls="collapseThree">
							Pedido No Entregado
						</button>
					</h5>
				</div>
				<div id="collapseEntrega" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					<div class="card-body">
						Pedido y/o Venta no Entregado<br>
						Nombre de Endpoint: No Entregado<br>
						Ruta:/api/delivery/noentregado<br>
						Método => "POST"<br>
						Parámetros => array(<br>
						"idventa" => integer / requerido / único",<br>
						"Status" => "Éxito",<br>
						"Falla" => array(<br>
						"error" => array("Error en validación de datos")<br>
						)
					</div>

				</div>
			</div>

			<div class="card">
				<div class="card-header" id="headingThree">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseCerrar" aria-expanded="false" aria-controls="collapseThree">
							Cancelar Pedido
						</button>
					</h5>
				</div>
				<div id="collapseCerrar" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					<div class="card-body">
						Cancelar Pedido<br>
						Nombre de Endpoint: Cancelar Pedido<br>
						Ruta:/api/delivery/cancelar<br>
						Método => "POST"<br>
						Parámetros => array(<br>
						"idventa" => integer / requerido / único",<br>
						"informe" => text / requerido / único",<br>
						"Status" => "Éxito","Mensaje"=>"Pedido Cancelado"<br>
						"Falla" => array(<br>
						"error" => array("Error en validación de datos")<br>
						)
					</div>

				</div>
			</div>


		</div>




			<div class="card">
				<div class="card-header" id="headingThree">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseCerrar" aria-expanded="false" aria-controls="collapseThree">
							Cerrar Jornada
						</button>
					</h5>
				</div>
				<div id="collapseCerrar" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					<div class="card-body">
						Finalizar la Jornada<br>
						Nombre de Endpoint: Cerrar Jornada<br>
						Ruta:/api/delivery/cerrarjornada<br>
						Método => "POST"<br>
						Parámetros => array(<br>
						"idventa" => integer / requerido / único",<br>
						"Status" => "Éxito",<br>
						"Falla" => array(<br>
						"error" => array("Error en validación de datos")<br>
						)
					</div>

				</div>
			</div>


		</div>
	</div>
</div>
@endsection

@push('scripts')


@endpush
