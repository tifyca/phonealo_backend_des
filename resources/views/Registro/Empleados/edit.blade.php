<?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

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
        		<input type="hidden" name="empleado_id" id="empleado_id" value="{{$empleado->id}}">
           <input type="hidden" id="id_usuario" name="id_usuario" value="{{$id_usuario}}">
        		<div class="col-12">
	          <div class="row">
	            
	              <div class="form-group col-md-4">
	                <label for="nombre_empleado">Nombres</label>
	                <input class="form-control read" type="text" id="nombre_empleado" name="nombre_empleado" placeholder="..."   value="{{$empleado->nombres}}" onkeypress="return soloLetras(event);" readonly>
	              </div>
	              <div class="form-group col-md-4">
	                <label for="ci_empleado">CI</label>
	                <input class="form-control read" type="text" id="ci_empleado" name="ci_empleado" placeholder="..."  value="{{$empleado->ci}}" onkeypress="return soloNumeros(event);" readonly>
	              </div>
	              <div class="form-group col-md-4">
	                <label for="telefono_empleado">Teléfono</label>
	                <input class="form-control read" type="text" id="telefono_empleado" name="telefono_empleado" placeholder="..." value="{{$empleado->telefono}}" onkeypress="return soloNumeros(event);" readonly>
	              </div>
	              <div class="form-group col-md-4">
	                <label for="email_empleado">Email</label>
	                <input class="form-control read" type="text" id="email_empleado" name="email_empleado" placeholder="..." value="{{$empleado->email}}" readonly>
	              </div>
	              <div class="form-group col-md-4">
	                <label for="direccion_empleado">Dirección</label>
	                <input class="form-control read" type="text" id="direccion_empleado" name="direccion_empleado" placeholder="..." value="{{$empleado->direccion}}" readonly>
	              </div>
	              <div class="form-group col-md-4">
			              <label for="cargo_empleado">Cargo</label>
			              <select class="form-control cargos read" id="cargo_empleado" name="cargo_empleado" disabled>
			                <option value="{{$empleado->id_cargo}}">{{$empleado->cargo}}</option>
			              </select>
			            </div>
	            	<div class="form-group col-12">
	                	<label for="referencia_empleado">Referencias</label>
	                	<textarea class="form-control read" disabled id="referencia_empleado" name="referencia_empleado" rows="3">{{$empleado->ci}}</textarea>
	              	</div>

	              	<div class="tile-footer col-12 d-flex align-items-center">
	                   <div class="form-check mr-3">
	                    <label class="form-check-label">
	                      <input class="form-check-input" id="editar" type="checkbox">Editar
	                    </label>
	                  </div>
	                  <div class="">
	                    <button class="btn btn-primary read" type="submit" id="btn-edit" disabled>Guardar</button>
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
 <meta name="_token" content="{!! csrf_token() !!}" />
 <script src="{{asset('js/Registro/js_empleados.js')}}"></script>
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