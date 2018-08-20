@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Nuevo Proveedor')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/proveedores'))

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
                <label for="nombre_proveedor">Nombres</label>
                <input class="form-control" type="text" id="nombre_proveedor" name="nombre_proveedor" placeholder="...">
              </div>
              <div class="form-group">
                <label for="direccion_proveedor">Direccion</label>
                <input class="form-control" type="text" id="direccion_proveedor" name="direccion_proveedor" placeholder="...">
              </div>
              <div class="form-group">
                <label for="email_proveedor">Email</label>
                <input class="form-control" id="email_proveedor" name="email_proveedor" type="email" aria-describedby="emailHelp" placeholder="...">
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="telefono_proveedor">Telefono</label>
                <input class="form-control" type="text" id="telefono_proveedor" name="telefono_proveedor" placeholder="...">
              </div>
              <div class="form-group">
                <label for="ruc_proveedor">RUC</label>
                <input class="form-control" type="text" id="ruc_proveedor" name="ruc_proveedor" placeholder="...">
              </div>
              <div class="form-group">
                <label for="ciudad_proveedor">Pais</label>
                <select class="form-control" id="ciudad_proveedor" name="ciudad_proveedor">
                  <option value="">Seleccione</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
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