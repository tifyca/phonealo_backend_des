@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Nuevo Cliente')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('registro/clientes'))

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
                <label for="nombre_cliente">Nombres</label>
                <input class="form-control" type="text" id="nombre_cliente" name="nombre_cliente" placeholder="...">
              </div>
              <div class="form-group">
                <label for="tipo_cliente">Tipo de Cliente</label>
                <select class="form-control" id="tipo_cliente" name="tipo_cliente">
                  <option value="">Seleccione</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="direccion_cliente">Dirección</label>
                <input class="form-control" type="text" id="direccion_cliente" name="direccion_cliente" placeholder="...">
              </div>
              <div class="form-group">
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
              <div class="form-group">
                <label for="email_cliente">Email</label>
                <input class="form-control" id="email_cliente" name="email_cliente" type="email" aria-describedby="emailHelp" placeholder="...">
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="telefono_cliente">Teléfono</label>
                <input class="form-control" type="text" id="telefono_cliente" name="telefono_cliente" placeholder="...">
              </div>
              <div class="form-group">
                <label for="ruc_cliente">RUC</label>
                <input class="form-control" type="text" id="ruc_cliente" name="ruc_cliente" placeholder="...">
              </div>
              <div class="form-group">
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
              <div class="form-group">
                <label for="barrio_cliente">Barrio</label>
                <input class="form-control" type="text" id="barrio_cliente" name="barrio_cliente" placeholder="...">
              </div>
              <div class="form-group">
                <label for="ubicacion_cliente">Ubicación</label>
                <input class="form-control" type="text" id="ubicacion_cliente" name="ubicacion_cliente" placeholder="...">
              </div>

            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="nota_cliente">Nota</label>
                <textarea class="form-control" id="nota_cliente" name="nota_cliente" rows="3"></textarea>
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