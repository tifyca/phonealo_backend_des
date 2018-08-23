@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', ' Gastos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('registro/gastos/show')) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Gastos</h3>
        <div class="tile-body ">
          <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th>Comprobante</th>
                    <th>Categoría</th>
                    <th>Proveedor</th>
                    <th>Usuario</th>
                    <th>Importe</th>
                    <th>Divisa</th>
                    <th>Fecha de Comprobante</th>
                    <th>Fecha de Carga</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td width="10%" class="text-right">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('gastos.update',1) }}"><i class="fa fa-lg fa-edit"></i></a>
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td>Lorem</td>
                    <td width="10%" class="text-right">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('gastos.update',1) }}"><i class="fa fa-lg fa-edit"></i></a>
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