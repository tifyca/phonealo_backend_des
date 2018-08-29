@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Nueva Venta')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
    	<h3 class="tile-title text-center text-md-left">Detalles del Cliente</h3>
        <div class="tile-body ">
          <form>
          <div class="row">
          	<div class="form-group col-md-4">
              <label for="telefono_cliente">Teléfono</label>
              <input class="form-control" type="text" id="telefono_cliente" name="telefono_cliente" placeholder="...">
            </div>
          	<div class="form-group col-md-4">
              <label for="nombre_cliente">Nombres</label>
              <input class="form-control" type="text" id="nombre_cliente" name="nombre_cliente" placeholder="...">
            </div>
            <div class="form-group col-md-4">
              <label for="email_cliente">Email</label>
              <input class="form-control" id="email_cliente" name="email_cliente" type="email" aria-describedby="emailHelp" placeholder="...">
            </div>
            <div class="form-group col-md-4">
              <label for="ruc_cliente">RUC</label>
              <input class="form-control" type="text" id="ruc_cliente" name="ruc_cliente" placeholder="...">
            </div>
            <div class="form-group col-12 col-md-4">
              <label for="tipo_cliente">Tipo de Cliente</label>
              <select class="form-control" id="tipo_cliente" name="tipo_cliente">
                <option value="">Seleccione</option>
                <option selected value="N">Natural</option>
                <option value="J">Jurídico</option>
              </select>
            </div>
            <div class="form-group col-12 col-md-4">
              <label for="departamento_cliente">Departamento</label>
              <select class="form-control" id="departamento_cliente" name="departamento_cliente">
                <option value="">Seleccione</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="ciudad_cliente">Ciudad</label>
              <select class="form-control" id="ciudad_cliente" name="ciudad_cliente">
                <option value="">Seleccione</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="barrio_cliente">Barrio</label>
              <select class="form-control" id="barrio_cliente" name="barrio_cliente">
                <option value="">Seleccione</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="ubicacion_cliente">Ubicación</label>
              <input class="form-control" type="text" id="ubicacion_cliente" name="ubicacion_cliente" placeholder="...">
            </div>
            <div class="form-group col-md-12">
              <label for="direccion_cliente">Dirección</label>
              <input class="form-control" type="text" id="direccion_cliente" name="direccion_cliente" placeholder="...">
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="col-7">
    <div class="tile">
      <h3 class="tile-title text-center text-md-left">Detalles de la Venta</h3>
        <div class="tile-body ">
          <div class="row">
          	<div class="form-group col-md-4">
              <label for="">Fecha de Venta</label>
              <input class="form-control" type="date" id="" name="" >
            </div>
             <div class="form-group col-md-4">
              <label for="">Fecha de Entrega</label>
              <input class="form-control" type="date" id="" name="" >
            </div>
            <div class="form-group col-md-4">
              <label for="">Horario de Entrega</label>
              <select class="form-control" id="" name="">
                <option value="">Seleccione</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">Cod. Producto</label>
              <input class="form-control" type="text" id="" name="" >
            </div>
            <div class="form-group col-md-9">
              <label for="descripcion">Descripción</label>
              <div class="row col-12 pr-0">
              	<input class="form-control col-md-3 mr-4" type="text" id="descripcion" name="descripcion" >

              	<select class="form-control col" id="" name="">
	                <option value="">Seleccione</option>
	                <option>1</option>
	                <option>2</option>
	                <option>3</option>
	                <option>4</option>
	                <option>5</option>
	              </select>

              </div>
            </div>
            <div class="form-group col-md-2">
              <label for="">Cantidad</label>
              <input class="form-control" type="text" id="" name="" >
            </div>
            <div class="form-group col-md-3">
              <label for="">Precio</label>
              <input class="form-control" type="text" id="" name="" >
            </div>
            <div class="form-group col-md-3">
              <label for="">Stock</label>
              <input class="form-control" type="text" id="" name=""  >
            </div>
            <div class="form-group col-md-4">
              <label for="">Forma de Pago</label>
              <select class="form-control" id="" name="">
                <option value="">Seleccione</option>
                <option>Efectivo</option>
                <option>Giro Tigo</option>
                <option>Tarjeta</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="">Factura</label>
              <select class="form-control" id="" name="">
                <option value="">Seleccione</option>
                <option>No</option>
                <option>Si</option>
                <option>Sin Nombre</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="">Stock Activo</label>
              <input class="form-control" type="text" id="" name="" >
            </div>
            <div class="col-sm-1">
              <a class="btn btn-primary mt-4" href="#"><i class=" fa fa-lg fa-plus"></i>Añadir</a>
            </div>
            <span style="border-top: solid silver 1px" class="my-3 col-12"></span>
            <div class="form-group col-md-6">
              <label for="">Vendedor</label>
              <input class="form-control" type="text" id="" name="" readonly>
            </div>
            <div class="col"></div>
            <div class="form-check col-md-1 ">
                <label class="form-check-label mt-4">
                  <input class="form-check-input" id="delivery" type="checkbox">Gratis
                </label>
              </div>
            <div class="form-group col-md-4">
              <label for="">Delivery</label>
              <input class="form-control" type="text" id="monto" name="" placeholder="Monto" >
            </div>
            <div class="form-group col-md-12">
              <label for="">Nota</label>
              <textarea name="" class="form-control" cols="5"></textarea>
            </div>

          </div>
        </div>
         
    </div>
  </div>
   <div class="col-5">
	    <div class="tile">
	      <h3 class="tile-title text-center text-md-left">Productos en la Cesta</h3>
	        <div class="tile-body ">
	        	<div class="table-responsive">
	        		<table class="table">
	        			<tbody style="border-bottom: solid black 2px">
	        				<tr>
	        					<th>Cod.:</th>
	        					<td>087609</td>
	        					<th>Producto:</th>
	        					<td>Barbeador Recargable Resistente al agua - 4x1</td>
	        				</tr>
	        				<tr>
	        					<th>Cantidad:</th>
								<td>9</td>
								<th>Precio:</th>
								<td>9987</td>
							</tr>
							<tr>
								<th>Importe:</th>
								<td colspan="2">23459</td>
								<td>
									<div class="btn-group">
										<a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-trash"></i></a>
										<a class="btn btn-primary" href="{{ route('productos.detalle',2) }}"><i class="m-0 fa fa-lg fa-info"></i></a>
									</div>
								</td>
							</tr>
	        			</tbody>
	        			<tbody style="border-bottom: solid black 2px">
	        				<tr>
	        					<th>Cod.:</th>
	        					<td>087609</td>
	        					<th>Producto:</th>
	        					<td>Barbeador Recargable Resistente al agua - 4x1</td>
	        				</tr>
	        				<tr>
	        					<th>Cantidad:</th>
								<td>9</td>
								<th>Precio:</th>
								<td>9987</td>
							</tr>
							<tr>
								<th>Importe:</th>
								<td colspan="2">23459</td>
								<td>
									<div class="btn-group">
										<a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-trash"></i></a>
										<a class="btn btn-primary" href="{{ route('productos.detalle',2) }}"><i class="m-0 fa fa-lg fa-info"></i></a>
									</div>
								</td>
							</tr>
	        			</tbody>
	        			<tbody style="border-bottom: solid black 2px">
	        				<tr>
	        					<th>Cod.:</th>
	        					<td>087609</td>
	        					<th>Producto:</th>
	        					<td>Barbeador Recargable Resistente al agua - 4x1</td>
	        				</tr>
	        				<tr>
	        					<th>Cantidad:</th>
								<td>9</td>
								<th>Precio:</th>
								<td>9987</td>
							</tr>
							<tr>
								<th>Importe:</th>
								<td colspan="2">23459</td>
								<td>
									<div class="btn-group">
										<a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-trash"></i></a>
										<a class="btn btn-primary" href="{{ route('productos.detalle',2) }}"><i class="m-0 fa fa-lg fa-info"></i></a>
									</div>
								</td>
							</tr>
	        			</tbody>

	        		</table>
	        	</div>
	        	
	        	<div class="row tile-footer">
	        		<div class="col-md-8">
	        			<h4>Total: 0000000</h4>
	        		</div>
	        		<div class=" col-12 col-md-4">
		              <button class="btn btn-primary" type="submit">Guardar</button>
		            </div>
	        	</div>
	        	
	        </div>
	    </div>
   </div>
  
   </form>
</div>

  

@endsection

@push('scripts')
<script type="text/javascript" charset="utf-8" async defer>
    $('#delivery').change(function(){
      if ($('#delivery').prop('checked')){
        
        $('#monto').prop('disabled', true);

      }
      else{
       $('#monto').prop('disabled', false);
      }
    });
  </script>
  
@endpush