@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Ver/Editar Producto')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_show', '') @section('link_back', url('registro/productos'))

@section('display_new','d-none')  @section('link_edit', url('')) 
@section('display_edit', 'd-none')    @section('link_new', url(''))
@section('display_trash','d-none')    @section('link_trash', url(''))

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
      <div class="tile-body ">
        <form>
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="codigo_producto">Código Producto</label>
                <input class="form-control read" type="text" id="codigo_producto" name="codigo_producto" readonly>
              </div>
              <div class="form-group">
                <label for="categoria_producto">Categoría</label>
                <select class="form-control read" id="categoria_producto" name="categoria_producto" disabled>
                  <option value="">Seleccione</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="stock_minimo_producto">Stock Mínimo</label>
                <input class="form-control read" type="text" id="stock_minimo_producto" name="stock_minimo_producto" readonly>
              </div>
              <div class="form-group">
                <label for="precio_minimo_producto">Precio Mínimo</label>
                <input class="form-control read" id="precio_minimo_producto" name="precio_minimo_producto" type="text" readonly>
              </div>
              <div class="form-group">
                <label for="cantidad_mayorista_producto">Cantidad Mayorista</label>
                <input class="form-control read" id="cantidad_mayorista_producto" name="cantidad_mayorista_producto" type="text" readonly>
              </div>
              
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="nombre_producto">Nombre Producto</label>
                <input class="form-control read" type="text" id="nombre_producto" name="nombre_producto" readonly>
              </div>
              <div class="form-group">
                <label for="tienda_producto">Tienda</label>
                <select class="form-control read" id="tienda_producto" name="tienda_producto" disabled>
                  <option value="">Seleccione</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="stock_activo_producto">Stock Activo</label>
                <input class="form-control read" type="text" id="stock_activo_producto" name="stock_activo_producto" readonly>
              </div>
              <div class="form-group">
                <label for="precio_ideal_producto">Precio Ideal</label>
                <input class="form-control read" type="text" id="precio_ideal_producto" name="precio_ideal_producto" readonly>
              </div>
              <div class="form-group">
                <label for="precio_compra_producto">Precio Compra</label>
                <input class="form-control read" type="text" id="precio_compra_producto" name="precio_compra_producto" readonly>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="descripcion_producto">Descripción</label>
                <textarea class="form-control read" disabled id="descripcion_producto" name="descripcion_producto" rows="3"></textarea>
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