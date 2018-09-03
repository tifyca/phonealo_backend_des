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

  <div class="col-12 ">
    <div class="tile">
      <div class="col mb-3 text-center">
          <div class="row">
            <div class="col">
              <h3 class="tile-title text-center text-md-left">Listado de Remitos</h3>
            </div>
            <div class="form-group col-md-2">
              <input class="form-control" type="text" id="" name="" placeholder="Remito">
            </div>
            <div class="form-group col-md-2">
              <input class="form-control" type="text" id="" name="" placeholder="Delivery">
            </div>
            <div class="form-group col-md-2">
              <input class="form-control" type="date" id="" name="" >
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="" name="">
                <option value="">Estado</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>
        </div>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>Remito</th>
                    <th>Delivery</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Importe</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0987</td>
                    <td>Nombres</td>
                    <td>00-00-0000</td>
                    <td>Confirmado</td>
                    <td>9876234</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalProductos" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-right">
                      <h4>Total:</h4>
                    </td>
                    <td colspan="2"><h4>0987654</h4></td>
                  </tr>
                </tbody>
              </table>
            </div>
            </div>
        </div>
    </div>
  </div>

 
</div>

<!-- Modal -->
<div class="modal fade" id="ModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ventas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Venta</th>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Importe</th>
                <th>Forma de Pago</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Venta</td>
                <td>Cliente</td>
                <td>Teléfono</td>
                <td>Importe</td>
                <td>Forma de Pago</td>
                <td>Fecha</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="m-0 fa fa-lg fa-eye"></i></a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="collapse table-responsive px-4" id="collapseExample" >
          <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
           <table class="table ">
            <thead>
              <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Código</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-file"></i></a>
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-times"></i></a>
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
{{--  --}}

  

@endsection

@push('scripts')
  
@endpush