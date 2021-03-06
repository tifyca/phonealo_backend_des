@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Nuevo Gasto')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/gastos'))
@section('display_new','d-none')  @section('link_new', '') 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  
  <div class="col-12">
    <div class="tile">
        <div class="tile-body ">
              <form>
                <div class="col-12 ">
                <div class="row">
                  
                    <div class="form-group col-md-6">
                      <label for="categoria_gasto">Categoría de Gastos</label>
                      <select class="form-control" id="categoria_gasto" name="categoria_gasto">
                        <option value="">Seleccione</option>}
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="descripcion_gasto">Descripción</label>
                      <input class="form-control" type="text" id="descripcion_gasto" name="descripcion_gasto" placeholder="...">
                    </div>
                    
                    <div class="form-group col-md-4">
                      <label for="comprobante_gasto">Comprobante</label>
                      <input class="form-control" type="text" id="comprobante_gasto" name="comprobante_gasto" placeholder="...">
                    </div>
                
                    

                    <div class="form-group col-md-4">
                      <label for="proveedor_gasto">Fuente</label>
                      <select class="form-control" id="proveedor_gasto" name="proveedor_gasto">
                        <option value="">Seleccione</option>}
                        <option>Caja Principal</option>
                        <option>Caja Chica</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="importe_gasto">Imnporte</label>
                      <input class="form-control" type="text" id="importe_gasto" name="importe_gasto" placeholder="...">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="fecha_comprobante_gasto">Fecha Comprobante</label>
                      <input class="form-control" type="date" id="fecha_comprobante_gasto" name="fecha_comprobante_gasto">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="divisa_gasto">Divisa</label>
                      <select class="form-control" id="divisa_gasto" name="divisa_gasto">
                        <option value="">Seleccione</option>}
                        <option>Guaranies</option>
                        <option>Dólares</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="cambio_gasto">Cambio</label>
                      <input class="form-control" type="text" id="cambio_gasto" name="cambio_gasto" placeholder="...">
                    </div>
                   
                 
                    <div class="form-group col-md-12">
                      <label for="observaciones_gastos">Observaciones</label>
                      <textarea class="form-control" id="observaciones_gastos" name="observaciones_gastos" rows="3"></textarea>
                    </div>
                    <div class="tile-footer col-md-12">
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