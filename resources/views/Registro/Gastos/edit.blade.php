@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Ver/Editar Gasto')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_show', '') @section('link_back', url('registro/gastos'))

@section('display_new','d-none')  @section('link_edit', url('')) 
@section('display_edit', 'd-none')    @section('link_new', url(''))
@section('display_trash','d-none')    @section('link_trash', url(''))

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
         <form>
          <div class="col-12">
                <div class="row">
                  
                    <div class="form-group col-md-6">
                      <label for="categoria_gasto">Categoría de Gastos</label>
                      <select class="form-control read" id="categoria_gasto" name="categoria_gasto" disabled>
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
                      <input class="form-control read" type="text" id="descripcion_gasto" name="descripcion_gasto" readonly>
                    </div>
                    
                    <div class="form-group col-md-4">
                      <label for="comprobante_gasto">Comprobante</label>
                      <input class="form-control read" type="text" id="comprobante_gasto" name="comprobante_gasto" readonly>
                    </div>
                    
                    
                  
                    <div class="form-group col-md-4">
                      <label for="proveedor_gasto">Fuente</label>
                      <select class="form-control read" id="proveedor_gasto" name="proveedor_gasto" disabled>
                        <option value="">Seleccione</option>}
                        <option>Caja Principal</option>
                        <option>Caja Chica</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="importe_gasto">Imnporte</label>
                      <input class="form-control read" type="text" id="importe_gasto" name="importe_gasto" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="fecha_comprobante_gasto">Fecha Comprobante</label>
                      <input class="form-control read" type="date" id="fecha_comprobante_gasto" name="fecha_comprobante_gasto" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="divisa_gasto">Divisa</label>
                      <select class="form-control read" id="divisa_gasto" name="divisa_gasto" disabled>
                        <option value="">Seleccione</option>}
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="cambio_gasto">Cambio</label>
                      <input class="form-control read" type="text" id="cambio_gasto" name="cambio_gasto" readonly>
                    </div>
                   
                  
                    <div class="form-group col-md-12">
                      <label for="observaciones_gastos">Observaciones</label>
                      <textarea class="form-control read" id="observaciones_gastos" name="observaciones_gastos" rows="3" disabled></textarea>
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