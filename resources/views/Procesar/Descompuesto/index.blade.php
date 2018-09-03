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
              <button class="btn btn-primary" data-toggle="modal" data-target="#ModalDescompuesto" type=""><i class="fa fa-lg fa-eye"></i>Enviar Seleccionados</button>
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
                    <th>Nota</th>
                    <th>Valor</th>
                    
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
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalDescompuesto" href="#"><i class="m-0 fa fa-lg fa-wrench"></i></a>
                        
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
<div class="modal fade" id="ModalDescompuesto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reporte de Descompuestos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe width="100%" height="500px" src="{{ asset('archivos/pdf.pdf') }}"></iframe>
      </div>
    </div>
  </div>
</div>
{{--  --}}

  

@endsection

@push('scripts')
  
@endpush