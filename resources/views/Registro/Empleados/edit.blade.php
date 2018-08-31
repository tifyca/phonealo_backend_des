@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Editar Empleado')
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
        		<div class="col-12">
	          <div class="row">
	            
	              <div class="form-group col-md-4">
	                <label for="nombre_empleado">Nombres</label>
	                <input class="form-control read" type="text" id="nombre_empleado" name="nombre_empleado" placeholder="..." readonly>
	              </div>
	              <div class="form-group col-md-4">
	                <label for="ruc_empleado">CI</label>
	                <input class="form-control read" type="text" id="ruc_empleado" name="ruc_empleado" placeholder="..." readonly>
	              </div>
	              <div class="form-group col-md-4">
	                <label for="telefono_empleado">Teléfono</label>
	                <input class="form-control read" type="text" id="telefono_empleado" name="telefono_empleado" placeholder="..." readonly>
	              </div>
	              <div class="form-group col-md-4">
	                <label for="email_empleado">Email</label>
	                <input class="form-control read" type="text" id="email_empleado" name="email_empleado" placeholder="..." readonly>
	              </div>
	              <div class="form-group col-md-4">
	                <label for="direccion_empleado">Dirección</label>
	                <input class="form-control read" type="text" id="direccion_empleado" name="direccion_empleado" placeholder="..." readonly>
	              </div>
	              <div class="form-group col-md-4">
			              <label for="cargo_empleado">Cargo</label>
			              <select class="form-control" id="cargo_empleado" name="cargo_empleado">
			                <option value="">Seleccione</option>
			                <option>1</option>
			                <option>2</option>
			                <option>3</option>
			                <option>4</option>
			                <option>5</option>
			              </select>
			            </div>
	            	<div class="form-group col-12">
	                	<label for="referencia_empleado">Referencias</label>
	                	<textarea class="form-control read" disabled id="referencia_empleado" name="referencia_empleado" rows="3"></textarea>
	              	</div>

	              	<div class="tile-footer col-12 d-flex align-items-center">
	                   <div class="form-check mr-3">
	                    <label class="form-check-label">
	                      <input class="form-check-input" id="editar" type="checkbox">Editar
	                    </label>
	                  </div>
	                  <div class="">
	                    <button class="btn btn-primary read" type="submit" disabled>Guardar</button>
	                  </div>
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
<script type="text/javascript" charset="utf-8" async defer>
  $('#editar').change(function(){
    if ($('#editar').prop('checked')){

      $('.read').prop('readonly', false);
      $('.read').prop('disabled', false);

    }
    else{
      $('.read').prop('readonly', true);
      $('.read').prop('disabled', true);
    }
  });
</script>

@endpush