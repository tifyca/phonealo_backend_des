@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Logistica')
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
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>Venta</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Fecha</th>
                    <th>Fecha Activo</th>
                    <th>Ciudad</th>
                    <th>Horario</th>
                    <th>Forma Pago</th>
                    <th>Importe</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr >
                    <td>Venta</td>
                    <td>Cliente</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>Fecha</td>
                    <td>Fecha Activo</td>
                    <td>Ciudad</td>
                    <td>Horario</td>
                    <td>Forma Pago</td>
                    <td>Importe</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalProductos" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalFactura" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregar" href="#"><i class="m-0 fa fa-lg fa-plus"></i></a>
                        <a class="btn btn-primary" href="{{ route('editar_logistica') }}"><i class="m-0 fa fa-lg fa-pencil"></i></a> 
                      </div>
                    </td>
                  </tr>
                  <tr class="table-primary">
                    <td>Venta</td>
                    <td>Cliente</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>Fecha</td>
                    <td>Fecha Activo</td>
                    <td>Ciudad</td>
                    <td>Horario</td>
                    <td>Forma Pago</td>
                    <td>Importe</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalProductos" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalFactura" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregar" href="#"><i class="m-0 fa fa-lg fa-plus"></i></a>
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-pencil"></i></a> 
                      </div>
                    </td>
                  </tr>
                  <tr class="table-secondary">
                    <td>Venta</td>
                    <td>Cliente</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>Fecha</td>
                    <td>Fecha Activo</td>
                    <td>Ciudad</td>
                    <td>Horario</td>
                    <td>Forma Pago</td>
                    <td>Importe</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalProductos" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalFactura" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregar" href="#"><i class="m-0 fa fa-lg fa-plus"></i></a>
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-pencil"></i></a> 
                      </div>
                    </td>
                  </tr>
                  <tr class="table-success">
                    <td>Venta</td>
                    <td>Cliente</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>Fecha</td>
                    <td>Fecha Activo</td>
                    <td>Ciudad</td>
                    <td>Horario</td>
                    <td>Forma Pago</td>
                    <td>Importe</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalProductos" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalFactura" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregar" href="#"><i class="m-0 fa fa-lg fa-plus"></i></a>
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-pencil"></i></a> 
                      </div>
                    </td>
                  </tr>
                  <tr class="table-danger">
                    <td>Venta</td>
                    <td>Cliente</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>Fecha</td>
                    <td>Fecha Activo</td>
                    <td>Ciudad</td>
                    <td>Horario</td>
                    <td>Forma Pago</td>
                    <td>Importe</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalProductos" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalFactura" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregar" href="#"><i class="m-0 fa fa-lg fa-plus"></i></a>
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-pencil"></i></a> 
                      </div>
                    </td>
                  </tr>
                  <tr class="table-warning">
                    <td>Venta</td>
                    <td>Cliente</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>Fecha</td>
                    <td>Fecha Activo</td>
                    <td>Ciudad</td>
                    <td>Horario</td>
                    <td>Forma Pago</td>
                    <td>Importe</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalProductos" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalFactura" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregar" href="#"><i class="m-0 fa fa-lg fa-plus"></i></a>
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-pencil"></i></a> 
                      </div>
                    </td>
                  </tr>
                  <tr class="table-info">
                    <td>Venta</td>
                    <td>Cliente</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>Fecha</td>
                    <td>Fecha Activo</td>
                    <td>Ciudad</td>
                    <td>Horario</td>
                    <td>Forma Pago</td>
                    <td>Importe</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalProductos" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalFactura" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregar" href="#"><i class="m-0 fa fa-lg fa-plus"></i></a>
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-pencil"></i></a> 
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

<!-- Modal -->
<div class="modal fade" id="ModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table">
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
<div class="modal fade" id="ModalFactura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row d-flex justify-content-center">
          <div class="form-group col-md-6">
            <label for="">Nro. Factura</label>
            <input class="form-control" type="text" id="" name="" placeholder="0987654">
          </div>
          <div class="tile-footer col-md-12 text-center ">
            <button class="btn btn-primary" type="submit">Generar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{--  --}}
<div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="tile-title text-center text-md-left">Venta</h3>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Venta</th>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Horario</th>
                <th>Forma Pago</th>
                <th>Importe</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Venta</td>
                <td>Cliente</td>
                <td>Teléfono</td>
                <td>Dirección</td>
                <td>Ciudad</td>
                <td>Horario</td>
                <td>Forma Pago</td>
                <td>Importe</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-print"></i></a>
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-minus"></i></a>
                    <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-sign-in"></i></a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="d-flex justify-content-center col-12 border-top">
          <div class=" col-11 table-responsive mt-3">
            <h3 class="tile-title text-center text-md-left">Productos</h3>
            <table class="table">
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
</div>

  

@endsection

@push('scripts')
  
@endpush