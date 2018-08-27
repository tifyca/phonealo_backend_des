@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Estados')
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
        <h3 class="tile-title">Listado de Estados</h3>
        <div class="tile-body ">
          <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Tiger Nixon</td>
                  </tr>
                  <tr>
                    <td>Garrett Winters</td>
                  </tr>
                  <tr>
                    <td>Ashton Cox</td>
                  </tr>
                  <tr>
                    <td>Cedric Kelly</td>
                  </tr>
                  <tr>
                    <td>Airi Satou</td>
                  </tr>
                  <tr>
                    <td>Brielle Williamson</td>
                  </tr>
                  <tr>
                    <td>Herrod Chandler</td>
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
 
@endpush