@extends ('delivery.documentacion.layout.layout')
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
							"Éxito" => "token, idusuario, idempleado",<br>
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
							"Éxito" => "id_venta,id_empleado,telefono,horario,id_estado,estado",<br>
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
							Pedidos Asignados
						</button>
					</h5>
				</div>
				<div id="collapseSubcategorias" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					<div class="card-body">
						Pedidos Asignados<br>
						Nombre de Endpoint: Pedidos<br>
						Ruta:/api/delivery/pedidos<br>
						Método => "GET"<br>
						Parámetros => array(<br>
							"idempleado" => integer / requerido / único",<br>
							"Éxito" => "id_venta,id_empleado,telefono,horario,id_estado,estado",<br>
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
							"Éxito" => "id_venta,telefono,direccion,vendedor,producto,cantidad,precio",<br>
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
						Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
						Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					</div>
				</div>
			</div>
			{{--  --}}
		</div>
	</div>
</div>
@endsection

@push('scripts')


@endpush
