@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Descompuestos - Soporte')
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
        <h3 class="tile-title">Listado de Soporte</h3>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>N° Caso</th>
                    <th>Fecha Cambio</th>
                    <th>Fecha Pedido</th>
                    <th>Producto</th>
                    <th>Valor</th>
                    <th>Nota</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0987</td>
                    <td>00-00-0000</td>
                    <td>00-00-0000</td>
                    <td>Soporte portable flexible p/ celular - blanco</td>
                    <td>123456787654</td>
                    <td>Nota</td>
                    <form action="">
                      <td width="20%">
                        <div class="row">
                          <div class="form-group col-7 m-0">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" value="1" type="radio" id="EstatusCargo" name="rep">Sin reparar
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                   <input class="form-check-input" value="0" type="radio" id="EstatusCargo2" name="rep">Reparado
                                </label>
                              </div>
                            </div>
                          <div class="btn-group col-3">
                            <button  class="btn btn-primary" type="submit"><i class="m-0 fa fa-lg fa-check"></i></button>
                          </div>
                        </div>
                      </td>
                    </form>
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