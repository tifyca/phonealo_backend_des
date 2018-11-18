 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Resumen de Cierre')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('caja/cierres'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row d-flex justify-content-center">
  <div class="col-12 col-md-7">
    <div class="tile">
        <div class="d-flex justify-content-between">
          <h5 class=" text-left">{{ $user }}</h5>
          <h5 class="text-right">{{ $fecha }}</h5>
        </div>
        <hr>
        <div class="tile-body ">
          <div class="col-12  my-4">
            <table class="table">
              <tbody>
                <tr>
                  <th>Total ingresos efectivo</th>
                  <td>{!!number_format($total_efectivo , 0, ',', '.')!!}</td>                  
                </tr>
                <tr>
                  <th>Total ingreso POS</th>
                  <td>{!!number_format($total_pos , 0, ',', '.')!!}</td>                  
                </tr>
                <tr>
                  <th>Total ingreso Otros</th>
                  <td>{!!number_format($total_otros , 0, ',', '.')!!}</td>
                </tr>
                <tr>
                  <th>Total Salidas</th>
                  <td>{!!number_format($total_salidas , 0, ',', '.')!!}</td>
                </tr>
                <tr>
                  <th>Total Gastos</th>
                  <td>{!!number_format($total_gastos , 0, ',', '.')!!}</td>
                </tr>
                <tr class="table-secondary">
                  <th class="text-right">NETO EFECTIVO EN CAJA</th>
                  <td><b>{!!number_format($total_neto , 0, ',', '.')!!}</b></td>
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