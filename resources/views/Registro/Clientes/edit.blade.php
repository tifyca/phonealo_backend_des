@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Editar Cliente')
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
            <div class="form-group col-md-6">
              <label for="nombre_cliente">Nombres</label>
              <input class="form-control read" type="text" id="nombre_cliente" name="nombre_cliente" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="email_cliente">Email</label>
              <input class="form-control read" id="email_cliente" name="email_cliente" type="email" aria-describedby="emailHelp" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="telefono_cliente">Teléfono</label>
              <input class="form-control read" type="text" id="telefono_cliente" name="telefono_cliente" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="ruc_cliente">RUC</label>
              <input class="form-control read" type="text" id="ruc_cliente" name="ruc_cliente" readonly>
            </div>
            <div class="form-group col-12 col-md-3">
              <label for="tipo_cliente">Tipo de Cliente</label>
              <select class="form-control read" id="tipo_cliente" name="tipo_cliente" disabled>
                <option value="">Seleccione</option>
                <option selected value="N">Natural</option>
                <option value="J">Jurídico</option>
              </select>
            </div>
            <div class="form-group col-12 col-md-3">
              <label for="departamento_cliente">Departamento</label>
              <select class="form-control read" id="departamento_cliente" name="departamento_cliente" disabled>
                <option value="">Seleccione</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="ciudad_cliente">Ciudad</label>
              <select class="form-control read" id="ciudad_cliente" name="ciudad_cliente" disabled>
                <option value="">Seleccione</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="barrio_cliente">Barrio</label>
              <select class="form-control read" id="barrio_cliente" name="barrio_cliente" disabled>
                <option value="">Seleccione</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="direccion_cliente">Dirección</label>
              <input class="form-control read" type="text" id="direccion_cliente" name="direccion_cliente" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="ubicacion_cliente">Ubicación</label>
              <input class="form-control read" type="text" id="ubicacion_cliente" name="ubicacion_cliente" readonly>
            </div>
            <div class="form-group col-12">
              <label for="nota_cliente">Nota</label>
              <textarea class="form-control read" id="nota_cliente" name="nota_cliente" rows="3" disabled></textarea>
            </div>
            <div class="tile-footer col-12 pl-3 row">
              <div class="form-check mx-3 mt-2">
                <label class="form-check-label">
                  <input class="form-check-input" id="editar" type="checkbox">Editar
                </label>
              </div>

              <button class="btn btn-primary" type="submit">Guardar</button>
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