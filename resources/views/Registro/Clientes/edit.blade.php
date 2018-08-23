@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Ver/Editar Cliente')
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
                <input class="form-control read" type="text" id="nombre_cliente" name="nombre_cliente" value="Nombres" readonly>
              </div>
              <div class="form-group">
                <label for="tipo_cliente">Tipo de Cliente</label>
                <select class="form-control read" id="tipo_cliente" name="tipo_cliente" disabled>
                  <option value="">Seleccione</option>
                  <option selected >1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="direccion_cliente">Dirección</label>
                <input class="form-control read" type="text" id="direccion_cliente" name="direccion_cliente" value="Dirección" readonly>
              </div>
              <div class="form-group">
                <label for="departamento_cliente">Departamento</label>
                <select class="form-control read" id="departamento_cliente" name="departamento_cliente" disabled>
                  <option value="">Seleccione</option>
                  <option>1</option>
                  <option selected>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="email_cliente">Email</label>
                <input class="form-control read" id="email_cliente" name="email_cliente" type="email" aria-describedby="emailHelp" value="Email" readonly>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="telefono_cliente">Teléfono</label>
                <input class="form-control read" type="text" id="telefono_cliente" name="telefono_cliente" value="0987654321" readonly>
              </div>
              <div class="form-group">
                <label for="ruc_cliente">RUC</label>
                <input class="form-control read" type="text" id="ruc_cliente" name="ruc_cliente" value="Example" readonly>
              </div>
              <div class="form-group">
                <label for="ciudad_cliente">Ciudad</label>
                <select class="form-control read" id="ciudad_cliente" name="ciudad_cliente" disabled>
                  <option value="">Seleccione</option>
                  <option >1</option>
                  <option>2</option>
                  <option selected>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="barrio_cliente">Barrio</label>
                <input class="form-control read" type="text" id="barrio_cliente" name="barrio_cliente" value="Barrio" readonly>
              </div>
              <div class="form-group">
                <label for="ubicacion_cliente">Ubicación</label>
                <input class="form-control read" type="text" id="ubicacion_cliente" name="ubicacion_cliente" value="Ubicacion" readonly>
              </div>

            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="nota_cliente">Nota</label>
                <textarea class="form-control read" id="nota_cliente" name="nota_cliente" rows="3" readonly>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis consectetur, repellendus. Rem quos dolorem velit consequuntur tempora doloremque nam error, animi cum, consequatur harum necessitatibus, reprehenderit dignissimos facilis nemo incidunt!</textarea>
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