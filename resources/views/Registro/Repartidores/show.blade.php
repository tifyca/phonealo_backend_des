@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Nuevo Repartidor')
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
	                <input class="form-control" type="text" id="nombre_repartidor" name="nombre_repartidor" placeholder="...">
	              </div>
	              <div class="form-group">
	                <label for="direccion_repartidor">Dirección</label>
	                <input class="form-control" type="text" id="direccion_repartidor" name="direccion_repartidor" placeholder="...">
	              </div>
	            </div>
	            <div class="col-12 col-md-6">
	              <div class="form-group">
	                <label for="telefono_repartidor">Teléfono</label>
	                <input class="form-control" type="text" id="telefono_repartidor" name="telefono_repartidor" placeholder="...">
	              </div>
	              <div class="form-group">
	                <label for="ruc_repartidor">RUC</label>
	                <input class="form-control" type="text" id="ruc_repartidor" name="ruc_repartidor" placeholder="...">
	              </div>
	            </div>
	            <div class="col-12">
	            	<div class="form-group">
	                	<label for="referencia_repartidor">Referencias</label>
	                	<textarea class="form-control" id="referencia_repartidor" name="referencia_repartidor" rows="3"></textarea>
	              	</div>
	              	<div class="tile-footer">
	                	<button class="btn btn-primary" type="submit">Guardar</button>
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

@endpush