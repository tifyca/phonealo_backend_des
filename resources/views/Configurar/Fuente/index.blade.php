@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Fuentes')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_edit', '') 
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Nueva Fuente</h3>
        <div class="tile-body ">
          <form>
            <div class="row">
               <div class="form-group col-12  col-md-4">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" placeholder="Nombre Fuente">
              </div>
              <div class="form-group row col-12 col-md-2">
                  <label class="control-label col-md-12">Estatus</label>
                  <div class="col-md-12 ">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="Estatus">Activo
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="Estatus">Inactivo
                      </label>
                    </div>
                  </div>
                </div>
              <div class="tile-footer text-center border-0" >
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;{{-- <a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a> --}}
              </div>
            </div>
          </form>
        </div>
        
    </div>
  </div>
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Fuentes</h3>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
             <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Tiger Nixon</td>

                    <td>Activo</td>
                    <td width="10%" class="text-right">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('categorias.update',1) }}"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Garrett Winters</td>

                    <td>Activo</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('categorias.update',1) }}"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Ashton Cox</td>

                    <td>Activo</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('categorias.update',1) }}"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Cedric Kelly</td>

                    <td>Activo</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('categorias.update',1) }}"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Airi Satou</td>

                    <td>Activo</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('categorias.update',1) }}"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Brielle Williamson</td>
  
                    <td>Activo</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('categorias.update',1) }}"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Herrod Chandler</td>
       
                    <td>Activo</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('categorias.update',1) }}"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>       
            </div>
            </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')

@endpush