@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Informe de Cierre')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('caja/cierres'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
          <h4 class=" text-center">Ventas cobradas</h4>
          <h4 class="text-center">Total : 12345</h4>
        <div class="d-flex justify-content-between mb-2">
          <h5 class=" text-left">Nombre Usuario</h5>
          <h5 class="text-right">08/08/2018</h5>
        </div>
        <div class="tile-body mt-4">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>N° venta </th>
                    <th>Importe</th>
                    <th>Forma de pago</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>30101</td>
                    <td>50000</td>
                    <td>Efectivo/POS: Ref.00009/Otros: Lorem</td>
                     <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Modificado" href="{{ route('caja.cierre.informe.modificado') }}"><i class="m-0 fa fa-lg fa-exclamation"></i></a>
                      </div>
                    </td>
                  </tr>
                   <tr>
                    <td>30101</td>
                    <td>50000</td>
                    <td>Efectivo/POS: Ref.00009/Otros: Lorem</td>
                     <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                      </div>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
  <div class="col-6">
    <div class="tile">
        <h4 class=" text-center">Total Gastos: 123456</h4>
        <div class="tile-body mt-4">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th>Importe</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Compra de papel</td>
                    <td>50000</td>
                  </tr>
                  <tr>
                    <td>Pago de encomienda</td>
                    <td>1234567</td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
  <div class="col-6">
    <div class="tile">
        <h4 class=" text-center">Total Salidas: 123456</h4>
        <div class="tile-body mt-4">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th>Importe</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Diferencia para giro</td>
                    <td>50000</td>
                  </tr>
                  <tr>
                    <td>Efectivo para GETEC</td>
                    <td>1234567</td>
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