@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Carga de Producto')
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
                <label for="cantidad_carga_producto">Cantidad</label>
                <input class="form-control" type="text" id="cantidad_carga_producto" name="cantidad_carga_producto" placeholder="...">
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="precio_carga_producto">Precio</label>
                <input class="form-control" type="text" id="precio_carga_producto" name="precio_carga_producto" placeholder="...">
              </div>
            </div>
            <div class="col-12">
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