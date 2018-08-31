@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Descompuestos')
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
      <div class="col mb-3 text-center">
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Descompuestos</h3>
            </div>

            <div class="col-md-2 mr-md-3">
              <button class="btn btn-primary" type=""><i class="m-0 fa fa-lg fa-eye"></i>Enviar Seleccionados</button>
            </div>
          </div>
        </div>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th><input type="checkbox" class="form-control" name="" value="" placeholder=""></th>
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
                    <td><input type="checkbox" class="form-control" name="" value="" placeholder=""></td>
                    <td> 0987</td>
                    <td>00-00-0000</td>
                    <td>00-00-0000</td>
                    <td>Nombre Producto</td>
                    <td>Nota</td>
                    <td>123456787654</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-wrench"></i></a>
                        
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
{{-- <iframe width=“300” scrolling=“no” height=“250” frameborder=“0" src=“https://ads2.contentabc.com/ads?spot_id=5483648&rand=765716860” allowtransparency=“true” marginheight=“0” marginwidth=“0" name=“spot_id_5483648”> </iframe> --}}

  

@endsection

@push('scripts')
  
@endpush