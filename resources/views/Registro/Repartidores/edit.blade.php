@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Editar Repartidores')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/repartidores'))
@section('display_new','d-none') 	@section('link_edit', '') 
@section('display_edit', 'd-none')		@section('link_new', '')
@section('display_trash','d-none')		@section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <div class="tile-body">
        	<form>
	          <div class="row">
	            <div class="col-12 col-md-6">
	              <div class="form-group">
	                <label for="nombre_repartidor">Nombres</label>
	                <input class="form-control read" type="text" id="nombre_repartidor" name="nombre_repartidor" placeholder="..." readonly>
	              </div>
	              <div class="form-group">
	                <label for="direccion_repartidor">Dirección</label>
	                <input class="form-control read" type="text" id="direccion_repartidor" name="direccion_repartidor" placeholder="..." readonly>
	              </div>
	            </div>
	            <div class="col-12 col-md-6">
	              <div class="form-group">
	                <label for="telefono_repartidor">Teléfono</label>
	                <input class="form-control read" type="text" id="telefono_repartidor" name="telefono_repartidor" placeholder="..." readonly>
	              </div>
	              <div class="form-group">
	                <label for="ruc_repartidor">RUC</label>
	                <input class="form-control read" type="text" id="ruc_repartidor" name="ruc_repartidor" placeholder="..." readonly>
	              </div>
	            </div>
	            <div class="col-12">
	            	<div class="form-group">
	                	<label for="referencia_repartidor">Referencias</label>
	                	<textarea class="form-control read" disabled id="referencia_repartidor" name="referencia_repartidor" rows="3"></textarea>
	              	</div>
	              	<div class="tile-footer d-flex align-items-center">
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