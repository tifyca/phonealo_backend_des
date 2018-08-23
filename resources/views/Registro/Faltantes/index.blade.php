@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Faltantes')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '') 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Faltantes</h3>
        <div class="tile-body ">
          <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Teléfono</th>
                    <th>Nombres</th>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Stock Antes</th>
                    <th>Stock Actual</th>
                    <th>Cantidad</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
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
                    <td>Lorem</td>
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
                    <td>Lorem</td>
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