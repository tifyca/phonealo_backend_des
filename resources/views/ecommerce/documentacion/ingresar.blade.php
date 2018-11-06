@extends ('ecommerce.documentacion.layout.layout')
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
							Registrar
						</button>
					</h5>
				</div>
				<div id="collapseCargos" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						Registrar Usuario<br>
						Nombre de Endpoint: Registrar<br>
						Ruta:/api/ecommerce/registrar<br>
						Método => "POST"<br>
						Parámetros => array(<br>
							"email" => "varchar(100) / requerido / único",<br>
							"clave" => "varchar(20) / requerido",),<br>
							"nombres" => "varchar(200) / requerido",),<br>
							"ruc" => "varchar(20) / requerido",),<br>
							"telefono" => "varchar(20) / requerido",),<br>
							"Éxito" => "token, idusuario, nombres",<br>
							"Falla" => array(<br>
							"error" => array("Error en validación de datos")<br>
						)
					</div>
				</div>
			</div>
			{{--  --}}
			

			<div class="card">
				<div class="card-header" id="headingOne">
					<h5 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapsePIN" aria-expanded="true" aria-controls="collapseOne">
							Validar PIN
						</button>
					</h5>
				</div>
				<div id="collapsePIN" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						Validar PIN<br>
						Nombre de Endpoint: Validar<br>
						Ruta:/api/ecommerce/validar<br>
						Método => "GET"<br>
						Parámetros => array(<br>
							"email" => "varchar(100) / requerido / único",<br>
							"pin" => "varchar(4) / requerido",),<br>
							"Éxito" => "token, idusuario",<br>
							"Falla" => array(<br>
							"error" => array("Error en validación de datos","PIN Incorrecto")<br>
						)
					</div>
				</div>
			</div>
			{{--  --}}
			



			<div class="card">
				<div class="card-header" id="headingOne">
					<h5 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseINGRESO" aria-expanded="true" aria-controls="collapseOne">
							Ingresar
						</button>
					</h5>
				</div>
				<div id="collapseINGRESO" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						Iniciar Sesion<br>
						Nombre de Endpoint: Ingresar<br>
						Ruta:/api/ecommerce/ingresar<br>
						Método => "POST"<br>
						Parámetros => array(<br>
							"email" => "varchar(100) / requerido / único",<br>
							"password" => "varchar(20) / requerido",),<br>
							"Éxito" => "token, idusuario, idempleado, nombres, productos",<br>
							"Falla" => array(<br>
							"error" => array("Error en validación de datos", "Usuario o password incorrectos","Usuario no autorizado")<br>
						)
					</div>
				</div>
			</div>
			{{--  --}}
			</div>
			{{--  --}}
		</div>
	</div>
</div>
@endsection

@push('scripts')


@endpush
