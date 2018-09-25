 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Detalle de Caja')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('caja/abrir'))
@section('display_new','d-none')  @section('link_new', url('') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row">
  <div class="col-12">
    
    <div class="tile">
      <div class="row d-flex justify-content-end">
      <div class="col-3">
       <form action="">
          <div class="form-group">
                <select class="form-control" id="" name="" ">
                  <option value="">Todos los Ingresos</option>
                  <option value="">Ingresos POS</option>}
                  <option value="">Otros Ingresos</option>}
                  <option value="">Total de Salidas</option>
                </select>
              </div>
       </form>
      </div>
    </div>
        
      
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <thead>
                <tr class="table-secondary">
                  <th>Tipo</th>
                  <th>Descripción</th>
                  <th>Referencia/Detalle</th>
                  <th>Importe</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Pago de factura de Getec</td>
                  <td>Lorem</td>
                  <td>Lorem</td>
                  <td> $ 95.000 </td>
                </tr>
                <tr>
                  <td>Diferencia de pago para giro bancario</td>
                  <td>Lorem</td>
                  <td>Lorem</td>
                  <td> $ 185.000 </td>
                </tr>
                <tr>
                  <td>Error de facturacion</td>
                  <td>Lorem</td>
                  <td>Lorem</td>
                  <td> $ 15.000 </td>
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