@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Editar Categoría')
@section('descripcion', 'Descripcion Opcional')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('configurar/categorias'))
@section('display_new','d-none')  @section('link_edit', '') 
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <div class="tile-body ">
          <form>
            <div class="row">
              <div class="form-group col-12  col-md-3">
                <label for="exampleSelect1">Categoría</label>
                <select class="form-control" id="exampleSelect1">
                  <option value="">Seleccione</option>}
                  <option selected>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group col-12 col-md-3">
                <label for="exampleSelect1">Tipo de Categoría</label>
                <select class="form-control" id="exampleSelect1">
                  <option value="">Seleccione</option>}
                  <option>1</option>
                  <option selected>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group col-12  col-md-4">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" value="Valor">
              </div>
              <div class="form-group row col-12 col-md-2">
                  <label class="control-label col-md-12">Status</label>
                  <div class="col-md-12 ">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" checked>Activo
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status">Inactivo
                      </label>
                    </div>
                  </div>
                </div>
              <div class="tile-footer col-12 col-md-12 text-center border-0" >
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Modificar</button>&nbsp;&nbsp;&nbsp;{{-- <a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a> --}}
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