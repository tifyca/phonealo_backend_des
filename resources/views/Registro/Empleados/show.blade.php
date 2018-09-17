<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Nuevo Empleado')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/empleados'))
@section('display_new','d-none') 	@section('link_edit', '') 
@section('display_edit', 'd-none')		@section('link_new', '')
@section('display_trash','d-none')		@section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <div class="tile-body">
        	<form>
        		<input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
          <input type="hidden" id="id_estado" name="id_estado" value="1">
              {{ csrf_field() }} 
        		<div class="col-12">
	          		<div class="row">
						<div class="form-group col-md-4">
							<label for="nombre_empleado">Nombres</label>
							<input class="form-control" type="text" id="nombre_empleado" name="nombre_empleado" placeholder="..." onkeypress="return soloLetras(event);" maxlength="50">
						</div>
						<div class="form-group col-md-4">
							<label for="ci_empleado">CI</label>
							<input class="form-control" type="text" id="ci_empleado" name="ci_empleado" maxlength="15" placeholder="..." onkeypress="return soloNumeros(event);" maxlength="15">
						</div>
						<div class="form-group col-md-4">
							<label for="telefono_empleado">Teléfono</label>
							<input class="form-control" type="text" id="telefono_empleado" name="telefono_empleado" placeholder="..." onkeypress="return soloNumeros(event);" maxlength="13">
						</div>
						<div class="form-group col-md-4">
							<label for="email_empleado">Email</label>
							<input class="form-control" type="email" id="email_empleado" name="email_empleado" placeholder="...">
						</div>
						<div class="form-group col-md-4">
							<label for="direccion_empleado">Dirección</label>
							<input class="form-control" type="text" id="direccion_empleado" name="direccion_empleado" placeholder="...">
						</div>
						<div class="form-group col-md-4">
			              <label for="cargo_empleado">Cargo</label>
			              <select class="form-control cargos" id="cargo_empleado" name="cargo_empleado">
			                <option value="">Seleccione</option>
			                
			              </select>
			            </div>
		            	<div class="form-group col-md-12">
		                	<label for="referencia_empleado">Referencias</label>
		                	<textarea class="form-control" id="referencia_empleado" name="referencia_empleado" rows="3"></textarea>
		              	</div>
		              	<div class="tile-footer col-12">
		                	<button class="btn btn-primary" type="submit" id="btn-save" >Guardar</button>
		              	</div>
	            	</div>
	          	</div>
	        </form>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
 <meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Registro/js_empleados.js')}}"></script>
<script  type="text/javascript" charset="utf-8">
  $(document).ready(function(){
  
      $.ajax({
          type: "get",
          url: '{{ route('cargos_ajax') }}',
          dataType: "json",
          success: function (data){

             $.each(data, function(i, item) {

              $(".cargos").append('<option value='+item.id+'>'+item.cargo+'</option>');
              });
          }

      });

      });
</script>
@endpush