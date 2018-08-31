@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Remitos')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Remitos</h3>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>Remito</th>
                    <th>Delivery</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Estadp</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0987</td>
                    <td>Nombres</td>
                    <td>9876234</td>
                    <td>00-00-0000</td>
                    <td>Confirmado</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>0987</td>
                    <td>Nombres</td>
                    <td>9876234</td>
                    <td>00-00-0000</td>
                    <td>Confirmado</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>0987</td>
                    <td>Nombres</td>
                    <td>9876234</td>
                    <td>00-00-0000</td>
                    <td>Confirmado</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        
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