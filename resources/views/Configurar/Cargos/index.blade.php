@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Cargos')
@section('descripcion', 'Descripcion Opcional')

{{-- ACCIONES --}}
@section('display_new','d-none')  @section('link_edit', '') 
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Nuevo Cargo</h3>
        <div class="tile-body ">
          <form>
            <div class="row">
              <div class="form-group col-12  col-md-5">
                <label for="exampleSelect1">Cargo</label>
                <select class="form-control" id="exampleSelect1">
                  <option value="">Seleccione</option>}
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group col-12  col-md-5">
                <label class="control-label">Nombre</label>
                <input class="form-control" type="text" placeholder="...">
              </div>
              <div class="tile-footer col-12 col-md-2 text-center border-0" >
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;{{-- <a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a> --}}
              </div>
            </div>
          </form>
        </div>
        
    </div>
  </div>
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Cargos</h3>
        <div class="tile-body ">
          <div class="tile-body">
                 <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Cargo</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td width="10%" class="text-right">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Ashton Cox</td>
                    <td>Junior Technical Author</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Cedric Kelly</td>
                    <td>Senior Javascript Developer</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Airi Satou</td>
                    <td>Accountant</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Brielle Williamson</td>
                    <td>Integration Specialist</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Herrod Chandler</td>
                    <td>Sales Assistant</td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-edit"></i></a>
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

  

@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush