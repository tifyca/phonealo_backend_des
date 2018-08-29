@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Entradas')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','')  @section('link_new', url('inventario/entradas/show') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Entradas</h3>
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="" name="">
                <option value="">Tipo</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="" name="">
                <option value="">Proveedor</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <input class="form-control" type="date" name="">
            </div>
          </div>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>N° Doc.</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Estatus</th>
                    <th>Monto</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>009809</td>
                    <td>Tipo</td>
                    <td>00-00-0000</td>
                    <td>Proveedor</td>
                    <td>Estatus</td>
                    <td>123456</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        {{-- <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-globe"></i></a> --}}
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>009809</td>
                    <td>Tipo</td>
                    <td>00-00-0000</td>
                    <td>Proveedor</td>
                    <td>Estatus</td>
                    <td>123456</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        {{-- <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-globe"></i></a> --}}
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>009809</td>
                    <td>Tipo</td>
                    <td>00-00-0000</td>
                    <td>Proveedor</td>
                    <td>Estatus</td>
                    <td>123456</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        {{-- <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-globe"></i></a> --}}
                      </div>
                    </td>
                  </tr>
                  <tr class="table-secondary">
                    <td colspan="5" class="text-right"><b>Total Importe</b></td>
                    <td colspan="2"><b>987654</b></td>
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