@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Editar Imagen')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('galeria/index'))

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
            <div class="col-md-6">
              <div class="row">
                <div class="form-group col-md-8">
                  <label for="titulo_galeria">Título</label>
                  <input class="form-control read" type="text" id="titulo_galeria" name="titulo_galeria" readonly>
                </div>
                <div class="form-group row col-12 col-md-2">
                  <label class="control-label col-md-12">Estatus</label>
                  <div class="col-md-12 ">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input read" value="1" type="radio" id="estatus_galeria" name="estatus_galeria" disabled>Activo
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                         <input class="form-check-input read" value="0" type="radio" id="estatus_galeria" name="estatus_galeria" disabled>Inactivo
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
           <div class="form-group col-md-4 text-center mt-3">
              <img src="{{ asset('img/img-default.png') }}" class="img-fluid " alt="">  
              <div class="form-group mt-4">
                <input type="file" class="form-control-file read" id="imagen_galeria" name="imagen_galeria" disabled>
              </div>
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