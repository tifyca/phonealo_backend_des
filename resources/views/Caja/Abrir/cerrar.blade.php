 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Cerrar Caja')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('caja/abrir'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row d-flex justify-content-center">
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
          <hr>
          <div class="col-12">
            <form action="">
              <textarea name="" class="form-control" rows="4" placeholder="Obersaciones"></textarea>
              
              <div class="col-12 text-center mt-4">
                <a href="" class="btn btn-primary" title="">Confirmar Cierre</a>
              </div>
              
            </form>
          </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')
  
@endpush