@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Clientes')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('registro/clientes/show') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Clientes</h3>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Barrio</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>flfijn</td>
                    <td>08989898009890</td>
                    <td>System Architect</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('clientes.update',2) }}"><i class="fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-globe"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>08989898009890</td>
                    <td>System Architect</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-globe"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>08989898009890</td>
                    <td>System Architect</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-globe"></i></a>
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