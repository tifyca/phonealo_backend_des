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
                <label for="nombre_producto">Nombres</label>
                <input class="form-control read" type="text" id="nombre_producto" name="nombre_producto" placeholder="..." readonly>
              </div>
              <div class="form-group">
                <label for="direccion_producto">Direccion</label>
                <input class="form-control read" type="text" id="direccion_producto" name="direccion_producto" placeholder="..." readonly>
              </div>
              <div class="form-group">
                <label for="email_producto">Email</label>
                <input class="form-control read" id="email_producto" name="email_producto" type="email" aria-describedby="emailHelp" placeholder="..." readonly>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="telefono_producto">Telefono</label>
                <input class="form-control read" type="text" id="telefono_producto" name="telefono_producto" placeholder="..." readonly>
              </div>
              <div class="form-group">
                <label for="ruc_producto">RUC</label>
                <input class="form-control read" type="text" id="ruc_producto" name="ruc_producto" placeholder="..." readonly>
              </div>
              <div class="form-group">
                <label for="ciudad_producto">Pais</label>
                <select class="form-control read" id="ciudad_producto" name="ciudad_producto" disabled>
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