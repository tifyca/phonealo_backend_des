@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Pagos Repartidor')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/repartidores'))
@section('display_new','d-none') 	@section('link_edit', '') 
@section('display_edit', 'd-none')		@section('link_new', '')
@section('display_trash','d-none')		@section('link_trash')

@section('content')

<div class="row">
   <div class="col-8">
    <div class="tile">
        <div class="tile-body ">
          <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Agregar</th>
                    <th>Horas</th>
                    <th>Fecha</th>
                    <th>Importe</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
					<td>
						<div class="form-group">
			            	<input class="form-control" type="checkbox" id="agrega_pago" name="agrega_pago">
			        	</div>
			        </td>
					<td>8:20:00</td>
					<td>2018-07-16</td>
					<td>66.667</td>
                  </tr>
                  <tr>
					<td>
						<div class="form-group">
			            	<input class="form-control" type="checkbox" id="agrega_pago" name="agrega_pago">
			        	</div>
			        </td>
					<td>8:20:00</td>
					<td>2018-07-16</td>
					<td>66.667</td>
                  </tr>
                  <tr>
					<td>
						<div class="form-group">
			            	<input class="form-control" type="checkbox" id="agrega_pago" name="agrega_pago">
			        	</div>
			        </td>
					<td>8:20:00</td>
					<td>2018-07-16</td>
					<td>66.667</td>
                  </tr>
                  <tr>
					<td>
						<div class="form-group">
			            	<input class="form-control" type="checkbox" id="agrega_pago" name="agrega_pago">
			        	</div>
			        </td>
					<td>8:20:00</td>
					<td>2018-07-16</td>
					<td>66.667</td>
                  </tr>
                  <tr class="table-secondary" >
                  	<th class="text-right" colspan="3">Total</th>
                  	<td>86736.29</td>
                  </tr> 
                </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
  <div class="col-4">
    <div class="tile">
        <div class="tile-body">
        	<div class="monto text-center">
        		<h1>098765 .Gs</h1>
        	</div>
        	<form>
	          <div class="row">
	            <div class="col-12 ">
	              <div class="form-group">
	                <label for="pago_repartidor">Premio</label>
	                <input class="form-control" type="text" id="pago_repartidor" name="pago_repartidor" placeholder="...">
	              </div>
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
  <div class="col-8">
    <div class="tile">
        <div class="tile-body ">
          <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Agregar</th>
                    <th>Fecha Anticipo</th>
                    <th>Importe</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
					<td>
						<div class="form-group">
			            	<input class="form-control" type="checkbox" id="agrega_pago" name="agrega_pago">
			        	</div>
			        </td>
					<td>2018-07-16</td>
					<td>66.667</td>
                  </tr>
                  <tr>
					<td>
						<div class="form-group">
			            	<input class="form-control" type="checkbox" id="agrega_pago" name="agrega_pago">
			        	</div>
			        </td>
					<td>2018-07-16</td>
					<td>66.667</td>
                  </tr>
                  <tr>
					<td>
						<div class="form-group">
			            	<input class="form-control" type="checkbox" id="agrega_pago" name="agrega_pago">
			        	</div>
			        </td>
					<td>2018-07-16</td>
					<td>66.667</td>
                  </tr>
                  <tr>
					<td>
						<div class="form-group">
			            	<input class="form-control" type="checkbox" id="agrega_pago" name="agrega_pago">
			        	</div>
			        </td>
					<td>2018-07-16</td>
					<td>66.667</td>
                  </tr>
                  <tr class="table-secondary" >
                  	<th class="text-right" colspan="2">Total</th>
                  	<td>86736.29</td>
                  </tr> 
                </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')

@endpush