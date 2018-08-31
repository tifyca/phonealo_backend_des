@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Ver/Editar Proveedor')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_show', '') @section('link_back', url('registro/proveedores'))

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
                <label for="nombre_proveedor">Nombres</label>
                <input class="form-control read" type="text" id="nombre_proveedor" name="nombre_proveedor" placeholder="..." readonly>
              </div>
               <div class="form-group col-md-6">
                <label for="email_proveedor">Email</label>
                <input class="form-control read" id="email_proveedor" name="email_proveedor" type="email" aria-describedby="emailHelp" placeholder="..." readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="direccion_proveedor">Dirección</label>
                <input class="form-control read" type="text" id="direccion_proveedor" name="direccion_proveedor" placeholder="..." readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="telefono_proveedor">Teléfono</label>
                <input class="form-control read" type="text" id="telefono_proveedor" name="telefono_proveedor" placeholder="..." readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="ruc_proveedor">RUC</label>
                <input class="form-control read" type="text" id="ruc_proveedor" name="ruc_proveedor" placeholder="..." readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="ciudad_proveedor">País</label>
                <select class="form-control read" id="ciudad_proveedor" name="ciudad_proveedor" disabled>
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