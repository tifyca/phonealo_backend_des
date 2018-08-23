@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Gastos Repartidor')
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
	              <div class="form-group col-12 col-md-4">
	                <label for="monto_gasto_repartidor">Monto</label>
	                <input class="form-control" type="text" id="monto_gasto_repartidor" name="monto_gasto_repartidor" placeholder="...">
	              </div>
	              <div class="form-group col-12  col-md-4">
	                <label for="tipo_gasto_repartidor">Tipo de Gatos</label>
	                <select class="form-control" id="tipo_gasto_repartidor" name="tipo_gasto_repartidor">
	                  <option value="">Seleccione</option>}
	                  <option>1</option>
	                  <option>2</option>
	                  <option>3</option>
	                  <option>4</option>
	                  <option>5</option>
	                </select>
	              </div>
	              <div class="col-12 col-md-4">
	              	<div class="tile-footer border-0">
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