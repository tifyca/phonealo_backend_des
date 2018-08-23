@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Nuevo producto')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/productos'))

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
                <input class="form-control" type="text" id="codigo_producto" name="codigo_producto" placeholder="...">
              </div>
              <div class="form-group">
                <label for="categoria_producto">Categoría</label>
                <select class="form-control" id="categoria_producto" name="categoria_producto">
                  <option value="">Seleccione</option>}
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="stock_minimo_producto">Stock Mínimo</label>
                <input class="form-control" type="text" id="stock_minimo_producto" name="stock_minimo_producto" placeholder="...">
              </div>
              <div class="form-group">
                <label for="precio_minimo_producto">Precio Mínimo</label>
                <input class="form-control" id="precio_minimo_producto" name="precio_minimo_producto" type="text" placeholder="...">
              </div>
              <div class="form-group">
                <label for="cantidad_mayorista_producto">Cantidad Mayorista</label>
                <input class="form-control" id="cantidad_mayorista_producto" name="cantidad_mayorista_producto" type="text" placeholder="...">
              </div>
              
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="nombre_producto">Nombre Producto</label>
                <input class="form-control" type="text" id="nombre_producto" name="nombre_producto" placeholder="...">
              </div>
              <div class="form-group">
                <label for="tienda_producto">Tienda</label>
                <select class="form-control" id="tienda_producto" name="tienda_producto">
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
                <input class="form-control" type="text" id="stock_activo_producto" name="stock_activo_producto" placeholder="...">
              </div>
              <div class="form-group">
                <label for="precio_ideal_producto">Precio Ideal</label>
                <input class="form-control" type="text" id="precio_ideal_producto" name="precio_ideal_producto" placeholder="...">
              </div>
              <div class="form-group">
                <label for="precio_compra_producto">Precio Compra</label>
                <input class="form-control" type="text" id="precio_compra_producto" name="precio_compra_producto" placeholder="...">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="descripcion_producto">Descripción</label>
                <textarea class="form-control" id="descripcion_producto" name="descripcion_producto" rows="3"></textarea>
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