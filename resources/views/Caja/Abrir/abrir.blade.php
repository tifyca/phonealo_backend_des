 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Caja')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_new', url('') ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row">
  <div class="col-12 col-md-7">
    <div class="tile">
        <div class="d-flex justify-content-between">
          <h5 class=" text-left">Nombre Usuario</h5>
          <h5 class="text-right">08/08/2018</h5>
        </div>
        <hr>
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <tbody>
                <tr>
                  <th>Total ingresos efectivo</th>
                  <td> $ 1.000.000 </td>
                </tr>
                <tr>
                  <th>Total ingreso POS</th>
                  <td> $ 250.000 </td>
                </tr>
                <tr>
                  <th>Total ingreso Otros</th>
                  <td> $ 100.000 </td>
                </tr>
                <tr>
                  <th>Total Salidas</th>
                  <td> $ 295.000 </td>
                </tr>
                <tr>
                  <th>Total Gastos</th>
                  <td> $ 122.000 </td>
                </tr>
                <tr class="table-secondary">
                  <th class="text-right">NETO EFECTIVO EN CAJA</th>
                  <td><b>$ 583.000</b></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
  <div class="col-12 col-md-5">
    <div class="row ">
      <div class="col-12">
        <a href="{{ route('caja.remitos') }}" title="" class="link-card">
          <div class="widget-small primary"><i class="icon fa fa-file fa-3x"></i>
            <div class="info">
              <h4>Registrar Cobro de Remitos</h4>
            </div>
          </div>
        </a>
      </div>
      <div class="col-12"> 
        <a href="" title="" class="link-card">
          <div class="widget-small info "><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Registrar Gastos</h4>
            </div>
          </div>
        </a>
      </div>
      <div class="col-12">
        <a href="{{ route('caja.salida') }}" title="" class="link-card">
          <div class="widget-small  warning"><i class="icon fa fa-file-o fa-3x"></i>
            <div class="info">
              <h4>Salidas</h4>
            </div>
          </div>
        </a>
      </div>
      <div class="col-12">
        <a href="{{ route('caja.cerrar') }}" title="" class="link-card">
          <div class="widget-small danger "><i class="icon fa fa-close fa-3x"></i>
            <div class="info">
              <h4>Cerrar Caja</h4>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="tile">
        
      <h3 class="tile-title text-center text-md-left">Salidas de Caja en Efectivo </h3>
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <thead>
                <tr class="table-secondary">
                  <th>Descripción</th>
                  <th>Importe</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Pago de factura de Getec</td>
                  <td> $ 95.000 </td>
                </tr>
                <tr>
                  <td>Diferencia de pago para giro bancario</td>
                  <td> $ 185.000 </td>
                </tr>
                <tr>
                  <td>Error de facturacion</td>
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