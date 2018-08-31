@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Editar producto')
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
            <div class="col-md-8">
              <div class="row">
                <div class="form-group col-md-3">
                  <label for="codigo_producto">Código Producto</label>
                  <input class="form-control read" type="text" id="codigo_producto" name="codigo_producto" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="nombre_producto">Nombre Producto</label>
                  <input class="form-control read" type="text" id="nombre_producto" name="nombre_producto" readonly>
                </div>
                <div class="form-group col-md-3">
                  <label for="cod_barra_producto">Código de Barras</label>
                  <input class="form-control read" type="text" id="cod_barra_producto" name="cod_barra_producto" readonly>
                </div>
                <div class="form-group col-md-3">
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
                <div class="form-group col-md-3">
                  <label for="categoria_producto">Subcategoría</label>
                  <select class="form-control read" id="categoria_producto" name="categoria_producto" disabled>
                    <option value="">Seleccione</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="precio_minimo_producto">Precio Mínimo</label>
                  <input class="form-control read" id="precio_minimo_producto" name="precio_minimo_producto" type="text" readonly>
                </div>
                <div class="form-group col-md-3">
                  <label for="precio_ideal_producto">Precio Ideal</label>
                  <input class="form-control read" type="text" id="precio_ideal_producto" name="precio_ideal_producto" readonly>
                </div>
                <div class="form-group col-12">
                  <label for="descripcion_producto">Descripción</label>
                  <textarea class="form-control read" id="descripcion_producto" name="descripcion_producto" rows="8" disabled>TINY</textarea>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="row">
                <label for="imagen_producto">Imagen del Producto</label>
                <div class="form-group col-12 text-center mt-3">
                  
                  <img src="{{ asset('img/img-default.png') }}" class="img-fluid " alt="">
                    
                    <div class="form-group mt-4">
                      <input type="file" class=" read-file read" id="imagen_producto" name="imagen_producto" disabled>
                    </div>
                </div>
                <div class="tile-footer d-flex align-items-center col-12">
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